# This Dockerfile uses the latest version of the Bitnami PHP-FPM Docker image
FROM php:7.1-fpm
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pgsql pdo pdo_pgsql && pecl install redis-4.0.1 \
    && docker-php-ext-enable redis
# Copy app's source code to the /app directory
COPY app-code /app

# The application's directory will be the working directory
WORKDIR /app
