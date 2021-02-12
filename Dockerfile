FROM militska/pthread_php_zts:latest

MAINTAINER Baryshev V <baryshev1983@yandex.ru>

RUN apt-get update && apt-get install -y curl wget git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN git clone https://github.com/baryshev1983/process-leads.git 
RUN cd process-leads && composer install

WORKDIR /var/www/process-leads
RUN echo | php index.php
                                 