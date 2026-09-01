# Stage 1: Build frontend assets
FROM node:20-alpine AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: PHP & Apache Application
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies & PHP extensions
RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libxml2-dev \
    libzip-dev \
    libonig-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring xml bcmath opcache fileinfo gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite and headers
RUN a2enmod rewrite headers

# Configure Apache DocumentRoot to Laravel's public directory and allow .htaccess overrides
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN sed -ri -e 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Configure PHP settings
RUN echo "memory_limit=256M" > /usr/local/etc/php/conf.d/memory-limit.ini \
    && echo "variables_order = 'EGPCS'" > /usr/local/etc/php/conf.d/vars.ini \
    && echo "upload_max_filesize=64M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size=64M" >> /usr/local/etc/php/conf.d/uploads.ini

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . /var/www/html

# Copy built frontend assets from frontend stage
COPY --from=frontend /app/public/build /var/www/html/public/build

# Install PHP dependencies without dev packages for production
RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs

# Prepare Laravel storage permissions and entrypoint
RUN chmod -R 777 storage bootstrap/cache && chmod +x /var/www/html/docker-entrypoint.sh

# Expose ports
EXPOSE 80 8080 10000

# Start via entrypoint script
CMD ["/var/www/html/docker-entrypoint.sh"]
