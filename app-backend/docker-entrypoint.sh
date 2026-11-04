#!/bin/sh
set -e

echo "🚀 Iniciando preparación para producción de Electrónica Digital MX..."

# Crear base de datos sqlite si no existe
if [ ! -f /var/www/html/database/database.sqlite ]; then
    touch /var/www/html/database/database.sqlite
    echo "📁 database.sqlite creado."
fi

# Ejecutar migraciones y seeders iniciales
php artisan migrate --force --isolated
php artisan db:seed --force

# Optimización de caché para máximo rendimiento
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Sistema optimizado y listo."

# Iniciar servidor web de producción
exec php artisan serve --host=0.0.0.0 --port=8000
