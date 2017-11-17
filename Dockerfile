FROM php:5.6-apache

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        zlib1g-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
        iconv \
        mbstring \
        zip \
    && docker-php-ext-configure gd \
        --with-freetype-dir=/usr/include/ \
        --with-jpeg-dir=/usr/include/ \
        --with-png-dir=/usr/include/ \
    && docker-php-ext-install gd

RUN a2enmod headers rewrite

# make sure `directory` exists
RUN mkdir -p /var/www/html/directory

# Ensure `.htaccess` is set
COPY htaccess /var/www/html/.htaccess

# copy remaining source
COPY . /var/www/html
