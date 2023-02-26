#!/bin/sh

cd /var/www

# php artisan migrate:fresh --seed
php artisan cache:clear
php artisan route:cache
php artisan optimize:clear && php artisan optimize && php artisan storage:link && php -d memory_limit=-1 artisan migrate:fresh --seed
/usr/bin/supervisord -c /etc/supervisord.conf