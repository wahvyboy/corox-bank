FROM php:8.3-cli

# Install system dependencies & SQLite extension
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite pdo_mysql

# Set working directory
WORKDIR /app

# Copy application files
COPY . /app

# Install composer dependencies
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Set directory permissions for Laravel
RUN chmod -R 777 storage bootstrap/cache database

# Expose dynamic application port
EXPOSE 8000

# Run database setup & start server
CMD php artisan migrate:fresh --seed --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
