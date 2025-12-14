APP_CONTAINER=ribarnica-app
DB_CONTAINER=ribarnica-db

# -------------------------------
# Pokretanje i zaustavljanje
# -------------------------------
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

# -------------------------------
# Composer komande
# -------------------------------
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

# -------------------------------
# Laravel migracije i seed
# -------------------------------
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

# Kopiranje vendor foldera iz Dockera
composer:
	if not exist app\vendor mkdir app\vendor
	docker cp $(APP_CONTAINER):/var/www/html/vendor/. app\vendor

# -------------------------------
# Kreiranje modela, kontrolera i tabele preko Dockera
# -------------------------------

# -------------------------------

# Kreira model + migraciju, koristi argument MODEL=ImeModela
model:
	docker exec -it -w /var/www/html $(APP_CONTAINER) php artisan make:model $(MODEL) -m
	@echo "Model $(MODEL) kreiran!"

# Kreira kontroler, koristi argument CONTROLLER=ImeKontrolera
controller:
	docker exec -it -w /var/www/html $(APP_CONTAINER) php artisan make:controller $(CONTROLLER)
	@echo "Kontroler $(CONTROLLER) kreiran!"

# Kreira model + migraciju za tabelu, koristi argument MODEL=ImeModela
table:
	docker exec -it -w /var/www/html $(APP_CONTAINER) php artisan make:model $(MODEL) -m
	@echo "Model $(MODEL) i migracija kreirani!"
	@echo "Uredi migraciju u database/migrations i dodaj kolone pre pokretanja migrate."

# Rollback poslednje migracije (brisanje tabele)
drop-table:
	docker exec -it -w /var/www/html $(APP_CONTAINER) php artisan migrate:rollback --step=1
	@echo "Rollback poslednje migracije izvršen!""

# -------------------------------
# Kombinovani ciljevi
# -------------------------------
baza: migrate
	@echo "Baza spremna!"
storage:
	docker cp .\storage\ ribarnica-app:/var/www/html/app/
	@echo "Storage folder kopiran u kontejner!"
storage-link:
	docker exec  $(APP_CONTAINER) php artisan storage:link
	@echo "Storage link kreiran!"
build: env up key storage storage-link
	@echo "Projekat izgradjen sledi da se odradi baza!"

dev-setup: env up key composer-local
	@echo "Development okruzenje spremno sa lokalnim vendor folderom!"
