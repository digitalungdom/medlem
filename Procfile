web: vendor/bin/heroku-php-apache2 public/
release: php artisan migrate --seed && php artisan cache:clear
worker: php artisan horizon