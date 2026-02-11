<?php

namespace Database\Seeders;

use App\Models\GovernmentArea;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GovernmentAreaSeeder extends Seeder
{
    public function run()
    {
        $areas = [
            [
                'name' => 'Intendencia',
                'responsible_name' => 'Carlos Alberto Pérez',
                'responsible_position' => 'Intendente Municipal',
                'address' => 'Av. de los Inmigrantes 123, Belén de Escobar',
                'phone' => '(0348) 444-1000',
                'email' => 'intendencia@escobar.gob.ar',
                'schedule' => 'Lunes a Viernes 8:00 - 16:00',
                'sort_order' => 0,
            ],
            [
                'name' => 'Secretaría de Gobierno',
                'responsible_name' => 'María Laura González',
                'responsible_position' => 'Secretaria de Gobierno',
                'address' => 'Av. de los Inmigrantes 123, Piso 1, Belén de Escobar',
                'phone' => '(0348) 444-1010',
                'email' => 'gobierno@escobar.gob.ar',
                'schedule' => 'Lunes a Viernes 8:00 - 16:00',
                'sort_order' => 1,
            ],
            [
                'name' => 'Secretaría de Hacienda',
                'responsible_name' => 'Roberto Alejandro Martínez',
                'responsible_position' => 'Secretario de Hacienda',
                'address' => 'Av. de los Inmigrantes 123, Piso 2, Belén de Escobar',
                'phone' => '(0348) 444-1020',
                'email' => 'hacienda@escobar.gob.ar',
                'schedule' => 'Lunes a Viernes 8:00 - 16:00',
                'sort_order' => 2,
            ],
            [
                'name' => 'Secretaría de Salud',
                'responsible_name' => 'Ana Beatriz Fernández',
                'responsible_position' => 'Secretaria de Salud',
                'address' => 'Calle Sarmiento 456, Belén de Escobar',
                'phone' => '(0348) 444-1030',
                'email' => 'salud@escobar.gob.ar',
                'schedule' => 'Lunes a Viernes 8:00 - 16:00',
                'sort_order' => 3,
            ],
            [
                'name' => 'Secretaría de Obras Públicas',
                'responsible_name' => 'Juan Pablo Rodríguez',
                'responsible_position' => 'Secretario de Obras Públicas',
                'address' => 'Calle Belgrano 789, Belén de Escobar',
                'phone' => '(0348) 444-1040',
                'email' => 'obras@escobar.gob.ar',
                'schedule' => 'Lunes a Viernes 8:00 - 16:00',
                'sort_order' => 4,
            ],
            [
                'name' => 'Secretaría de Desarrollo Social',
                'responsible_name' => 'Luciana Morales',
                'responsible_position' => 'Secretaria de Desarrollo Social',
                'address' => 'Calle San Martín 321, Belén de Escobar',
                'phone' => '(0348) 444-1050',
                'email' => 'social@escobar.gob.ar',
                'schedule' => 'Lunes a Viernes 8:00 - 16:00',
                'sort_order' => 5,
            ],
            [
                'name' => 'Secretaría de Seguridad',
                'responsible_name' => 'Diego Hernández',
                'responsible_position' => 'Secretario de Seguridad',
                'address' => 'Calle Rivadavia 654, Belén de Escobar',
                'phone' => '(0348) 444-1060',
                'email' => 'seguridad@escobar.gob.ar',
                'schedule' => 'Lunes a Viernes 8:00 - 16:00',
                'sort_order' => 6,
            ],
            [
                'name' => 'Secretaría de Cultura y Educación',
                'responsible_name' => 'Patricia Sánchez',
                'responsible_position' => 'Secretaria de Cultura y Educación',
                'address' => 'Calle Mitre 987, Belén de Escobar',
                'phone' => '(0348) 444-1070',
                'email' => 'cultura@escobar.gob.ar',
                'schedule' => 'Lunes a Viernes 8:00 - 16:00',
                'sort_order' => 7,
            ],
            [
                'name' => 'Secretaría de Ambiente',
                'responsible_name' => 'Fernando López',
                'responsible_position' => 'Secretario de Ambiente',
                'address' => 'Calle Moreno 147, Belén de Escobar',
                'phone' => '(0348) 444-1080',
                'email' => 'ambiente@escobar.gob.ar',
                'schedule' => 'Lunes a Viernes 8:00 - 16:00',
                'sort_order' => 8,
            ],
            [
                'name' => 'Secretaría de Modernización',
                'responsible_name' => 'Gabriela Torres',
                'responsible_position' => 'Secretaria de Modernización',
                'address' => 'Av. de los Inmigrantes 123, Piso 3, Belén de Escobar',
                'phone' => '(0348) 444-1090',
                'email' => 'modernizacion@escobar.gob.ar',
                'schedule' => 'Lunes a Viernes 8:00 - 16:00',
                'sort_order' => 9,
            ],
        ];

        foreach ($areas as $areaData) {
            GovernmentArea::updateOrCreate(
                ['slug' => Str::slug($areaData['name'])],
                $areaData
            );
        }
    }
}
