<?php

namespace Database\Seeders;

use App\Models\Institution;
use Illuminate\Database\Seeder;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        Institution::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Municipalidad de Escobar',
                'description' => 'Portal de datos abiertos del Municipio de Escobar. Transparencia e información pública al alcance de todos los ciudadanos.',
                'address' => 'Por definir - Dirección del Palacio Municipal',
                'phone' => '(0348) 444-1000',
                'email' => 'datos@escobar.gob.ar',
                'schedule' => 'Lunes a Viernes de 8:00 a 14:00 hs',
                'website' => 'https://www.escobar.gob.ar',
                'facebook_url' => null,
                'instagram_url' => null,
                'twitter_url' => null,
                'youtube_url' => null,
                'whatsapp_number' => null,
                'logo_url' => null,
                'is_active' => true,
            ]
        );
    }
}
