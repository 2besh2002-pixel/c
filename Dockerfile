# Stage 1: Build frontend assets
FROM node:20-alpine AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: PHP Application
FROM php:8.2-cli-alpine

# Set working directory
WORKDIR /app

# Install system dependencies & PHP extensions
RUN apk add --no-cache \
    curl \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    oniguruma-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_mysql mbstring xml bcmath opcache fileinfo gd zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . /app

# Copy built frontend assets from frontend stage
COPY --from=frontend /app/public/build /app/public/build

# Install PHP dependencies without dev packages for production
RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs

# Prepare Laravel storage permissions and caching
RUN chmod -R 777 storage bootstrap/cache && chmod +x /app/docker-entrypoint.sh

# Expose ports (Render uses PORT env variable, default 8080 or 10000)
EXPOSE 8080 10000

# Start entrypoint script
CMD ["/app/docker-entrypoint.sh"]
