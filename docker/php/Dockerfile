FROM php:7.4-fpm

COPY php.ini /usr/local/etc/php/


RUN apt-get update && apt-get install -y \
    libmariadb-dev \
    zlib1g-dev \
    libzip-dev \

    unzip \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer self-update

WORKDIR /var/www