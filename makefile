.PHONY: up stop down install sh
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
