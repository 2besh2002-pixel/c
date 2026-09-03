FROM php:8.2-cli-alpine

WORKDIR /app

RUN apk add --no-cache \
    curl \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    oniguruma-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        mbstring \
        xml \
        bcmath \
        opcache \
        fileinfo \
        gd \
        zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . /app

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --ignore-platform-reqs

RUN chmod -R 777 storage bootstrap/cache \
    && chmod +x /app/docker-entrypoint.sh

RUN php artisan storage:link || true

EXPOSE 8080

CMD ["/app/docker-entrypoint.sh"]
