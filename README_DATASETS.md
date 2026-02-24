# Datasets - Portal de Datos Abiertos Escobar

## Estado Actual

✅ **32 datasets cargados y listos**  
✅ **66 archivos en storage público**  
✅ **39 MB de datos geoespaciales y tabulares**  
✅ **Gestión via Dashboard Filament**

---

## 📁 Ubicación de Archivos

Todos los archivos están en:
```
storage/app/public/datasets/{dataset-slug}/
```

Accesibles via web en:
```
/storage/datasets/{dataset-slug}/{archivo}
```

---

## 🎨 Gestión de Datasets

### Dashboard de Administración

**URL:** `/admin`

**Navegación:** Dashboard → Datos Abiertos → Datasets

### Cargar en Base de Datos (Primera Vez)

```bash
php artisan db:seed --class=DatasetSeeder
```

Esto cargará los 32 datasets con sus archivos y metadatos.

---

## 📊 Datasets Disponibles

| Categoría | Cantidad |
|-----------|----------|
| Ambiente y Biodiversidad | 6 |
| Infraestructura y Servicios Públicos | 6 |
| Movilidad y Tránsito | 4 |
| Salud | 3 |
| Riesgo Climático | 3 |
| Hábitat y Desarrollo Social | 3 |
| Monitoreo Institucional | 2 |
| Otros | 5 |

---

## 🔧 Agregar Nuevo Dataset

1. **Subir archivos a storage:**
   ```bash
   mkdir -p storage/app/public/datasets/nuevo-dataset
   cp archivo.geojson storage/app/public/datasets/nuevo-dataset/
   ```

2. **Crear dataset en Dashboard** (`/admin`)
   - Completar metadatos
   - Guardar

3. **Vincular archivos** (via código o seeder)
   - Tabla pivot `dataset_format`

**Ver guía completa:** `GESTION_DATASETS_VIA_DASHBOARD.md`

---

## 📚 Documentación

- **`GESTION_DATASETS_VIA_DASHBOARD.md`** - Guía de uso del dashboard
- **`INFORME_FINAL_CARGA_DATASETS.md`** - Informe de carga inicial
- **`INFORME_LIMPIEZA_DATOS.md`** - Limpieza de datos de prueba
- **`GUIA_SISTEMA_STORAGE_DATASETS.md`** - Arquitectura del sistema (referencia)

---

## ⚠️ Notas Importantes

- La carpeta `/data` fue **eliminada** (solo se usó para carga inicial)
- Los scripts Python en `scripts/archive/` son de **referencia histórica**
- La gestión se realiza **exclusivamente via Dashboard**
- Los archivos están en **storage público**, no en `/data`

---

## 🚀 Inicio Rápido

```bash
# 1. Verificar link simbólico
php artisan storage:link

# 2. Cargar datasets en BD (primera vez)
php artisan db:seed --class=DatasetSeeder

# 3. Acceder al dashboard
# → /admin
```

---

**Contacto:** modernizacion@escobar.gob.ar
