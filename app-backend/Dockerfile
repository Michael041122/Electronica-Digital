# Dockerfile multi-etapa optimizado para despliegue gratuito (Render / Railway / Koyeb)
FROM php:8.2-fpm-alpine

# Instalar extensiones requeridas para Laravel y MySQL/SQLite
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    oniguruma-dev \
    sqlite-dev

RUN docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd

# Copiar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias optimizadas para producción
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copiar script de arranque y dar permisos
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Permisos para almacenamiento y caché
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

EXPOSE 80 8000

ENTRYPOINT ["docker-entrypoint.sh"]
