#!/bin/bash

echo "========================================"
echo "  Blizz Ayurveda - Fix Deployment"
echo "========================================"
echo "This script will manually run the deployment steps"
echo "that should have been executed by .cpanel.yml"
echo

# Get current directory
CURRENT_DIR=$(pwd)
echo "Current directory: $CURRENT_DIR"

# Check if we're in Laravel root
if [ ! -f "artisan" ]; then
    echo "❌ Error: artisan file not found!"
    echo "Please run this script from your Laravel root directory"
    echo "Expected location: /public_html/blizz/"
    exit 1
fi

echo "✅ Found Laravel application"
echo

# Check PHP version and path
echo "🔍 Checking PHP configuration..."
PHP_PATH=$(which php)
if [ -z "$PHP_PATH" ]; then
    # Try common cPanel PHP paths
    if [ -f "/usr/local/bin/php" ]; then
        PHP_PATH="/usr/local/bin/php"
    elif [ -f "/opt/cpanel/ea-php82/root/usr/bin/php" ]; then
        PHP_PATH="/opt/cpanel/ea-php82/root/usr/bin/php"
    elif [ -f "/opt/cpanel/ea-php81/root/usr/bin/php" ]; then
        PHP_PATH="/opt/cpanel/ea-php81/root/usr/bin/php"
    else
        PHP_PATH="php"
        echo "⚠️  PHP path not found, using 'php' command"
    fi
fi

echo "PHP path: $PHP_PATH"
$PHP_PATH -v
echo

# Step 1: Set permissions
echo "📁 [1/9] Setting file permissions..."
chmod -R 755 storage/ 2>/dev/null || echo "⚠️  Could not set storage permissions"
chmod -R 755 bootstrap/cache/ 2>/dev/null || echo "⚠️  Could not set bootstrap/cache permissions"
chmod 644 .env* 2>/dev/null || echo "⚠️  Could not set .env permissions"
echo "✅ Permissions set"

# Step 2: Environment file
echo "⚙️  [2/9] Setting up environment file..."
if [ ! -f ".env" ]; then
    if [ -f ".env.subdomain.template" ]; then
        cp .env.subdomain.template .env
        echo "✅ Created .env from subdomain template"
    elif [ -f ".env.example.production" ]; then
        cp .env.example.production .env
        echo "✅ Created .env from production example"
    elif [ -f ".env.example" ]; then
        cp .env.example .env
        echo "✅ Created .env from example"
    else
        echo "❌ No environment template found!"
        exit 1
    fi
    echo "⚠️  IMPORTANT: You need to edit .env with your database credentials!"
else
    echo "✅ Environment file already exists"
fi

# Step 3: Generate App Key
echo "🔑 [3/9] Generating application key..."
$PHP_PATH artisan key:generate --force
if [ $? -eq 0 ]; then
    echo "✅ Application key generated successfully"
else
    echo "❌ Failed to generate application key"
fi

# Step 4: Storage Link
echo "🔗 [4/9] Creating storage symlink..."
$PHP_PATH artisan storage:link
if [ $? -eq 0 ]; then
    echo "✅ Storage symlink created"
else
    echo "⚠️  Storage symlink creation failed (may already exist)"
fi

# Step 5: Clear Caches
echo "🧹 [5/9] Clearing application caches..."
$PHP_PATH artisan config:clear
$PHP_PATH artisan route:clear
$PHP_PATH artisan view:clear
$PHP_PATH artisan cache:clear
echo "✅ Caches cleared"

# Step 6: Database Migration
echo "🗄️  [6/9] Running database migrations..."
$PHP_PATH artisan migrate --force
if [ $? -eq 0 ]; then
    echo "✅ Database migrations completed"
else
    echo "❌ Database migrations failed - check your database configuration in .env"
    echo "Make sure you have:"
    echo "  - Created the database in cPanel"
    echo "  - Updated DB_DATABASE, DB_USERNAME, DB_PASSWORD in .env"
fi

# Step 7: Cache Configurations
echo "💾 [7/9] Caching configurations for production..."
$PHP_PATH artisan config:cache
$PHP_PATH artisan route:cache
$PHP_PATH artisan view:cache
echo "✅ Configurations cached"

# Step 8: Optimize Application
echo "⚡ [8/9] Optimizing application..."
$PHP_PATH artisan optimize
echo "✅ Application optimized"

# Step 9: Final Permissions
echo "🔒 [9/9] Setting final permissions..."
chmod -R 755 storage/ 2>/dev/null || true
chmod -R 755 bootstrap/cache/ 2>/dev/null || true
echo "✅ Final permissions set"

echo
echo "========================================"
echo "  🎉 DEPLOYMENT FIX COMPLETED!"
echo "========================================"
echo
echo "✅ Your Blizz Ayurveda website should now be working!"
echo
echo "🌐 Visit your subdomain to verify:"
echo "   • Main site: https://blizz.yourdomain.com"
echo "   • Admin panel: https://blizz.yourdomain.com/admin"
echo
echo "🔧 If you still see issues:"
echo "   1. Check your .env file has correct database credentials"
echo "   2. Verify your subdomain points to /public_html/blizz/public"
echo "   3. Check error logs in cPanel"
echo
echo "📝 Next time, the updated .cpanel.yml should work automatically!"
echo
