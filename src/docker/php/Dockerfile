FROM php:8.3-fpm

ENV COMPOSER_ALLOW_SUPERUSER=1

COPY . /usr/share/nginx/html

WORKDIR /usr/share/nginx/html

# Composer install
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip pdo pdo_mysql \
    && docker-php-ext-enable pdo pdo_mysql \
    && pecl install redis && docker-php-ext-enable redis

RUN groupadd -g 1000 www && useradd -u 1000 -ms /bin/bash -g www www

USER www

EXPOSE 9000

CMD ["php-fpm"]
