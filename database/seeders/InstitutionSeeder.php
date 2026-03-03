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
                'address' => 'J. M. Estrada 599, Belén de Escobar',
                'phone' => '147',
                'email' => 'infovecinos@escobar.gob.ar',
                'schedule' => 'Lunes a Viernes de 8:00 a 15:00 hs',
                'website' => 'https://www.escobar.gob.ar',
                'facebook_url' => 'https://www.facebook.com/MunicipalidadDeEscobar',
                'instagram_url' => 'https://www.instagram.com/escobar.municipio/',
                'platform_url' => 'https://escobar360.gob.ar/default.aspx',
                'youtube_url' => 'https://www.youtube.com/@MunicipiodeEscobarOficial',
                'whatsapp_number' => 'https://wa.me/5491168131202',
                'logo_url' => 'public/logo/logo-progresa.svg',
                'is_active' => true,
            ]
        );
    }
}
