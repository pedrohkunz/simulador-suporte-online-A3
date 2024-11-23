FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    bash \
    linux-headers \
    libpng-dev \
    libzip-dev \
    zlib-dev \
    libxml2-dev \
    oniguruma-dev \
    autoconf \
    automake \
    g++ \
    make

RUN docker-php-ext-install gd zip

RUN pecl install -o -f xdebug \
    && docker-php-ext-enable xdebug

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
 
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www

RUN composer install
RUN composer dump-autoload

EXPOSE 9000