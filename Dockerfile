FROM php:8.2-fpm

# Installer les dépendances système, y compris acl et netcat
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    git \
    curl \
    acl \
    netcat-traditional \
    && rm -rf /var/lib/apt/lists/*

# Installer les extensions PHP
RUN docker-php-ext-install pdo_mysql opcache intl gd zip

# Configuration OPcache optimisée pour le développement
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.memory_consumption=256" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.max_accelerated_files=20000" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.validate_timestamps=1" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.revalidate_freq=0" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.interned_strings_buffer=16" >> /usr/local/etc/php/conf.d/opcache.ini

# Augmenter la limite de mémoire PHP
RUN echo "memory_limit=512M" >> /usr/local/etc/php/conf.d/memory.ini && \
    echo "max_execution_time=60" >> /usr/local/etc/php/conf.d/memory.ini

# Installer le CLI SYMFONY
RUN curl -sS https://get.symfony.com/cli/installer | bash && \
    find /root/ -name 'symfony' -exec mv {} /usr/local/bin/symfony \;

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/symfony

COPY composer.json composer.lock ./
RUN composer install --optimize-autoloader --no-scripts --classmap-authoritative

COPY . .

# Copier notre script d'entrée et le rendre exécutable
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Définir notre script comme point d'entrée
ENTRYPOINT ["docker-entrypoint.sh"]

# La commande par défaut sera celle de docker-compose.yaml
EXPOSE 9000