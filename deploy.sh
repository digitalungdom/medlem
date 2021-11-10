#!/bin/bash
DEPLOYLOG=storage/logs/deploy.log
echo "Running git pull" >> $DEPLOYLOG
git pull >> $DEPLOYLOG
echo "Running composer install" >> $DEPLOYLOG
composer install --no-interaction --no-dev --prefer-dist >> $DEPLOYLOG
echo "Running migration" >> $DEPLOYLOG
php artisan migrate --force >> $DEPLOYLOG


