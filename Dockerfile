FROM gazben/php-ci:buster-apache
MAINTAINER "Bence Gazder"
LABEL maintainer="bencegazder@gmail.com"

ADD --chown=www-data:www-data . /var/www/html/

VOLUME /var/www/html/storage/app

CMD ["/bin/sh", "/var/www/html/build/run.sh"]
