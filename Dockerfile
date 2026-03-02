FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl zip \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev \
    gnupg libzip-dev

# Install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql bcmath zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy all files first
COPY . .

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev --no-interaction

# Install JS dependencies and build assets
RUN npm install && npm run build

# Set permissions AFTER files are copied and composer has run
# This ensures the web user (www-data) can write to logs and cache
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache \
    && chmod -R 775 /app/storage /app/bootstrap/cache

# IMPORTANT: We don't cache config during BUILD because 
# Railway injected env vars won't be available yet. 
# We do it at RUNTIME instead.

EXPOSE 8080

# Use a shell script or a multi-command CMD to clear cache at startup
CMD php artisan config:clear && php artisan view:clear && php -S 0.0.0.0:$PORT -t public