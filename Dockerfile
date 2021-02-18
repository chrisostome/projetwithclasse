FROM php:7-apache
LABEL version="1.0" maintainer="AJDAINI Hatim &tl;ajdaini.hatim@gmail.com>"
# Activation des modules php
RUN docker-php-ext-install pdo pdo_mysql
WORKDIR /var/www/html
