# Resumen de Organización de Archivos - related_files

## Archivos Procesados y Organizados

### ✅ Nuevos Datasets Agregados al Seeder

#### 1. Paradas Mi Bus
- **Ubicación:** `/data/Movilidad y tránsito/paradas_mi_bus/`
- **Archivos:** Shapefile completo (shp, shx, dbf, prj, cpg, qmd)
- **Categoría:** Movilidad y tránsito
- **Estado:** ✓ Agregado al DatasetSeeder

#### 2. Paradas Seguras del Partido de Escobar
- **Ubicación:** `/data/Movilidad y tránsito/paradas_seguras/`
- **Archivos:** Shapefile completo (shp, shx, dbf, prj, cpg, qmd)
- **Categoría:** Movilidad y tránsito
- **Estado:** ✓ Agregado al DatasetSeeder

#### 3. Registro Abierto de Políticas de Género, Niñez y Asistencia Crítica
- **Ubicación:** `/data/Derechos Humanos/`
- **Archivo:** PDF (270 KB)
- **Categoría:** Derechos Humanos
- **Estado:** ✓ Agregado al DatasetSeeder

---

## ❌ Archivos que NO se procesaron (ya existían)

### Derechos Humanos
- **Mapa de la Memoria de Escobar.kml** - Ya existe en data/Derechos Humanos/
- **Personas detenidas desaparecidas.pdf** - Ya existe en data/Derechos Humanos/
- **Protocolo_Derechos_Humanos.md** - Ya existe en data/Derechos Humanos/

### Movilidad y tránsito
- **_ESCOBAR 2026 LINEAS Y PARADAS.xlsx** - Ya existe en data/Movilidad y tránsito/
- **empresas de transporte que operan.xlsx** - Ya existe en data/Movilidad y tránsito/

---

## 📋 Próximos Pasos

1. **Subir archivos a Cloudflare R2:**
   - `data/Movilidad y tránsito/paradas_mi_bus/` (todos los archivos del shapefile)
   - `data/Movilidad y tránsito/paradas_seguras/` (todos los archivos del shapefile)
   - `data/Derechos Humanos/Registro Abierto de Políticas de Género, Niñez y Asistencia Crítica - Ciclo 2025.pdf`

2. **Ejecutar el seeder** para cargar los datasets en la base de datos:
   ```bash
   php artisan db:seed --class=DatasetSeeder
   ```

3. El directorio `related_files` puede eliminarse ya que todos los archivos útiles fueron procesados.

---

## 📊 Estructura Final

```
data/
├── Derechos Humanos/
│   ├── Mapa de la Memoria de Escobar.kml
│   ├── Personas detenidas desaparecidas....pdf
│   ├── Protocolo_Derechos_Humanos.docx
│   ├── Protocolo_Derechos_Humanos.md
│   └── Registro Abierto de Políticas de Género, Niñez y Asistencia Crítica - Ciclo 2025.pdf ⭐ NUEVO
│
└── Movilidad y tránsito/
    ├── paradas_mi_bus/ ⭐ NUEVO
    │   ├── paradas_mi_bus.shp
    │   ├── paradas_mi_bus.shx
    │   ├── paradas_mi_bus.dbf
    │   ├── paradas_mi_bus.prj
    │   ├── paradas_mi_bus.cpg
    │   ├── paradas_mi_bus.qmd
    │   └── informacion paradas mi bus.md
    │
    └── paradas_seguras/ ⭐ NUEVO
        ├── paradas_seguras.shp
        ├── paradas_seguras.shx
        ├── paradas_seguras.dbf
        ├── paradas_seguras.prj
        ├── paradas_seguras.cpg
        ├── paradas_seguras.qmd
        └── Informacion_paradas_seguras.md
```
