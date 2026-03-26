#!/bin/bash
# render-build.sh

echo "Starting build process..."

# Install composer dependencies
composer install --no-dev --optimize-autoloader

# Copy configuration if needed
cp config/db.php config/db.php.backup

echo "Build completed successfully!"