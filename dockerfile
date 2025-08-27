FROM php:8.2-apache

# Update system packages to fix vulnerabilities
RUN apt-get update && apt-get upgrade -y

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy Laravel files
COPY . /var/www/html

# Install dependencies (skip dev dependencies)
RUN composer install --optimize-autoloader --no-dev

# Fix permissions
RUN chown -R www-data:www-data /var/www/html/storage
RUN chmod -R 775 /var/www/html/storage

# Enable Apache rewrite
RUN a2enmod rewrite