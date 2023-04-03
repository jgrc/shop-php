.PHONY: up stop down install sh clear
up:
	docker-compose up -d
stop:
	docker-compose stop
down:
	docker-compose down
install:
	docker-compose exec php composer install
sh:
	docker-compose exec php sh
clear:
	docker-compose exec php bin/console cache:clear
