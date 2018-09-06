FROM apiki/webserver:php

MAINTAINER Team Maintainers "mesaque.s.silva@gmail.com"

ENV DEBIAN_FRONTEND noninteractive

ADD * /var/www/html/
ADD docker-requires/init.sh /init/init.sh

WORKDIR /var/www/html

CMD ["/init/init.sh"]