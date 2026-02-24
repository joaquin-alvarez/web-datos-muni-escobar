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
                'name' => 'Secretaría General',
                'address' => 'J. M. Estrada 599, Belén de Escobar',
                'phone' => '(0348) 443-0463',
                'email' => 'secretariageneral@escobar.gob.ar',
                'sort_order' => 1,
            ],
            [
                'name' => 'Secretaría de Gobierno',
                'address' => 'J. M. Estrada 599, Belén de Escobar',
                'phone' => '11 7615 9409',
                'email' => 'gobierno@escobar.gob.ar',
                'sort_order' => 2,
            ],
            [
                'name' => 'Secretaría de Hacienda y Producción',
                'address' => 'J. M. Estrada 599, Belén de Escobar',
                'phone' => '(0348) 443-0490',
                'email' => 'hacienda@escobar.gob.ar',
                'sort_order' => 3,
            ],
            [
                'name' => 'Secretaría de Salud',
                'address' => 'Almirante Brown 3200, Garín (Hospital del Bicentenario)',
                'phone' => null,
                'email' => 'salud@escobar.gob.ar',
                'sort_order' => 4,
            ],
            [
                'name' => 'Secretaría de Desarrollo Social',
                'address' => 'Colectora Este 659/677, Belén de Escobar',
                'phone' => '11 3293 4932',
                'email' => 'desarrollosocial@escobar.gob.ar',
                'sort_order' => 5,
            ],
            [
                'name' => 'Secretaría de Seguridad',
                'address' => 'Sucre 1549, Ingeniero Maschwitz',
                'phone' => '11 2476 8697',
                'email' => 'seguridad@escobar.gob.ar',
                'sort_order' => 6,
            ],
            [
                'name' => 'Secretaría de Educación',
                'address' => 'Colectora Oeste Ramal Escobar 2098, Ing. Maschwitz',
                'phone' => '11 2791-1963',
                'email' => 'secretariadeeducacion@escobar.gob.ar',
                'sort_order' => 7,
            ],
            [
                'name' => 'Subsecretaría de Cultura y Turismo',
                'address' => 'Mitre 450, Belén de Escobar',
                'phone' => '11 2716 3202',
                'email' => 'cultura@escobar.gob.ar',
                'sort_order' => 8,
            ],
            [
                'name' => 'Subsecretaría de Hábitat y Vivienda',
                'address' => '25 de mayo 459, 2do piso, Belén de Escobar',
                'phone' => '1135447092',
                'email' => 'habitatyvivienda@escobar.gob.ar',
                'sort_order' => 9,
            ],
            [
                'name' => 'Secretaría de Planificación e Infraestructura',
                'address' => 'Hipólito Yrigoyen 743, Belén de Escobar',
                'phone' => '(0348) 443-0494',
                'email' => 'secretariadeplanificacioninfraestructura@escobar.gob.ar',
                'sort_order' => 10,
            ],
            [
                'name' => 'Secretaría de Planificación Territorial y Espacio Público',
                'address' => 'Sucre 1550, Ing. Maschwitz',
                'phone' => null,
                'email' => 'licitacionesespaciospublicos@escobar.go.ar',
                'sort_order' => 11,
            ],
            [
                'name' => 'Subsecretaría de Escobar Sostenible',
                'address' => 'Sucre 1550, Ing. Maschwitz',
                'phone' => '11 3731 9156',
                'email' => 'sostenible@escobar.gob.ar',
                'sort_order' => 12,
            ],
            [
                'name' => 'Secretaría Legal y Técnica',
                'address' => 'Estrada 599, Belén de Escobar',
                'phone' => '(0348) 443-0463',
                'email' => 'secretarialegalytecnica@escobar.gob.ar',
                'sort_order' => 13,
            ],
            [
                'name' => 'Agencia Municipal de Desarrollo Productivo',
                'address' => 'Belgrano 657, Belén de Escobar',
                'phone' => '11 3726 1259',
                'email' => 'secretariaproduccion@escobar.gob.ar',
                'sort_order' => 14,
            ],
            [
                'name' => 'Secretaría Contravencional',
                'address' => 'Alberdi 526, Belén de Escobar',
                'phone' => '(11) 2175-3769',
                'email' => 'contravesc@escobar.gob.ar',
                'sort_order' => 15,
            ],
            [
                'name' => 'Secretaría de Ingresos Públicos - AMIP',
                'address' => 'Belgrano 657, Belén de Escobar',
                'phone' => '(0348) 4262870',
                'email' => 'amip@escobar.gob.ar',
                'sort_order' => 16,
            ],
            [
                'name' => 'Subsecretaría de Inspección',
                'address' => 'Belgrano 657, 1º piso, Belén de Escobar',
                'phone' => '11 7628 9856',
                'email' => 'subsecretariadeinspeccion@escobar.gob.ar',
                'sort_order' => 17,
            ],
            [
                'name' => 'Agencia Municipal de Transporte y Tránsito',
                'address' => 'Av. 25 de Mayo 459 (1° piso), Belén de Escobar',
                'phone' => '11 2482-4266',
                'email' => 'transito@escobar.gob.ar',
                'sort_order' => 18,
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
