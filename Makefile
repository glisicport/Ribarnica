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
	docker exec -it $(APP_CONTAINER) php artisan migrate

migrate-fresh:
	docker exec -it $(APP_CONTAINER) php artisan migrate:fresh

tinker:
	docker exec -it $(APP_CONTAINER) php artisan tinker

key:
	docker exec -it $(APP_CONTAINER) php artisan key:generate

# --- MySQL komande ---
mysql:
	docker exec -it $(DB_CONTAINER) mysql -uadmin -p

seed:
	docker exec -it $(APP_CONTAINER) php artisan db:seed
