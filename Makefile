APP_CONTAINER=ribarnica-app
DB_CONTAINER=ribarnica-db

# Pokretanje kontejnera
up:
	docker-compose up -d --build

down:
	docker-compose down

logs:
	docker-compose logs -f

ps:
	docker-compose ps

exec:
	docker exec -it $(APP_CONTAINER) bash

# Composer komande
composer-install:
	docker exec -it -w /var/www/html $(APP_CONTAINER) composer install

composer-update:
	docker exec -it -w /var/www/html $(APP_CONTAINER) composer update

composer-dump:
	docker exec -it -w /var/www/html $(APP_CONTAINER) composer dump-autoload

# Lokalna composer instalacija (za IDE)
composer-local:
	cd app && composer install
	@echo "Vendor folder instaliran lokalno za IDE!"

# Laravel migracije i seed
migrate:
	docker exec -it -w /var/www/html $(APP_CONTAINER) php artisan migrate

migrate-fresh:
	docker exec -it -w /var/www/html $(APP_CONTAINER) php artisan migrate:fresh

tinker:
	docker exec -it -w /var/www/html $(APP_CONTAINER) php artisan tinker

key:
	docker exec -it -w /var/www/html $(APP_CONTAINER) php artisan key:generate

env:
	copy .env.example app\.env

mysql:
	docker exec -it $(DB_CONTAINER) mysql -uadmin -padmin ribarnica

seed:
	docker exec -it -w /var/www/html $(APP_CONTAINER) php artisan db:seed

composer:
	if not exist app\vendor mkdir app\vendor
	docker cp ribarnica-app:/var/www/html/vendor/. app\vendor


# Kombinovani cilj za pripremu baze
baza: migrate 
	@echo "Baza spremna!"

# Novi build cilj
build: env up key 
	@echo "Projekat izgradjen i baza spremna!"

# Dev setup sa lokalnim vendor-om
dev-setup: env up key composer-local
	@echo "Development okruzenje spremno sa lokalnim vendor folderom!"