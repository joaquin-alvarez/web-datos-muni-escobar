#!/bin/bash

set -e

echo "Running init-app.sh..."

# Generate application key if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Run migrations
php artisan migrate --force

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Seed database if needed (optional - remove if not needed in production)
# php artisan db:seed --force

echo "App initialization complete!"
