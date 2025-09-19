#!/bin/bash

echo "========================================"
echo "  Blizz Ayurveda - Subdomain Deployment"
echo "========================================"
echo

echo "[1/6] Switching to production branch..."
git checkout production
if [ $? -ne 0 ]; then
    echo "Error: Failed to switch to production branch"
    exit 1
fi

echo "[2/6] Installing NPM dependencies..."
npm ci
if [ $? -ne 0 ]; then
    echo "Error: NPM install failed"
    exit 1
fi

echo "[3/6] Building production assets..."
npm run build
if [ $? -ne 0 ]; then
    echo "Error: Asset build failed"
    exit 1
fi

echo "[4/6] Installing Composer dependencies..."
composer install --optimize-autoloader --no-dev
if [ $? -ne 0 ]; then
    echo "Error: Composer install failed"
    exit 1
fi

echo "[5/6] Creating deployment package..."
rm -f blizz-subdomain.tar.gz

tar -czf blizz-subdomain.tar.gz \
    --exclude='.git*' \
    --exclude='node_modules' \
    --exclude='.env' \
    --exclude='storage/logs/*' \
    --exclude='storage/framework/cache/*' \
    --exclude='storage/framework/sessions/*' \
    --exclude='storage/framework/views/*' \
    --exclude='tests' \
    --exclude='*.bat' \
    --exclude='*.sh' \
    --exclude='README*.md' \
    --exclude='DEPLOYMENT*.md' \
    .

if [ $? -ne 0 ]; then
    echo "Error: Failed to create deployment package"
    exit 1
fi

echo "[6/6] Deployment package created successfully!"
echo
echo "========================================"
echo "  DEPLOYMENT PACKAGE READY"
echo "========================================"
echo
echo "File: blizz-subdomain.tar.gz"
echo "Size: $(du -h blizz-subdomain.tar.gz | cut -f1)"
echo
echo "NEXT STEPS:"
echo "1. Upload blizz-subdomain.tar.gz to your cPanel File Manager"
echo "2. Extract to /public_html/blizz/"
echo "3. Create subdomain pointing to /public_html/blizz/public"
echo "4. Copy .env.subdomain.template to .env and configure"
echo "5. Run deployment commands via cPanel Terminal"
echo
echo "For detailed instructions, see SUBDOMAIN-DEPLOYMENT.md"
echo
