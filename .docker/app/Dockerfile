FROM node:18 as node

FROM php:8.2-fpm

ENV TZ=Asia/Tokyo

COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer
COPY --from=node /usr/local/bin/node /usr/local/bin/
COPY --from=node /usr/local/lib/node_modules/ /usr/local/lib/node_modules/

RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm \
  && ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npx

# php conf
COPY ./php.ini /usr/local/etc/php/php.ini
COPY ./xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY ./www.conf /usr/local/etc/php-fpm.d/www.conf

# liblaries install
RUN apt-get update \
  && apt-get install -y git unzip vim sqlite3 zip libzip-dev libxml2-dev libpng-dev \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

# php extention install
RUN docker-php-ext-install pdo_mysql zip xml gd iconv simplexml soap \
  && pecl install xdebug \
  && docker-php-ext-enable xdebug

COPY ./entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT [ "/entrypoint.sh" ]
CMD ["php-fpm"]
