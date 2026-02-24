# Configuración de Railway - Portal de Datos Abiertos Escobar

## 🚀 Variables de Entorno Requeridas

**Configurar en Railway → Service → Variables**

### Obligatorias

```bash
# Aplicación
APP_NAME="Portal de Datos Abiertos - Escobar"
APP_ENV=production
APP_KEY=base64:XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
APP_DEBUG=false
APP_URL=https://web-datos-mun-escobar-production.up.railway.app
ASSET_URL=https://web-datos-mun-escobar-production.up.railway.app

# Base de Datos (se autocompletan con Railway Postgres)
DB_CONNECTION=pgsql
DB_HOST=${{Postgres.PGHOST}}
DB_PORT=${{Postgres.PGPORT}}
DB_DATABASE=${{Postgres.PGDATABASE}}
DB_USERNAME=${{Postgres.PGUSER}}
DB_PASSWORD=${{Postgres.PGPASSWORD}}

# Sesiones y Cache
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

# Filesystem
FILESYSTEM_DISK=public
```

### Opcionales pero Recomendadas

```bash
# Logging
LOG_CHANNEL=stack
LOG_LEVEL=error

# Email (configurar según proveedor)
MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=your-email@example.com
MAIL_PASSWORD=your-password
MAIL_FROM_ADDRESS=noreply@escobar.gob.ar
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 🔧 Configuración del Servicio

### railway.json

**Ya configurado en el proyecto:**
- Builder: RAILPACK (detecta Laravel/PHP automáticamente)
- Runtime: V2
- CPU: 4 cores
- Memory: 4GB
- PreDeploy: `./railway/init-app.sh`

### Comandos de Despliegue

**Orden de ejecución automática:**

```bash
1. npm run build          # Build de assets Vite
2. composer install       # Dependencias PHP
3. ./railway/init-app.sh  # Inicialización:
   ├── php artisan migrate --force
   ├── php artisan config:cache
   ├── php artisan route:cache
   ├── php artisan view:cache
   ├── php artisan db:seed --force
   └── Copiar storage/app/public → public/storage
```

---

## 📁 Storage en Producción

### ⚠️ IMPORTANTE: Symlinks NO funcionan en Railway

**Problema:**
- `php artisan storage:link` crea symlinks
- Los symlinks no persisten en contenedores Railway/FrankenPHP

**Solución implementada:**
```bash
# En railway/init-app.sh
cp -r /app/storage/app/public/* /app/public/storage/
```

Los archivos se **copian** directamente a `public/storage/` en cada deploy.

### Implicaciones

**✅ Archivos de datasets YA están en el repositorio:**
- `storage/app/public/datasets/` → Se despliega con el código
- `init-app.sh` los copia a `public/storage/datasets/`
- Accesibles en: `https://tu-app.railway.app/storage/datasets/...`

**⚠️ Archivos subidos via dashboard NO persisten:**
- Los contenedores de Railway son efímeros
- Cada redeploy borra archivos subidos manualmente
- **Solución:** Usar almacenamiento externo (S3/CloudFlare R2) o subir via Git

---

## 🎨 Assets (CSS/JS) de Filament

### Configuración de Vite para Producción

**Variables necesarias:**
```bash
APP_URL=https://web-datos-mun-escobar-production.up.railway.app
ASSET_URL=https://web-datos-mun-escobar-production.up.railway.app
```

**Proceso de build:**
1. `npm run build` genera archivos en `public/build/`
2. Laravel Vite Plugin los sirve automáticamente
3. FrankenPHP sirve desde `/app/public/`

### Verificación

**URLs que deben funcionar:**
```
✓ https://tu-app.railway.app/build/assets/app-XXXXXX.css
✓ https://tu-app.railway.app/build/assets/app-XXXXXX.js
✓ https://tu-app.railway.app/build/manifest.json
✓ https://tu-app.railway.app/storage/datasets/...
```

---

## 🔐 Generar APP_KEY

**Primera vez:**

```bash
# Opción 1: En tu máquina local
php artisan key:generate --show

# Opción 2: En Railway logs (después del primer deploy fallido)
# El script init-app.sh lo genera automáticamente si no existe
```

**Copiar y pegar** el valor generado en Railway Variables.

---

## 🗄️ Base de Datos

### Conectar Postgres

1. **Crear servicio Postgres en Railway**
2. **Vincular al servicio web:**
   - Railway → Service → Variables → Add Reference
   - Seleccionar: `Postgres.PGHOST`, `PGPORT`, etc.

3. **Variables se autocompletan:**
   ```bash
   DB_HOST=${{Postgres.PGHOST}}
   DB_PORT=${{Postgres.PGPORT}}
   # etc.
   ```

### Migraciones y Seeds

**Se ejecutan automáticamente en cada deploy:**
```bash
php artisan migrate --force
php artisan db:seed --force
```

**⚠️ CUIDADO:** Los seeders usan `updateOrCreate()` pero igual revisa los logs.

---

## 🐛 Troubleshooting

### Storage devuelve 404

**Verificar en Railway logs:**
```bash
# Buscar en deployment logs:
"Copying storage files to public/storage..."
"Storage files copied successfully"
```

**Si no aparece:**
```bash
# Verificar que existe storage/app/public/datasets/
ls -la storage/app/public/datasets/
```

**Acceder a Railway Shell:**
```bash
railway shell

# Dentro del contenedor:
ls -la /app/public/storage/
ls -la /app/public/build/
```

### Filament sin CSS/JS

**1. Verificar ASSET_URL:**
```bash
railway variables
# Debe mostrar ASSET_URL correcto
```

**2. Verificar build artifacts:**
```bash
railway shell
ls -la /app/public/build/
# Debe mostrar assets/ y manifest.json
```

**3. Limpiar cache:**
```bash
railway run php artisan config:clear
railway run php artisan cache:clear
railway run php artisan view:clear
```

### Deploy falla con errores de DB

**Verificar variables de base de datos:**
```bash
railway variables | grep DB_
```

**Verificar que Postgres esté vinculado:**
- Railway → Service → Settings → Connected Services

### Archivos subidos se pierden

**Esto es NORMAL en Railway.**

**Soluciones:**

1. **Desarrollo:** Subir archivos via Git
   ```bash
   # Copiar a storage/app/public/datasets/
   git add storage/app/public/datasets/
   git commit -m "Add dataset files"
   railway up
   ```

2. **Producción:** Usar S3/CloudFlare R2
   ```bash
   # .env
   FILESYSTEM_DISK=s3
   AWS_ACCESS_KEY_ID=xxx
   AWS_SECRET_ACCESS_KEY=xxx
   AWS_DEFAULT_REGION=us-east-1
   AWS_BUCKET=escobar-datasets
   ```

---

## 📊 Recursos y Límites

**Configurado en railway.json:**

```json
{
  "deploy": {
    "limitOverride": {
      "containers": {
        "cpu": 4,
        "memoryBytes": 4000000000
      }
    }
  }
}
```

**Ajustar según plan de Railway.**

---

## 🔄 Workflow de Actualización

### Para código y datasets

```bash
# 1. Hacer cambios locales
git add .
git commit -m "Update datasets"
git push

# 2. Deploy a Railway
railway up

# 3. Verificar logs
railway logs --tail
```

### Solo rebuild (sin cambios)

```bash
railway redeploy
```

### Rollback a versión anterior

```bash
# En Railway Dashboard
Deployments → [versión anterior] → Redeploy
```

---

## 📝 Checklist de Deploy Inicial

- [ ] Crear proyecto en Railway
- [ ] Crear servicio Postgres
- [ ] Vincular Postgres al servicio web
- [ ] Configurar variables de entorno (APP_KEY, APP_URL, ASSET_URL)
- [ ] Verificar que `railway.json` existe
- [ ] Verificar que `railway/init-app.sh` es ejecutable
- [ ] Push del código
- [ ] `railway up`
- [ ] Verificar logs: migraciones exitosas
- [ ] Verificar logs: seeds exitosos
- [ ] Verificar logs: storage copiado
- [ ] Acceder a `/admin` → Dashboard funciona
- [ ] Acceder a `/storage/datasets/...` → Archivos accesibles

---

## 🌐 URLs de Verificación

**Después del deploy exitoso:**

```bash
# Dashboard
https://tu-app.railway.app/admin

# Assets
https://tu-app.railway.app/build/manifest.json

# Datasets de ejemplo
https://tu-app.railway.app/storage/datasets/centros-de-salud-del-partido-de-escobar/Centros_de_salud.geojson

# API (si existe)
https://tu-app.railway.app/api/datasets
```

---

## 📞 Soporte

**Documentación Railway:**
- https://docs.railway.app/guides/laravel

**Documentación Laravel + Railway:**
- https://railway.app/templates/laravel

**Logs en tiempo real:**
```bash
railway logs --tail
```

---

**Última actualización:** 24/02/2026  
**Versión:** 1.0
