#FROM php:8.0-apache
FROM php:8.4-fpm

RUN apt-get update -y && apt-get upgrade -y && apt-get install git libssl-dev -y

RUN docker-php-ext-install pdo pdo_mysql 
