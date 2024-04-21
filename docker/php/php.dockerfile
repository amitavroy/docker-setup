FROM php:8.2-fpm-alpine3.19

RUN mkdir -p /var/www/html

RUN apk --no-cache add shadow && usermod -u 1000 www-data

# This statement is required to give proper permissions to the necessary files.
RUN chown -R www-data:www-data /var/www/html/storage
RUN chown -R www-data:www-data /var/www/html/bootstrap/cache

RUN docker-php-ext-install pdo pdo_mysql
