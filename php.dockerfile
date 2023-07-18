FROM php:8.2.8-fpm-alpine

RUN mkdir -p /var/www/html

RUN apk --no-cache add shadow && usermod -u 1000 www-data

RUN docker-php-ext-install pdo pdo_mysql
