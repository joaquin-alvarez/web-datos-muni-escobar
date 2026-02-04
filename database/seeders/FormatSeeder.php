<?php

namespace Database\Seeders;

use App\Models\Format;
use Illuminate\Database\Seeder;

class FormatSeeder extends Seeder
{
    public function run()
    {
        $formats = [
            ['name' => 'CSV', 'extension' => 'csv', 'color' => '#28a745'],
            ['name' => 'JSON', 'extension' => 'json', 'color' => '#17a2b8'],
            ['name' => 'Excel', 'extension' => 'xlsx', 'color' => '#1d6f42'],
            ['name' => 'PDF', 'extension' => 'pdf', 'color' => '#dc3545'],
            ['name' => 'XML', 'extension' => 'xml', 'color' => '#fd7e14'],
            ['name' => 'GeoJSON', 'extension' => 'geojson', 'color' => '#6610f2'],
            ['name' => 'Shapefile', 'extension' => 'shp', 'color' => '#6f42c1'],
            ['name' => 'XLS', 'extension' => 'xls', 'color' => '#20c997'],
        ];

        foreach ($formats as $format) {
            Format::create($format);
        }
    }
}
