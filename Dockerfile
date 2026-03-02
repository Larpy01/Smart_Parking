[Region: us-west1]
=========================
Using Detected Dockerfile
=========================

context: xwv1-smjm

internal
load build definition from Dockerfile
0ms

internal
load metadata for docker.io/library/composer:latest
131ms

internal
load metadata for docker.io/library/php:8.2-cli
135ms

internal
load .dockerignore
0ms

internal
load build context
0ms

FROM docker.io/library/composer:latest@sha256:f0809732b2188154b3faa8e44ab900595acb0b09cd0aa6c34e798efe4ebc9021
9ms

stage-0
FROM docker.io/library/php:8.2-cli@sha256:150212cbf83a9ed49a2669df8645afcf6082faec526d365fdf7580ed0af06204
10ms

stage-0
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache /app/public cached
0ms

stage-0
RUN npm install && npm run build cached
0ms

stage-0
RUN composer install --optimize-autoloader --no-interaction cached
0ms

stage-0
COPY . . cached
0ms

stage-0
WORKDIR /app cached
0ms

stage-0
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer cached
0ms

stage-0
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - && apt-get install -y nodejs cached
0ms

stage-0
RUN docker-php-ext-configure gd --with-freetype --with-jpeg     && docker-php-ext-install gd pdo pdo_mysql cached
0ms

stage-0
RUN apt-get update && apt-get install -y     git unzip curl zip     libpng-dev libjpeg-dev libfreetype6-dev     libonig-dev libxml2-dev cached
0ms

auth
sharing credentials for production-us-west2.railway-registry.com
0ms

importing to docker