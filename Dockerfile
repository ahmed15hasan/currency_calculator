FROM php:8.1-apache

# Install PDO MySQL extension
RUN docker-php-ext-install pdo pdo_mysql

# Optionally, you can install other dependencies you might need
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Copy custom configuration files if any
COPY ./apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Set the working directory
WORKDIR /var/www/html
