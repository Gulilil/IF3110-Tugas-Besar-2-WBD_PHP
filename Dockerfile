FROM php:8.0-apache

WORKDIR /
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

COPY ./src /var/www/html
RUN echo "ServerName localhost:80" >> /etc/apache2/apache2.conf
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]