# Blizz - cPanel Git Deployment Guide

## Method: cPanel Git Integration (Recommended)

This method uses cPanel's built-in Git integration for automatic deployment with proper Laravel setup.

### Step 1: Set up Git Repository in cPanel

1. **Login to cPanel**
2. **Go to Git Version Control**
3. **Create Repository:**
   - Repository URL: `https://github.com/AravinthSingh/blizz.git`
   - Branch: `production`
   - Repository Path: `blizz` (this creates `/public_html/blizz/`)
   - Repository Name: `blizz`

### Step 2: Configure Subdomain

1. **Go to cPanel → Subdomains**
2. **Create Subdomain:**
   - Subdomain: `blizz`
   - Domain: `yourdomain.com`
   - Document Root: `public_html/blizz/public`

### Step 3: Deploy and Setup

1. **In Git Version Control, click "Pull or Deploy"**
2. **The `.cpanel.yml` file will automatically:**
   - Install Composer dependencies
   - Build CSS/JS assets with npm
   - Generate APP_KEY
   - Run database migrations
   - Set proper permissions
   - Cache configurations

### Step 4: Verify Deployment

1. **Visit:** `https://blizz.yourdomain.com`
2. **Admin Panel:** `https://blizz.yourdomain.com/admin/login`
   - Email: `admin@blizz.com`
   - Password: `password123`

### Future Updates

For future updates, simply:
1. Push changes to `production` branch
2. Go to cPanel Git Version Control
3. Click "Pull or Deploy"
4. Everything is automated!

## Manual Deployment (Alternative)

If Git integration doesn't work:

### Step 1: Build Locally
```bash
git checkout production
npm ci
npm run build
composer install --optimize-autoloader --no-dev
```

### Step 2: Create ZIP
```bash
.\deploy-zip.bat
```

### Step 3: Upload and Extract
1. Upload `blizz-production.zip` to cPanel
2. Extract to `public_html/blizz/`
3. Run `deploy-hooks.sh` script

## Database Configuration

The deployment automatically configures:
- **Database:** `revlhiro_blizz`
- **Username:** `revlhiro_aravinth`
- **Password:** `Revline@Admin`

## Troubleshooting

### HTTP 500 Error
- Check if APP_KEY is generated
- Verify file permissions (755 for storage/, bootstrap/cache/)
- Check error logs in cPanel

### CSS Not Loading
- Ensure `npm run build` completed successfully
- Check `public/build/` directory exists
- Verify Vite manifest file is present

### Database Issues
- Verify database credentials in `.env`
- Check if migrations ran successfully
- Ensure database exists in cPanel MySQL

## File Structure After Deployment

```
public_html/
└── blizz/                    ← Laravel app
    ├── app/
    ├── bootstrap/
    ├── config/
    ├── public/              ← Subdomain document root
    │   ├── index.php
    │   └── build/           ← Compiled assets
    ├── storage/
    ├── .env                 ← Production environment
    └── ...
```

## Security Notes

- `.env` file contains sensitive data - never commit to Git
- Database credentials are configured automatically
- File permissions are set properly during deployment
- Debug mode is disabled in production
