#!/usr/bin/env python3
"""
Analiza todos los archivos .md con metadatos de datasets y genera un reporte completo
"""
import os
import re
import json
from pathlib import Path
from collections import defaultdict

# Directorio base de datos
DATA_DIR = Path(__file__).parent.parent / 'data'

def extract_metadata_from_md(md_path):
    """Extrae metadatos estructurados de un archivo .md"""
    with open(md_path, 'r', encoding='utf-8') as f:
        content = f.read()
    
    metadata = {}
    
    # Patrones para extraer información
    patterns = {
        'title': r'Título del conjunto de datos:\s*\n(.+?)(?:\n|$)',
        'description': r'Descripción:\s*\n(.+?)(?:\nTema|$)',
        'category': r'Tema / Categoría temática:\s*\n(.+?)(?:\n|$)',
        'tags': r'Palabras clave \(tags\):\s*\n(.+?)(?:\n|$)',
        'license': r'Licencia de uso:\s*\n(.+?)(?:\n|$)',
        'periodicity': r'Periodicidad de actualización:\s*\n(.+?)(?:\n|$)',
        'organization': r'Área responsable / productora del dato:\s*\n(.+?)(?:\n|$)',
        'contact': r'Contacto institucional:\s*\n(.+?)(?:\n|$)',
        'coverage': r'Cobertura geográfica:\s*\n(.+?)(?:\n|$)',
        'source': r'Fuente oficial o página de referencia:\s*\n(.+?)(?:\n|$)',
        'observations': r'Observaciones metodológicas:\s*\n(.+?)(?:\nSistema|Termómetro|$)',
        'sensitivity': r'Termómetro de sensibilidad:\s*\n(.+?)(?:\n|$)',
    }
    
    for key, pattern in patterns.items():
        match = re.search(pattern, content, re.MULTILINE | re.DOTALL)
        if match:
            value = match.group(1).strip()
            # Limpiar saltos de línea múltiples
            value = re.sub(r'\n+', ' ', value)
            metadata[key] = value
        else:
            metadata[key] = None
    
    return metadata

def find_related_files(dataset_dir):
    """Encuentra todos los archivos relacionados a un dataset"""
    files = {
        'shp': [],
        'dbf': [],
        'prj': [],
        'shx': [],
        'cpg': [],
        'qmd': [],
        'geojson': [],
        'json': [],
        'csv': [],
        'xlsx': [],
        'xls': [],
        'pdf': [],
        'docx': [],
        'md': [],
        'other': []
    }
    
    if not dataset_dir.exists():
        return files
    
    for file_path in dataset_dir.iterdir():
        if file_path.is_file():
            ext = file_path.suffix[1:].lower()
            if ext in files:
                files[ext].append(file_path.name)
            else:
                files['other'].append(file_path.name)
    
    return files

def analyze_all_datasets():
    """Analiza todos los datasets en la carpeta data"""
    datasets = []
    categories = defaultdict(list)
    
    # Buscar todos los archivos .md de información
    for md_file in DATA_DIR.rglob('informacion*.md'):
        # Extraer metadatos
        metadata = extract_metadata_from_md(md_file)
        
        # Encontrar archivos relacionados
        dataset_dir = md_file.parent
        files = find_related_files(dataset_dir)
        
        # Crear registro de dataset
        dataset = {
            'metadata_file': str(md_file.relative_to(DATA_DIR)),
            'dataset_dir': str(dataset_dir.relative_to(DATA_DIR)),
            'metadata': metadata,
            'files': files,
            'has_spatial': len(files['shp']) > 0 or len(files['geojson']) > 0,
            'has_tabular': len(files['csv']) > 0 or len(files['xlsx']) > 0,
        }
        
        datasets.append(dataset)
        
        # Agrupar por categoría
        category = metadata.get('category', 'Sin categoría')
        categories[category].append(dataset)
    
    # Buscar archivos sueltos (sin .md de información)
    standalone_files = []
    for category_dir in DATA_DIR.iterdir():
        if category_dir.is_dir():
            # Archivos directos en la categoría
            for file_path in category_dir.iterdir():
                if file_path.is_file() and file_path.suffix.lower() in ['.xlsx', '.csv']:
                    standalone_files.append({
                        'file': str(file_path.relative_to(DATA_DIR)),
                        'name': file_path.stem,
                        'category': category_dir.name,
                        'extension': file_path.suffix[1:].lower()
                    })
    
    return {
        'datasets': datasets,
        'categories': dict(categories),
        'standalone_files': standalone_files,
        'summary': {
            'total_datasets': len(datasets),
            'total_categories': len(categories),
            'spatial_datasets': sum(1 for d in datasets if d['has_spatial']),
            'tabular_datasets': sum(1 for d in datasets if d['has_tabular']),
            'standalone_files': len(standalone_files)
        }
    }

def generate_report(analysis):
    """Genera un reporte legible"""
    report = []
    report.append("=" * 80)
    report.append("ANÁLISIS DE DATASETS - MUNICIPALIDAD DE ESCOBAR")
    report.append("=" * 80)
    report.append("")
    
    # Resumen
    report.append("RESUMEN")
    report.append("-" * 80)
    summary = analysis['summary']
    report.append(f"Total de datasets documentados: {summary['total_datasets']}")
    report.append(f"Datasets espaciales (SHP/GeoJSON): {summary['spatial_datasets']}")
    report.append(f"Datasets tabulares (CSV/Excel): {summary['tabular_datasets']}")
    report.append(f"Archivos sueltos sin documentar: {summary['standalone_files']}")
    report.append(f"Categorías: {summary['total_categories']}")
    report.append("")
    
    # Por categoría
    report.append("DATASETS POR CATEGORÍA")
    report.append("-" * 80)
    for category, datasets in sorted(analysis['categories'].items(), key=lambda x: x[0] or 'ZZZ'):
        report.append(f"\n📁 {category} ({len(datasets)} datasets)")
        for ds in datasets:
            title = ds['metadata'].get('title', 'Sin título')
            report.append(f"  • {title}")
            
            # Archivos
            files_summary = []
            if ds['files']['shp']:
                files_summary.append(f"{len(ds['files']['shp'])} SHP")
            if ds['files']['geojson']:
                files_summary.append(f"{len(ds['files']['geojson'])} GeoJSON")
            if ds['files']['csv']:
                files_summary.append(f"{len(ds['files']['csv'])} CSV")
            if ds['files']['xlsx']:
                files_summary.append(f"{len(ds['files']['xlsx'])} Excel")
            
            if files_summary:
                report.append(f"    Archivos: {', '.join(files_summary)}")
            
            # Organización
            org = ds['metadata'].get('organization', 'No especificada')
            if org and org != 'PENDIENTE':
                report.append(f"    Organización: {org}")
    
    # Archivos sueltos
    if analysis['standalone_files']:
        report.append("\n\nARCHIVOS SUELTOS (sin metadatos .md)")
        report.append("-" * 80)
        by_category = defaultdict(list)
        for f in analysis['standalone_files']:
            by_category[f['category']].append(f)
        
        for category, files in sorted(by_category.items()):
            report.append(f"\n📁 {category}")
            for f in files:
                report.append(f"  • {f['name']}.{f['extension']}")
    
    report.append("\n" + "=" * 80)
    
    return "\n".join(report)

if __name__ == '__main__':
    print("Analizando datasets...")
    analysis = analyze_all_datasets()
    
    # Guardar análisis en JSON
    output_json = Path(__file__).parent.parent / 'dataset_analysis.json'
    with open(output_json, 'w', encoding='utf-8') as f:
        json.dump(analysis, f, indent=2, ensure_ascii=False)
    print(f"✓ Análisis guardado en: {output_json}")
    
    # Generar reporte
    report = generate_report(analysis)
    output_report = Path(__file__).parent.parent / 'REPORTE_DATASETS.txt'
    with open(output_report, 'w', encoding='utf-8') as f:
        f.write(report)
    print(f"✓ Reporte guardado en: {output_report}")
    
    # Mostrar resumen
    print("\n" + report)
