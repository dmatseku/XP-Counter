#! /bin/sh

docker-compose exec xp-app composer install
docker-compose exec xp-app php artisan key:generate

docker-compose exec xp-app php artisan migrate