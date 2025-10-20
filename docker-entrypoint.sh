#!/bin/sh
set -e

echo "Entrypoint: Running migrations non-interactively..."
# L'option --no-interaction empêche le script de se bloquer
symfony console doctrine:migrations:migrate --no-interaction

echo "Entrypoint: Setting file permissions..."
chown -R www-data:www-data var public/uploads

echo "Entrypoint: Handing over to www-data to start php-fpm..."
exec gosu www-data "$@"