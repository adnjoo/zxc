# Use the official PHP image from DockerHub
FROM php:8.2-apache

# Copy project files to the Docker container
COPY . /var/www/html/

# Expose port 80 for HTTP traffic
EXPOSE 80
