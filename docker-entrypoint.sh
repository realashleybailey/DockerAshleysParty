#!/bin/bash
set -e

chown -R www-data:www-data /var/www/
chmod -R 750 /var/www/

exec "$@"
