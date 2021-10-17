#!/bin/bash

export ROLE="${CONTAINER_ROLE:-1}"

echo $ROLE
#export ROLE="app"

if [[ $ROLE == "app" ]]
then
echo "running as app"
php artisan config:clear
php artisan clear-compiled
php artisan auth:clear-resets
php artisan optimize:clear
php artisan config:cache
php artisan view:cache
php artisan route:cache
php artisan migrate --force --no-interaction
php artisan db:seed
find * -type f -exec chmod 644 {} \;
find * -type d -exec chmod 755 {} \;
chgrp -R www-data /var/www/storage
chmod -R ug+rwx /var/www/storage
chmod -R ug+rwx /var/www/bootstrap/cache
php artisan storage:link
/usr/bin/supervisord

else

echo "running as scheduler"

while true;

do php /var/www/artisan schedule:run --verbose & sleep 60;

done

fi
