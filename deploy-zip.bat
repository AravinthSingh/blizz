@echo off
REM Create production ZIP for manual upload to cPanel

echo 🚀 Creating production ZIP for manual deployment...

REM Build production assets
echo 📦 Building production assets...
call npm ci
call npm run build
call composer install --optimize-autoloader --no-dev

REM Create deployment directory
if exist "deployment" rmdir /s /q deployment
mkdir deployment

REM Copy files to deployment directory
echo 📋 Copying files...
xcopy /E /I /H /Y app deployment\app
xcopy /E /I /H /Y bootstrap deployment\bootstrap
xcopy /E /I /H /Y config deployment\config
xcopy /E /I /H /Y database deployment\database
xcopy /E /I /H /Y public deployment\public
xcopy /E /I /H /Y resources deployment\resources
xcopy /E /I /H /Y routes deployment\routes
xcopy /E /I /H /Y vendor deployment\vendor

REM Copy storage but exclude cache/logs
mkdir deployment\storage
xcopy /E /I /H /Y storage\app deployment\storage\app
mkdir deployment\storage\framework
mkdir deployment\storage\logs

REM Copy individual files
copy artisan deployment\
copy composer.json deployment\
copy composer.lock deployment\
copy package.json deployment\
copy package-lock.json deployment\
copy .env.example.production deployment\.env.example

REM Create ZIP file
echo 📦 Creating ZIP archive...
powershell Compress-Archive -Path "deployment\*" -DestinationPath "blizz-production.zip" -Force

REM Cleanup
rmdir /s /q deployment

echo ✅ Production ZIP created: blizz-production.zip
echo 📤 Upload this file to your cPanel File Manager
echo 📁 Extract to public_html/ directory
echo 🔧 Don't forget to create .env file and run migrations!

pause
