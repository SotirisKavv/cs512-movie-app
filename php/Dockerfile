ARG PHP_V=""
FROM php:${PHP_V:+${PHP_V}-}fpm-alpine

RUN apk update; \
    apk upgrade;

RUN docker-php-ext-install mysqli pdo pdo_mysql
