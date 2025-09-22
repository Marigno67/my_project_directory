FROM php:8.2-fpm

# Installer les dépendances système, y compris acl
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    git \
    curl \
    acl \
    && rm -rf /var/lib/apt/lists/*

# Installer les extensions PHP
RUN docker-php-ext-install pdo_mysql opcache intl gd zip

# Installer le CLI SYMFONY
RUN curl -sS https://get.symfony.com/cli/installer | bash && \
    find /root/ -name 'symfony' -exec mv {} /usr/local/bin/symfony \;

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/symfony

COPY composer.json composer.lock ./
RUN composer install --optimize-autoloader --no-scripts

COPY . .

# Copier notre script d'entrée et le rendre exécutable
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Définir notre script comme point d'entrée
ENTRYPOINT ["docker-entrypoint.sh"]

# La commande par défaut sera celle de docker-compose.yaml
EXPOSE 9000