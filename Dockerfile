FROM oberd/php-8.0-apache

RUN apt update && apt dist-upgrade -y
RUN apt install software-properties-common -y
RUN apt update

RUN a2enmod rewrite
RUN a2enmod headers

RUN apt-get update && apt-get install -y \
      libcurl4-openssl-dev \
      libsqlite3-dev \
      xz-utils \
      libapache2-mod-xsendfile \
 && rm -rf /var/lib/apt/lists/*

CMD ["apache2-foreground"]