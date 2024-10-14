FROM php:8.2-apache

# Install necessary PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql

# Copy app files to the web root
COPY public/ /var/www/html/

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html/

# Expose the default Apache port
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
