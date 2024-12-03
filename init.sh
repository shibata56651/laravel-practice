#!/bin/sh
cp .env.example .env

cp src/.env.example src/.env

cd .docker/nginx
mkcert localhost
cd ../../

docker-compose up -d

docker compose exec app composer update

docker compose exec app composer install

docker compose exec app php artisan key:generate

docker compose exec app php artisan migrate --seed

# ビルドしたファイルを使いたい時に残ってると邪魔するので、一旦消しておく
docker compose exec app rm -rf public/hot
