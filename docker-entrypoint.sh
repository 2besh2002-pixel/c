#!/bin/sh
set -e

# Prepare directories and permissions
mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache/data storage/logs bootstrap/cache
chmod -R 777 storage bootstrap/cache

# Clear cached config/views to avoid environment mismatches
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Ensure storage symlink exists
php artisan storage:link --force || true

# Run database migrations if configured (fail-safe)
if [ -n "$DB_HOST" ] && [ "$DB_HOST" != "127.0.0.1" ]; then
    echo "Attempting database connection & migrations..."
    php artisan migrate --force --no-interaction || echo "Migration notice: Database connection or tables skipped for now."
fi

# Set server port (Render provides $PORT, fallback to 10000 or 8080)
APP_PORT="${PORT:-10000}"

# Start PHP built-in production server directly on the public directory
echo "Starting production web server on port $APP_PORT..."
exec php -d variables_order=EGPCS -S 0.0.0.0:"$APP_PORT" -t public public/index.php
