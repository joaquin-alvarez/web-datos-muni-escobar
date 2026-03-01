# Railway Deployment Guide - Datos Abiertos Escobar

## Prerequisites

1. Railway CLI installed: `npm install -g @railway/cli`
2. Railway account and logged in: `railway login`

## Database Configuration

This app uses **SQLite** by default. The database file will be created automatically during deployment.

For persistent storage on Railway, you'll need to use a volume or switch to PostgreSQL/MySQL.

## Environment Variables

Set these in Railway dashboard or via CLI:

```bash
# Required
APP_NAME="Datos Abiertos Escobar"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.up.railway.app

# Will be auto-generated if not set
APP_KEY=

# Database (SQLite - default)
DB_CONNECTION=sqlite
DB_DATABASE=/app/database/database.sqlite

# Optional: Switch to PostgreSQL
# DB_CONNECTION=pgsql
# DB_HOST=${PGHOST}
# DB_PORT=${PGPORT}
# DB_DATABASE=${PGDATABASE}
# DB_USERNAME=${PGUSER}
# DB_PASSWORD=${PGPASSWORD}

# Session & Cache
SESSION_DRIVER=file
CACHE_STORE=file

# Logging
LOG_CHANNEL=stack
LOG_LEVEL=error

# Cloudflare R2 (dataset file storage)
CLOUDFLARE_R2_ACCESS_KEY_ID=your_r2_access_key
CLOUDFLARE_R2_SECRET_ACCESS_KEY=your_r2_secret_key
CLOUDFLARE_R2_BUCKET=datos-escobar
CLOUDFLARE_R2_ENDPOINT=https://<ACCOUNT_ID>.r2.cloudflarestorage.com
CLOUDFLARE_R2_URL=https://<YOUR_PUBLIC_BUCKET_DOMAIN>
```

## Deployment Steps

### 1. Initialize Railway Project

```bash
cd web-datos-muni-escobar
railway init
```

### 2. Link to Railway Project (if exists)

```bash
railway link
```

### 3. Set Environment Variables

Option A - Via CLI:
```bash
railway variables set APP_ENV=production
railway variables set APP_DEBUG=false
railway variables set APP_URL=https://your-app.up.railway.app
railway variables set DB_CONNECTION=pgsql
```

Option B - Via Railway Dashboard:
- Go to your project → Variables
- Add each variable manually

### 4. Deploy

```bash
railway up
```

Or push to GitHub and connect Railway to your repository for automatic deployments.

### 5. Generate APP_KEY (if needed)

If APP_KEY is not set, it will be auto-generated during `init-app.sh`.

To manually generate:
```bash
railway run php artisan key:generate --show
```

Then set it:
```bash
railway variables set APP_KEY="base64:YOUR_KEY_HERE"
```

### 6. Run Database Migrations & Seeders

The `init-app.sh` script runs migrations automatically during deployment.

To manually seed sample data:
```bash
railway run php artisan db:seed --force
```

## Deployment Architecture

The deployment uses these scripts in `railway/`:

- **`init-app.sh`** - Runs during build phase
  - Generates APP_KEY if missing
  - Runs migrations
  - Caches config/routes/views

- **`run-app.sh`** - Main web server (start command)
  - Runs PHP built-in server on PORT

- **`run-worker.sh`** - Optional queue worker service
  - Use if you have queued jobs

- **`run-cron.sh`** - Optional scheduler service
  - Use if you have scheduled tasks

## Multiple Services Setup (Optional)

If you need workers or cron:

1. Create a new service in Railway
2. Use the same repository
3. Set start command to:
   - For worker: `./railway/run-worker.sh`
   - For cron: `./railway/run-cron.sh`

## Cloudflare R2 Setup (Dataset File Storage)

Dataset files (geojson, shp, xlsx, csv) are served from a **Cloudflare R2** bucket.
R2 is S3-compatible, has a generous free tier (10GB storage, 10M reads/month), and zero egress fees.

### 1. Create R2 Bucket

1. Go to [Cloudflare Dashboard](https://dash.cloudflare.com/) → R2 Object Storage
2. Create a bucket named `datos-escobar`
3. Enable **public access** on the bucket (Settings → Public access → Allow Access)
4. Note the public URL (e.g., `https://pub-xxxx.r2.dev`)

### 2. Create API Token

1. In R2 → Manage R2 API Tokens → Create API Token
2. Permissions: Object Read & Write
3. Scope: Apply to `datos-escobar` bucket only
4. Copy the **Access Key ID** and **Secret Access Key**
5. Note your **Account ID** (visible in the R2 dashboard URL or Overview page)

### 3. Set Environment Variables in Railway

```bash
railway variables set CLOUDFLARE_R2_ACCESS_KEY_ID="your_access_key_id"
railway variables set CLOUDFLARE_R2_SECRET_ACCESS_KEY="your_secret_access_key"
railway variables set CLOUDFLARE_R2_BUCKET="datos-escobar"
railway variables set CLOUDFLARE_R2_ENDPOINT="https://<ACCOUNT_ID>.r2.cloudflarestorage.com"
railway variables set CLOUDFLARE_R2_URL="https://pub-xxxx.r2.dev"
```

**Important - HTTPS for Filament**: 
- The `init-app.sh` script automatically sets `APP_URL` to HTTPS using Railway's `RAILWAY_PUBLIC_DOMAIN` variable
- Additionally, `AppServiceProvider` forces HTTPS scheme in production to ensure all Filament asset URLs are served over HTTPS (required for mixed content security)
- If you need to override `APP_URL`, set it explicitly in Railway variables

### 4. Upload Dataset Files

Place your dataset files locally in `storage/app/public/datasets/` organized as:
```
storage/app/public/datasets/
  centros-de-salud-del-partido-de-escobar/
    Centros_de_salud.geojson
    Centros_de_salud.shp
  jardines-municipales-del-partido-de-escobar/
    Jardines_municipales.geojson
    ...
```

Then upload to R2:
```bash
# Dry run (preview without uploading)
php artisan datasets:upload-to-r2 --dry-run

# Upload
php artisan datasets:upload-to-r2
```

Or upload via Railway shell:
```bash
railway run php artisan datasets:upload-to-r2
```

### 5. Re-seed Database

After setting R2 env vars, re-seed so file URLs point to R2:
```bash
railway run php artisan db:seed --force
```

## Using PostgreSQL Instead of SQLite

1. Add PostgreSQL plugin in Railway
2. Update environment variables:
```bash
railway variables set DB_CONNECTION=pgsql
```

The connection details will be auto-injected by Railway.

## Troubleshooting

### Migration Errors
- Check database connection
- Verify environment variables are set correctly

### APP_KEY Error
- Run: `railway run php artisan key:generate --force`
- Or let `init-app.sh` generate it automatically

### Permission Errors
- Scripts are made executable in build phase: `chmod +x railway/*.sh`

## Local Development

```bash
# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate key
php artisan key:generate

# Create database
touch database/database.sqlite

# Run migrations
php artisan migrate

# Seed sample data
php artisan db:seed

# Start server
php artisan serve
```

## Railway CLI Useful Commands

```bash
# View logs
railway logs

# Connect to shell
railway shell

# Run artisan commands
railway run php artisan migrate
railway run php artisan db:seed
railway run php artisan cache:clear

# View variables
railway variables
```

## Production Checklist

- [ ] APP_ENV set to `production`
- [ ] APP_DEBUG set to `false`
- [ ] APP_URL set to your domain
- [ ] APP_KEY generated
- [ ] Database configured (SQLite or PostgreSQL)
- [ ] Migrations run successfully
- [ ] Seeders run (if needed)
- [ ] Cloudflare R2 configured (env vars set)
- [ ] Dataset files uploaded to R2
- [ ] Application accessible

## Support

For issues, check:
1. Railway logs: `railway logs`
2. Laravel logs: Check storage/logs in Railway shell
3. Environment variables are correctly set
