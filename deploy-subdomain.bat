@echo off
echo ========================================
echo   Blizz Ayurveda - Subdomain Deployment
echo ========================================
echo.

echo [1/6] Switching to production branch...
git checkout production
if %errorlevel% neq 0 (
    echo Error: Failed to switch to production branch
    pause
    exit /b 1
)

echo [2/6] Installing NPM dependencies...
call npm ci
if %errorlevel% neq 0 (
    echo Error: NPM install failed
    pause
    exit /b 1
)

echo [3/6] Building production assets...
call npm run build
if %errorlevel% neq 0 (
    echo Error: Asset build failed
    pause
    exit /b 1
)

echo [4/6] Installing Composer dependencies...
call composer install --optimize-autoloader --no-dev
if %errorlevel% neq 0 (
    echo Error: Composer install failed
    pause
    exit /b 1
)

echo [5/6] Creating deployment package...
if exist "blizz-subdomain.zip" del "blizz-subdomain.zip"

powershell -Command "& {
    $exclude = @(
        '.git*',
        'node_modules*',
        '.env',
        'storage\logs\*',
        'storage\framework\cache\*',
        'storage\framework\sessions\*',
        'storage\framework\views\*',
        'tests*',
        '*.bat',
        '*.sh',
        'README*.md',
        'DEPLOYMENT*.md'
    )
    
    Get-ChildItem -Path '.' -Recurse | 
    Where-Object { 
        $item = $_
        -not ($exclude | Where-Object { $item.FullName -like \"*$_*\" })
    } |
    Compress-Archive -DestinationPath 'blizz-subdomain.zip' -Force
}"

if %errorlevel% neq 0 (
    echo Error: Failed to create deployment package
    pause
    exit /b 1
)

echo [6/6] Deployment package created successfully!
echo.
echo ========================================
echo   DEPLOYMENT PACKAGE READY
echo ========================================
echo.
echo File: blizz-subdomain.zip
echo Size: 
for %%A in (blizz-subdomain.zip) do echo %%~zA bytes
echo.
echo NEXT STEPS:
echo 1. Upload blizz-subdomain.zip to your cPanel File Manager
echo 2. Extract to /public_html/blizz/
echo 3. Create subdomain pointing to /public_html/blizz/public
echo 4. Copy .env.subdomain.template to .env and configure
echo 5. Run deployment commands via cPanel Terminal
echo.
echo For detailed instructions, see SUBDOMAIN-DEPLOYMENT.md
echo.
pause
