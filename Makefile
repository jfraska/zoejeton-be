include .env

build:
	@docker-compose up --build -d

migrate:
	@docker exec ${APP_NAME}_php /bin/sh -c 'php artisan migrate'

fresh:
	@docker exec ${APP_NAME}_php /bin/sh -c 'php artisan migrate:fresh'
