FROM php:8.0-apache

WORKDIR /
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

COPY ./app /var/www/html
RUN echo "ServerName localhost:80" >> /etc/apache2/apache2.conf
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]

RUN chown www-data:www-data /var/www/html/public/img/anime/
RUN chmod 755 /var/www/html/public/img/anime/

RUN chown www-data:www-data /var/www/html/public/img/client/
RUN chmod 755 /var/www/html/public/img/client/

RUN chown www-data:www-data /var/www/html/public/img/studio/
RUN chmod 755 /var/www/html/public/img/studio/

RUN chown www-data:www-data /var/www/html/public/vid/
RUN chmod 755 /var/www/html/public/vid/


RUN service apache2 restart
