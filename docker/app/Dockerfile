FROM node:18-alpine3.18 AS node
FROM composer:latest AS composer
FROM php:8.4-fpm-alpine3.21

ARG TZ=UTC
ARG UID=1000
ARG GID=1000

WORKDIR /var/www

# Установка timezone
RUN set -eux \
    && apk add --no-cache tzdata \
    && cp /usr/share/zoneinfo/${TZ} /etc/localtime \
    && echo "${TZ}" > /etc/timezone \
    && apk del tzdata

# Установка пакетов
RUN set -eux \
    && apk add --no-cache \
        shadow \
        openssh \
        openssl \
        bash \
        zsh \
        zsh-vcs \
        linux-headers \
        freetype \
        icu \
        icu-libs \
        libzip \
        libpng \
        libjpeg-turbo \
        imagemagick \
        build-base \
        procps \
        make \
        nano \
        git \
        wget \
        libwebp \
        libwebp-tools \
        lz4 \
        postgresql-dev

# Установка php пакетов
RUN set -eux \
    && apk add --no-cache --virtual .build-deps-php \
        $PHPIZE_DEPS \
        openssl-dev \
        zlib-dev \
        imagemagick-dev \
        icu-dev \
        g++ \
        automake \
        autoconf \
        libzip-dev \
        libpng-dev \
        libwebp-dev \
        libjpeg-turbo-dev \
        freetype-dev \
    && pecl install redis xdebug \
    && docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        gd \
        pdo \
        pgsql \
        pdo_pgsql \
        intl \
        pcntl \
        opcache \
        exif \
        zip \
        sockets \
    && docker-php-ext-enable redis xdebug \
    && apk del .build-deps-php \
    && rm -rf /usr/src/php* /tmp/pear

# Установка nodejs, npm
COPY --from=node /usr/local/bin/node /usr/local/bin/node
COPY --from=node /usr/local/include/node /usr/local/include/node
COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm \
    && ln -s /usr/local/lib/node_modules/npm/bin/npx-cli.js /usr/local/bin/npx

# Установка php.ini
RUN cp "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Установка composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Настройка git
RUN git config --system --add safe.directory '*'

# Настройка пользователя
RUN usermod -u ${UID} www-data && groupmod -g ${GID} www-data

USER www-data

# Установка oh-my-zsh и плагинов
RUN sh -c "$(curl -fsSL https://raw.githubusercontent.com/ohmyzsh/ohmyzsh/master/tools/install.sh)" "" --unattended \
    && git clone https://github.com/zsh-users/zsh-syntax-highlighting /home/www-data/.oh-my-zsh/custom/plugins/zsh-syntax-highlighting \
    && git clone https://github.com/zsh-users/zsh-autosuggestions /home/www-data/.oh-my-zsh/custom/plugins/zsh-autosuggestions

EXPOSE 9000 8000 5173 8005

CMD ["php-fpm"]