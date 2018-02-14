#!/usr/bin/env bash

service php7.2-fpm start
service nginx start

chown -R :www-data storage
chmod -R g+w storage

composer update
php artisan key:generate
php artisan jwt:secret
php artisan migrate:fresh --seed

if ! [ -h "public/storage" ]
then
    php artisan storage:link
fi

tail -f /var/log/nginx/error.log