@echo off
REM Blizz Auto-Deployment Script for cPanel (Windows)
REM This script syncs main to production and triggers deployment

echo 🚀 Starting Blizz deployment process...

REM Check if we're in the right directory
if not exist "artisan" (
    echo ❌ Error: Not in Laravel project directory
    exit /b 1
)

REM Stash any uncommitted changes
echo 📦 Stashing uncommitted changes...
git stash

REM Switch to main branch and pull latest
echo 🔄 Switching to main branch...
git checkout main
git pull origin main

REM Create or switch to production branch
echo 🏭 Creating/switching to production branch...
git checkout production 2>nul || git checkout -b production

REM Merge main into production
echo 🔀 Merging main into production...
git merge main

REM Build production assets
echo 🏗️ Building production assets...
call npm ci
call npm run build

REM Optimize for production
echo ⚡ Optimizing for production...
call composer install --optimize-autoloader --no-dev

REM Clear and cache Laravel configs
echo 🧹 Clearing Laravel caches...
call php artisan config:clear
call php artisan route:clear
call php artisan view:clear
call php artisan cache:clear

echo 📦 Caching configurations...
call php artisan config:cache
call php artisan route:cache
call php artisan view:cache

REM Push to production branch
echo 📤 Pushing to production branch...
git add .
git commit -m "Production build %date% %time%" || echo No changes to commit
git push origin production

echo ✅ Deployment process completed!
echo 🌐 GitHub Actions will now deploy to your cPanel server
echo.
echo Next steps:
echo 1. Set up GitHub secrets: FTP_HOST, FTP_USERNAME, FTP_PASSWORD
echo 2. Monitor deployment at: https://github.com/AravinthSingh/blizz/actions

pause
