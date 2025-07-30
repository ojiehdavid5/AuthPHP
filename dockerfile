FROM php:8.2-cli

# Set working directory
WORKDIR /app

# Copy your PHP files into the container
COPY . .

# Set default command to run a PHP file
CMD ["php", "index.php"]
