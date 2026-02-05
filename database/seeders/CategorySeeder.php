<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Ambiente y Biodiversidad', 'icon' => 'fa-leaf'],
            ['name' => 'Cultura', 'icon' => 'fa-palette'],
            ['name' => 'Deporte', 'icon' => 'fa-futbol'],
            ['name' => 'Derechos Humanos', 'icon' => 'fa-hand-holding-heart'],
            ['name' => 'Economía y Finanzas', 'icon' => 'fa-chart-line'],
            ['name' => 'Hábitat, Vivienda y Desarrollo Social', 'icon' => 'fa-home'],
            ['name' => 'Infraestructura y Servicios Públicos', 'icon' => 'fa-tools'],
            ['name' => 'Monitoreo Institucional', 'icon' => 'fa-search'],
            ['name' => 'Movilidad y tránsito', 'icon' => 'fa-car'],
            ['name' => 'Ordenamiento Territorial', 'icon' => 'fa-map'],
            ['name' => 'Participación Ciudadana', 'icon' => 'fa-users'],
            ['name' => 'Riesgo Climático y Gestión de Emergencias', 'icon' => 'fa-exclamation-triangle'],
            ['name' => 'Salud', 'icon' => 'fa-heartbeat'],
            ['name' => 'Seguridad', 'icon' => 'fa-shield-alt'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'icon' => $category['icon']
                ]
            );
        }
    }
}
