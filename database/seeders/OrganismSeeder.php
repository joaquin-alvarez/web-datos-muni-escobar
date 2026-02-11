<?php

namespace Database\Seeders;

use App\Models\Organism;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrganismSeeder extends Seeder
{
    public function run()
    {
        $intendencia = Organism::updateOrCreate(
            ['slug' => 'intendencia'],
            [
                'name' => 'Intendencia Municipal',
                'type' => 'Intendencia',
                'description' => 'Máxima autoridad ejecutiva del Municipio de Escobar. Dirige y coordina la administración pública municipal.',
                'functions' => 'Dirigir la administración municipal. Representar al municipio. Ejecutar las ordenanzas y resoluciones del Concejo Deliberante. Proponer el presupuesto anual.',
                'head_name' => 'Carlos Alberto Pérez',
                'head_position' => 'Intendente Municipal',
                'sort_order' => 0,
            ]
        );

        $secretarias = [
            [
                'name' => 'Secretaría de Gobierno',
                'type' => 'Secretaría',
                'description' => 'Responsable de la gestión política y administrativa del municipio, coordinación con otros niveles de gobierno y relaciones institucionales.',
                'functions' => 'Coordinar la gestión política municipal. Gestionar relaciones institucionales. Supervisar el funcionamiento administrativo. Coordinar con organismos provinciales y nacionales.',
                'head_name' => 'María Laura González',
                'head_position' => 'Secretaria de Gobierno',
                'sort_order' => 1,
            ],
            [
                'name' => 'Secretaría de Hacienda',
                'type' => 'Secretaría',
                'description' => 'Encargada de la gestión económica, financiera y presupuestaria del municipio.',
                'functions' => 'Elaborar y ejecutar el presupuesto municipal. Administrar los recursos financieros. Recaudar tributos municipales. Gestionar la contabilidad pública.',
                'head_name' => 'Roberto Alejandro Martínez',
                'head_position' => 'Secretario de Hacienda',
                'sort_order' => 2,
            ],
            [
                'name' => 'Secretaría de Salud',
                'type' => 'Secretaría',
                'description' => 'Responsable de la planificación, coordinación y ejecución de políticas de salud pública en el municipio.',
                'functions' => 'Administrar los centros de salud municipales. Implementar programas de prevención. Coordinar campañas de vacunación. Gestionar emergencias sanitarias.',
                'head_name' => 'Ana Beatriz Fernández',
                'head_position' => 'Secretaria de Salud',
                'sort_order' => 3,
            ],
            [
                'name' => 'Secretaría de Obras Públicas',
                'type' => 'Secretaría',
                'description' => 'Encargada de la planificación, ejecución y mantenimiento de obras de infraestructura municipal.',
                'functions' => 'Planificar y ejecutar obras públicas. Mantener la infraestructura vial. Gestionar el alumbrado público. Supervisar construcciones y habilitaciones.',
                'head_name' => 'Juan Pablo Rodríguez',
                'head_position' => 'Secretario de Obras Públicas',
                'sort_order' => 4,
            ],
            [
                'name' => 'Secretaría de Desarrollo Social',
                'type' => 'Secretaría',
                'description' => 'Responsable de implementar políticas sociales orientadas a mejorar la calidad de vida de los habitantes del municipio.',
                'functions' => 'Implementar programas de asistencia social. Gestionar políticas de vivienda. Coordinar programas alimentarios. Atender situaciones de vulnerabilidad social.',
                'head_name' => 'Luciana Morales',
                'head_position' => 'Secretaria de Desarrollo Social',
                'sort_order' => 5,
            ],
            [
                'name' => 'Secretaría de Seguridad',
                'type' => 'Secretaría',
                'description' => 'Encargada de la coordinación de políticas de seguridad ciudadana y prevención del delito en el municipio.',
                'functions' => 'Coordinar políticas de seguridad ciudadana. Gestionar el sistema de monitoreo urbano. Coordinar con fuerzas de seguridad. Implementar programas de prevención.',
                'head_name' => 'Diego Hernández',
                'head_position' => 'Secretario de Seguridad',
                'sort_order' => 6,
            ],
            [
                'name' => 'Secretaría de Cultura y Educación',
                'type' => 'Secretaría',
                'description' => 'Responsable de promover actividades culturales, educativas y artísticas en el municipio.',
                'functions' => 'Organizar eventos culturales. Gestionar bibliotecas y museos municipales. Coordinar talleres educativos y artísticos. Promover el patrimonio cultural local.',
                'head_name' => 'Patricia Sánchez',
                'head_position' => 'Secretaria de Cultura y Educación',
                'sort_order' => 7,
            ],
            [
                'name' => 'Secretaría de Ambiente',
                'type' => 'Secretaría',
                'description' => 'Encargada de la gestión ambiental, protección de recursos naturales y promoción de políticas de desarrollo sustentable.',
                'functions' => 'Gestionar políticas ambientales. Controlar la calidad del aire y agua. Administrar reservas naturales. Implementar programas de reciclaje y sustentabilidad.',
                'head_name' => 'Fernando López',
                'head_position' => 'Secretario de Ambiente',
                'sort_order' => 8,
            ],
            [
                'name' => 'Secretaría de Modernización',
                'type' => 'Secretaría',
                'description' => 'Responsable de la transformación digital del municipio, gobierno abierto y datos abiertos.',
                'functions' => 'Implementar gobierno electrónico. Gestionar el portal de datos abiertos. Modernizar procesos administrativos. Desarrollar plataformas digitales ciudadanas.',
                'head_name' => 'Gabriela Torres',
                'head_position' => 'Secretaria de Modernización',
                'sort_order' => 9,
            ],
        ];

        foreach ($secretarias as $sec) {
            Organism::updateOrCreate(
                ['slug' => Str::slug($sec['name'])],
                array_merge($sec, ['parent_id' => $intendencia->id])
            );
        }
    }
}
