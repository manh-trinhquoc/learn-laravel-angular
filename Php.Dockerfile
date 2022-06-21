FROM php:7.4-fpm
RUN apt-get update 
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo pdo_mysql 

RUN apt-get update -y && apt-get install -y zlib1g-dev libjpeg-dev libpng-dev  libfreetype6-dev  libwebp-dev \
    libjpeg62-turbo-dev \
    libgmp-dev \
    libldap2-dev \
  && rm -rf /var/lib/apt/lists/*
RUN apt-get update -y && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
  && docker-php-ext-install -j$(nproc) gd

RUN apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-install zip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" 
RUN  php composer-setup.php \
   && php -r "unlink('composer-setup.php');" \
  &&  mv composer.phar /usr/local/bin/composer

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN apt-get -y update \
  && apt-get install -y libicu-dev \ 
  && docker-php-ext-configure intl \
  && docker-php-ext-install intl

WORKDIR /var/www/  

RUN apt-get update -y \ 
  && apt-get install -y  libxml2-dev   \ 
  && apt-get clean -y \ 
  && docker-php-ext-install soap

RUN apt-get update && \
    apt-get install -y libxslt1-dev && \
    docker-php-ext-install xsl && \
    apt-get remove -y libxslt1-dev icu-devtools libicu-dev libxml2-dev && \
    rm -rf /var/lib/apt/lists/*

RUN apt-get update; \
    # Imagick extension
    apt-get install -y libmagickwand-dev; \
    pecl install imagick; \
    docker-php-ext-enable imagick;

RUN docker-php-ext-install sockets
RUN docker-php-ext-install bcmath

RUN apt install -y nano

RUN cd /usr/local/etc/php/conf.d/ && \
  echo 'memory_limit = -1' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini

RUN apt-get install -y cron
