FROM oberd/php-8.0-apache

RUN apt update && apt dist-upgrade -y
RUN apt install software-properties-common -y
RUN apt update

RUN a2enmod rewrite


RUN apt-get update && apt-get install -y \
      libcurl4-openssl-dev \
      libsqlite3-dev \
      xz-utils \
      libapache2-mod-xsendfile \
 && rm -rf /var/lib/apt/lists/*

VOLUME /var/www/html

ENV RS_VERSION 0.9.9

COPY docker-entrypoint.sh /entrypoint.sh
COPY apache.conf /etc/apache2/sites-enabled/apache.conf

ENTRYPOINT ["/entrypoint.sh"]
CMD ["apache2-foreground"]
