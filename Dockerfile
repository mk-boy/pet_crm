FROM php:8.5-fpm

# Установка системных зависимостей, необходимых для PHP
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Установка расширений PHP для работы с PostgreSQL и нужд Laravel
RUN docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# Копируем Composer из официального образа
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Копируем файлы зависимостей для кэширования слоев Docker
COPY composer.json composer.lock ./

# Устанавливаем зависимости без запуска скриптов Laravel
RUN composer install --no-scripts --no-autoloader --prefer-dist

# Копируем весь остальной код проекта
COPY . .

# Генерируем финальный автозагрузчик классов
RUN composer dump-autoload --optimize

# Назначаем права для корректной работы кэша и логов Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
