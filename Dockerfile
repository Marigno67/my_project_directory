FROM php:8.2-fpm

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    git \
    && rm -rf /var/lib/apt/lists/*

# Installer les extensions PHP
RUN docker-php-ext-install pdo_mysql opcache intl gd zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/symfony
COPY . /var/www/symfony

# Installer les dépendances Symfony
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Exposer le port de l'application
EXPOSE 9000

CMD ["php-fpm"]