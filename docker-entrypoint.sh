#!/bin/sh
set -e

# Crée les dossiers nécessaires s'ils n'existent pas
mkdir -p var/cache var/log public/uploads

# Change le propriétaire des dossiers pour l'utilisateur du serveur web (www-data)
chown -R www-data:www-data var public/uploads

# Exécute la commande qui a été passée au conteneur (symfony server:start...)
exec "$@"