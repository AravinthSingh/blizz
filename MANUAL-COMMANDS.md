# 🔧 Manual Deployment Commands

If the `.cpanel.yml` file didn't execute properly, run these commands manually in cPanel Terminal:

## 📍 Navigate to Your Laravel Directory
```bash
cd /public_html/blizz
```

## 🔑 Generate Application Key (CRITICAL!)
```bash
# Try these commands in order until one works:
php artisan key:generate --force
/usr/local/bin/php artisan key:generate --force
/opt/cpanel/ea-php82/root/usr/bin/php artisan key:generate --force
```

## 📁 Set File Permissions
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

## ⚙️ Create Environment File (if missing)
```bash
# If .env doesn't exist:
cp .env.subdomain.template .env
# OR
cp .env.example.production .env
```

## 🔗 Create Storage Symlink
```bash
php artisan storage:link
```

## 🧹 Clear All Caches
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

## 🗄️ Run Database Migrations
```bash
php artisan migrate --force
```

## 💾 Cache for Production
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## ⚡ Optimize Application
```bash
php artisan optimize
```

---

## 🚨 If Commands Fail

### PHP Not Found Error
Try these PHP paths:
```bash
/usr/local/bin/php artisan key:generate --force
/opt/cpanel/ea-php82/root/usr/bin/php artisan key:generate --force
/opt/cpanel/ea-php81/root/usr/bin/php artisan key:generate --force
```

### Permission Denied
```bash
chmod +x fix-deployment.sh
./fix-deployment.sh
```

### Database Connection Error
1. Check your `.env` file:
   - `DB_DATABASE=yourusername_blizz`
   - `DB_USERNAME=yourusername_blizz_user`
   - `DB_PASSWORD=your_password`

2. Verify database exists in cPanel MySQL Databases

### Storage Link Error
```bash
rm public/storage
php artisan storage:link
```

---

## ✅ Verification Commands

Check if everything is working:
```bash
# Check app key exists
grep APP_KEY .env

# Check storage link
ls -la public/storage

# Check database connection
php artisan migrate:status

# Check if site loads
curl -I https://blizz.yourdomain.com
```

---

## 🔄 Quick Fix Script

Instead of running commands individually, use the automated script:
```bash
chmod +x fix-deployment.sh
./fix-deployment.sh
```

This will run all commands automatically with proper error handling.
