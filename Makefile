# --- Osnovne varijable ---
APP_CONTAINER=ribarnica-app
DB_CONTAINER=ribarnica-db

# --- Docker komande ---
up:
	docker-compose up -d --build

down:
	docker-compose down

logs:
	docker-compose logs -f

ps:
	docker-compose ps

# --- Laravel komande ---
exec:
	docker exec -it $(APP_CONTAINER) bash

migrate:
	docker exec -it -w /var/www/html $(APP_CONTAINER) php artisan migrate

migrate-fresh:
	docker exec -it -w /var/www/html $(APP_CONTAINER) php artisan migrate:fresh

tinker:
	docker exec -it -w /var/www/html $(APP_CONTAINER) php artisan tinker

key:
	# Ako .env ne postoji, kopira .env.example
	@test -f ./app/.env || cp ./app/.env.example ./app/.env
	docker exec -it -w /var/www/html $(APP_CONTAINER) php artisan key:generate

# --- MySQL komande ---
mysql:
	docker exec -it $(DB_CONTAINER) mysql -uadmin -p

seed:
	docker exec -it -w /var/www/html $(APP_CONTAINER) php artisan db:seed

# --- Build sve odjednom ---

build:
ifeq ($(OS),Windows_NT)
	if not exist app\.env copy .\.env.example app\.env
else
	@if [ ! -f app/.env ]; then cp ./.env.example app/.env; fi
endif
	docker exec -it ribarnica-app composer require fakerphp/faker --dev
	docker exec -it -w /var/www/html $(APP_CONTAINER) php artisan key:generate
	docker exec -it -w /var/www/html $(APP_CONTAINER) php artisan migrate:fresh --force
	docker exec -it -w /var/www/html $(APP_CONTAINER) php artisan db:seed

