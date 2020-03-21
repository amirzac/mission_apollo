include .env

.PHONY: up down stop prune ps shell logs

default: up

## help	:	Print commands help.
help : docker.mk
	@sed -n 's/^##//p' $<

## install
install:
	@echo "Starting up containers for for $(PROJECT_NAME)..."
	docker-compose pull
	docker-compose up -d --remove-orphans
	@echo "Installing composer dependencies"
	@docker-compose exec php composer install
	@echo "Run migrations"
	@docker-compose exec php bin/console doctrine:migrations:migrate --no-interaction
	@echo "Load fixtures"
	@docker-compose exec php bin/console doctrine:fixtures:load --no-interaction

## up	:	Start up containers.
up:
	@echo "Starting up containers for for $(PROJECT_NAME)..."
	docker-compose pull
	docker-compose up -d --remove-orphans

## down	:	Stop containers.
down: stop

## start	:	Start containers without updating.
start:
	@echo "Starting containers for $(PROJECT_NAME) from where you left off..."
	@docker-compose start

## stop	:	Stop containers.
stop:
	@echo "Stopping containers for $(PROJECT_NAME)..."
	@docker-compose stop

## prune	:	Remove containers and their volumes.
##		You can optionally pass an argument with the service name to prune single container
##		prune mariadb	: Prune `mariadb` container and remove its volumes.
##		prune mariadb solr	: Prune `mariadb` and `solr` containers and remove their volumes.
prune:
	@echo "Removing containers for $(PROJECT_NAME)..."
	@docker-compose down -v $(filter-out $@,$(MAKECMDGOALS))

## ps	:	List running containers.
ps:
	@docker ps --filter name='$(PROJECT_NAME)*'

## show_host : show nginx host
show_host:
	@docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' "$(PROJECT_NAME)_nginx"

## symfony console
symfony_console:
	@docker-compose exec php bin/console

## install composer dependencies
composer_install:
	@docker-compose exec php composer install

## make migration
migration:
	@docker-compose exec php bin/console make:migration

## run migrate
run_migrate:
	@docker-compose exec php bin/console doctrine:migrations:migrate --no-interaction

## run migrate
load_fixtures:
	@docker-compose exec php bin/console doctrine:fixtures:load --no-interaction

## run migrate
db_connect:
	@docker exec -ti "$(PROJECT_NAME)_$(DB_HOST)" bash

## run tests
test:
	@docker-compose exec php bin/phpunit

## shell	:	Access `php` container via shell.
shell:
	docker exec -ti -e COLUMNS=$(shell tput cols) -e LINES=$(shell tput lines) $(shell docker ps --filter name='$(PROJECT_NAME)_php' --format "{{ .ID }}") sh

## logs	:	View containers logs.
##		You can optinally pass an argument with the service name to limit logs
##		logs php	: View `php` container logs.
##		logs nginx php	: View `nginx` and `php` containers logs.
logs:
	@docker-compose logs -f $(filter-out $@,$(MAKECMDGOALS))

# https://stackoverflow.com/a/6273809/1826109
%:
	@: