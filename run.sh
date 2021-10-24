php artisan config:clear
php artisan clear-compiled
php artisan auth:clear-resets
php artisan optimize:clear
sleep 10
php artisan migrate --force --no-interaction
php artisan db:seed
php artisan optimize
chmod -R 777 /var/www/storage
chmod -R 777 /var/www/bootstrap/cache
php artisan storage:link

apachectl -D FOREGROUND
