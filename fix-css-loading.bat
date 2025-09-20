@echo off
REM 🚨 Emergency CSS Loading Fix Script (Windows)
REM This script provides temporary fixes for CSS loading issues

echo 🔧 Blizz Ayurveda - CSS Loading Fix Script
echo ==========================================

REM Check if we're in the right directory
if not exist "artisan" (
    echo ❌ Error: Please run this script from the Laravel root directory
    pause
    exit /b 1
)

echo 📍 Current directory: %CD%

REM Solution 1: Create .htaccess redirect (if subdomain root is wrong)
echo 🛠️  Creating .htaccess redirect...
(
echo ^<IfModule mod_rewrite.c^>
echo     RewriteEngine On
echo.
echo     # Redirect everything to public folder
echo     RewriteCond %%{REQUEST_URI} !^/public/
echo     RewriteRule ^^(.*)$ public/$1 [L]
echo ^</IfModule^>
) > .htaccess
echo ✅ Created .htaccess redirect

REM Solution 2: Update environment for asset URLs
echo 🛠️  Updating environment configuration...
if exist ".env" (
    echo ✅ .env file exists, updating...
    REM Note: Manual update needed for Windows batch
    echo ⚠️  Please manually update .env file:
    echo    APP_URL=https://test.revlinetrucks.com
    echo    ASSET_URL=https://test.revlinetrucks.com
) else (
    echo ⚠️  .env file not found, copying from template...
    copy .env.subdomain.template .env
    echo ✅ Created .env from template
    echo ⚠️  Please manually update .env file with correct URLs
)

REM Solution 3: Clear and cache configurations
echo 🧹 Clearing Laravel caches...
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

echo 💾 Caching for production...
php artisan config:cache
php artisan route:cache
php artisan view:cache

REM Solution 4: Create storage symlink
echo 🔗 Creating storage symlink...
php artisan storage:link

REM Verification
echo.
echo 🔍 VERIFICATION:
echo ==================

REM Check if CSS file exists
if exist "public\build\assets\app-CotBYrHi.css" (
    echo ✅ CSS file exists
) else (
    echo ❌ CSS file missing
)

REM Check if manifest exists
if exist "public\build\manifest.json" (
    echo ✅ Vite manifest exists
) else (
    echo ❌ Vite manifest missing
)

echo.
echo 🎯 NEXT STEPS:
echo ==============
echo 1. Visit: https://test.revlinetrucks.com/build/assets/app-CotBYrHi.css
echo    (Should show CSS content)
echo.
echo 2. Visit: https://test.revlinetrucks.com
echo    (Should show styled website)
echo.
echo 3. If still not working, contact hosting provider to set
echo    subdomain document root to: /public_html/blizz/public
echo.
echo ✨ Fix completed! Clear browser cache and test the website.

pause
