ARG PHP_V=""
FROM php:${PHP_V}-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN a2enmod rewrite

COPY rest_api.conf /etc/apache2/rest_api.conf
RUN echo "Include /etc/apache2/rest_api.conf" \
    >> /etc/apache2/apache2.conf

RUN apt-get update; \
	apt-get install openssl libssl-dev libcurl4-openssl-dev -y; \
	pecl install mongo && docker-php-ext-enable mongodb; \
	echo "extension=/mongo.so" >> /usr/local/etc/php/conf.d/mongo.ini
