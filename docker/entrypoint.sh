#!/bin/sh
set -eu

git config --global --add safe.directory /var/www

project_owner_uid="$(stat -c '%u' /var/www)"

setfacl -R -m "u:www-data:rwX,u:${project_owner_uid}:rwX" /var/www/storage /var/www/bootstrap/cache
setfacl -dR -m "u:www-data:rwx,u:${project_owner_uid}:rwx" /var/www/storage /var/www/bootstrap/cache

exec docker-php-entrypoint "$@"
