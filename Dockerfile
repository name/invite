# Use the official PHP 8.0 Apache image as the base image
FROM php:8.0-apache

# Install system dependencies
RUN apt-get update && \
    apt-get install -y \
        unzip \
        git

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache modules
RUN a2enmod rewrite

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set up PHP application
COPY ./public /var/www/html/