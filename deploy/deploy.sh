#!/usr/bin/env bash
# Redeploy script — run on the Pi from the app directory after the first
# setup in DEPLOYMENT.md is done: bash deploy/deploy.sh
set -euo pipefail

git pull origin main

composer install --no-dev --optimize-autoloader

npm ci
npm run build

php artisan migrate --force

php artisan config:cache
php artisan route:cache
php artisan view:cache

sudo systemctl restart php8.4-fpm
