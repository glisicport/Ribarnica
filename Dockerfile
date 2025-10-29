# Koristimo PHP 8.2 CLI kao base image
FROM php:8.2-cli

# Postavljamo radni direktorijum
WORKDIR /var/www/html

# Instaliramo sistemske zavisnosti
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libpq-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instaliramo PHP ekstenzije potrebne za Laravel
RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip

# Instaliramo Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Kopiramo celu aplikaciju
COPY ./app .

# Kreiramo entrypoint skriptu
RUN echo '#!/bin/bash\n\
set -e\n\
\n\
# Proveravamo da li vendor folder postoji i nije prazan\n\
if [ ! -d "vendor" ] || [ -z "$(ls -A vendor)" ]; then\n\
    echo "Vendor folder je prazan ili ne postoji. Pokrećem composer install..."\n\
    composer install --no-interaction --optimize-autoloader --no-dev\n\
else\n\
    echo "Vendor folder već postoji."\n\
fi\n\
\n\
# Postavljamo permissions\n\
chown -R www-data:www-data /var/www/html\n\
chmod -R 755 /var/www/html/storage\n\
chmod -R 755 /var/www/html/bootstrap/cache\n\
\n\
# Pokrećemo glavni proces\n\
exec "$@"' > /usr/local/bin/docker-entrypoint.sh \
    && chmod +x /usr/local/bin/docker-entrypoint.sh

# Postavljamo permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Eksponujemo port 8000 za Laravel development server
EXPOSE 8000

# Koristimo custom entrypoint
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]

# Pokrećemo Laravel development server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
