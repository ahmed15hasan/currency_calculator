FROM php:8.1-apache

# Install PDO MySQL extension
RUN docker-php-ext-install pdo pdo_mysql

# Optionally, you can install other dependencies you might need
RUN apt-get update && apt-get install -y \
    git \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd


RUN curl -s https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy the existing application directory contents
COPY . /var/www/html

# Ensure the web server has correct permissions
RUN chown -R www-data:www-data /var/www/html/storage \
    && chmod -R 777 /var/www/html/public

# Install composer dependencies with --ignore-platform-reqs
RUN composer install --ignore-platform-reqs 

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy custom configuration files if any
COPY ./apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Set the working directory
WORKDIR /var/www/html
