# 🌿 Blizz Ayurveda - Subdomain Deployment Guide

Complete guide for deploying Blizz Ayurveda e-commerce website to a shared server subdomain.

## 🚀 Quick Deployment Steps

### Method 1: cPanel Git Integration (Recommended)

#### Step 1: Setup Git Repository in cPanel
1. **Login to your cPanel**
2. **Navigate to "Git Version Control"**
3. **Create Repository:**
   ```
   Repository URL: https://github.com/AravinthSingh/blizz.git
   Branch: production
   Repository Path: blizz
   Repository Name: blizz-ayurveda
   ```

#### Step 2: Create Subdomain
1. **Go to cPanel → Subdomains**
2. **Create New Subdomain:**
   ```
   Subdomain: blizz (or your preferred name)
   Domain: yourdomain.com
   Document Root: public_html/blizz/public
   ```
   
   **Result:** `https://blizz.yourdomain.com`

#### Step 3: Configure Database
1. **Go to cPanel → MySQL Databases**
2. **Create Database:** `yourusername_blizz`
3. **Create User:** `yourusername_blizz_user`
4. **Set Password:** (secure password)
5. **Add User to Database** with ALL PRIVILEGES

#### Step 4: Update Environment Configuration
1. **In cPanel File Manager, navigate to `/public_html/blizz/`**
2. **Copy `.env.example.production` to `.env`**
3. **Edit `.env` file with your details:**
   ```env
   APP_NAME="Blizz Ayurveda"
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://blizz.yourdomain.com

   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=yourusername_blizz
   DB_USERNAME=yourusername_blizz_user
   DB_PASSWORD=your_secure_password
   ```

#### Step 5: Deploy
1. **In Git Version Control, click "Pull or Deploy"**
2. **The deployment will automatically:**
   - Install Composer dependencies
   - Generate APP_KEY
   - Run database migrations
   - Set proper permissions
   - Cache configurations
   - Create storage symlink

#### Step 6: Verify Deployment
1. **Visit:** `https://blizz.yourdomain.com`
2. **Admin Panel:** `https://blizz.yourdomain.com/admin/login`
   - Default credentials will be created during migration

---

### Method 2: Manual FTP Deployment

#### Step 1: Build Locally
```bash
# Switch to production branch
git checkout production

# Install dependencies and build
npm ci
npm run build
composer install --optimize-autoloader --no-dev

# Create deployment package
.\deploy-zip.bat
```

#### Step 2: Upload via FTP/cPanel
1. **Upload `blizz-production.zip` to cPanel File Manager**
2. **Extract to `/public_html/blizz/`**
3. **Set up subdomain pointing to `/public_html/blizz/public`**

#### Step 3: Run Setup Commands
```bash
# SSH into your server or use cPanel Terminal
cd /public_html/blizz

# Set permissions
chmod -R 755 storage bootstrap/cache

# Copy environment file
cp .env.example.production .env

# Generate app key
php artisan key:generate --force

# Run migrations
php artisan migrate --force

# Create storage link
php artisan storage:link

# Cache configurations
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🔧 Configuration Details

### Subdomain Structure
```
yourdomain.com/
├── public_html/
│   └── blizz/                    ← Laravel application root
│       ├── app/
│       ├── bootstrap/
│       ├── config/
│       ├── database/
│       ├── public/              ← Subdomain document root
│       │   ├── index.php        ← Entry point
│       │   ├── build/           ← Compiled CSS/JS assets
│       │   └── storage/         ← Symlinked storage
│       ├── resources/
│       ├── routes/
│       ├── storage/
│       ├── .env                 ← Production environment
│       └── vendor/
```

### Required PHP Extensions
- PHP 8.1 or higher
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

### File Permissions
```bash
# Laravel requires these permissions
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod 644 .env
```

---

## 🌿 Ayurvedic Features Included

### Frontend Features
- ✅ Beautiful Ayurvedic-themed design
- ✅ Product catalog with advanced filtering
- ✅ Shopping cart functionality
- ✅ Customer testimonials
- ✅ Newsletter subscription
- ✅ Mobile-responsive design
- ✅ Nature animations and effects

### Admin Panel Features
- ✅ Complete dashboard with analytics
- ✅ Product management (CRUD)
- ✅ Order management system
- ✅ Pre-orders handling
- ✅ Stock management
- ✅ Testimonials management
- ✅ Sales reporting

---

## 🔐 Security Configuration

### Production Security
```env
# In .env file
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:... (auto-generated)

# Database security
DB_PASSWORD=strong_random_password

# Session security
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
```

### File Security
- `.env` file is protected by `.htaccess`
- Storage directory is symlinked properly
- Sensitive files are outside public directory

---

## 🚨 Troubleshooting

### Common Issues

#### 1. HTTP 500 Error
```bash
# Check Laravel logs
tail -f storage/logs/laravel.log

# Common fixes:
php artisan key:generate --force
chmod -R 755 storage bootstrap/cache
php artisan config:cache
```

#### 2. CSS/JS Not Loading
```bash
# Rebuild assets
npm run build

# Check if build directory exists
ls -la public/build/

# Clear cache
php artisan view:clear
```

#### 3. Database Connection Error
- Verify database credentials in `.env`
- Ensure database exists in cPanel
- Check if user has proper privileges

#### 4. Storage Link Issues
```bash
# Recreate storage link
rm public/storage
php artisan storage:link
```

#### 5. Permission Denied Errors
```bash
# Fix Laravel permissions
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chown -R username:username storage/ bootstrap/cache/
```

---

## 📞 Support

### Admin Access
- **URL:** `https://blizz.yourdomain.com/admin`
- **Default Admin:** Created during migration
- **Features:** Full e-commerce management

### Database Management
- **phpMyAdmin:** Available in cPanel
- **Backup:** Regular database backups recommended
- **Migration:** All tables created automatically

### Performance Optimization
- **Caching:** Redis/Memcached (if available)
- **CDN:** Consider CloudFlare for static assets
- **Compression:** Gzip enabled by default

---

## 🔄 Future Updates

### Automatic Updates (GitHub Actions)
1. **Push to production branch**
2. **GitHub Actions automatically:**
   - Builds assets
   - Deploys via FTP
   - Runs deployment hooks

### Manual Updates
1. **Pull latest changes in cPanel Git**
2. **Click "Pull or Deploy"**
3. **Deployment hooks run automatically**

---

## ✅ Post-Deployment Checklist

- [ ] Subdomain accessible: `https://blizz.yourdomain.com`
- [ ] Admin panel working: `https://blizz.yourdomain.com/admin`
- [ ] Database connected and migrated
- [ ] CSS/JS assets loading properly
- [ ] Storage symlink created
- [ ] SSL certificate active
- [ ] Email configuration (if needed)
- [ ] Backup system configured
- [ ] Performance monitoring setup

---

**🌿 Your Blizz Ayurveda e-commerce website is now live!**

Visit your subdomain to see the beautiful Ayurvedic-themed online store with complete admin functionality.
