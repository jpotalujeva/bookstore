FROM php:7.2.10-fpm-alpine3.8

RUN docker-php-ext-install pdo_mysql

#Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --version=1.7.2 --install-dir=/usr/local/bin --filename=composer
#Install phing
RUN curl -Lq http://www.phing.info/get/phing-2.16.1.phar > /usr/local/bin/phing && chmod a+x /usr/local/bin/phing
#allow composer over http
RUN composer config -g secure-http false
#remove apk cache
RUN rm -rf /var/cache/apk/*