<?php

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
            [
                'title' => 'Calidad del Aire - Mediciones mensuales 2023',
                'description' => 'Registro de mediciones de calidad del aire en distintos puntos del municipio de Escobar. Incluye niveles de PM2.5, PM10, CO2 y otros contaminantes atmosféricos.',
                'category' => 'ambiente-y-biodiversidad',
                'organization' => 'Secretaría de Ambiente',
                'version' => '2.1',
                'periodicity' => 'Mensual',
                'source' => 'Secretaría de Ambiente - Dirección de Monitoreo Ambiental',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(14),
                'last_modified' => Carbon::now()->subDays(5),
                'formats' => ['csv', 'json', 'xlsx']
            ],
            [
                'title' => 'Espacios Verdes y Plazas del Municipio',
                'description' => 'Información geolocalizada de todos los espacios verdes públicos, plazas y parques del municipio de Escobar, incluyendo superficie, equipamiento y estado de mantenimiento.',
                'category' => 'ambiente-y-biodiversidad',
                'organization' => 'Secretaría de Obras Públicas',
                'version' => '1.3',
                'periodicity' => 'Semestral',
                'source' => 'Secretaría de Obras Públicas - Dirección de Espacios Verdes',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(18),
                'last_modified' => Carbon::now()->subDays(12),
                'formats' => ['csv', 'geojson', 'shp']
            ],
            [
                'title' => 'Agenda Cultural Municipal 2024',
                'description' => 'Calendario completo de eventos culturales organizados por el municipio: obras de teatro, conciertos, exposiciones, talleres y actividades comunitarias.',
                'category' => 'cultura',
                'organization' => 'Secretaría de Cultura',
                'version' => '1.0',
                'periodicity' => 'Semanal',
                'source' => 'Secretaría de Cultura y Educación',
                'license' => 'Creative Commons Attribution 4.0',
                'created_date' => Carbon::now()->subMonths(3),
                'last_modified' => Carbon::now()->subDays(2),
                'formats' => ['csv', 'json', 'pdf']
            ],
            [
                'title' => 'Instalaciones Deportivas Municipales',
                'description' => 'Listado de todas las instalaciones deportivas públicas del municipio: polideportivos, canchas de fútbol, natatorios, gimnasios, con horarios de apertura y servicios disponibles.',
                'category' => 'deporte',
                'organization' => 'Secretaría de Deportes',
                'version' => '1.1',
                'periodicity' => 'Anual',
                'source' => 'Secretaría de Deportes - Dirección de Infraestructura Deportiva',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(10),
                'last_modified' => Carbon::now()->subDays(8),
                'formats' => ['csv', 'json', 'xlsx']
            ],
            [
                'title' => 'Presupuesto Municipal Ejecutado 2023',
                'description' => 'Detalle de la ejecución presupuestaria del municipio de Escobar durante el año 2023, discriminado por área, programa y partida presupuestaria.',
                'category' => 'economia-y-finanzas',
                'organization' => 'Secretaría de Hacienda',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Secretaría de Hacienda - Dirección de Presupuesto',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(8),
                'last_modified' => Carbon::now()->subDays(15),
                'formats' => ['csv', 'xlsx', 'pdf']
            ],
            [
                'title' => 'Compras y Contrataciones Públicas',
                'description' => 'Registro de todas las compras y contrataciones realizadas por el municipio, incluyendo proveedor, monto, objeto de contratación y modalidad de selección.',
                'category' => 'economia-y-finanzas',
                'organization' => 'Dirección de Compras',
                'version' => '3.0',
                'periodicity' => 'Mensual',
                'source' => 'Secretaría de Hacienda - Dirección de Compras',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(24),
                'last_modified' => Carbon::now()->subDays(3),
                'formats' => ['csv', 'json', 'xlsx']
            ],
            [
                'title' => 'Programas de Vivienda Social',
                'description' => 'Información sobre programas de acceso a vivienda social, planes de mejoramiento habitacional y asistencia a familias en situación de vulnerabilidad.',
                'category' => 'habitat-vivienda-y-desarrollo-social',
                'organization' => 'Secretaría de Desarrollo Social',
                'version' => '1.2',
                'periodicity' => 'Trimestral',
                'source' => 'Secretaría de Desarrollo Social - Dirección de Hábitat',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(12),
                'last_modified' => Carbon::now()->subDays(7),
                'formats' => ['csv', 'pdf', 'json']
            ],
            [
                'title' => 'Red de Alumbrado Público',
                'description' => 'Inventario completo de la red de alumbrado público municipal con ubicación geográfica, tipo de luminaria, potencia y estado de funcionamiento.',
                'category' => 'infraestructura-y-servicios-publicos',
                'organization' => 'Subsecretaría de Servicios Públicos',
                'version' => '2.0',
                'periodicity' => 'Trimestral',
                'source' => 'Secretaría de Obras Públicas - Subsecretaría de Servicios Públicos',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(20),
                'last_modified' => Carbon::now()->subDays(10),
                'formats' => ['csv', 'geojson', 'xlsx']
            ],
            [
                'title' => 'Accidentes de Tránsito - Estadísticas 2023',
                'description' => 'Registro estadístico de accidentes de tránsito ocurridos en el municipio durante 2023, con información sobre ubicación, tipo de accidente, vehículos involucrados y consecuencias.',
                'category' => 'movilidad-y-transito',
                'organization' => 'Agencia de Seguridad Vial',
                'version' => '1.0',
                'periodicity' => 'Mensual',
                'source' => 'Secretaría de Seguridad - Agencia de Seguridad Vial',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(4),
                'formats' => ['csv', 'json', 'xlsx', 'pdf']
            ],
            [
                'title' => 'Zonificación y Uso del Suelo',
                'description' => 'Información sobre la zonificación municipal, clasificación de usos del suelo (residencial, comercial, industrial, rural) y normativa aplicable por zona.',
                'category' => 'ordenamiento-territorial',
                'organization' => 'Dirección de Planeamiento Urbano',
                'version' => '1.5',
                'periodicity' => 'Anual',
                'source' => 'Secretaría de Obras Públicas - Dirección de Planeamiento Urbano',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(30),
                'last_modified' => Carbon::now()->subDays(20),
                'formats' => ['csv', 'geojson', 'shp', 'pdf']
            ],
            [
                'title' => 'Proyectos de Presupuesto Participativo',
                'description' => 'Listado de proyectos presentados y votados en el proceso de presupuesto participativo, con información sobre barrio, temática, cantidad de votos y estado de ejecución.',
                'category' => 'participacion-ciudadana',
                'organization' => 'Subsecretaría de Participación Ciudadana',
                'version' => '2.0',
                'periodicity' => 'Anual',
                'source' => 'Secretaría de Gobierno - Subsecretaría de Participación Ciudadana',
                'license' => 'Creative Commons Attribution 4.0',
                'created_date' => Carbon::now()->subMonths(16),
                'last_modified' => Carbon::now()->subDays(6),
                'formats' => ['csv', 'json', 'xlsx']
            ],
            [
                'title' => 'Centros de Salud y Servicios Médicos',
                'description' => 'Información de todos los centros de atención primaria de salud, hospitales municipales, servicios disponibles, horarios de atención y especialidades médicas.',
                'category' => 'salud',
                'organization' => 'Secretaría de Salud',
                'version' => '1.4',
                'periodicity' => 'Mensual',
                'source' => 'Secretaría de Salud - Dirección de Atención Primaria',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(22),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['csv', 'json', 'geojson', 'xlsx']
            ],
        ];

        foreach ($datasets as $datasetData) {
            $category = Category::where('slug', $datasetData['category'])->first();
            
            if (!$category) continue;

            $slug = Str::slug($datasetData['title']);
            
            $dataset = Dataset::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $datasetData['title'],
                    'description' => $datasetData['description'],
                    'category_id' => $category->id,
                    'organization' => $datasetData['organization'],
                    'version' => $datasetData['version'] ?? '1.0',
                    'periodicity' => $datasetData['periodicity'] ?? 'Mensual',
                    'source' => $datasetData['source'] ?? null,
                    'license' => $datasetData['license'] ?? 'Open Data Commons Open Database License (ODbL)',
                    'created_date' => $datasetData['created_date'] ?? Carbon::now()->subMonths(6),
                    'last_modified' => $datasetData['last_modified']
                ]
            );

            $syncData = [];
            foreach ($datasetData['formats'] as $formatExtension) {
                $format = Format::where('extension', $formatExtension)->first();
                
                if ($format) {
                    $syncData[$format->id] = [
                        'file_name' => $slug . '.' . $formatExtension,
                        'file_url' => '/storage/datasets/' . $slug . '.' . $formatExtension,
                        'file_size' => rand(50000, 5000000)
                    ];
                }
            }
            
            $dataset->formats()->sync($syncData);
        }
    }
}
