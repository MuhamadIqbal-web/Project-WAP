FROM php:8.2-fpm

WORKDIR /var/www/html

# Install ekstensi yang dibutuhkan
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy semua file PHP
COPY html/ /var/www/html/
