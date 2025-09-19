# 🚀 Blizz Ayurveda - Quick Deploy Reference

## Method 1: Automated cPanel Git Deployment (Recommended)

### 1. Setup Repository in cPanel
```
Git Version Control → Create Repository
URL: https://github.com/AravinthSingh/blizz.git
Branch: production
Path: blizz
```

### 2. Create Subdomain
```
cPanel → Subdomains
Subdomain: blizz
Document Root: public_html/blizz/public
```

### 3. Deploy
```
Git Version Control → Pull or Deploy
(Automatic setup via .cpanel.yml)
```

---

## Method 2: Manual Upload

### 1. Build Locally
```bash
# Windows
.\deploy-subdomain.bat

# Linux/Mac
chmod +x deploy-subdomain.sh
./deploy-subdomain.sh
```

### 2. Upload & Extract
- Upload `blizz-subdomain.zip` to cPanel
- Extract to `/public_html/blizz/`

### 3. Server Setup
```bash
# SSH or cPanel Terminal
cd /public_html/blizz
chmod +x server-setup.sh
./server-setup.sh
```

---

## Environment Configuration

Copy `.env.subdomain.template` to `.env` and update:

```env
APP_URL=https://blizz.yourdomain.com
DB_DATABASE=yourusername_blizz
DB_USERNAME=yourusername_blizz_user
DB_PASSWORD=your_password
```

---

## Verification

- ✅ Website: `https://blizz.yourdomain.com`
- ✅ Admin: `https://blizz.yourdomain.com/admin`
- ✅ Storage link working
- ✅ CSS/JS loading
- ✅ Database connected

---

## Troubleshooting

**500 Error:** Check `.env` file and permissions
**CSS Missing:** Run `npm run build` and check `/public/build/`
**DB Error:** Verify database credentials and existence

For detailed guide: `SUBDOMAIN-DEPLOYMENT.md`
