#!/bin/bash
set -e

chown -R www-data:www-data /var/www/html
chmod -R 750 /var/www/html

exec "$@"
