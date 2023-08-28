FROM php:8.2-cli
COPY ./src /usr/src/php-demo-serialize
WORKDIR /usr/src/php-demo-serialize
CMD [ "php", "./main.php" ]