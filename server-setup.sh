#!/bin/bash

echo "========================================"
echo "  Blizz Ayurveda - Server Setup Script"
echo "========================================"
echo "Run this script on your shared server after uploading files"
echo

# Get the current directory (should be the Laravel root)
LARAVEL_ROOT=$(pwd)
echo "Laravel root: $LARAVEL_ROOT"
echo

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    echo "Error: artisan file not found. Please run this script from Laravel root directory."
    exit 1
fi

echo "[1/8] Setting proper file permissions..."
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod 644 .env 2>/dev/null || echo "Note: .env file not found yet"
echo "✓ Permissions set"

echo "[2/8] Copying environment configuration..."
if [ ! -f ".env" ]; then
    if [ -f ".env.subdomain.template" ]; then
        cp .env.subdomain.template .env
        echo "✓ Environment file created from template"
        echo "⚠️  IMPORTANT: Edit .env file with your database credentials!"
    elif [ -f ".env.example.production" ]; then
        cp .env.example.production .env
        echo "✓ Environment file created from production example"
        echo "⚠️  IMPORTANT: Edit .env file with your database credentials!"
    else
        echo "⚠️  No environment template found. Please create .env manually."
    fi
else
    echo "✓ Environment file already exists"
fi

echo "[3/8] Generating application key..."
php artisan key:generate --force
if [ $? -eq 0 ]; then
    echo "✓ Application key generated"
else
    echo "⚠️  Failed to generate application key"
fi

echo "[4/8] Creating storage symlink..."
php artisan storage:link
if [ $? -eq 0 ]; then
    echo "✓ Storage symlink created"
else
    echo "⚠️  Failed to create storage symlink"
fi

echo "[5/8] Running database migrations..."
php artisan migrate --force
if [ $? -eq 0 ]; then
    echo "✓ Database migrations completed"
else
    echo "⚠️  Database migrations failed. Check your database configuration."
fi

echo "[6/8] Clearing application caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
echo "✓ Caches cleared"

echo "[7/8] Caching configurations for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo "✓ Configurations cached"

echo "[8/8] Optimizing application..."
php artisan optimize
echo "✓ Application optimized"

echo
echo "========================================"
echo "  SETUP COMPLETED!"
echo "========================================"
echo
echo "✅ Your Blizz Ayurveda website should now be ready!"
echo
echo "NEXT STEPS:"
echo "1. Visit your subdomain: https://blizz.yourdomain.com"
echo "2. Check admin panel: https://blizz.yourdomain.com/admin"
echo "3. If you see errors, check the troubleshooting guide"
echo
echo "IMPORTANT NOTES:"
echo "• Make sure your .env file has correct database credentials"
echo "• Ensure your subdomain points to /public_html/blizz/public"
echo "• Check that all required PHP extensions are installed"
echo
echo "For support, refer to SUBDOMAIN-DEPLOYMENT.md"
echo
