web: vendor/bin/heroku-php-apache2 public/ -C apache-prod.conf || php -S 0.0.0.0:$PORT -t public
release: php artisan migrate --force
