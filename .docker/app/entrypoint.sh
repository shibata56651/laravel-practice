#!/bin/bash
set -e

cd /var/www/src

# 各種バージョン
echo ">>> php-fpm version"
php-fpm -v

echo ">>> composer version"
composer --version

echo ">>> node version"
node -v

echo ">>> npm version"
npm -v

# インストール関連
echo ">>> composer install"
composer install

echo ">>> npm install"
npm i

# マイグレーション
echo ">>> migrate & seed"
php artisan migrate:fresh --seed

echo "<<< initialized container. >>>"

exec "$@"
