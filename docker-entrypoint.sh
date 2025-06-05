#!/bin/bash
set -e

chown -R www-data:www-data /var/www
chmod -R 775 storage bootstrap/cache

php artisan key:generate || true
php artisan migrate --seed || true
php artisan config:cache
php artisan route:cache
php artisan view:cache

exec "$@"
