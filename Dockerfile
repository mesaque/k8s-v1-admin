FROM apiki/webserver:php

MAINTAINER Team Maintainers "mesaque.s.silva@gmail.com"

ENV DEBIAN_FRONTEND noninteractive

ADD * /var/www/html/

ADD infrastructure/init.sh /init/init.sh
ADD infrastructure/nginx/ /usr/local/openresty/nginx/conf

RUN cd / \
&& php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
&& php /composer-setup.php \
&& chmod +x composer.phar \
&& mv composer.phar /usr/bin/composer

RUN chown -R www-data:www-data /var/www
USER www-data

RUN cd /var/www/html && composer install
WORKDIR /var/www/html

USER root
CMD ["/init/init.sh"]