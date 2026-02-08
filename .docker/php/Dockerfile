FROM php:8.4-fpm

ARG WORKDIR
WORKDIR ${WORKDIR}

# System dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    nano \
    rsync \
    libxml2-dev \
    zip \
    curl \
    && rm -rf /var/lib/apt/lists/*

# PHP extensions
RUN docker-php-ext-install \
    xml \
    pdo \
    pdo_mysql

# Redis extension
RUN pecl install redis \
    && docker-php-ext-enable redis

# Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Composer
RUN php -r "readfile('https://getcomposer.org/installer');" | php \
    -- --install-dir=/usr/bin/ --filename=composer

ENV TERM xterm-256color

EXPOSE 9000
CMD ["php-fpm"]
