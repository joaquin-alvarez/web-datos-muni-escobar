# Railway Environment Variables Setup

## Required Environment Variables for Laravel + PostgreSQL

Set these in your Railway service (Laravel app) variables:

### Application Settings
```bash
APP_NAME="Datos Abiertos Escobar"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.up.railway.app
APP_KEY=  # Will be generated - see below
```

### PostgreSQL Database Connection (Railway Private Network)

**Important:** Use Railway's **private network** variables, not public ones.

```bash
# Database Configuration
DB_CONNECTION=pgsql
DB_HOST=${{Postgres.RAILWAY_PRIVATE_DOMAIN}}
DB_PORT=${{Postgres.RAILWAY_PRIVATE_PORT}}
DB_DATABASE=${{Postgres.PGDATABASE}}
DB_USERNAME=${{Postgres.PGUSER}}
DB_PASSWORD=${{Postgres.PGPASSWORD}}
```

**How to reference PostgreSQL service:**
1. In Railway dashboard, click on your Laravel service
2. Go to "Variables" tab
3. Click "New Variable" → "Add Reference"
4. Select your PostgreSQL service
5. Choose the private network variables as shown above

### Session & Cache
```bash
SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database
```

### Logging
```bash
LOG_CHANNEL=stack
LOG_LEVEL=info
```

## Steps to Configure

### 1. Add PostgreSQL Service to Project

If you haven't already:
1. In Railway project dashboard, click "+ New"
2. Select "Database" → "PostgreSQL"
3. Wait for it to provision

### 2. Set Up Laravel Service Variables

**Option A: Via Railway Dashboard**
1. Click on your Laravel service
2. Go to "Variables" tab
3. Add each variable manually
4. For database variables, use "Add Reference" to link to PostgreSQL service

**Option B: Via Railway CLI**
```bash
# Basic app settings
railway variables set APP_ENV=production
railway variables set APP_DEBUG=false
railway variables set APP_URL=https://your-app.up.railway.app

# Database - these will be auto-populated by Railway references
railway variables set DB_CONNECTION=pgsql

# Session/Cache
railway variables set SESSION_DRIVER=database
railway variables set CACHE_STORE=database
```

### 3. Generate APP_KEY

**Method 1: Let Railway Generate It**

The `init-app.sh` script will generate it on first deploy. Check the build logs:
```bash
railway logs
```

Look for the generated key in the logs and then set it:
```bash
railway variables set APP_KEY="base64:YOUR_GENERATED_KEY_HERE"
```

**Method 2: Generate Locally**
```bash
cd /home/JA/development/web-datos-muni-escobar
php artisan key:generate --show
```

Copy the output and set it in Railway:
```bash
railway variables set APP_KEY="base64:xxxxxxxxxxxxx"
```

### 4. Create Sessions Table Migration

Since we're using `database` session driver, create the sessions table:

```bash
# In your local environment
php artisan session:table
php artisan queue:table  # If using database queue
php artisan cache:table  # If using database cache
```

Then commit and push the new migrations.

### 5. Verify Database Connection

After deployment, test the connection:
```bash
railway run php artisan migrate --force
```

## Troubleshooting

### APP_KEY Not Set
- Check Railway logs: `railway logs`
- Generate manually and set it: `railway variables set APP_KEY="base64:xxx"`

### Database Connection Failed
- **Verify you're using RAILWAY_PRIVATE_DOMAIN, not PUBLIC_DOMAIN**
- Check PostgreSQL service is running
- Verify variable references are correctly pointing to Postgres service
- Check logs: `railway logs`

### "SQLSTATE[08006] connection refused"
This means you're using public host. Use private network variables:
- `${{Postgres.RAILWAY_PRIVATE_DOMAIN}}` 
- NOT `${{Postgres.RAILWAY_PUBLIC_DOMAIN}}`

### Session Errors
Make sure you've run:
```bash
railway run php artisan session:table
railway run php artisan migrate --force
```

## Example Variable Configuration in Railway

Your variables should look like this in the Railway dashboard:

```
APP_NAME = Datos Abiertos Escobar
APP_ENV = production
APP_DEBUG = false
APP_URL = https://datos-escobar.up.railway.app
APP_KEY = base64:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx=

DB_CONNECTION = pgsql
DB_HOST = postgres.railway.internal (referenced from Postgres service)
DB_PORT = 5432 (referenced from Postgres service)
DB_DATABASE = railway (referenced from Postgres service)
DB_USERNAME = postgres (referenced from Postgres service)
DB_PASSWORD = xxxxxxxxx (referenced from Postgres service)

SESSION_DRIVER = database
CACHE_STORE = database
LOG_CHANNEL = stack
LOG_LEVEL = info
```

## Deploy Commands

```bash
# Commit changes
git add .
git commit -m "Configure Railway deployment"

# Deploy
railway up

# Check logs
railway logs

# Run migrations
railway run php artisan migrate --force

# Seed database (optional)
railway run php artisan db:seed --force
```

## Database Session Setup

After first successful deployment, run:

```bash
# Create session table
railway run php artisan session:table

# Run the migration
railway run php artisan migrate --force
```

This creates the `sessions` table required for database-backed sessions.
