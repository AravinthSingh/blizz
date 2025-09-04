# Blizz E-commerce Deployment Guide

## Quick Deployment

### Windows (Recommended)
```bash
deploy.bat
```

### Linux/Mac
```bash
chmod +x deploy.sh
./deploy.sh
```

## Manual Deployment Steps

### 1. Create Production Branch
```bash
git checkout main
git pull origin main
git checkout -b production
git push origin production
```

### 2. Setup GitHub Secrets
Go to: `https://github.com/AravinthSingh/blizz/settings/secrets/actions`

Add these secrets:
- `FTP_HOST` - Your cPanel FTP hostname
- `FTP_USERNAME` - Your cPanel FTP username  
- `FTP_PASSWORD` - Your cPanel FTP password

### 3. Deploy to Production
```bash
# Switch to production branch
git checkout production

# Merge latest changes from main
git merge main

# Build production assets
npm ci
npm run build

# Optimize for production
composer install --optimize-autoloader --no-dev

# Clear caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Cache for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Commit and push
git add .
git commit -m "Production build $(date)"
git push origin production
```

## cPanel Server Setup

### 1. Database Setup
- Create MySQL database in cPanel
- Import your local database or run migrations
- Update `.env` file with production database credentials

### 2. File Permissions
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

### 3. Environment File
- Copy `.env.example.production` to `.env`
- Update all production values
- Generate app key: `php artisan key:generate`

### 4. Run Migrations (First Time Only)
```bash
php artisan migrate --seed
```

## Automatic Deployment

Once GitHub secrets are configured, every push to `production` branch will:

1. ✅ Install dependencies
2. ✅ Build CSS/JS assets  
3. ✅ Optimize for production
4. ✅ Deploy via FTP to cPanel
5. ✅ Clear caches

## Monitoring

- **GitHub Actions**: https://github.com/AravinthSingh/blizz/actions
- **Production Site**: Your cPanel domain
- **Admin Panel**: yourdomain.com/admin/login

## Troubleshooting

### CSS Not Loading
- Ensure `npm run build` completed successfully
- Check `public/build/` directory exists
- Verify Vite manifest file is present

### Database Issues
- Check `.env` database credentials
- Ensure database exists in cPanel
- Run `php artisan migrate:status`

### File Permissions
```bash
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```
