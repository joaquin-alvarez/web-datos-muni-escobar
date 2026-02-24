#!/usr/bin/env python3
"""
Prepara todos los datasets para carga:
1. Convierte SHP a GeoJSON
2. Copia archivos a storage/app/public/datasets/
3. Genera seeder completo con datos reales
"""
import os
import json
import shutil
import subprocess
from pathlib import Path
from datetime import datetime

# Directorios
BASE_DIR = Path(__file__).parent.parent
DATA_DIR = BASE_DIR / 'data'
STORAGE_DIR = BASE_DIR / 'storage' / 'app' / 'public' / 'datasets'
ANALYSIS_FILE = BASE_DIR / 'dataset_analysis.json'

def ensure_storage_structure():
    """Crea la estructura de directorios en storage"""
    STORAGE_DIR.mkdir(parents=True, exist_ok=True)
    print(f"✓ Estructura de storage creada: {STORAGE_DIR}")

def convert_shp_to_geojson(shp_path, output_dir):
    """Convierte shapefile a GeoJSON usando ogr2ogr"""
    try:
        geojson_name = shp_path.stem + '.geojson'
        geojson_path = output_dir / geojson_name
        
        # Usar ogr2ogr si está disponible
        result = subprocess.run(
            ['ogr2ogr', '-f', 'GeoJSON', str(geojson_path), str(shp_path)],
            capture_output=True,
            text=True
        )
        
        if result.returncode == 0:
            return geojson_path
        else:
            print(f"  ⚠ Error convirtiendo {shp_path.name}: {result.stderr}")
            return None
    except FileNotFoundError:
        print("  ⚠ ogr2ogr no disponible, se necesita instalar GDAL")
        return None

def copy_file_to_storage(file_path, dataset_slug):
    """Copia un archivo al storage con nombre apropiado"""
    # Crear subdirectorio para el dataset
    dataset_dir = STORAGE_DIR / dataset_slug
    dataset_dir.mkdir(exist_ok=True)
    
    # Copiar archivo
    dest_path = dataset_dir / file_path.name
    shutil.copy2(file_path, dest_path)
    
    # Calcular tamaño
    file_size = dest_path.stat().st_size
    
    return {
        'file_name': file_path.name,
        'file_path': str(dest_path.relative_to(STORAGE_DIR.parent.parent)),
        'file_url': f'/storage/datasets/{dataset_slug}/{file_path.name}',
        'file_size': file_size
    }

def slugify(text):
    """Convierte texto a slug"""
    import re
    text = text.lower()
    text = re.sub(r'[áàäâ]', 'a', text)
    text = re.sub(r'[éèëê]', 'e', text)
    text = re.sub(r'[íìïî]', 'i', text)
    text = re.sub(r'[óòöô]', 'o', text)
    text = re.sub(r'[úùüû]', 'u', text)
    text = re.sub(r'[ñ]', 'n', text)
    text = re.sub(r'[^a-z0-9\s-]', '', text)
    text = re.sub(r'[\s-]+', '-', text)
    return text.strip('-')

def map_category_to_slug(category):
    """Mapea categoría del .md al slug de la base de datos"""
    mapping = {
        'Ambiente y Biodiversidad': 'ambiente-y-biodiversidad',
        'Cultura y Turismo': 'cultura',
        'Deportes': 'deporte',
        'Desarrollo Social': 'habitat-vivienda-y-desarrollo-social',
        'Desarrollo Social y Población': 'habitat-vivienda-y-desarrollo-social',
        'Educación': 'educacion',
        'Hábitat, vivienda y desarrollo social': 'habitat-vivienda-y-desarrollo-social',
        'Infraestructura y Servicios Públicos': 'infraestructura-y-servicios-publicos',
        'Movilidad y Transporte': 'movilidad-y-transito',
        'Participación Ciudadana': 'participacion-ciudadana',
        'Riesgo Climático y Gestión de Emergencias': 'riesgo-climatico-y-gestion-de-emergencias',
        'Salud': 'salud',
        'Seguridad': 'seguridad',
        'Monitoreo Institucional': 'monitoreo-institucional',
        'Economía y finanzas': 'economia-y-finanzas',
    }
    return mapping.get(category, slugify(category or 'sin-categoria'))

def map_periodicity(periodicity):
    """Mapea periodicidad al formato esperado"""
    if not periodicity:
        return 'Anual'
    
    periodicity = periodicity.lower()
    if 'variable' in periodicity or 'demanda' in periodicity:
        return 'Anual'
    elif 'mensual' in periodicity:
        return 'Mensual'
    elif 'trimestral' in periodicity:
        return 'Trimestral'
    elif 'semestral' in periodicity:
        return 'Semestral'
    elif 'anual' in periodicity:
        return 'Anual'
    elif 'diaria' in periodicity or 'continua' in periodicity:
        return 'Diaria'
    else:
        return 'Anual'

def prepare_all_datasets():
    """Prepara todos los datasets para carga"""
    # Cargar análisis
    with open(ANALYSIS_FILE, 'r', encoding='utf-8') as f:
        analysis = json.load(f)
    
    # Asegurar estructura
    ensure_storage_structure()
    
    prepared_datasets = []
    conversion_log = []
    
    print("\nPREPARANDO DATASETS...")
    print("=" * 80)
    
    for dataset in analysis['datasets']:
        title = dataset['metadata'].get('title')
        if not title:
            continue
        
        print(f"\n📦 {title}")
        
        # Generar slug
        slug = slugify(title)
        dataset_dir = DATA_DIR / dataset['dataset_dir']
        
        # Preparar archivos
        files_prepared = []
        
        # Shapefiles -> convertir a GeoJSON
        for shp_file in dataset['files'].get('shp', []):
            shp_path = dataset_dir / shp_file
            print(f"  🔄 Convirtiendo {shp_file} -> GeoJSON...")
            
            # Intentar convertir
            temp_dir = BASE_DIR / 'temp_geojson'
            temp_dir.mkdir(exist_ok=True)
            geojson_path = convert_shp_to_geojson(shp_path, temp_dir)
            
            if geojson_path and geojson_path.exists():
                # Copiar GeoJSON a storage
                file_info = copy_file_to_storage(geojson_path, slug)
                files_prepared.append(file_info)
                conversion_log.append(f"✓ {shp_file} -> {geojson_path.name}")
                print(f"    ✓ GeoJSON creado")
                
                # Limpiar temporal
                geojson_path.unlink()
            
            # También copiar el shapefile original
            file_info = copy_file_to_storage(shp_path, slug)
            files_prepared.append(file_info)
        
        # Archivos CSV, Excel
        for ext in ['csv', 'xlsx', 'xls']:
            for file_name in dataset['files'].get(ext, []):
                file_path = dataset_dir / file_name
                if file_path.exists():
                    file_info = copy_file_to_storage(file_path, slug)
                    files_prepared.append(file_info)
                    print(f"  ✓ Copiado {file_name}")
        
        # Preparar metadata para seeder
        metadata = dataset['metadata']
        prepared_dataset = {
            'title': title,
            'slug': slug,
            'description': metadata.get('description', ''),
            'category': map_category_to_slug(metadata.get('category')),
            'organization': metadata.get('organization', 'Municipalidad de Escobar'),
            'version': '1.0',
            'periodicity': map_periodicity(metadata.get('periodicity')),
            'source': metadata.get('source', 'Municipalidad de Escobar'),
            'license': 'Open Data Commons Open Database License (ODbL)',
            'files': files_prepared,
            'tags': metadata.get('tags', ''),
        }
        
        # Limpiar valores PENDIENTE
        if prepared_dataset['organization'] == 'PENDIENTE':
            prepared_dataset['organization'] = 'Municipalidad de Escobar'
        
        prepared_datasets.append(prepared_dataset)
    
    # Procesar archivos sueltos
    print("\n\nARCHIVOS SUELTOS...")
    print("=" * 80)
    
    for standalone in analysis['standalone_files']:
        file_path = DATA_DIR / standalone['file']
        title = standalone['name'].replace('_', ' ').title()
        slug = slugify(title)
        
        print(f"\n📄 {title}")
        
        if file_path.exists():
            file_info = copy_file_to_storage(file_path, slug)
            
            prepared_dataset = {
                'title': title,
                'slug': slug,
                'description': f'Dataset {title}',
                'category': map_category_to_slug(standalone['category']),
                'organization': 'Municipalidad de Escobar',
                'version': '1.0',
                'periodicity': 'Anual',
                'source': 'Municipalidad de Escobar',
                'license': 'Open Data Commons Open Database License (ODbL)',
                'files': [file_info],
                'tags': '',
            }
            
            prepared_datasets.append(prepared_dataset)
            print(f"  ✓ Procesado")
    
    # Guardar resultados
    output_file = BASE_DIR / 'prepared_datasets.json'
    with open(output_file, 'w', encoding='utf-8') as f:
        json.dump(prepared_datasets, f, indent=2, ensure_ascii=False)
    
    print(f"\n\n✓ Datasets preparados: {len(prepared_datasets)}")
    print(f"✓ Datos guardados en: {output_file}")
    
    return prepared_datasets

if __name__ == '__main__':
    datasets = prepare_all_datasets()
    print("\n" + "=" * 80)
    print("PREPARACIÓN COMPLETA")
    print("=" * 80)
