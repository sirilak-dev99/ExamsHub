FROM php:8.3-fpm

# ติดตั้งไลบรารีพื้นฐานและส่วนขยายของ PHP สำหรับอ่านไฟล์เอกสารและต่อฐานข้อมูล
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo_mysql zip gd

# ติดตั้ง Composer สำหรับจัดการแพ็กเกจของ Laravel
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html