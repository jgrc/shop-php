.PHONY: up stop down install sh clear validate unit-test
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
validate:
	docker-compose exec php vendor/bin/phpcs
	docker-compose exec php vendor/bin/phpstan
unit-tests:
	docker-compose exec php vendor/bin/phpunit --testsuite unit
