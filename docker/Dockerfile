FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www