#!/bin/sh
set -e

# Applique les permissions sur le dossier var (qui vient de votre PC via le volume)
setfacl -R -m u:www-data:rwX var
setfacl -dR -m u:www-data:rwX var

# Exécute la commande qui a été passée au conteneur
# (dans notre cas, ce sera "symfony server:start...")
exec "$@"