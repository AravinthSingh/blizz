#!/bin/bash

# 🚨 Emergency CSS Loading Fix Script
# This script provides temporary fixes for CSS loading issues

echo "🔧 Blizz Ayurveda - CSS Loading Fix Script"
echo "=========================================="

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    echo "❌ Error: Please run this script from the Laravel root directory"
    exit 1
fi

echo "📍 Current directory: $(pwd)"

# Solution 1: Create .htaccess redirect (if subdomain root is wrong)
echo "🛠️  Creating .htaccess redirect..."
cat > .htaccess << 'EOF'
<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # Redirect everything to public folder
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
EOF
echo "✅ Created .htaccess redirect"

# Solution 2: Update environment for asset URLs
echo "🛠️  Updating environment configuration..."
if [ -f ".env" ]; then
    # Update existing .env
    sed -i 's|^APP_URL=.*|APP_URL=https://test.revlinetrucks.com|' .env
    
    # Add ASSET_URL if not exists
    if ! grep -q "ASSET_URL" .env; then
        echo "ASSET_URL=https://test.revlinetrucks.com" >> .env
    else
        sed -i 's|^ASSET_URL=.*|ASSET_URL=https://test.revlinetrucks.com|' .env
    fi
    
    echo "✅ Updated .env file"
else
    echo "⚠️  .env file not found, creating from template..."
    cp .env.subdomain.template .env
    sed -i 's|blizz.yourdomain.com|test.revlinetrucks.com|g' .env
    sed -i 's|yourusername_blizz|revlhiro_blizz|g' .env
    echo "✅ Created .env from template"
fi

# Solution 3: Clear and cache configurations
echo "🧹 Clearing Laravel caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

echo "💾 Caching for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Solution 4: Set proper permissions
echo "🔒 Setting file permissions..."
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod 644 .env

# Solution 5: Create storage symlink
echo "🔗 Creating storage symlink..."
php artisan storage:link

# Verification
echo ""
echo "🔍 VERIFICATION:"
echo "=================="

# Check if CSS file exists
if [ -f "public/build/assets/app-CotBYrHi.css" ]; then
    echo "✅ CSS file exists: $(ls -lh public/build/assets/app-CotBYrHi.css | awk '{print $5}')"
else
    echo "❌ CSS file missing"
fi

# Check if manifest exists
if [ -f "public/build/manifest.json" ]; then
    echo "✅ Vite manifest exists"
else
    echo "❌ Vite manifest missing"
fi

# Check .env configuration
if grep -q "test.revlinetrucks.com" .env; then
    echo "✅ Environment URLs configured"
else
    echo "❌ Environment URLs not configured"
fi

echo ""
echo "🎯 NEXT STEPS:"
echo "=============="
echo "1. Visit: https://test.revlinetrucks.com/build/assets/app-CotBYrHi.css"
echo "   (Should show CSS content)"
echo ""
echo "2. Visit: https://test.revlinetrucks.com"
echo "   (Should show styled website)"
echo ""
echo "3. If still not working, contact hosting provider to set"
echo "   subdomain document root to: /public_html/blizz/public"
echo ""
echo "✨ Fix completed! Clear browser cache and test the website."
