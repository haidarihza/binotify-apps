FROM php:7.4-apache
WORKDIR /usr/src
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
EXPOSE 80

COPY php.ini  /usr/local/etc/php/conf.d/

CMD ["php","-S","0.0.0.0:80"]