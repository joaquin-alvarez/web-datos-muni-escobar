<?php

namespace Database\Seeders;

use App\Models\Official;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OfficialSeeder extends Seeder
{
    public function run()
    {
        $officials = [
            [
                'name' => 'Carlos Alberto Pérez',
                'position' => 'Intendente Municipal',
                'rank' => 'Intendente',
                'area' => 'Intendencia',
                'biography' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                'photo_url' => 'https://placehold.co/400x500/0052a3/ffffff?text=Intendente',
                'cv_url' => '#',
                'email' => 'intendencia@escobar.gob.ar',
                'phone' => '(0348) 444-1000',
                'is_intendente' => true,
                'is_cabinet' => false,
                'sort_order' => 0,
            ],
            [
                'name' => 'María Laura González',
                'position' => 'Secretaria de Gobierno',
                'rank' => 'Secretario/a',
                'area' => 'Secretaría de Gobierno',
                'biography' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam euismod, nisl eget aliquam ultricies, nunc nisl aliquet nunc, vitae aliquam nisl nunc vitae nisl. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'photo_url' => 'https://placehold.co/400x500/198754/ffffff?text=Sec+Gobierno',
                'cv_url' => '#',
                'email' => 'gobierno@escobar.gob.ar',
                'phone' => '(0348) 444-1010',
                'is_intendente' => false,
                'is_cabinet' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Roberto Alejandro Martínez',
                'position' => 'Secretario de Hacienda',
                'rank' => 'Secretario/a',
                'area' => 'Secretaría de Hacienda',
                'biography' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.',
                'photo_url' => 'https://placehold.co/400x500/1976d2/ffffff?text=Sec+Hacienda',
                'cv_url' => '#',
                'email' => 'hacienda@escobar.gob.ar',
                'phone' => '(0348) 444-1020',
                'is_intendente' => false,
                'is_cabinet' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Ana Beatriz Fernández',
                'position' => 'Secretaria de Salud',
                'rank' => 'Secretario/a',
                'area' => 'Secretaría de Salud',
                'biography' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.',
                'photo_url' => 'https://placehold.co/400x500/00a651/ffffff?text=Sec+Salud',
                'cv_url' => '#',
                'email' => 'salud@escobar.gob.ar',
                'phone' => '(0348) 444-1030',
                'is_intendente' => false,
                'is_cabinet' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Juan Pablo Rodríguez',
                'position' => 'Secretario de Obras Públicas',
                'rank' => 'Secretario/a',
                'area' => 'Secretaría de Obras Públicas',
                'biography' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Maecenas faucibus mollis interdum.',
                'photo_url' => 'https://placehold.co/400x500/fd7e14/ffffff?text=Sec+Obras',
                'cv_url' => '#',
                'email' => 'obras@escobar.gob.ar',
                'phone' => '(0348) 444-1040',
                'is_intendente' => false,
                'is_cabinet' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Luciana Morales',
                'position' => 'Secretaria de Desarrollo Social',
                'rank' => 'Secretario/a',
                'area' => 'Secretaría de Desarrollo Social',
                'biography' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porta sem malesuada magna mollis euismod. Nullam quis risus eget urna mollis ornare vel eu leo.',
                'photo_url' => 'https://placehold.co/400x500/6610f2/ffffff?text=Sec+Social',
                'cv_url' => '#',
                'email' => 'social@escobar.gob.ar',
                'phone' => '(0348) 444-1050',
                'is_intendente' => false,
                'is_cabinet' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Diego Hernández',
                'position' => 'Secretario de Seguridad',
                'rank' => 'Secretario/a',
                'area' => 'Secretaría de Seguridad',
                'biography' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna.',
                'photo_url' => 'https://placehold.co/400x500/dc3545/ffffff?text=Sec+Seguridad',
                'cv_url' => '#',
                'email' => 'seguridad@escobar.gob.ar',
                'phone' => '(0348) 444-1060',
                'is_intendente' => false,
                'is_cabinet' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'Patricia Sánchez',
                'position' => 'Secretaria de Cultura y Educación',
                'rank' => 'Secretario/a',
                'area' => 'Secretaría de Cultura y Educación',
                'biography' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean lacinia bibendum nulla sed consectetur. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.',
                'photo_url' => 'https://placehold.co/400x500/e83e8c/ffffff?text=Sec+Cultura',
                'cv_url' => '#',
                'email' => 'cultura@escobar.gob.ar',
                'phone' => '(0348) 444-1070',
                'is_intendente' => false,
                'is_cabinet' => true,
                'sort_order' => 7,
            ],
            [
                'name' => 'Fernando López',
                'position' => 'Secretario de Ambiente',
                'rank' => 'Secretario/a',
                'area' => 'Secretaría de Ambiente',
                'biography' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
                'photo_url' => 'https://placehold.co/400x500/28a745/ffffff?text=Sec+Ambiente',
                'cv_url' => '#',
                'email' => 'ambiente@escobar.gob.ar',
                'phone' => '(0348) 444-1080',
                'is_intendente' => false,
                'is_cabinet' => true,
                'sort_order' => 8,
            ],
            [
                'name' => 'Gabriela Torres',
                'position' => 'Secretaria de Modernización',
                'rank' => 'Secretario/a',
                'area' => 'Secretaría de Modernización',
                'biography' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit sit amet non magna.',
                'photo_url' => 'https://placehold.co/400x500/17a2b8/ffffff?text=Sec+Modern',
                'cv_url' => '#',
                'email' => 'modernizacion@escobar.gob.ar',
                'phone' => '(0348) 444-1090',
                'is_intendente' => false,
                'is_cabinet' => true,
                'sort_order' => 9,
            ],
        ];

        foreach ($officials as $officialData) {
            Official::updateOrCreate(
                ['slug' => Str::slug($officialData['name'])],
                $officialData
            );
        }
    }
}
