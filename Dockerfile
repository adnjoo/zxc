# Use the official PHP-Apache image
FROM php:8.2-apache

# Install PostgreSQL libraries and PHP extensions
RUN apt-get update && \
    apt-get install -y \
    libpq-dev \
    postgresql-client \
    && docker-php-ext-install pdo pdo_pgsql

# Copy public files to the Apache web root
COPY public/ /var/www/html/

# Copy the migration scripts to the container
COPY src/migration /migrations

# Set correct permissions for Apache
RUN chown -R www-data:www-data /var/www/html/

# Expose Apache's default port
EXPOSE 80

# Run the migration script and start Apache
CMD ["sh", "-c", "psql $DATABASE_URL < /migrations/migrations.sql && apache2-foreground"]
