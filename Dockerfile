# =============================== 
# Dockerfile Laravel + Apache + PostgreSQL + Vite 
# ===============================

FROM php:8.2-apache

# --- 1. Install system dependencies ---
RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    libicu-dev \
    pkg-config \
    g++ \
    zlib1g-dev \
    libgd-dev \
    build-essential \
    libonig-dev && \
    docker-php-source extract && \
    rm -rf /var/lib/apt/lists/*

# --- 2. Install PHP extensions ---
RUN docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath zip
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN docker-php-source delete

# --- 3. Install Node.js 20 (untuk Vite) ---
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

# --- 4. Enable mod_rewrite Apache ---
RUN a2enmod rewrite

# --- 5. Fix Apache ServerName warning ---
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# --- 6. Set Apache Document Root ke folder Laravel public ---
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# --- 7. Configure Apache untuk Railway ---
RUN echo '<VirtualHost *:${PORT}>' > /etc/apache2/sites-available/000-default.conf && \
    echo '    DocumentRoot ${APACHE_DOCUMENT_ROOT}' >> /etc/apache2/sites-available/000-default.conf && \
    echo '    <Directory ${APACHE_DOCUMENT_ROOT}>' >> /etc/apache2/sites-available/000-default.conf && \
    echo '        AllowOverride All' >> /etc/apache2/sites-available/000-default.conf && \
    echo '        Require all granted' >> /etc/apache2/sites-available/000-default.conf && \
    echo '    </Directory>' >> /etc/apache2/sites-available/000-default.conf && \
    echo '</VirtualHost>' >> /etc/apache2/sites-available/000-default.conf

# --- 8. Ambil Composer dari image resmi ---
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# --- 9. Set working directory ---
WORKDIR /var/www/html

# --- 10. Copy project files ---
COPY . .

# --- 11. Install dependensi Laravel ---
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# --- 12. Install dependensi Node.js ---
RUN npm install --legacy-peer-deps

# --- 13. Build Vite assets ---
RUN npm run build

# --- 14. Fix Vite manifest path ---
RUN if [ -f public/build/.vite/manifest.json ]; then \
    cp public/build/.vite/manifest.json public/build/manifest.json; \
fi

# --- 15. Set proper permissions ---
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache && \
    mkdir -p /var/www/html/public/assets-foto/price_list && \
    chown -R www-data:www-data /var/www/html/public/assets-foto && \
    chmod -R 775 /var/www/html/public/assets-foto

# --- 16. Expose port ---
EXPOSE $PORT

# --- 17. Custom Apache start script dengan migration ---
COPY <<EOF /usr/local/bin/start-apache.sh
#!/bin/bash
set -e

echo "Configuring Apache for Railway..."

# Set port dari environment variable Railway
export PORT=\${PORT:-8080}
sed -i "s/Listen 80/Listen \$PORT/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:\$PORT>/g" /etc/apache2/sites-available/000-default.conf

echo "Setting up Laravel..."

# Setup .env jika belum ada
if [ ! -f .env ]; then
    echo "Creating .env file..."
    cp .env.example .env || true
fi

# Pastikan .env writable
chown www-data:www-data .env
chmod 664 .env

# Generate APP_KEY jika belum ada
php artisan key:generate --no-interaction --force || true

# Buat session table jika belum ada
php artisan session:table --no-interaction || true

# Clear caches
php artisan config:clear --no-interaction || true
php artisan route:clear --no-interaction || true
php artisan view:clear --no-interaction || true

# Test database connection
echo "Testing database connection..."
php artisan migrate:fresh || echo "Migration status check failed, proceeding anyway..."

# Jalankan semua migration
echo "Running database migrations..."
php artisan migrate:fresh --force --no-interaction || echo "Migration failed, continuing..."

# Create storage symlink
php artisan storage:link --no-interaction || true

echo "Starting Apache on port \$PORT..."
exec apache2-foreground
EOF

RUN chmod +x /usr/local/bin/start-apache.sh

# --- 18. Start container dengan custom script ---
CMD ["/usr/local/bin/start-apache.sh"]
