FROM grpc/php:latest

WORKDIR /var/www

COPY . /var/www/html

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN curl -L https://getcomposer.org/installer -o composer-setup.php && \
      php composer-setup.php && \
      rm  composer-setup.php && \
      mv composer.phar /usr/local/bin/composer && \
    chmod +rx /usr/local/bin/composer