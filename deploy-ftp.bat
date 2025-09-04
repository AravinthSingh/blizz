@echo off
REM Automated FTP Deployment for Blizz

echo 🚀 Building production assets...
call npm ci
call npm run build
call composer install --optimize-autoloader --no-dev

echo 📦 Creating deployment package...
if exist "deploy-temp" rmdir /s /q deploy-temp
mkdir deploy-temp

REM Copy all necessary files
xcopy /E /I /H /Y app deploy-temp\app
xcopy /E /I /H /Y bootstrap deploy-temp\bootstrap
xcopy /E /I /H /Y config deploy-temp\config
xcopy /E /I /H /Y database deploy-temp\database
xcopy /E /I /H /Y public deploy-temp\public
xcopy /E /I /H /Y resources deploy-temp\resources
xcopy /E /I /H /Y routes deploy-temp\routes
xcopy /E /I /H /Y storage\app deploy-temp\storage\app
xcopy /E /I /H /Y vendor deploy-temp\vendor

REM Create empty directories
mkdir deploy-temp\storage\framework\cache
mkdir deploy-temp\storage\framework\sessions
mkdir deploy-temp\storage\framework\views
mkdir deploy-temp\storage\logs

REM Copy files
copy artisan deploy-temp\
copy composer.json deploy-temp\
copy composer.lock deploy-temp\
copy .env.example.production deploy-temp\.env

echo 📤 Ready for FTP upload!
echo Upload contents of deploy-temp\ folder to public_html/blizz/
echo Then run the setup script on server.

pause
