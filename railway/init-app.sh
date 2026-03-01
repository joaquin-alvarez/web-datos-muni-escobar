#!/bin/bash

set -e

echo "Running init-app.sh..."

# Generate application key if not set
if [ -z "$APP_KEY" ]; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force --show
    echo "APP_KEY has been generated. Please copy it from above and set it in Railway variables."
fi

# Run migrations
php artisan migrate --force

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Seed database if needed (optional - remove if not needed in production)
php artisan db:seed --force

# Create session table
php artisan session:table

echo "App initialization complete!"
