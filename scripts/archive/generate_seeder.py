#!/usr/bin/env python3
"""
Genera el DatasetSeeder.php actualizado con todos los datos reales preparados
"""
import json
from pathlib import Path
from datetime import datetime

BASE_DIR = Path(__file__).parent.parent
PREPARED_FILE = BASE_DIR / 'prepared_datasets.json'
SEEDER_FILE = BASE_DIR / 'database' / 'seeders' / 'DatasetSeeder.php'

def generate_seeder_code(datasets):
    """Genera el código PHP del seeder"""
    
    # Header
    code = """<?php

namespace Database\Seeders;

use App\Models\Dataset;
use App\Models\Category;
use App\Models\Format;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatasetSeeder extends Seeder
{
    public function run()
    {
        $datasets = [
"""
    
    # Datasets
    for i, ds in enumerate(datasets):
        # Determinar formatos
        formats = set()
        for file_info in ds['files']:
            ext = file_info['file_name'].split('.')[-1].lower()
            formats.add(ext)
        
        formats_array = ', '.join([f"'{fmt}'" for fmt in sorted(formats)])
        
        # Escapar comillas en strings
        def escape_php_string(s):
            if not s:
                return ''
            return s.replace("'", "\\'").replace('\n', ' ')
        
        title = escape_php_string(ds['title'])
        description = escape_php_string(ds['description'])
        organization = escape_php_string(ds['organization'])
        source = escape_php_string(ds['source'])
        
        code += f"""            [
                'title' => '{title}',
                'description' => '{description}',
                'category' => '{ds['category']}',
                'organization' => '{organization}',
                'version' => '{ds['version']}',
                'periodicity' => '{ds['periodicity']}',
                'source' => '{source}',
                'license' => '{ds['license']}',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => [{formats_array}],
                'files' => [
"""
        
        # Files info
        for file_info in ds['files']:
            code += f"""                    [
                        'name' => '{file_info['file_name']}',
                        'url' => '{file_info['file_url']}',
                        'size' => {file_info['file_size']},
                    ],
"""
        
        code += """                ],
            ],
"""
    
    # Footer con lógica de carga
    code += """        ];

        foreach ($datasets as $datasetData) {
            $category = Category::where('slug', $datasetData['category'])->first();
            
            if (!$category) {
                echo "⚠ Categoría no encontrada: {$datasetData['category']} para dataset: {$datasetData['title']}\\n";
                continue;
            }

            $slug = Str::slug($datasetData['title']);
            
            $dataset = Dataset::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $datasetData['title'],
                    'description' => $datasetData['description'],
                    'category_id' => $category->id,
                    'organization' => $datasetData['organization'],
                    'version' => $datasetData['version'] ?? '1.0',
                    'periodicity' => $datasetData['periodicity'] ?? 'Anual',
                    'source' => $datasetData['source'] ?? null,
                    'license' => $datasetData['license'] ?? 'Open Data Commons Open Database License (ODbL)',
                    'created_date' => $datasetData['created_date'] ?? Carbon::now()->subMonths(6),
                    'last_modified' => $datasetData['last_modified']
                ]
            );

            // Sincronizar archivos con formatos
            $syncData = [];
            foreach ($datasetData['files'] as $fileInfo) {
                $extension = pathinfo($fileInfo['name'], PATHINFO_EXTENSION);
                $format = Format::where('extension', $extension)->first();
                
                if ($format) {
                    $syncData[$format->id] = [
                        'file_name' => $fileInfo['name'],
                        'file_url' => $fileInfo['url'],
                        'file_size' => $fileInfo['size']
                    ];
                }
            }
            
            $dataset->formats()->sync($syncData);
            
            echo "✓ Dataset cargado: {$datasetData['title']}\\n";
        }
        
        echo "\\n✓ Carga completa: " . count($datasets) . " datasets\\n";
    }
}
"""
    
    return code

def main():
    # Cargar datasets preparados
    with open(PREPARED_FILE, 'r', encoding='utf-8') as f:
        datasets = json.load(f)
    
    print(f"Generando seeder para {len(datasets)} datasets...")
    
    # Generar código
    seeder_code = generate_seeder_code(datasets)
    
    # Guardar seeder
    with open(SEEDER_FILE, 'w', encoding='utf-8') as f:
        f.write(seeder_code)
    
    print(f"✓ Seeder generado: {SEEDER_FILE}")
    print(f"✓ Total de datasets: {len(datasets)}")
    
    # Estadísticas
    categories = {}
    for ds in datasets:
        cat = ds['category']
        categories[cat] = categories.get(cat, 0) + 1
    
    print("\nDistribución por categoría:")
    for cat, count in sorted(categories.items()):
        print(f"  - {cat}: {count}")

if __name__ == '__main__':
    main()
