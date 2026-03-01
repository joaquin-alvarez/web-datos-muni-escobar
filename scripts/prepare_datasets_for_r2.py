#!/usr/bin/env python3
"""
Prepares datasets for R2 upload by:
1. Converting SHP files to GeoJSON
2. Staging all files in storage/app/public/datasets/<slug>/
3. Calculating actual file sizes
4. Generating a size report for updating the seeder
"""

import os
import shutil
import subprocess
from pathlib import Path
import json

# Base paths
BASE_DIR = Path(__file__).parent.parent
DATA_DIR = BASE_DIR / 'data'
STAGING_DIR = BASE_DIR / 'storage' / 'app' / 'public' / 'datasets'

# Dataset mappings: (slug, source_folder, files_to_convert)
# Format: {slug: {'source': 'path/to/source', 'files': ['filename_without_ext', ...]}}
DATASETS = {
    'centros-de-salud-del-partido-de-escobar': {
        'source': 'Salud/Centros_de_salud',
        'files': ['Centros_de_salud']
    },
    'jardines-municipales-del-partido-de-escobar': {
        'source': 'Educación/Jardines_municipales',
        'files': ['Jardines_municipales']
    },
    'centros-de-desarrollo-infantil-del-partido-de-escobar': {
        'source': 'Educación/Centro_Desarrollo_Infantil',
        'files': ['CDIs']
    },
    'peligrosidad-de-inundaciones-partido-de-escobar': {
        'source': 'Riesgo Climático y Gestión de Emergencias/Inundaciones',
        'files': ['peligrosidad_inundaciones']
    },
    'zonas-de-anegamiento-detectadas-a-partir-de-tormentas-2025-partido-de-escobar': {
        'source': 'Riesgo Climático y Gestión de Emergencias/Zonas de anegamiento',
        'files': ['zonas_anegamientos_2025']
    },
    'riesgo-humano-por-olas-de-calor-partido-de-escobar': {
        'source': 'Riesgo Climático y Gestión de Emergencias/Olas de calor',
        'files': ['riesgo_ola_calor_verano2021_2022', 'riesgo_ola_calor_verano2024_2025', 'riesgo_ola_calor_verano2022_2023']
    },
    'indice-de-vulnerabilidad-social-ivs-partido-de-escobar': {
        'source': 'Hábitat, Vivienda y Desarrollo Social/Indice_vulnerabilidad_social',
        'files': ['IVS_medio', 'IVS_alto', 'IVS_bajo']
    },
    'radios-censales-2022-partido-de-escobar': {
        'source': 'Hábitat, Vivienda y Desarrollo Social/Radios_censales',
        'files': ['Indicadores de personas. Radios, 2022 - Escobar']
    },
    'polideportivos-del-partido-de-escobar': {
        'source': 'Deporte/Polideportivos',
        'files': ['polideportivos']
    },
    'instalaciones-de-seguridad-del-partido-de-escobar': {
        'source': 'Seguridad/instalaciones_seguridad',
        'files': ['seguridad']
    },
    'red-de-distribucion-de-agua-potable-partido-de-escobar': {
        'source': 'Infraestructura y Servicios Públicos/Red_Agua_Potable',
        'files': ['AYSA_agua_potable']
    },
    'cobertura-del-servicio-de-agua-potable-partido-de-escobar': {
        'source': 'Infraestructura y Servicios Públicos/Cobertura_agua_potable',
        'files': ['AYSA_agua']
    },
    'plantas-aysa-infraestructura-sanitaria-del-partido-de-escobar': {
        'source': 'Infraestructura y Servicios Públicos/Plantas_AySA',
        'files': ['Plantas_AySA']
    },
    'subestaciones-de-energia-del-partido-de-escobar': {
        'source': 'Infraestructura y Servicios Públicos/subestaciones_energia',
        'files': ['subestaciones_energia']
    },
    'red-de-distribucion-cloacal-partido-de-escobar': {
        'source': 'Infraestructura y Servicios Públicos/Red_cloacas',
        'files': ['AYSA_cloacas']
    },
    'estaciones-de-ferrocarril-del-partido-de-escobar': {
        'source': 'Movilidad y tránsito/estaciones_ferrocarril',
        'files': ['estaciones_ferrocarril']
    },
    'linea-de-ferrocarril-del-partido-de-escobar': {
        'source': 'Movilidad y tránsito/linea_ferrocarril',
        'files': ['linea_ferrocarril']
    },
    'ejes-de-calles-del-partido-de-escobar': {
        'source': 'Movilidad y tránsito/ejes_calles',
        'files': ['ejes_calles']
    },
    'terminal-de-omnibus-del-partido-de-escobar': {
        'source': 'Movilidad y tránsito/Estacion_omnibus',
        'files': ['terminal_omnibus']
    },
    'via-nacional-en-el-partido-de-escobar': {
        'source': 'Movilidad y tránsito/via_nacional',
        'files': ['via_nacional']
    },
    'unidades-de-gestion-comunitaria-del-partido-de-escobar': {
        'source': 'Participacion Ciudadana/UGCs',
        'files': ['UGCs']
    },
    'atractivos-turisticos-del-partido-de-escobar': {
        'source': 'Cultura/atractivos_turisticos',
        'files': ['atractivos_turisticos']
    },
    'ecorregiones-del-partido-de-escobar': {
        'source': 'Ambiente y Biodiversidad/Ecorregiones',
        'files': ['ecorregiones']
    },
    'areas-verdes-urbanas-del-partido-de-escobar': {
        'source': 'Ambiente y Biodiversidad/Areas_verdes',
        'files': ['areas_verdes']
    },
    'cursos-de-agua-del-partido-de-escobar': {
        'source': 'Ambiente y Biodiversidad/Red hídrica',
        'files': ['cursos_agua']
    },
    'clasificacion-de-cobertura-del-suelo-mapbiomas-2022-partido-de-escobar': {
        'source': 'Ambiente y Biodiversidad/Uso de suelo Map Biomas 2022',
        'files': ['map_biomas_2022']
    },
    'plazas-y-parques-del-partido-de-escobar': {
        'source': 'Ambiente y Biodiversidad/Plazas_parques',
        'files': ['plazas_y_parques']
    },
}

# Non-shapefile datasets (xlsx, csv)
NON_GEO_DATASETS = {
    'estadisticas-vitales-2005-2022-escobar': {
        'source': 'Monitoreo Institucional',
        'files': ['Estadísticas vitales 2005 -2022 Escobar.xlsx']
    },
    'poblacion-por-sexo-segun-radio-censal-censo-2022-radio': {
        'source': 'Monitoreo Institucional',
        'files': ['Población por sexo según radio Censal - Censo_2022_radio.csv']
    },
    'farmacias-escobar': {
        'source': 'Salud',
        'files': ['Farmacias_Escobar.xlsx']
    },
    'centros-medicos-unificado-escobar-version-completa': {
        'source': 'Salud',
        'files': ['centros_medicos_unificado_escobar_version_completa.xlsx']
    },
}


def get_shp_extensions():
    """Returns list of shapefile component extensions"""
    return ['.shp', '.shx', '.dbf', '.prj', '.cpg', '.sbn', '.sbx', '.shp.xml', '.qmd']


def convert_shp_to_geojson(shp_path, geojson_path):
    """Convert shapefile to GeoJSON using ogr2ogr"""
    try:
        cmd = ['ogr2ogr', '-f', 'GeoJSON', str(geojson_path), str(shp_path)]
        result = subprocess.run(cmd, capture_output=True, text=True, check=True)
        return True
    except subprocess.CalledProcessError as e:
        print(f"  ⚠️  Error converting {shp_path.name}: {e.stderr}")
        return False


def copy_shapefile_components(source_dir, dest_dir, base_name):
    """Copy all shapefile components (.shp, .dbf, .prj, etc.)"""
    copied = []
    for ext in get_shp_extensions():
        source_file = source_dir / f"{base_name}{ext}"
        if source_file.exists():
            dest_file = dest_dir / source_file.name
            shutil.copy2(source_file, dest_file)
            copied.append(ext)
    return copied


def copy_regular_file(source_dir, dest_dir, filename):
    """Copy a regular file (xlsx, csv, etc.)"""
    source_file = source_dir / filename
    if source_file.exists():
        dest_file = dest_dir / filename
        shutil.copy2(source_file, dest_file)
        return True
    return False


def process_shapefile_dataset(slug, config):
    """Process a shapefile-based dataset"""
    source_dir = DATA_DIR / config['source']
    dest_dir = STAGING_DIR / slug
    
    if not source_dir.exists():
        print(f"  ⚠️  Source directory not found: {source_dir}")
        return None
    
    # Create destination directory
    dest_dir.mkdir(parents=True, exist_ok=True)
    
    results = {
        'slug': slug,
        'files': []
    }
    
    for base_name in config['files']:
        shp_file = source_dir / f"{base_name}.shp"
        
        if not shp_file.exists():
            print(f"  ⚠️  SHP file not found: {shp_file}")
            continue
        
        # Copy shapefile components
        copied_exts = copy_shapefile_components(source_dir, dest_dir, base_name)
        print(f"  ✓ Copied {base_name}.shp + {len(copied_exts)-1} components")
        
        # Convert to GeoJSON
        geojson_file = dest_dir / f"{base_name}.geojson"
        if convert_shp_to_geojson(shp_file, geojson_file):
            print(f"  ✓ Converted to {base_name}.geojson")
            
            # Record file sizes
            shp_size = shp_file.stat().st_size
            geojson_size = geojson_file.stat().st_size
            
            results['files'].append({
                'name': base_name,
                'geojson': {
                    'filename': f"{base_name}.geojson",
                    'size': geojson_size
                },
                'shp': {
                    'filename': f"{base_name}.shp",
                    'size': shp_size
                }
            })
    
    return results


def process_regular_dataset(slug, config):
    """Process a non-shapefile dataset (xlsx, csv, etc.)"""
    source_dir = DATA_DIR / config['source']
    dest_dir = STAGING_DIR / slug
    
    if not source_dir.exists():
        print(f"  ⚠️  Source directory not found: {source_dir}")
        return None
    
    # Create destination directory
    dest_dir.mkdir(parents=True, exist_ok=True)
    
    results = {
        'slug': slug,
        'files': []
    }
    
    for filename in config['files']:
        if copy_regular_file(source_dir, dest_dir, filename):
            print(f"  ✓ Copied {filename}")
            
            source_file = source_dir / filename
            file_size = source_file.stat().st_size
            
            results['files'].append({
                'name': filename,
                'size': file_size
            })
        else:
            print(f"  ⚠️  File not found: {filename}")
    
    return results


def generate_size_report(all_results):
    """Generate a report with file sizes for updating the seeder"""
    report = []
    report.append("=" * 80)
    report.append("FILE SIZE REPORT FOR SEEDER UPDATE")
    report.append("=" * 80)
    report.append("")
    
    for result in all_results:
        if not result:
            continue
            
        report.append(f"Dataset: {result['slug']}")
        report.append("-" * 80)
        
        for file_info in result['files']:
            if 'geojson' in file_info:
                report.append(f"  {file_info['name']}.geojson: {file_info['geojson']['size']} bytes")
                report.append(f"  {file_info['name']}.shp: {file_info['shp']['size']} bytes")
            else:
                report.append(f"  {file_info['name']}: {file_info['size']} bytes")
        
        report.append("")
    
    return "\n".join(report)


def main():
    print("=" * 80)
    print("DATASET PREPARATION FOR R2 UPLOAD")
    print("=" * 80)
    print("")
    
    # Create staging directory
    STAGING_DIR.mkdir(parents=True, exist_ok=True)
    print(f"✓ Staging directory: {STAGING_DIR}")
    print("")
    
    all_results = []
    
    # Process shapefile datasets
    print("Processing shapefile datasets...")
    print("=" * 80)
    for slug, config in DATASETS.items():
        print(f"\n[{slug}]")
        result = process_shapefile_dataset(slug, config)
        all_results.append(result)
    
    # Process non-geo datasets
    print("\n\nProcessing non-geographic datasets...")
    print("=" * 80)
    for slug, config in NON_GEO_DATASETS.items():
        print(f"\n[{slug}]")
        result = process_regular_dataset(slug, config)
        all_results.append(result)
    
    # Save results to JSON
    results_file = BASE_DIR / 'dataset_preparation_results.json'
    with open(results_file, 'w', encoding='utf-8') as f:
        json.dump([r for r in all_results if r], f, indent=2, ensure_ascii=False)
    
    print("\n\n" + "=" * 80)
    print(f"✓ Results saved to: {results_file}")
    
    # Generate size report
    report = generate_size_report(all_results)
    report_file = BASE_DIR / 'DATASET_SIZES.txt'
    with open(report_file, 'w', encoding='utf-8') as f:
        f.write(report)
    
    print(f"✓ Size report saved to: {report_file}")
    print("=" * 80)
    print("")
    print("Next steps:")
    print("  1. Review the size report and update the seeder if needed")
    print("  2. Configure R2 credentials in .env")
    print("  3. Run: php artisan datasets:upload-to-r2")
    print("  4. Run: php artisan db:seed --class=DatasetSeeder")
    print("")


if __name__ == '__main__':
    main()
