FROM php:8.0-apache

# Installation de l'extension mysqli pour MySQL
RUN docker-php-ext-install mysqli

# Copie des fichiers de l'application dans le container
COPY . /var/www/html/


# Modification des permissions pour Apache

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Exposition du port 80 pour accéder à l'application via HTTP
EXPOSE 80
