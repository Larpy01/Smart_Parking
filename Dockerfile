FROM php:8.2-cli

# Install system deps
RUN apt-get update && apt-get install -y \
    git unzip curl zip \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev

# Install GD
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Install Node.js (for Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - && apt-get install -y nodejs

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Install PHP deps
RUN composer install --optimize-autoloader --no-interaction

# Install JS deps & build Vite
RUN npm install && npm run build

# Debug: Check if assets were built
RUN echo "=== Checking built assets ===" && \
    ls -la public/build/ && \
    ls -la public/build/assets/ || true && \
    echo "=== Checking manifest ===" && \
    cat public/build/manifest.json || true

RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache /app/public

CMD php artisan serve --host=0.0.0.0 --port=$PORT