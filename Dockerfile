FROM php:8.3-fpm as php_base

# Install dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    bash \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    git \
    curl \
    ca-certificates \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

# Copy source code
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=php

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Final stage with Nginx
FROM nginx:alpine

# Install PHP-FPM
RUN apk add --no-cache php83-fpm php83-pdo php83-pdo_mysql php83-gd php83-zip

# Copy Nginx config
COPY nginx/default.conf /etc/nginx/conf.d/default.conf

# Copy PHP app from builder
COPY --from=php_base /var/www /var/www

# Copy PHP-FPM config
RUN mkdir -p /usr/local/etc/php-fpm.d && \
    echo "[global]\nerror_log = /proc/self/fd/2\n\n[www]\nuser = nobody\ngroup = nobody\nlisten = 127.0.0.1:9000\naccess.log = /proc/self/fd/2" > /usr/local/etc/php-fpm.conf.d/docker.conf

EXPOSE 80

# Start both Nginx and PHP-FPM
CMD sh -c "php-fpm83 -D && nginx -g 'daemon off;'"
