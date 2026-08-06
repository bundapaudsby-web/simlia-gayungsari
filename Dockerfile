FROM php:8.4-cli

# Install system dependencies & PostgreSQL PHP drivers
RUN apt-get update && apt-get install -y     libpq-dev     git     unzip     nodejs     npm     && docker-php-ext-install pdo pdo_pgsql pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

EXPOSE 8000

CMD php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=$PORT
