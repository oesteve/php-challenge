FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
		git libzip-dev zip
    
# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

# Install XDebug
# WARNING: This image is only for dev & debug purposes, install and enable xdebug in a production environment may cause
# performance issues
RUN pecl install xdebug zip \
    && docker-php-ext-install mysqli \
    && docker-php-ext-enable xdebug zip mysqli

RUN mkdir /app
WORKDIR /app
