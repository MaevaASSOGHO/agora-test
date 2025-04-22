# Utilise une image PHP officielle avec Apache
FROM php:8.1-apache

# Copie tous tes fichiers dans le dossier /var/www/html
COPY . /var/www/html

# Active les erreurs PHP dans le navigateur (utile en dev)
RUN docker-php-ext-install mysqli && \
    echo "display_errors=On\nerror_reporting=E_ALL" > /usr/local/etc/php/conf.d/errors.ini

# Expose le port 80
EXPOSE 80
