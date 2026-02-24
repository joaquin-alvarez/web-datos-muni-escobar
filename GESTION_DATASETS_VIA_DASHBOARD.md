# Gestión de Datasets via Dashboard
## Portal de Datos Abiertos - Municipalidad de Escobar

**Fecha:** 24 de Febrero de 2026

---

## 🎯 RESUMEN

Los datasets se gestionan **exclusivamente via Dashboard de Filament**. La carpeta `/data` fue utilizada solo para la carga inicial y ha sido eliminada.

---

## 📁 UBICACIÓN DE ARCHIVOS

### Storage Público

**Todos los archivos de datasets están en:**
```
storage/app/public/datasets/{dataset-slug}/
```

**Acceso web via link simbólico:**
```
https://escobar.gob.ar/storage/datasets/{dataset-slug}/{archivo}
```

**Ejemplo:**
```
storage/app/public/datasets/centros-de-salud-del-partido-de-escobar/
├── Centros_de_salud.geojson
└── Centros_de_salud.shp
```

Accesible en: `/storage/datasets/centros-de-salud-del-partido-de-escobar/Centros_de_salud.geojson`

---

## 🎨 GESTIÓN VIA DASHBOARD

### Acceso al Dashboard

```
URL: https://escobar.gob.ar/admin
```

**Navegación:**
```
Dashboard → Datos Abiertos → Datasets
```

### Crear Nuevo Dataset

1. **Click en "Nuevo Dataset"**

2. **Completar Información Principal:**
   - **Título**: Nombre claro y descriptivo
   - **Slug**: Se genera automáticamente (URL-friendly)
   - **Descripción**: Explicación completa del dataset
   - **Categoría**: Seleccionar de lista desplegable
   - **Organización**: Área responsable

3. **Completar Metadatos:**
   - **Versión**: 1.0 (por defecto)
   - **Periodicidad**: Diaria/Mensual/Anual/etc.
   - **Fuente**: Origen oficial de los datos
   - **Licencia**: ODbL (por defecto)
   - **Fecha de creación**
   - **Última modificación**

4. **Guardar**

### Agregar Archivos a un Dataset

**Método 1: Via Base de Datos (Avanzado)**

Los archivos se vinculan via tabla pivot `dataset_format`:

```php
// En Tinker o código
$dataset = Dataset::where('slug', 'nombre-dataset')->first();
$format = Format::where('extension', 'geojson')->first();

$dataset->formats()->attach($format->id, [
    'file_name' => 'archivo.geojson',
    'file_url' => '/storage/datasets/nombre-dataset/archivo.geojson',
    'file_size' => filesize(storage_path('app/public/datasets/nombre-dataset/archivo.geojson'))
]);
```

**Método 2: Via Seeder (Recomendado para carga masiva)**

Editar `database/seeders/DatasetSeeder.php` y agregar el dataset con sus archivos.

---

## 📤 SUBIR ARCHIVOS AL STORAGE

### Opción 1: Vía FTP/SFTP

1. Conectar al servidor
2. Navegar a: `storage/app/public/datasets/`
3. Crear carpeta con slug del dataset
4. Subir archivos

### Opción 2: Vía Terminal/SSH

```bash
# Crear directorio del dataset
mkdir -p storage/app/public/datasets/mi-nuevo-dataset

# Copiar archivos
cp archivo.geojson storage/app/public/datasets/mi-nuevo-dataset/

# Ajustar permisos
chmod -R 755 storage/app/public/datasets/mi-nuevo-dataset
```

### Opción 3: Via Código (Script personalizado)

```php
use Illuminate\Support\Facades\Storage;

// Subir archivo
$path = Storage::disk('public')->putFileAs(
    'datasets/mi-dataset',
    $uploadedFile,
    'nombre-archivo.geojson'
);

// Obtener URL pública
$url = Storage::disk('public')->url($path);
// → /storage/datasets/mi-dataset/nombre-archivo.geojson
```

---

## 🔄 FLUJO DE TRABAJO COMPLETO

### Para Agregar un Nuevo Dataset

```
1. Preparar archivos de datos
   ├── Formato espacial: Convertir SHP → GeoJSON (si necesario)
   ├── Formato tabular: CSV o Excel
   └── Documentos: PDF

2. Subir archivos a storage
   └── storage/app/public/datasets/{slug}/

3. Crear dataset en Dashboard
   ├── Completar metadatos
   └── Guardar

4. Vincular archivos (via código o seeder)
   └── Tabla dataset_format
```

### Herramientas de Conversión

**Shapefile → GeoJSON:**
```bash
ogr2ogr -f GeoJSON output.geojson input.shp
```

**Excel → CSV:**
- Abrir en Excel/LibreOffice
- Guardar como → CSV UTF-8

---

## 📊 ESTADO ACTUAL

### Datasets Cargados

**Total:** 32 datasets

**Distribución:**
- Ambiente y Biodiversidad: 6
- Infraestructura y Servicios Públicos: 6
- Movilidad y Tránsito: 4
- Salud: 3
- Riesgo Climático: 3
- Hábitat y Desarrollo Social: 3
- Monitoreo Institucional: 2
- Otros: 5

### Espacio Utilizado

```
storage/app/public/datasets/: ~39 MB
Archivos totales: 66
Carpetas: 32
```

---

## 🛠️ MANTENIMIENTO

### Actualizar Dataset Existente

**Via Dashboard:**
1. Ir a Datasets → Buscar dataset
2. Click en "Editar"
3. Modificar metadatos
4. Actualizar "Última modificación"
5. Guardar

**Actualizar archivos:**
1. Subir nuevo archivo a storage
2. Actualizar registro en `dataset_format` con nueva URL/tamaño

### Eliminar Dataset

**⚠️ CUIDADO: Acción irreversible**

```bash
# 1. Eliminar de base de datos (via Dashboard o Tinker)
php artisan tinker
>>> Dataset::where('slug', 'dataset-a-eliminar')->delete();

# 2. Eliminar archivos de storage
rm -rf storage/app/public/datasets/dataset-a-eliminar/
```

### Verificar Integridad

```bash
# Listar datasets en BD
php artisan tinker
>>> Dataset::pluck('slug')->toArray();

# Listar carpetas en storage
ls storage/app/public/datasets/

# Comparar (deben coincidir)
```

---

## 🔍 CONSULTAS ÚTILES

### Ver Todos los Datasets

```php
php artisan tinker
>>> Dataset::with('category')->get(['id', 'title', 'category_id']);
```

### Datasets por Categoría

```php
>>> Category::with('datasets')->get();
```

### Archivos de un Dataset

```php
>>> $dataset = Dataset::find(1);
>>> $dataset->formats()->get();
```

### Tamaño Total de Storage

```bash
du -sh storage/app/public/datasets/
```

---

## 📝 CATEGORÍAS DISPONIBLES

Las categorías se gestionan en:
```
Dashboard → Datos Abiertos → Categorías
```

**Categorías actuales:**
1. Ambiente y Biodiversidad
2. Cultura
3. Deporte
4. Derechos Humanos
5. Economía y Finanzas
6. Educación
7. Hábitat, Vivienda y Desarrollo Social
8. Infraestructura y Servicios Públicos
9. Monitoreo Institucional
10. Movilidad y Tránsito
11. Ordenamiento Territorial
12. Participación Ciudadana
13. Riesgo Climático y Gestión de Emergencias
14. Salud
15. Seguridad

---

## 🚀 BUENAS PRÁCTICAS

### Nomenclatura de Archivos

✅ **Usar:**
- Minúsculas
- Guiones bajos o medios
- Sin espacios
- Extensión clara

```
centros_de_salud.geojson ✓
plazas-y-parques.csv ✓
```

❌ **Evitar:**
```
Centros De Salud.geojson ✗
archivo final (1).csv ✗
```

### Organización de Carpetas

**Cada dataset en su propia carpeta:**
```
storage/app/public/datasets/
├── dataset-1/
│   ├── datos.geojson
│   └── datos.shp
├── dataset-2/
│   └── datos.csv
```

### Metadatos Completos

Siempre completar:
- ✅ Título descriptivo
- ✅ Descripción clara
- ✅ Categoría correcta
- ✅ Organización responsable
- ✅ Periodicidad de actualización
- ✅ Fuente oficial

---

## 🔐 PERMISOS Y SEGURIDAD

### Permisos de Storage

```bash
# Asegurar permisos correctos
chmod -R 755 storage/app/public/datasets
chown -R www-data:www-data storage/app/public/datasets
```

### Link Simbólico

**Verificar que existe:**
```bash
ls -la public/storage
# Debe apuntar a: ../storage/app/public
```

**Recrear si es necesario:**
```bash
php artisan storage:link
```

---

## 📞 SOPORTE

### Problemas Comunes

**Archivo no accesible via web:**
1. Verificar link simbólico: `ls -la public/storage`
2. Verificar permisos: `ls -la storage/app/public/datasets/`
3. Verificar URL en `dataset_format.file_url`

**Dataset no aparece en el portal:**
1. Verificar que está en BD: `Dataset::find(id)`
2. Verificar que tiene categoría válida
3. Limpiar caché: `php artisan cache:clear`

**Error al subir archivos grandes:**
1. Ajustar `upload_max_filesize` en php.ini
2. Ajustar `post_max_size` en php.ini
3. Reiniciar servidor web

---

## 📚 REFERENCIAS

**Laravel Storage:**
- https://laravel.com/docs/11.x/filesystem

**Filament Admin Panel:**
- https://filamentphp.com/docs

**Formatos Geoespaciales:**
- GeoJSON: https://geojson.org/
- Shapefile: https://gdal.org/

---

**Responsable:** Dirección General de Modernización  
**Contacto:** modernizacion@escobar.gob.ar  
**Última Actualización:** 24/02/2026
