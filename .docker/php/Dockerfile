FROM php:8.2-fpm-alpine3.17

ARG UID
ARG GID

RUN apk add --no-cache curl git zip unzip libzip-dev shadow $PHPIZE_DEPS linux-headers rabbitmq-c rabbitmq-c-dev oniguruma-dev \
    && rm -rf /var/cache/apk/*

RUN pecl install amqp xdebug-3.2.0

RUN docker-php-ext-install pdo_mysql zip mbstring

RUN docker-php-ext-enable amqp xdebug mbstring

RUN usermod -u $UID www-data && groupmod -g $GID www-data

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www