#!/bin/bash
DEPLOYLOG=storage/logs/deploy.log
echo "Running git pull" >> $DEPLOYLOG
git pull
echo "Running composer install" >> $DEPLOYLOG
composer install --no-interaction --no-dev --prefer-dist
echo "Running migration" >> $DEPLOYLOG
php artisan migrate --force


