#!/bin/sh
set -e

echo "Starting Laravel..."

# Clear Laravel caches
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Create storage link
php artisan storage:link --force || true

# Run migrations
if [ -n "$DB_HOST" ]; then
    echo "Running database migrations..."
    php artisan migrate --force
fi

# Start Laravel
echo "Starting Laravel server on port ${PORT:-10000}..."

exec php artisan serve \
    --host=0.0.0.0 \
    --port="${PORT:-10000}"
