#!/usr/bin/env bash

service php7.2-fpm start
service nginx start

chown -R :www-data storage
chmod -R g+w storage

composer update
php artisan key:generate
php artisan jwt:secret
php artisan migrate:fresh --seed

rm -f public/storage
php artisan storage:link


tail -f /var/log/nginx/error.log