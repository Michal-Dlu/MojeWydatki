# Wybór obrazu bazowego PHP z Apache
FROM php:8.2-apache

# Instalacja zależności systemowych
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalacja rozszerzeń PHP
RUN docker-php-ext-install pdo mbstring exif pcntl bcmath gd

# Włączenie modułu Apache rewrite
RUN a2enmod rewrite

# Instalacja Composera
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Ustawienie katalogu roboczego
WORKDIR /var/www/html

# Kopiowanie plików composer.json i composer.lock (pozwala na wykorzystanie cache w Dockerze)
COPY composer.json composer.lock /var/www/html/

# Instalacja zależności PHP
RUN composer install --no-autoloader --no-scripts

# Kopiowanie reszty plików aplikacji
COPY . /var/www/html/

# Generowanie autoloadera
RUN composer dump-autoload --optimize

# Ustawienie odpowiednich uprawnień do katalogów storage i bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Eksponowanie portu 80
EXPOSE 80

# Ustawienie zmiennych środowiskowych dla aplikacji Laravel
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV APP_KEY=base64:YourBase64EncodedKeyHere
ENV DB_CONNECTION=mysql
ENV DB_HOST=db
ENV DB_PORT=3306
ENV DB_DATABASE=mojewydatki
ENV DB_USERNAME=root
ENV DB_PASSWORD=yourpassword

# Uruchomienie serwera Apache w trybie pierwszoplanowym
CMD ["apache2-foreground"]
