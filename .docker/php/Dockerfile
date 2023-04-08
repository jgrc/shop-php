FROM php:8.2-fpm-alpine3.17

ARG UID
ARG GID

RUN apk add --no-cache curl git zip unzip libzip-dev shadow $PHPIZE_DEPS linux-headers\
    && rm -rf /var/cache/apk/*

RUN pecl install xdebug-3.2.0 && docker-php-ext-enable xdebug

RUN docker-php-ext-install pdo_mysql zip

RUN usermod -u $UID www-data && groupmod -g $GID www-data

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www