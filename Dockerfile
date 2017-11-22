FROM php:7-apache

# Installing Utilities
RUN apt-get update
RUN apt-get install -y --force-yes git zip unzip zlib1g-dev wget


# Installing composer
RUN curl -s https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer


# RUN composer global require friendsofphp/php-cs-fixer


# Installing PHP Extensions

# Mysqli
RUN /usr/local/bin/docker-php-ext-install mysqli

# PDO:
RUN /usr/local/bin/docker-php-ext-install pdo_mysql

# XDEBUG
RUN pecl install xdebug


# Apache configuration
RUN a2enmod rewrite

# PATH Configuration
RUN export PATH="$PATH:$HOME/.composer/vendor/bin"


# To disable the Apache's Access logs, enable the following:
# RUN ln -sfT /dev/null "/var/log/apache2/access.log"


# Installing PHPUnit
RUN wget https://phar.phpunit.de/phpunit-6.4.phar
RUN chmod +x phpunit-6.4.phar
RUN mv phpunit-6.4.phar /usr/local/bin/phpunit


# PHP.ini configuration
ADD ./build/php/ /usr/local/etc/php

# Adding Source Files
ADD ./source /var/www/html

# Installing dependencies using composer
RUN cd /var/www/html/api && composer install

# Running the Unit-Tests

EXPOSE 80