#!/bin/bash
git pull

composer install --no-interaction --no-dev --prefer-dist

php artisan migrate --force


