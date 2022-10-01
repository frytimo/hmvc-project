FROM php:alpine

ENV REDIS_VERSION 5.3.7

# Install Postgres PHP extension dependencies
RUN apk --no-cache add \
  php81-fpm \
  php81-dev \
  postgresql-dev \
  autoconf \
  bzip2 \
  bzip2-dev \
  libzip \
  libzip-dev \
  libxml2-dev \
  dpkg-dev \
  dpkg \
  libmagic \
  file \
  musl-dev \
  libc-dev \
  g++ \
  make \
  re2c \
  php81-bcmath \
  php81-common \
  php81-ctype \
  php81-dom \
  php81-fileinfo \
  php81-json \
  php81-mbstring \
  php81-openssl \
  php81-pdo \
  php81-pdo_pgsql \
  php81-pgsql \
  php81-tokenizer \
  php81-xml \
  php81-xmlwriter \
  php81-session \
  php81-pecl-redis \
  pcre

# install composer for 8.1
RUN curl -sS https://getcomposer.org/installer -o /tmp/composer-installer.php && php /tmp/composer-installer.php --install-dir=/usr/local/bin --filename=composer

# Install Postgres and Redis PHP extensions
RUN docker-php-ext-install pdo_pgsql && docker-php-source delete

RUN pecl install redis

RUN pecl install xdebug

# Install Supervisor
RUN apk --no-cache add supervisor && mkdir /etc/supervisor.d

# Create user and group
RUN addgroup -S -g 1000 www && adduser -S -D -u 1000 -G www www

# Create workdir
RUN mkdir /www && touch /www/docker-volume-not-mounted && chown www:www /www
WORKDIR /www

# Supervisor will run PHP-FPM and Laravel queue workers
CMD ["supervisord", "--nodaemon", "--configuration", "/etc/supervisord.conf"]
