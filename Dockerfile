FROM php:8.1-apache

# Install required PHP extensions
RUN apt-get update \
 && apt-get install -y libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install pdo pdo_mysql gd fileinfo \
 && a2enmod rewrite \
 && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Copy application code
COPY . .

# Ensure Apache can read/write where needed (uploads live under images/)
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
