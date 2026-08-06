FROM php:8.4-apache

# Install system dependencies & PostgreSQL driver
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Enable Apache mod_rewrite for Laravel routing
RUN a2enmod rewrite

# Change Apache document root to /var/www/html/public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html

COPY . /var/www/html

# Install PHP dependencies with platform reqs override
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --ignore-platform-reqs --no-dev --optimize-autoloader

# Build Vue 3 Vite assets
RUN npm install && npm run build

# Set permissions for Laravel storage
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Configure Railway PORT
ENV PORT=8080
EXPOSE 8080

CMD php artisan config:clear && php artisan migrate --force --no-interaction && php artisan db:seed --force --no-interaction ; apache2-foreground
