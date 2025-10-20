FROM php:8.2-fpm

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    git \
    curl \
    acl \
    dos2unix \
    && rm -rf /var/lib/apt/lists/*

# Installer les extensions PHP
RUN docker-php-ext-install pdo_mysql opcache intl gd zip

# Installer le CLI SYMFONY
RUN curl -sS https://get.symfony.com/cli/installer | bash && \
    find /root/ -name 'symfony' -exec mv {} /usr/local/bin/symfony \;

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/symfony

# Copier les fichiers de dépendances et les installer
COPY composer.json composer.lock ./
RUN composer install --optimize-autoloader --no-scripts

# Copier le reste du code de l'application
COPY . .

# Copier le script d'entrée, le convertir et le rendre exécutable
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN dos2unix /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Définir notre script comme point d'entrée
ENTRYPOINT ["docker-entrypoint.sh"]

# La commande par défaut sera "php-fpm"
CMD ["php-fpm"]

# Exposer le port pour le service PHP-FPM
EXPOSE 9000