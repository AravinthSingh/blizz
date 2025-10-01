# Blizz Ayurveda – Deployment Guide (blizzaura.lk)

This project is ready for shared hosting on cPanel under the apex domain `blizzaura.lk`. You can deploy via either GitHub Actions (FTP) or cPanel Git. The site is a Laravel app; make sure your domain document root points to the `public` folder.

## Option A – GitHub Actions (FTP auto-deploy)

- Branch: `production` (pushes to this branch trigger deploy)
- Workflow: `.github/workflows/deploy.yml`
- Deploy path: `/public_html/blizz/` (Laravel root). Set domain document root to `/public_html/blizz/public`.

### Prerequisites
- Create DNS A record for `blizzaura.lk` to your server IP.
- In cPanel → Domains → Set document root to `/public_html/blizz/public`.
- Create a MySQL database and user, note: DB name, username, password, host.
- In GitHub repo → Settings → Secrets and variables → Actions, add:
  - `FTP_HOST` (e.g. ftp.yourhost.com)
  - `FTP_USERNAME`
  - `FTP_PASSWORD`

### Build & Deploy
1. Commit production env template changes if needed (`.env.production.example`).
2. Push to `production` branch. The workflow will:
   - Install PHP/JS deps
   - Run `npm run build` to generate `public/build` (Vite manifest)
   - Upload code and built assets to `/public_html/blizz/`

### One-time server setup after first deploy
Because FTP cannot run server-side commands, after the first deploy do one of the following using cPanel Terminal/SSH:

```bash
cd ~/public_html/blizz
cp .env.production.example .env   # then edit with real creds
php artisan key:generate --force
php artisan storage:link
php artisan migrate --force
php artisan optimize
```

Alternatively, use the cPanel Git deployment (Option B) which can run these automatically via `.cpanel.yml`.

## Option B – cPanel Git Deployment (Recommended if you have SSH/Terminal)

- File: `.cpanel.yml`
- Repo: connect your GitHub repo in cPanel → Git Version Control
- Deploy path: `/home/<user>/public_html/blizz/` (Laravel root)

### Steps
1. In cPanel → Domains → Document Root for `blizzaura.lk`: `/public_html/blizz/public`.
2. In cPanel → Git Version Control → Create: set clone path to `/home/<user>/public_html/blizz` and connect your GitHub repo.
3. On first deploy, `.cpanel.yml` will:
   - Run composer install (no-dev, optimized)
   - Copy `.env.production.example` to `.env` if absent
   - Run artisan `key:generate`, `storage:link`, `migrate`, caches
4. Edit `~/public_html/blizz/.env` with real DB and mail credentials.

## Environment
Use `.env.production.example` as a starting point. Important keys:

```
APP_ENV=production
APP_URL=https://blizzaura.lk
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blizz
DB_USERNAME=blizz_user
DB_PASSWORD=secure_password
MAIL_HOST=mail.blizzaura.lk
MAIL_USERNAME=no-reply@blizzaura.lk
MAIL_PASSWORD=secure_password
```

## Assets
The layout `resources/views/layouts/app.blade.php` uses `@vite(['resources/css/app.css', 'resources/js/app.js'])`, which reads `public/build/manifest.json` in production. Ensure `npm run build` runs during deployment and that `public/build/` is uploaded.

## Folder Structure on Server
```
public_html/
  blizz/            # Laravel root
    public/         # Domain document root (configured in cPanel)
    app/
    bootstrap/
    config/
    ...
```

## Troubleshooting
- Blank styles or 404 on assets: confirm `public/build/` exists and `APP_URL` matches domain.
- 500 error: check `storage/logs/laravel.log`. Ensure correct file permissions on `storage/` and `bootstrap/cache/` (755 dirs).
- CSS not loading: double-check domain document root points to `/public_html/blizz/public`.

## Rollback
Use cPanel Git Version Control to checkout a previous commit, or revert the `production` branch and redeploy.
