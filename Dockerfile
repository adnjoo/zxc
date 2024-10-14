# Use the official PHP image
FROM php:8.2-cli

# Install PostgreSQL client and required PHP extensions
RUN apt-get update && \
    apt-get install -y \
    libpq-dev \
    postgresql-client \
    && docker-php-ext-install pdo pdo_pgsql

# Set the working directory to /app
WORKDIR /app

# Copy the application files into the container
COPY . /app

# Ensure the public/ directory exists
RUN if [ ! -d "public" ]; then echo "Error: public directory not found!"; exit 1; fi

# Expose port 3000 required by Railway
EXPOSE 3000

# Command to run PHP's built-in server
CMD ["php", "-S", "0.0.0.0:3000", "-t", "public"]
