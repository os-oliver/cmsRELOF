# Executables (local)
DOCKER_COMP = docker compose

# Docker containers
PHP_CONT = $(DOCKER_COMP) exec php-apache
MYSQL_CONT = $(DOCKER_COMP) exec mysql

# Executables
PHP      = $(PHP_CONT) php
COMPOSER = $(PHP_CONT) composer

# Misc
.DEFAULT_GOAL = help
.PHONY        = help build up start down logs sh composer vendor sf cc

help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

## —— Docker 🐳 ————————————————————————————————————————————————————————————————
build: ## Builds the Docker images
	@$(DOCKER_COMP) build

up: ## Start the docker hub in detached mode (no logs)
	@$(DOCKER_COMP) up --detach

start: build up ## Build and start the containers

down: ## Stops the docker hub and removes volumes
	@$(DOCKER_COMP) down --remove-orphans

stop: ## Stops the docker hub
	@$(DOCKER_COMP) stop

logs: ## Show live logs
	@$(DOCKER_COMP) logs --tail=0 --follow

sh: ## Connect to the PHP FPM container
	@$(PHP_CONT) bash

mysqlsh: ## Connect to the MYSQL container
	@$(MYSQL_CONT) bash

## —— Composer 🧙 ——————————————————————————————————————————————————————————————
composer: ## Run composer, pass the parameter "c=" to run a given command, example: make composer c='req symfony/orm-pack'
	@$(eval c ?=)
	@$(COMPOSER) $(c)

vendor: ## Install vendors according to the current composer.lock file
vendor: c=install --prefer-dist --no-dev --no-progress --no-scripts --no-interaction
vendor: composer
