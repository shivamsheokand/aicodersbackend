#!/bin/bash

# Put application in maintenance mode
php artisan down

# Install dependencies
composer install --no-dev --optimize-autoloader

# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Optimize the application
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations
php artisan migrate --force

# Create storage link
php artisan storage:link

# Set proper permissions
chmod -R 755 storage bootstrap/cache

# Build frontend assets
npm ci
npm run build

# Take application out of maintenance mode
php artisan up