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

# Laravel migracije i seed
migrate:
	docker exec -it -w /var/www/html $(APP_CONTAINER) php artisan migrate

migrate-fresh:
	docker exec -it -w /var/www/html $(APP_CONTAINER) php artisan migrate:fresh

tinker:
	docker exec -it -w /var/www/html $(APP_CONTAINER) php artisan tinker

key:
	if not exist app\.env copy app\.env.example app\.env
	docker exec -it -w /var/www/html $(APP_CONTAINER) php artisan key:generate

mysql:
	docker exec -it $(DB_CONTAINER) mysql -uadmin -padmin ribarnica

seed:
	docker exec -it -w /var/www/html $(APP_CONTAINER) php artisan db:seed

# Kombinovani cilj za pripremu baze
baza:  migrate-fresh seed
	@echo "Baza spremna!"

# Novi build cilj
build: key up baza
	@echo "Projekat izgradjen i baza spremna!"
