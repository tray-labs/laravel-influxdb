FROM php:8.2-cli

RUN apt-get update && apt-get install -y git unzip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app

COPY composer.json ./

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

COPY . .

CMD ["vendor/bin/phpunit", "--testdox"]
