FROM php:7.2.6-fpm

COPY ./php.ini /usr/local/etc/php/

WORKDIR /app

RUN apt-get update -y && apt-get upgrade -y

RUN apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libicu-dev \
        wget \
        git \
        --no-install-recommends

RUN docker-php-ext-install zip intl mbstring pdo_mysql exif \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd

RUN wget https://getcomposer.org/composer.phar && chmod +x ./composer.phar && mv ./composer.phar /usr/bin/composer