FROM php:8.2-apache-bookworm

# Install system dependencies & required PHP extensions for CodeIgniter 4
RUN apt-get update && apt-get install -y --no-install-recommends \
        curl \
        git \
        unzip \
        libicu-dev \
        libzip-dev \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        gd \
        intl \
        mbstring \
        mysqli \
        pdo_mysql \
        zip \
        opcache \
    && rm -rf /var/lib/apt/lists/*

# Copy Composer binary from official pinned image
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

# Configure Apache DocumentRoot to /var/www/html/public and enable URL rewriting
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN a2enmod rewrite headers \
    && sed -ri -e "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/*.conf \
    && sed -ri -e "s!/var/www/!${APACHE_DOCUMENT_ROOT}/!g" /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && sed -ri -e "s!AllowOverride None!AllowOverride All!g" /etc/apache2/apache2.conf \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Configure PHP runtime settings for CodeIgniter 4
RUN { \
        echo "variables_order = EGPCS"; \
        echo "upload_max_filesize = 10M"; \
        echo "post_max_size = 12M"; \
        echo "memory_limit = 256M"; \
        echo "date.timezone = Asia/Jakarta"; \
    } > /usr/local/etc/php/conf.d/orionclinic.ini

WORKDIR /var/www/html

# Install Composer dependencies reproducibly from composer.lock (including dev deps for testing)
COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
    && cp -a /var/www/html/vendor /opt/vendor-dist \
    && sha256sum composer.lock > /opt/vendor-dist/.lock-hash \
    && cp /opt/vendor-dist/.lock-hash /var/www/html/vendor/.lock-hash

# Copy application source code
COPY . .

# Create idempotent entrypoint script to keep vendor/ and writable/ healthy with bind mounts
RUN cat <<'EOF' > /usr/local/bin/orion-entrypoint.sh
#!/bin/sh
set -e

if [ ! -f /var/www/html/vendor/autoload.php ] || ! cmp -s /opt/vendor-dist/.lock-hash /var/www/html/vendor/.lock-hash 2>/dev/null; then
    echo "[Orion Entrypoint] Menyinkronkan dependensi Composer ke /var/www/html/vendor..."
    mkdir -p /var/www/html/vendor
    cp -a /opt/vendor-dist/. /var/www/html/vendor/
fi

mkdir -p \
    /var/www/html/writable/cache \
    /var/www/html/writable/logs \
    /var/www/html/writable/session \
    /var/www/html/writable/uploads \
    /var/www/html/writable/debugbar \
    /var/www/html/public/uploads/payments \
    /var/www/html/public/uploads/chat

HOST_UID=$(stat -c '%u' /var/www/html 2>/dev/null || echo 33)
chown -R "${HOST_UID}:www-data" /var/www/html/writable /var/www/html/public/uploads 2>/dev/null || true
find /var/www/html/writable /var/www/html/public/uploads -type d -exec chmod 2775 {} + 2>/dev/null || true
find /var/www/html/writable /var/www/html/public/uploads -type f -exec chmod 0664 {} + 2>/dev/null || true
umask 0002

exec docker-php-entrypoint "$@"
EOF
RUN chmod +x /usr/local/bin/orion-entrypoint.sh \
    && mkdir -p writable/cache writable/logs writable/session writable/uploads writable/debugbar public/uploads \
    && chown -R www-data:www-data writable public/uploads

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/orion-entrypoint.sh"]
CMD ["apache2-foreground"]
