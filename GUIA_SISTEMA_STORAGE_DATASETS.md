# Guía del Sistema de Storage de Datasets
## Municipalidad de Escobar - Portal de Datos Abiertos

**Fecha:** 24 de Febrero de 2026

---

## 📋 ÍNDICE

1. [Arquitectura del Sistema](#arquitectura-del-sistema)
2. [Estructura de Directorios](#estructura-de-directorios)
3. [Flujo de Datos](#flujo-de-datos)
4. [Proceso de Carga](#proceso-de-carga)
5. [Formatos Soportados](#formatos-soportados)
6. [Scripts Disponibles](#scripts-disponibles)
7. [Base de Datos](#base-de-datos)
8. [Mantenimiento](#mantenimiento)

---

## 1. ARQUITECTURA DEL SISTEMA

### Componentes Principales

```
┌─────────────────────────────────────────────────────────┐
│  /data (Fuente original)                                │
│  ├── Categoría/                                         │
│  │   ├── Dataset/                                       │
│  │   │   ├── informacion_*.md (Metadatos)               │
│  │   │   ├── *.shp, *.dbf, *.prj (Shapefile)            │
│  │   │   ├── *.csv, *.xlsx (Tabular)                    │
│  │   │   └── *.pdf, *.docx (Docs)                       │
└─────────────────────────────────────────────────────────┘
                          ↓
                    [Scripts Python]
                    - analyze_datasets.py
                    - prepare_datasets.py
                    - generate_seeder.py
                          ↓
┌─────────────────────────────────────────────────────────┐
│  /storage/app/public/datasets/                          │
│  ├── dataset-slug-1/                                    │
│  │   ├── archivo.geojson                                │
│  │   ├── archivo.shp                                    │
│  │   └── archivo.csv                                    │
│  ├── dataset-slug-2/                                    │
│  └── ...                                                │
└─────────────────────────────────────────────────────────┘
                          ↓
         [Link Simbólico: public/storage]
                          ↓
                 Acceso Web: /storage/datasets/...
                          ↓
┌─────────────────────────────────────────────────────────┐
│  Base de Datos (MySQL/PostgreSQL)                       │
│  ├── datasets (Tabla principal)                         │
│  ├── categories (Categorías)                            │
│  ├── formats (Formatos: csv, shp, geojson, etc.)        │
│  └── dataset_format (Pivot: archivos)                   │
│      ├── file_name                                      │
│      ├── file_url                                       │
│      └── file_size                                      │
└─────────────────────────────────────────────────────────┘
```

---

## 2. ESTRUCTURA DE DIRECTORIOS

### Directorio de Datos Originales

```bash
/data/
├── Ambiente y Biodiversidad/
│   ├── Areas_verdes/
│   │   ├── informacion_areas_verdes.md
│   │   ├── areas_verdes.shp
│   │   ├── areas_verdes.dbf
│   │   └── ...
│   └── Ecorregiones/
├── Salud/
│   ├── Centros_de_salud/
│   ├── Farmacias_Escobar.xlsx
│   └── centros_medicos_unificado_escobar_version_completa.xlsx
└── [13 categorías más...]
```

### Directorio de Storage (Laravel)

```bash
storage/app/
├── private/          # Archivos privados (no accesibles)
└── public/           # Archivos públicos
    └── datasets/     # ← DATASETS AQUÍ
        ├── centros-de-salud-del-partido-de-escobar/
        │   ├── Centros_de_salud.geojson
        │   └── Centros_de_salud.shp
        ├── jardines-municipales-del-partido-de-escobar/
        │   ├── Jardines_municipales.geojson
        │   └── Jardines_municipales.shp
        └── [30 datasets más...]
```

### Link Simbólico

```bash
public/storage → storage/app/public
```

**Acceso Web:**
- URL: `https://escobar.gob.ar/storage/datasets/{slug}/{archivo}`
- Ejemplo: `/storage/datasets/centros-de-salud-del-partido-de-escobar/Centros_de_salud.geojson`

---

## 3. FLUJO DE DATOS

### Paso 1: Análisis de Metadatos

```bash
python3 scripts/analyze_datasets.py
```

**Qué hace:**
- Escanea todos los archivos `.md` con metadatos
- Identifica archivos relacionados (SHP, CSV, etc.)
- Genera `dataset_analysis.json` con estructura completa
- Produce `REPORTE_DATASETS.txt` legible

**Salida:**
```json
{
  "datasets": [
    {
      "metadata_file": "Salud/Centros_de_salud/informacion_centros_de_salud.md",
      "metadata": {
        "title": "Centros de Salud del Partido de Escobar",
        "category": "Salud",
        "organization": "Secretaría de Salud",
        ...
      },
      "files": {
        "shp": ["Centros_de_salud.shp"],
        "dbf": ["Centros_de_salud.dbf"],
        ...
      }
    }
  ]
}
```

### Paso 2: Preparación de Archivos

```bash
python3 scripts/prepare_datasets.py
```

**Qué hace:**
1. Convierte **Shapefiles → GeoJSON** (usando ogr2ogr)
2. Copia archivos a `storage/app/public/datasets/{slug}/`
3. Calcula tamaño de archivos
4. Genera `prepared_datasets.json` con rutas finales

**Transformaciones:**
- `areas_verdes.shp` → `areas_verdes.geojson` + copia original
- Conserva CSV, XLSX sin cambios
- Organiza por slug del dataset

### Paso 3: Generación de Seeder

```bash
python3 scripts/generate_seeder.py
```

**Qué hace:**
- Lee `prepared_datasets.json`
- Genera `database/seeders/DatasetSeeder.php` actualizado
- Incluye todos los archivos con rutas y tamaños

### Paso 4: Carga en Base de Datos

```bash
php artisan db:seed --class=DatasetSeeder
```

**Qué hace:**
- Crea registros en tabla `datasets`
- Vincula con `categories`
- Sincroniza archivos en tabla pivot `dataset_format`

---

## 4. PROCESO DE CARGA

### Carga Completa (Desde Cero)

```bash
# 1. Analizar datos
python3 scripts/analyze_datasets.py

# 2. Preparar archivos (convierte y copia)
python3 scripts/prepare_datasets.py

# 3. Generar seeder
python3 scripts/generate_seeder.py

# 4. Crear link simbólico (solo primera vez)
php artisan storage:link

# 5. Ejecutar seeder
php artisan db:seed --class=DatasetSeeder
```

### Actualización de Datasets

Cuando se actualiza información en `/data`:

```bash
# 1. Re-analizar
python3 scripts/analyze_datasets.py

# 2. Re-preparar (solo nuevos/modificados)
python3 scripts/prepare_datasets.py

# 3. Re-generar seeder
python3 scripts/generate_seeder.py

# 4. Re-ejecutar seeder (updateOrCreate)
php artisan db:seed --class=DatasetSeeder
```

---

## 5. FORMATOS SOPORTADOS

### Formatos Espaciales

| Formato | Extensión | Uso | Conversión |
|---------|-----------|-----|------------|
| Shapefile | .shp, .dbf, .prj, .shx | GIS Desktop | → GeoJSON |
| GeoJSON | .geojson | Web, APIs | Nativo |

**Sistema de Referencia:** EPSG:4326 (WGS 84)

### Formatos Tabulares

| Formato | Extensión | Uso |
|---------|-----------|-----|
| CSV | .csv | Universal, APIs |
| Excel | .xlsx, .xls | Oficina, análisis |

### Formatos Documentales

| Formato | Extensión | Uso |
|---------|-----------|-----|
| PDF | .pdf | Informes, normativas |
| Markdown | .md | Metadatos |

---

## 6. SCRIPTS DISPONIBLES

### `scripts/analyze_datasets.py`

**Propósito:** Análisis de estructura de datos

**Entrada:** Carpeta `/data`

**Salida:**
- `dataset_analysis.json`
- `REPORTE_DATASETS.txt`

**Uso:**
```bash
python3 scripts/analyze_datasets.py
```

### `scripts/prepare_datasets.py`

**Propósito:** Preparación y conversión de archivos

**Requisitos:**
- `ogr2ogr` (GDAL) instalado

**Salida:**
- Archivos en `storage/app/public/datasets/`
- `prepared_datasets.json`

**Uso:**
```bash
python3 scripts/prepare_datasets.py
```

### `scripts/generate_seeder.py`

**Propósito:** Generación automática de seeder

**Entrada:** `prepared_datasets.json`

**Salida:**
- `database/seeders/DatasetSeeder.php` (sobrescribe)

**Uso:**
```bash
python3 scripts/generate_seeder.py
```

---

## 7. BASE DE DATOS

### Tabla: `datasets`

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | ID único |
| title | varchar(255) | Título del dataset |
| slug | varchar(255) | URL-friendly |
| description | text | Descripción completa |
| category_id | bigint | FK → categories |
| organization | varchar(255) | Organismo responsable |
| version | varchar(20) | Versión (ej: 1.0) |
| periodicity | varchar(50) | Actualización |
| source | varchar(255) | Fuente oficial |
| license | varchar(255) | Licencia |
| created_date | timestamp | Fecha creación |
| last_modified | timestamp | Última modificación |

### Tabla Pivot: `dataset_format`

| Campo | Tipo | Descripción |
|-------|------|-------------|
| dataset_id | bigint | FK → datasets |
| format_id | bigint | FK → formats |
| file_name | varchar(255) | Nombre archivo |
| file_url | varchar(500) | URL acceso |
| file_size | bigint | Tamaño en bytes |

### Relaciones

```php
// Dataset → Formats (Many-to-Many)
$dataset->formats()->attach($formatId, [
    'file_name' => 'archivo.geojson',
    'file_url' => '/storage/datasets/slug/archivo.geojson',
    'file_size' => 152345
]);
```

---

## 8. MANTENIMIENTO

### Agregar Nuevo Dataset

1. Crear carpeta en `/data/{Categoría}/{NombreDataset}/`
2. Agregar archivos de datos (SHP, CSV, etc.)
3. Crear `informacion_{nombre}.md` con metadatos
4. Ejecutar proceso de carga completo

### Actualizar Dataset Existente

1. Modificar archivos en `/data/...`
2. Actualizar `.md` si cambiaron metadatos
3. Re-ejecutar proceso de carga

### Eliminar Dataset

```bash
# 1. Eliminar de base de datos
php artisan tinker
>>> Dataset::where('slug', 'nombre-dataset')->delete();

# 2. Eliminar archivos de storage
rm -rf storage/app/public/datasets/nombre-dataset/
```

### Limpiar Storage (Regenerar Todo)

```bash
# ⚠️ CUIDADO: Esto elimina todos los datasets
rm -rf storage/app/public/datasets/*
python3 scripts/prepare_datasets.py
php artisan db:seed --class=DatasetSeeder
```

---

## 9. TROUBLESHOOTING

### Error: "ogr2ogr not found"

**Solución:**
```bash
# Ubuntu/Debian
sudo apt-get install gdal-bin

# macOS
brew install gdal

# Verificar
which ogr2ogr
```

### Error: "storage link already exists"

**Solución:**
```bash
rm public/storage
php artisan storage:link
```

### Error: "Category not found"

**Solución:**
```bash
# Verificar categorías en base de datos
php artisan tinker
>>> Category::all()->pluck('slug');

# Ejecutar CategorySeeder primero
php artisan db:seed --class=CategorySeeder
```

### Archivos no accesibles via web

**Verificar:**
1. Link simbólico existe: `ls -la public/storage`
2. Permisos correctos: `chmod -R 755 storage/app/public`
3. URL correcta: `/storage/datasets/{slug}/{archivo}`

---

## 10. ESTADÍSTICAS ACTUALES

**Total Datasets Cargados:** 32

**Por Categoría:**
- Ambiente y Biodiversidad: 6
- Cultura: 1
- Deporte: 1
- Educación: 1
- Hábitat, Vivienda y Desarrollo Social: 3
- Infraestructura y Servicios Públicos: 6
- Movilidad y Tránsito: 4
- Monitoreo Institucional: 2
- Participación Ciudadana: 1
- Riesgo Climático: 3
- Salud: 3
- Seguridad: 1

**Formatos Disponibles:**
- GeoJSON: 28 archivos
- Shapefile: 28 archivos
- Excel (XLSX): 3 archivos
- CSV: 1 archivo

**Espacio Utilizado:** ~50 MB (aprox.)

---

## 11. REFERENCIAS

### Documentación Laravel Storage
- https://laravel.com/docs/11.x/filesystem

### GDAL/OGR Documentation
- https://gdal.org/programs/ogr2ogr.html

### GeoJSON Specification
- https://geojson.org/

### Protocolo Municipal
- Ver: `data/{Categoría}/Protocolo_*.md`

---

**Elaborado por:** Sistema de Gestión de Datos Abiertos  
**Contacto Técnico:** desarrollo@escobar.gob.ar  
**Última Actualización:** 24/02/2026
