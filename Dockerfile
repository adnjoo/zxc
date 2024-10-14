# Use the official PHP-Apache image
FROM php:8.2-apache

# Install PostgreSQL libraries and PHP extensions
RUN apt-get update && \
    apt-get install -y \
    libpq-dev \
    postgresql-client \
    && docker-php-ext-install pdo pdo_pgsql

# Ensure the working directory is the project root
WORKDIR /var/www/html

# Copy everything to the container, including the public directory
COPY . /var/www/html/

# Ensure public/ exists and is accessible
RUN if [ ! -d "public" ]; then echo "Error: public directory not found!"; exit 1; fi

# Expose the Apache port
EXPOSE 80

# Run the migration script and start Apache
CMD ["sh", "-c", "psql $DATABASE_URL < /migrations/migrations.sql && apache2-foreground"]
