FROM php:apache

RUN apt-get -qq update && \
    apt-get -qq install -y zip unzip zlib1g-dev libpng-dev libonig-dev libzip-dev

RUN docker-php-ext-install gd mbstring mysqli pdo pdo_mysql zip
RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN curl -sL https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite

RUN sed -i -E 's|^(\s*DocumentRoot).*$|\1 /var/www/public|g' /etc/apache2/sites-available/*

WORKDIR /var/www

COPY --chown=www-data:www-data composer.json composer.lock ./

RUN composer install --no-interaction --no-ansi --no-scripts

COPY --chown=www-data:www-data ./ ./

RUN composer install --no-interaction --no-ansi
