#!/bin/bash

set -e

echo "Starting queue worker..."

# Run Laravel queue worker
php artisan queue:work --verbose --tries=3 --timeout=90
