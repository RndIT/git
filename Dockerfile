FROM php:8.2-cli
COPY ./src /usr/src/php-demo-serialize/src
COPY ./composer.* /usr/src/php-demo-serialize/
WORKDIR /usr/src/php-demo-serialize
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
RUN apt-get update && apt install git unzip -y
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN composer install 
WORKDIR /usr/src/php-demo-serialize/src
CMD [ "php", "MessageDTOTest.php" ]