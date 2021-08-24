FROM php:7.4-fpm-alpine

#----------------
# Build Arguments (default value)
#----------------
ARG WITH_XDEBUG=false


#---------------------------------
# Install Extensions and Utilities
#---------------------------------
# Update repositories and install.
RUN apk update && apk add \
    libzip-dev libmcrypt-dev libpng-dev libjpeg-turbo-dev \
    libxml2-dev icu-dev postgresql-dev curl-dev libmemcached-dev \
    vim zip unzip ca-certificates curl git composer

# Install more programs
# (in a virtual package "build-dependencies", thats's removed above)
RUN apk add --update --virtual build-dependencies build-base gcc \
    wget autoconf dpkg-dev dpkg re2c

# PHP and extensions (extract and install, finally delete it)
RUN docker-php-source extract \
    && docker-php-ext-install gd zip pdo_pgsql pdo_mysql \
    && docker-php-source delete

# Xdebug (if is required)
RUN if [ $WITH_XDEBUG = "true" ]; then \
        echo "Installing X-debug ..." && \
        apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS && \
        pecl install xdebug && \
        docker-php-ext-enable xdebug && \
        apk del .phpize-deps && \
        php -v && \
        php -m; \
    fi;

# Node.js
RUN apk add nodejs nodejs-npm

# Clen-Up (delete "build-dependencies" virtual package and clean apk cache)
RUN apk del build-dependencies && rm -rf /var/cache/apk/*

# Set Entry Point
WORKDIR /var/www/html

# Set local time as : Buenos Aires
RUN apk add tzdata && cp /usr/share/zoneinfo/America/Buenos_Aires /etc/localtime

# Copy Project files inside the container
COPY . /var/www/html

# Set nedded permisions
RUN chmod -R 777 storage
