FROM php:7.3-apache
RUN docker-php-ext-install mysqli mbstring
RUN ["apt-get", "update"]
RUN ["apt-get", "install", "-y", "vim"]
