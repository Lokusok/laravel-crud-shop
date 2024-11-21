FROM php:8.3-fpm

ENV COMPOSER_ALLOW_SUPERUSER=1

COPY . /usr/share/nginx/html

WORKDIR /usr/share/nginx/html

# Composer install
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Node install
RUN apt-get update && apt-get install -y \
    curl \
    gnupg \
    && curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip pdo pdo_mysql \
    && docker-php-ext-enable pdo pdo_mysql

# RUN composer install && npm i

CMD ["php-fpm"]
