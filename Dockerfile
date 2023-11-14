FROM php:8.0-apache

WORKDIR /
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

COPY ./app /var/www/html
RUN echo "ServerName localhost:80" >> /etc/apache2/apache2.conf
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]

# RUN sudo chown www-data:www-data /var/www/html/public/img/anime/
# RUN sudo chmod 755 /var/www/html/public/img/anime/

# RUN sudo chown www-data:www-data /var/www/html/public/img/client/
# RUN sudo chmod 755 /var/www/html/public/img/client/

# RUN sudo chown www-data:www-data /var/www/html/public/img/studio/
# RUN sudo chmod 755 /var/www/html/public/img/studio/

# RUN sudo chown www-data:www-data /var/www/html/public/vid/
# RUN sudo chmod 755 /var/www/html/public/vid/


RUN service apache2 restart