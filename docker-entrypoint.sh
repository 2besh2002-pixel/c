#!/bin/sh
set -e

# Prepare directories and permissions
mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache/data storage/logs bootstrap/cache
chmod -R 777 storage bootstrap/cache

# Clear and optimize
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Ensure storage symlink exists
php artisan storage:link --force || true

# Run migrations if database is configured
if [ -n "$DB_HOST" ] && [ "$DB_HOST" != "127.0.0.1" ]; then
    echo "Running database migrations..."
    php artisan migrate --force || echo "Migration notice: Database may still be initializing or table exists."
fi

# Start Laravel
echo "Starting Laravel server on port ${PORT:-8080}..."
exec php artisan serve --host=0.0.0.0 --port="${PORT:-8080}"
