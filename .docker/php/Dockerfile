FROM php:8.2-fpm-alpine3.17

RUN apk add --no-cache curl git zip unzip libzip-dev \
    && rm -rf /var/cache/apk/*

RUN docker-php-ext-install pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www