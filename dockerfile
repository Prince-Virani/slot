# ===================================================================
# STAGE 1: Build Stage - Installing Dependencies
# ===================================================================
FROM composer:2.6 as build

# Set working directory inside container
# This is where our application will live
WORKDIR /app

# Copy composer files first (Docker layer caching optimization)
# If these files don't change, Docker uses cached dependencies
COPY composer.json composer.lock ./

# Install PHP dependencies
# --no-scripts: Skip post-install scripts (we'll run them later)
# --no-autoloader: Skip autoloader (we'll generate it with all files)
# --prefer-dist: Download from dist for faster installation
RUN composer install --no-scripts --no-autoloader --prefer-dist

# Now copy all application files
COPY . .

# Generate optimized autoloader
# --optimize: Convert PSR-0/4 to classmap for faster loading
# --no-dev: Exclude development dependencies (smaller image)
RUN composer dump-autoload --optimize --no-dev

# ===================================================================
# STAGE 2: Production Stage - Final Image
# ===================================================================
FROM php:8.2-fpm-alpine

# Why Alpine? 
# - Super small (5MB vs Ubuntu's 70MB)
# - Security: Minimal attack surface
# - Enterprise standard for production containers

# Install system dependencies
# --no-cache: Don't cache package index (smaller image)
RUN apk --no-cache add \
    # Nginx web server
    nginx \
    # Process manager (runs multiple services)
    supervisor \
    # Basic utilities
    curl \
    zip \
    unzip \
    git \
    # For image manipulation in Laravel
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    # For PostgreSQL (if needed)
    postgresql-dev \
    # For Redis (if needed)
    redis \
    # For node/npm (compiling assets)
    nodejs \
    npm

# Configure PHP extensions for image processing
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg

# Install PHP extensions required by Laravel
RUN docker-php-ext-install \
    # MySQL/MariaDB support
    pdo \
    pdo_mysql \
    # PostgreSQL support (optional)
    pdo_pgsql \
    # Image manipulation
    gd \
    # Better performance with OPcache
    opcache \
    # Process Control (for queue workers)
    pcntl \
    # BC Math (for precision calculations)
    bcmath \
    # Internationalization
    intl

# Install Redis PHP extension (for caching/sessions)
RUN pecl install redis && docker-php-ext-enable redis

# Copy application from build stage
# This brings in all files with dependencies installed
COPY --from=build /app /var/www/html

# Copy configuration files
# Nginx configuration
COPY docker/nginx/default.conf /etc/nginx/nginx.conf

# Supervisor configuration (manages multiple processes)
COPY docker/supervisor/supervisord.conf /etc/supervisord.conf

# PHP configuration for production
COPY docker/php/php.ini /usr/local/etc/php/php.ini

# PHP-FPM configuration
COPY docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

# Create necessary directories
RUN mkdir -p /var/www/html/storage/logs \
    && mkdir -p /var/www/html/storage/framework/cache \
    && mkdir -p reconvene/html/storage/framework/sessions \
    && mkdir -p /var/www/html/storage/framework/views \
    && mkdir -p /var/www/html/bootstrap/cache

# Set correct ownership (www-data is the web server user)
# Laravel needs write access to storage and bootstrap/cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Create directory for PHP-FPM socket
RUN mkdir -p /var/run/php

# Expose port 80 (HTTP)
EXPOSE 80

# Health check (Docker can restart unhealthy containers)
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost/health || exit 1

# Start supervisor (which starts Nginx and PHP-FPM)
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]