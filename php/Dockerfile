FROM php:7.4-fpm-alpine
RUN apk update; \
    apk upgrade;
RUN docker-php-ext-install pdo_mysql
# RUN docker-php-ext-install mysqli pdo_mysql pdo_pgsql