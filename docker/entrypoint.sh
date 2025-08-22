set -e

chown -R www-data:www-data storage bootstrap/cache database
chmod -R 775 storage bootstrap/cache database

php-fpm
