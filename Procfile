"post-install-cmd": [
     "php artisan clear-compiled",
     "php artisan optimize",
     "chmod -R 777 public/"
 ]

 web: vendor/bin/heroku-php-apache2 public/ heroku ps heroku open