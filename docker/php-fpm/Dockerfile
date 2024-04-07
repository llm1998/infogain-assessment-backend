#
#--------------------------------------------------------------------------
# Image Setup
#--------------------------------------------------------------------------
#
FROM php:8.3-fpm

#
#--------------------------------------------------------------------------
# Software's Installation
#--------------------------------------------------------------------------
#
# Installing tools and PHP extentions using "apt", "docker-php", "pecl",
#
# Install "curl", "zip", "unzip", "libmemcached-dev", "libz-dev", "libpq-dev", "libjpeg-dev",
#         "libpng-dev", "libfreetype6-dev", "libssl-dev", "libwebp-dev", "libmcrypt-dev",
#         "libonig-dev", "libjpeg62-turbo-dev", "libxml2-dev", "libcurl4-openssl-dev"
RUN set -eux; \
    apt-get update; \
    apt-get upgrade -y; \
    apt-get install -y --no-install-recommends \
        curl \
        zip \
        unzip \
        libmemcached-dev \
        libz-dev \
        libpq-dev \
        libjpeg-dev \
        libpng-dev \
        libfreetype6-dev \
        libssl-dev \
        libwebp-dev \
        libxpm-dev \
        libmcrypt-dev \
        libonig-dev \
        libjpeg62-turbo-dev \
        libxml2-dev \
        libcurl4-openssl-dev \
        zlib1g-dev \
        libicu-dev \
        g++; \
    rm -rf /var/lib/apt/lists/*

RUN set -eux; \
    # Install the PHP bcmath extension
    docker-php-ext-install bcmath; \
    # Install the PHP ctype exntension
    docker-php-ext-install ctype; \
    # Install the PHP cURL extension
    docker-php-ext-install curl; \
    # Install the PHP DOM extension
    docker-php-ext-install dom; \
    # Install the Php exif extension
    docker-php-ext-install exif; \
    # Install the PHP FileInfo extension
    docker-php-ext-install fileinfo; \
    # Install the PHP intl extension
    docker-php-ext-configure intl && docker-php-ext-install intl; \
    # Install the PHP mbstring extension
    docker-php-ext-install mbstring; \
    # Install the PHP mysqli extension
    docker-php-ext-install mysqli; \
    # Install the PHP pdo extention
    docker-php-ext-install pdo; \
    # Install the PHP pdo_mysql extention
    docker-php-ext-install pdo_mysql; \
    # Install the PHP session extention
    docker-php-ext-install session; \
    # Install the PHP soap extention
    docker-php-ext-install soap; \
    # Install the PHP xml extention
    docker-php-ext-install xml; \
    # Install the PHP gd library
    docker-php-ext-configure gd \
            --prefix=/usr \
            --with-jpeg \
            --with-webp \
            --with-xpm \
            --with-freetype; \
    # Install the PHP xml extention
    docker-php-ext-install gd; \
    php -r 'var_dump(gd_info());'

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
	&& php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
	&& php composer-setup.php \
	&& php -r "unlink('composer-setup.php');" \
	&& mv composer.phar /usr/local/bin/composer

#
#--------------------------------------------------------------------------
# Path php.ini
#--------------------------------------------------------------------------
#
COPY ./php.ini /usr/local/etc/php

#
#--------------------------------------------------------------------------
# XDebug:
#--------------------------------------------------------------------------
#
# Install the xdebug extension
# https://xdebug.org/docs/compat
# RUN pecl install xdebug-3.3.0; \
#     docker-php-ext-enable xdebug;

# # Copy xdebug configuration for remote debugging
# COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# RUN sed -i "s/xdebug.remote_host=/xdebug.client_host=/" /usr/local/etc/php/conf.d/xdebug.ini && \
#     sed -i "s/xdebug.remote_connect_back=0/xdebug.discover_client_host=false/" /usr/local/etc/php/conf.d/xdebug.ini && \
#     sed -i "s/xdebug.remote_port=9000/xdebug.client_port=${XDEBUG_PORT}/" /usr/local/etc/php/conf.d/xdebug.ini && \
#     sed -i "s/xdebug.profiler_enable=0/; xdebug.profiler_enable=0/" /usr/local/etc/php/conf.d/xdebug.ini && \
#     sed -i "s/xdebug.profiler_output_dir=/xdebug.output_dir=/" /usr/local/etc/php/conf.d/xdebug.ini && \
#     sed -i "s/xdebug.remote_mode=req/; xdebug.remote_mode=req/" /usr/local/etc/php/conf.d/xdebug.ini && \
#     sed -i "s/xdebug.remote_autostart=0/xdebug.start_with_request=yes/" /usr/local/etc/php/conf.d/xdebug.ini && \
#     sed -i "s/xdebug.remote_enable=0/xdebug.mode=debug/" /usr/local/etc/php/conf.d/xdebug.ini;

# RUN sed -i "s/xdebug.cli_color=0/xdebug.cli_color=1/" /usr/local/etc/php/conf.d/xdebug.ini