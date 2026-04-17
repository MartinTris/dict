# Build stage
FROM php:8.2-fpm as build

# Install dependencies (added: mysql-client, ca-certificates, git for SSL support)
RUN apt-get update && apt-get install -y \
    bash \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    npm \
    curl \
    mysql-client \
    ca-certificates \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

# Copy source code
COPY . .

# Install PHP dependencies without dev (for production)
RUN composer install --no-dev --optimize-autoloader

# Build frontend (if needed)
RUN npm install && npm run build && rm -rf node_modules

# Production stage
FROM php:8.2-fpm

# Install only necessary system dependencies (added: mysql-client, ca-certificates)
RUN apt-get update && apt-get install -y \
    bash \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    mysql-client \
    ca-certificates \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Install Composer (if you need it at runtime)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

# Copy only built app from build stage
COPY --from=build /var/www /var/www

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
