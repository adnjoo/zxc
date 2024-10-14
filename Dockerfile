FROM php:8.2-apache

# Install necessary PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql

# Copy app files to the Apache web root
COPY public/ /var/www/html/

# Copy migration scripts to the container
COPY src/migration /migrations

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html/

# Expose the Apache port
EXPOSE 80

# Run migrations and start Apache
CMD psql $DATABASE_URL < /migrations/migrations.sql && apache2-foreground
