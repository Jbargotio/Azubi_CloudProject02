# Use the official PHP image with Apache
FROM php:8.2.12-apache

# Copy the content of the current directory to /var/www/html/
COPY . /var/www/html/

# Expose port 80 to the outside world
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]