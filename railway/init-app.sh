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

# Setup storage for public access (Railway/FrankenPHP compatible)
echo "Setting up public storage..."

# Remove old symlink if exists
rm -rf /app/public/storage

# Create public/storage directory
mkdir -p /app/public/storage

# Copy storage/app/public contents to public/storage
if [ -d "/app/storage/app/public" ]; then
    echo "Copying storage files to public/storage..."
    cp -r /app/storage/app/public/* /app/public/storage/ 2>/dev/null || true
    echo "Storage files copied successfully"
else
    echo "Warning: /app/storage/app/public does not exist"
fi

# Set proper permissions
chmod -R 755 /app/public/storage

echo "App initialization complete!"
