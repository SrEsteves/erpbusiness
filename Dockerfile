# Defina a versão base da imagem PHP com Apache
FROM php:8.2-apache

# Defina o diretório público do Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Instale dependências do sistema e extensões do PHP necessárias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Habilite o mod_rewrite do Apache
RUN a2enmod rewrite

# Instale o Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Copie o binário do Composer para o contêiner
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Defina o diretório de trabalho
WORKDIR /var/www/html

# Copie todo o código da aplicação para o contêiner
COPY . .

# Instale as dependências do Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Instale as dependências do NPM e faça o build dos assets
RUN npm install && npm run build

# Ajuste permissões do diretório de armazenamento e cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copie o script de entrada personalizado
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Comando de inicialização do contêiner
CMD ["/usr/local/bin/docker-entrypoint.sh"]