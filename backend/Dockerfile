# FROM php:8.2-fpm

# # Installer les dépendances système
# RUN apt-get update && apt-get install -y \
#     git zip unzip libonig-dev libpng-dev libpq-dev default-mysql-client netcat-openbsd \
#     && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# # Installer Composer
# COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# # Copier les fichiers du projet
# WORKDIR /var/www
# COPY . .

# # Installer les dépendances PHP
# RUN composer install --no-dev --optimize-autoloader

# # Générer la clé APP_KEY si nécessaire
# RUN php artisan key:generate --force || true

# EXPOSE 9000

# # Commande d'entrée : attendre MySQL, puis lancer PHP-FPM
# CMD bash -c '\
#     echo "⏳ Attente de MySQL..."; \
#     while ! nc -z mysql_container 3306; do \
#         sleep 1; \
#     done; \
#     echo "✅ MySQL disponible !"; \
#     echo "📝 Préparation de Laravel..."; \
#     php artisan config:clear && php artisan cache:clear; \
#     echo "🔄 Lancement des migrations..."; \
#     php artisan migrate:fresh --force; \
#     echo "✅ Migrations terminées !"; \
#     echo "🚀 Démarrage de PHP-FPM..."; \
#     php-fpm'

FROM php:8.2-fpm

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git zip unzip libonig-dev libpng-dev libpq-dev default-mysql-client netcat-openbsd \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copier les fichiers du projet
WORKDIR /var/www
COPY . .

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Générer la clé APP_KEY si nécessaire
RUN php artisan key:generate --force || true

# Donner les permissions
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 9000

# Commande d'entrée : attendre MySQL, puis lancer le serveur Laravel
CMD bash -c '\
    echo "⏳ Attente de MySQL..."; \
    while ! nc -z mysql_container 3306; do \
        sleep 1; \
    done; \
    echo "✅ MySQL disponible !"; \
    echo "📝 Préparation de Laravel..."; \
    php artisan config:clear && php artisan cache:clear && php artisan route:clear; \
    echo "🔄 Lancement des migrations..."; \
    php artisan migrate:fresh --force; \
    echo "✅ Migrations terminées !"; \
    echo "🚀 Démarrage du serveur Laravel..."; \
    php artisan serve --host=0.0.0.0 --port=9000'