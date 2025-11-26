#!/bin/sh
set -e

<<<<<<< HEAD
echo "🚀 Démarrage du conteneur Symfony..."

# 1. Crée les dossiers nécessaires
mkdir -p var/cache var/log public/uploads

# 2. D'ABORD, on répare l'autoloader pour que Symfony puisse trouver le Kernel
# C'est CRUCIAL de le faire avant d'utiliser 'php bin/console'
echo "⚡ Régénération de l'autoloader..."
composer dump-autoload --optimize 2>/dev/null || echo "⚠️ Echec dump-autoload"

# 3. ENSUITE, on peut attendre la base de données
echo "⏳ Attente de la base de données..."
counter=0
max_attempts=60

# Attendre que le port MySQL soit ouvert (via netcat)
until nc -z database 3306 2>/dev/null; do
  counter=$((counter + 1))
  if [ $counter -gt $max_attempts ]; then
    echo "❌ Erreur : La base de données n'a pas démarré"
    exit 1
  fi
  echo "   Tentative $counter/$max_attempts - Attente du port MySQL..."
  sleep 1
done

echo "📡 Port MySQL ouvert, attente de la disponibilité complète..."
sleep 3

# 4. Maintenant que l'autoloader est prêt, on peut utiliser la console Symfony
counter=0
until php bin/console doctrine:query:sql "SELECT 1"; do
  counter=$((counter + 1))
  if [ $counter -gt 20 ]; then
    echo "❌ Erreur : Impossible de se connecter à la base de données"
    exit 1
  fi
  echo "   Tentative $counter/20 - Connexion Doctrine..."
  sleep 2
done

echo "✅ Base de données connectée !"

# ... Le reste du fichier ne change pas (migrations, cache, permissions...)
echo "🔄 Application des migrations..."
php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration || echo "⚠️  Aucune migration à appliquer"

echo "🔐 Configuration des permissions..."
chown -R www-data:www-data var public/uploads 2>/dev/null || true

echo "✨ Conteneur prêt !"
echo ""

exec "$@"
=======
echo "Entrypoint: Running migrations non-interactively..."
# L'option --no-interaction empêche le script de se bloquer
symfony console doctrine:migrations:migrate --no-interaction

echo "Entrypoint: Setting file permissions..."
chown -R www-data:www-data var public/uploads

echo "Entrypoint: Handing over to www-data to start php-fpm..."
exec gosu www-data "$@"
>>>>>>> 56aa453fb52d4ccf25e7f6c3e1c31f39d0b0cad2
