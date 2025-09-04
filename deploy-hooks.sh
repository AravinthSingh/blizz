#!/bin/bash

# cPanel Git Deployment Hook for Blizz Laravel App
# This script runs after Git deployment to set up Laravel

echo "🚀 Starting Laravel deployment setup..."

# Set deployment path (update this to match your cPanel path)
DEPLOY_PATH="/home/revlhiro/public_html/blizz"

# Navigate to deployment directory
cd $DEPLOY_PATH

# Install Composer dependencies (production)
echo "📦 Installing Composer dependencies..."
composer install --optimize-autoloader --no-dev --no-interaction

# Install NPM dependencies and build assets
echo "🏗️ Building frontend assets..."
npm ci --silent
npm run build

# Create .env file if it doesn't exist
if [ ! -f .env ]; then
    echo "📝 Creating .env file..."
    cp .env.example.production .env
    
    # Update database credentials
    sed -i "s/DB_DATABASE=.*/DB_DATABASE=revlhiro_blizz/" .env
    sed -i "s/DB_USERNAME=.*/DB_USERNAME=revlhiro_aravinth/" .env
    sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=Revline@Admin/" .env
    sed -i "s|APP_URL=.*|APP_URL=https://blizz.yourdomain.com|" .env
fi

# Generate application key
echo "🔑 Generating application key..."
php artisan key:generate --force

# Set proper permissions
echo "🔒 Setting file permissions..."
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod 644 .env

# Clear all caches
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Run database migrations
echo "🗄️ Running database migrations..."
php artisan migrate --seed --force

# Cache configurations for production
echo "⚡ Caching configurations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Laravel deployment completed successfully!"
echo "🌐 Your site should now be live at: https://blizz.yourdomain.com"
