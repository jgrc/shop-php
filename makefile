.PHONY: up stop down install sh clear validate tests unit-test acceptance-test
up:
	docker-compose up -d
stop:
	docker-compose stop
down:
	docker-compose down --volumes
install:
	docker-compose exec php composer install
sh:
	docker-compose exec php sh
clear:
	docker-compose exec php bin/console cache:clear
validate:
	docker-compose exec php bin/console lint:container
	docker-compose exec php vendor/bin/phpcs
	docker-compose exec php vendor/bin/phpstan
tests:
	docker-compose exec php vendor/bin/phpunit --testsuite unit
	docker-compose exec php vendor/bin/behat
unit-tests:
	docker-compose exec php vendor/bin/phpunit --testsuite unit
acceptance-tests:
	docker-compose exec php vendor/bin/behat
