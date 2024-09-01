#!/bin/bash
set -e

# Debugging
echo "Starting Docker Entry Point"

# # Limpe caches existentes
# php artisan config:clear
# php artisan route:clear
# php artisan view:clear
# php artisan cache:clear

# # Gere a chave da aplicação
# php artisan key:generate --force

# # Gere caches necessários
# php artisan config:cache
# php artisan view:cache

# # Tente criar o cache de rotas, se falhar, continue sem ele
# if php artisan route:cache; then
#     echo "Route cache generated successfully."
# else
#     echo "Skipping route cache due to conflicts."
# fi

# Realize as migrações
# php artisan migrate --force

# Ajuste as permissões
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Debugging
echo "Starting Apache"

# Inicie o Apache em segundo plano
exec apache2-foreground
