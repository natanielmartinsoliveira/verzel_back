#!/usr/bin/env sh

composer install
mv .env.example .env
php artisan key:generaate
php artisan migrate
php artisan db:seed

exec $@
