# Nome do Docker
LARADOCK=laradock

# Nome do Projeto
NAME_PROJETO=exitlag-web

# Container PHP
PHP_CONTAINER_NAME=$(LARADOCK)_php-fpm_1

# Container POSTGRESS
DB_CONTAINER_NAME=$(LARADOCK)_postgres_1

# Container WORKSPACE
WORKSPACE_CONTAINER_NAME=$(LARADOCK)_workspace_1

# Container MYSQL
MYSQL_CONTAINER_NAME=${LARADOCK}_mysql_1

# Listagem dos serviços
LIST_OF_CONTAINERS_TO_RUN=nginx mysql phpmyadmin workspace redis

# Algumas variáveis ​​que são exigidas pelo destino de instalação
LARADOCK_REPO=https://github.com/Laradock/laradock.git

# Porta do nginx
LARADOCK_NGINX_PORT=8080

help: 
	@printf "\033[33mComo usar:\033[0m\n make [comando]\n\n\033[33mComandos:\033[0m\n" 
	@grep -E '^[-a-zA-Z0-9_\.\/]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf " \033[32m%-30s\033[0m %s\n", $$1, $$2}'

# clone the repo
# replace some variabls in laradock's .env file
# create and update .env file of laravel
# replace some env variables in laravel's .env file
install-laradock: ## Instala o laradock dentro do seu projeto
	git clone $(LARADOCK_REPO) $(LARADOCK) && \
	cp $(LARADOCK)/env-example $(LARADOCK)/.env && \
	sed -i "/PHP_FPM_INSTALL_PGSQL=false/c\PHP_FPM_INSTALL_PGSQL=true" $(LARADOCK)/.env && \
	sed -i "/DATA_PATH_HOST=.*/c\DATA_PATH_HOST=..\/docker-data" $(LARADOCK)/.env && \
	sed -i "/NGINX_HOST_HTTP_PORT=80/c\NGINX_HOST_HTTP_PORT=$(LARADOCK_NGINX_PORT)" $(LARADOCK)/.env && \
	(test -s .env || cp .env.example .env) ; \
	sed -i "/DB_CONNECTION=.*/c\DB_CONNECTION=pgsql" .env && \
	sed -i "/DB_HOST=.*/c\DB_HOST=postgres" .env && \
	sed -i "/DB_DATABASE=.*/c\DB_DATABASE=default" .env && \
	sed -i "/DB_USERNAME=.*/c\DB_USERNAME=default" .env && \
	sudo chmod -R 777 storage

up: ## Inicia o docker compose (php, mysql, redis e o workspace)
	@echo "🐳🐘 Make: Ligando os serviços\n"
	cd .. && cd $(LARADOCK) && sudo docker-compose up -d $(LIST_OF_CONTAINERS_TO_RUN)

down: ## Para todos os container do docker
	@echo "🔴 Make: Desligando os serviços.\n"
	cd .. && cd $(LARADOCK) && sudo docker-compose stop && sudo docker-compose rm -f

ps: ## Verifica os containers em execução
	@echo "📦 Make: Serviços que estão em execução\n"
	cd .. && cd $(LARADOCK) && sudo docker-compose ps

bash-workspace: ## Bash dentro do container workspace
	@echo "► Make: Acessando o container workspace\n"
	sudo docker exec -it $(WORKSPACE_CONTAINER_NAME) bash

bash-mysql: ## Bash para entrar no container do MySQL.
	@echo "► Make: Acessando o container workspace\n"
	sudo docker exec -it ${MYSQL_CONTAINER_NAME} bash

bash-php: ## Bash dentro do container do PHP
	@echo "► Make: Acessando o container do PHP\n"
	sudo docker exec -it $(PHP_CONTAINER_NAME) bash

log: ## Verificar os logs que o sistema gerou.
	@echo "🔒 Make: Verificando os logs do sistema.\n"
	sudo tail -f storage/logs/laravel.log

docker-log: ## Verificando o log do docker.
	@echo "🔒 Make: Verificando os logs do docker.\n"
	cd .. && cd $(LARADOCK) && sudo docker-compose logs -f

test-unit: ## Rodar os testes unitários criados (AJUSTAR).
	@read -p "Nome do teste (* para completo): " testName; \
	sudo docker exec -it $(PHP_CONTAINER_NAME) ./vendor/bin/phpunit

composer-install: ## Instalando depedencias do composer
	@echo "💾 Make: Instalando as depedências do projeto.\n"
	sudo docker exec -it $(WORKSPACE_CONTAINER_NAME) composer install