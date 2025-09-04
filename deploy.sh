#!/bin/bash

# Blizz Auto-Deployment Script for cPanel
# This script syncs main to production and triggers deployment

echo "🚀 Starting Blizz deployment process..."

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    echo "❌ Error: Not in Laravel project directory"
    exit 1
fi

# Stash any uncommitted changes
echo "📦 Stashing uncommitted changes..."
git stash

# Switch to main branch and pull latest
echo "🔄 Switching to main branch..."
git checkout main
git pull origin main

# Switch to production branch
echo "🏭 Switching to production branch..."
git checkout production

# Merge main into production
echo "🔀 Merging main into production..."
git merge main

# Build production assets
echo "🏗️ Building production assets..."
npm ci
npm run build

# Optimize for production
echo "⚡ Optimizing for production..."
composer install --optimize-autoloader --no-dev

# Clear and cache Laravel configs
echo "🧹 Clearing Laravel caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

echo "📦 Caching configurations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Push to production branch
echo "📤 Pushing to production branch..."
git add .
git commit -m "Production build $(date '+%Y-%m-%d %H:%M:%S')" || echo "No changes to commit"
git push origin production

echo "✅ Deployment process completed!"
echo "🌐 GitHub Actions will now deploy to your cPanel server"
echo ""
echo "Next steps:"
echo "1. Set up GitHub secrets: FTP_HOST, FTP_USERNAME, FTP_PASSWORD"
echo "2. Monitor deployment at: https://github.com/AravinthSingh/blizz/actions"
