FROM php:7.4-cli
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#install some base extensions
RUN apt-get update -y && \
    apt-get install -y libzip-dev zip && \
    docker-php-ext-install zip && \
    apt-get clean
WORKDIR /usr/src/holidays
