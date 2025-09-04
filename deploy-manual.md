# Manual Deployment Options for Blizz

## Option 1: Direct FTP Upload (Recommended)

### Step 1: Build Production Assets Locally
```bash
npm ci
npm run build
composer install --optimize-autoloader --no-dev
```

### Step 2: Create ZIP Archive
Create a ZIP file with these folders/files:
- `app/`
- `bootstrap/`
- `config/`
- `database/`
- `public/`
- `resources/`
- `routes/`
- `storage/` (exclude logs, cache, sessions, views)
- `vendor/`
- `artisan`
- `composer.json`
- `composer.lock`

**Exclude:**
- `.git/`
- `node_modules/`
- `.env`
- `tests/`
- `storage/logs/*`
- `storage/framework/cache/*`
- `storage/framework/sessions/*`
- `storage/framework/views/*`

### Step 3: Upload via cPanel File Manager
1. Login to cPanel
2. Open File Manager
3. Navigate to `public_html/`
4. Upload and extract ZIP file
5. Delete ZIP file after extraction

## Option 2: Git Clone on Server

### Step 1: SSH into cPanel (if available)
```bash
cd public_html/
git clone https://github.com/AravinthSingh/blizz.git .
git checkout production
```

### Step 2: Install Dependencies
```bash
composer install --optimize-autoloader --no-dev
npm ci
npm run build
```

## Option 3: cPanel Git Integration

### Step 1: Enable Git in cPanel
1. Go to cPanel → Git Version Control
2. Create repository from: `https://github.com/AravinthSingh/blizz.git`
3. Set branch to: `production`
4. Set repository path to: `public_html/`

### Step 2: Deploy
1. Click "Pull or Deploy"
2. Run post-deployment commands

## Post-Deployment Setup (All Methods)

### 1. Create .env file
```bash
APP_NAME=Blizz
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=revlhiro_blizz
DB_USERNAME=revlhiro_aravinth
DB_PASSWORD=Revline@Admin

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
LOG_LEVEL=error
```

### 2. Generate App Key
```bash
php artisan key:generate
```

### 3. Run Migrations
```bash
php artisan migrate --seed
```

### 4. Set Permissions
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

### 5. Cache Optimization
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Quick Update Script for Future Deployments

Create `update.sh` on server:
```bash
#!/bin/bash
git pull origin production
composer install --optimize-autoloader --no-dev
npm ci
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo "Deployment complete!"
```
