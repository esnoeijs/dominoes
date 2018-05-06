FROM php:7.2-cli
WORKDIR /usr/src/dominoes/

VOLUME /usr/src/dominoes/

RUN apt-get update \
    && apt-get install -y unzip \
    && apt-get clean  \
    && pecl install xdebug  \
    && docker-php-ext-enable xdebug

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY composer.json ./
RUN composer install --no-autoloader

COPY test/ /usr/src/dominoes/test
COPY src/ /usr/src/dominoes/src

RUN composer dump-autoload --optimize

CMD [ "php", "./src/dominoes.php" ]
