#FROM php:7.1-fpm

FROM militska/pthread_php_zts:latest
MAINTAINER Baryshev V <baryshev1983@yandex.ru>
RUN apt-get update && apt-get install -y curl wget git 
#        libfreetype6-dev \
#        libjpeg62-turbo-dev \
#       libmcrypt-dev \
#    && docker-php-ext-install -j$(nproc) iconv mcrypt mbstring mysqli pdo_mysql zip \
#    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
#    && docker-php-ext-install -j$(nproc) gd
    
# Куда же без composer'а.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN git clone https://github.com/baryshev1983/process-leads.git 
RUN cd process-leads && composer install

# Добавим свой php.ini, можем в нем определять свои значения конфига
#ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini

# Указываем рабочую директорию для PHP
WORKDIR /var/www/process-leads
RUN echo '--------------------------------- Запуск обработки лидов --------------------------------------'
RUN echo | php index.php
RUN echo '----------------------------------- Обработка окончена ----------------------------------------'
                                 