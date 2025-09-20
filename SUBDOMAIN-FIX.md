# 🚨 SUBDOMAIN CSS LOADING FIX

## 🔍 **PROBLEM IDENTIFIED**
The website CSS is not loading because the subdomain document root is pointing to the wrong directory.

**Current Issue**: Subdomain document root points to `/public_html/blizz/` (Laravel root)
**Required Fix**: Subdomain document root must point to `/public_html/blizz/public/` (Laravel public folder)

---

## 🛠️ **SOLUTION 1: Fix Subdomain Document Root (RECOMMENDED)**

### **Step 1: Access cPanel Subdomain Manager**
1. Login to your cPanel
2. Go to **Subdomains** section
3. Find your subdomain (e.g., `blizz` or `test`)
4. Click **Manage** or **Edit**

### **Step 2: Update Document Root**
Change the document root from:
```
/public_html/blizz
```
To:
```
/public_html/blizz/public
```

### **Step 3: Save and Wait**
- Save the changes
- Wait 5-10 minutes for DNS propagation
- Clear browser cache and test

---

## 🛠️ **SOLUTION 2: Alternative .htaccess Fix**

If you cannot change the subdomain document root, create this file:

### **File: `/public_html/blizz/.htaccess`**
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

---

## 🛠️ **SOLUTION 3: Manual Asset Links (Temporary)**

If both above solutions don't work, update the layout file:

### **File: `resources/views/layouts/app.blade.php`**
Replace line 7:
```php
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

With:
```php
<link rel="stylesheet" href="{{ asset('build/assets/app-CotBYrHi.css') }}">
<script src="{{ asset('build/assets/app-l0sNRNKZ.js') }}"></script>
```

---

## 🛠️ **SOLUTION 4: Environment Configuration**

### **Update .env file on server:**
```env
APP_URL=https://test.revlinetrucks.com
ASSET_URL=https://test.revlinetrucks.com
VITE_APP_URL=https://test.revlinetrucks.com
```

### **Run these commands in cPanel Terminal:**
```bash
cd /public_html/blizz
php artisan config:clear
php artisan config:cache
php artisan view:clear
php artisan view:cache
```

---

## ✅ **VERIFICATION STEPS**

After applying any solution:

1. **Check CSS file directly:**
   - Visit: `https://test.revlinetrucks.com/build/assets/app-CotBYrHi.css`
   - Should show the CSS content

2. **Check main website:**
   - Visit: `https://test.revlinetrucks.com`
   - Should show beautiful Ayurvedic styling

3. **Check browser developer tools:**
   - Press F12 → Network tab
   - Refresh page
   - CSS files should load with 200 status

---

## 🎯 **RECOMMENDED ACTION**

**Use SOLUTION 1** - Fix the subdomain document root. This is the proper way to configure a Laravel application on shared hosting.

The document root MUST point to the `public` folder for:
- ✅ Proper asset loading
- ✅ Security (Laravel files outside web root)
- ✅ SEO-friendly URLs
- ✅ Framework functionality

---

## 📞 **If Still Not Working**

Contact your hosting provider and ask them to:
1. Set subdomain document root to `/public_html/blizz/public`
2. Ensure PHP version is 8.1 or higher
3. Enable required PHP extensions (mbstring, openssl, pdo, tokenizer, xml)

The website files are correctly deployed - only the subdomain configuration needs fixing!
