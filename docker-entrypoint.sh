#!/bin/sh
set -e

# Change to application directory
cd /var/www/html

# Prepare storage directories and permissions
mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache/data storage/logs bootstrap/cache
chmod -R 777 storage bootstrap/cache

# Clear cached configs/routes/views
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Ensure storage link exists
php artisan storage:link --force || true

# Configure Apache port dynamically for Render (PORT env variable)
APP_PORT="${PORT:-80}"
echo "Configuring Apache to listen on port $APP_PORT..."
echo "Listen $APP_PORT" > /etc/apache2/ports.conf
sed -i -E "s/<VirtualHost \*:[0-9]+>/<VirtualHost \*:$APP_PORT>/g" /etc/apache2/sites-available/*.conf

# Run database migrations in background so web server starts immediately
if [ -n "$DB_HOST" ] && [ "$DB_HOST" != "127.0.0.1" ]; then
    echo "Starting background database migrations..."
    (php artisan migrate --force --no-interaction || echo "Migration notice: Database check completed.") &
fi

# Start Apache in foreground
echo "Starting Apache production server on port $APP_PORT..."
exec apache2-foreground
