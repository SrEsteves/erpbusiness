#!/bin/bash
set -e

echo "Starting Docker Entry Point"

php artisan key:generate

echo "Waiting for the database to be ready..."

until mysql -h"${DB_HOST}" -u"${DB_USERNAME}" -p"${DB_PASSWORD}" -e 'select 1'; do
  >&2 echo "MySQL is unavailable - sleeping"
  sleep 5
done

>&2 echo "MySQL is up - executing migrations"

php artisan migrate --force

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

echo "Starting Apache"

exec apache2-foreground