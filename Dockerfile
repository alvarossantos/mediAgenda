FROM php:8.2-apache

# Instala e habilita a extensão mysqli necessária para o seu banco
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli

# Habilita o mod_rewrite do Apache (útil para URLs amigáveis futuras)
RUN a2enmod rewrite

# Ajusta permissões básicas
RUN chown -R www-data:www-data /var/www/html