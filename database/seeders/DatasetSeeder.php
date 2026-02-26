<?php

namespace Database\Seeders;

use App\Models\Dataset;
use App\Models\Category;
use App\Models\Format;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatasetSeeder extends Seeder
{
    public function run()
    {
        $datasets = [
            [
                'title' => 'Centros de Salud del Partido de Escobar',
                'description' => 'Localización geográfica de los centros de salud públicos del Partido de Escobar, incluyendo hospitales, centros de atención primaria de la salud (CAPS) y otros establecimientos sanitarios municipales. El conjunto de datos permite identificar la distribución territorial de la infraestructura sanitaria y constituye un insumo para el análisis de accesibilidad, la planificación de servicios de salud y la atención de la población.',
                'category' => 'salud',
                'organization' => 'Municipalidad de Escobar',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Relevamiento propio del Municipio de Escobar',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'Centros_de_salud.geojson',
                        'path' => 'datasets/centros-de-salud-del-partido-de-escobar/Centros_de_salud.geojson',
                        'size' => 18963,
                    ],
                    [
                        'name' => 'Centros_de_salud.shp',
                        'path' => 'datasets/centros-de-salud-del-partido-de-escobar/Centros_de_salud.shp',
                        'size' => 940,
                    ],
                ],
            ],
            [
                'title' => 'Jardines Municipales del Partido de Escobar',
                'description' => 'Localización geográfica de los jardines municipales del Partido de Escobar destinados a la educación inicial. El conjunto de datos incluye establecimientos educativos de gestión municipal y constituye un insumo para el análisis de la cobertura territorial de la educación inicial, la planificación educativa y el fortalecimiento de políticas públicas de primera infancia.',
                'category' => 'educacion',
                'organization' => '',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Relevamiento propio del Municipio de Escobar',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'Jardines_municipales.geojson',
                        'path' => 'datasets/jardines-municipales-del-partido-de-escobar/Jardines_municipales.geojson',
                        'size' => 3899,
                    ],
                    [
                        'name' => 'Jardines_municipales.shp',
                        'path' => 'datasets/jardines-municipales-del-partido-de-escobar/Jardines_municipales.shp',
                        'size' => 212,
                    ],
                ],
            ],
            [
                'title' => 'Centros de Desarrollo Infantil del Partido de Escobar',
                'description' => 'Localización geográfica de los Centros de Desarrollo Infantil (CDI) del Partido de Escobar, espacios destinados a la atención integral de niñas y niños en la primera infancia. Los CDI brindan servicios de cuidado, acompañamiento, estimulación temprana y contención social, y el conjunto de datos constituye un insumo para el análisis de cobertura territorial, el diseño de políticas de primera infancia y la planificación de acciones de desarrollo social.',
                'category' => 'habitat-vivienda-y-desarrollo-social',
                'organization' => '',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Relevamiento propio del Municipio de Escobar',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'CDIs.geojson',
                        'path' => 'datasets/centros-de-desarrollo-infantil-del-partido-de-escobar/CDIs.geojson',
                        'size' => 4055,
                    ],
                    [
                        'name' => 'CDIs.shp',
                        'path' => 'datasets/centros-de-desarrollo-infantil-del-partido-de-escobar/CDIs.shp',
                        'size' => 296,
                    ],
                ],
            ],
            [
                'title' => 'Peligrosidad de Inundaciones – Partido de Escobar',
                'description' => 'Mapa de peligrosidad de inundaciones del Partido de Escobar, elaborado a partir de cartografía oficial de la Autoridad del Agua (ADA) de la Provincia de Buenos Aires. El conjunto de datos identifica áreas con distinto nivel de peligrosidad hídrica y constituye un insumo para la planificación territorial, la gestión del riesgo y la toma de decisiones en materia de ordenamiento urbano.',
                'category' => 'riesgo-climatico-y-gestion-de-emergencias',
                'organization' => 'Estrategia Ambiental y datos',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Elaboración propia a partir de cartografía de la Autoridad del Agua (ADA), Provincia de Buenos Aires.',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'peligrosidad_inundaciones.geojson',
                        'path' => 'datasets/peligrosidad-de-inundaciones-partido-de-escobar/peligrosidad_inundaciones.geojson',
                        'size' => 1604103,
                    ],
                    [
                        'name' => 'peligrosidad_inundaciones.shp',
                        'path' => 'datasets/peligrosidad-de-inundaciones-partido-de-escobar/peligrosidad_inundaciones.shp',
                        'size' => 477580,
                    ],
                ],
            ],
            [
                'title' => 'Zonas de Anegamiento Detectadas a partir de Tormentas 2025 – Partido de Escobar',
                'description' => 'Identificación de zonas de anegamiento en el Partido de Escobar a partir del análisis de imágenes satelitales correspondientes a eventos de tormentas ocurridos durante el año 2025, utilizando el Índice Normalizado de Diferencia de Agua (MNDWI). El conjunto de datos permite visualizar áreas con presencia temporal de agua superficial y constituye un insumo para el análisis de eventos extremos y la gestión del riesgo hídrico.',
                'category' => 'riesgo-climatico-y-gestion-de-emergencias',
                'organization' => 'Estrategia Ambiental y datos',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Elaboración propia del Municipio de Escobar a partir de imágenes satelitales de COPERNICUS/S2_SR_HARMONIZED correspondientes a tormentas registradas durante el año 2025.',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'zonas_anegamientos_2025.geojson',
                        'path' => 'datasets/zonas-de-anegamiento-detectadas-a-partir-de-tormentas-2025-partido-de-escobar/zonas_anegamientos_2025.geojson',
                        'size' => 825494,
                    ],
                    [
                        'name' => 'zonas_anegamientos_2025.shp',
                        'path' => 'datasets/zonas-de-anegamiento-detectadas-a-partir-de-tormentas-2025-partido-de-escobar/zonas_anegamientos_2025.shp',
                        'size' => 276240,
                    ],
                ],
            ],
            [
                'title' => 'Riesgo Humano por Olas de Calor – Partido de Escobar',
                'description' => 'Mapa de riesgo humano asociado a olas de calor en el Partido de Escobar, elaborado a partir del análisis de la Temperatura de Superficie Terrestre (Land Surface Temperature – LST) obtenida de imágenes satelitales Landsat 8. El conjunto de datos clasifica el territorio en distintos niveles de riesgo térmico y constituye un insumo para la planificación urbana, la gestión del riesgo climático y la protección de la salud de la población.',
                'category' => 'riesgo-climatico-y-gestion-de-emergencias',
                'organization' => 'Estrategia Ambiental y datos',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Elaboración propia del Municipio de Escobar a partir de imágenes satelitales Landsat 8.',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'riesgo_ola_calor_verano2021_2022.geojson',
                        'path' => 'datasets/riesgo-humano-por-olas-de-calor-partido-de-escobar/riesgo_ola_calor_verano2021_2022.geojson',
                        'size' => 1396843,
                    ],
                    [
                        'name' => 'riesgo_ola_calor_verano2021_2022.shp',
                        'path' => 'datasets/riesgo-humano-por-olas-de-calor-partido-de-escobar/riesgo_ola_calor_verano2021_2022.shp',
                        'size' => 449940,
                    ],
                    [
                        'name' => 'riesgo_ola_calor_verano2024_2025.geojson',
                        'path' => 'datasets/riesgo-humano-por-olas-de-calor-partido-de-escobar/riesgo_ola_calor_verano2024_2025.geojson',
                        'size' => 820145,
                    ],
                    [
                        'name' => 'riesgo_ola_calor_verano2024_2025.shp',
                        'path' => 'datasets/riesgo-humano-por-olas-de-calor-partido-de-escobar/riesgo_ola_calor_verano2024_2025.shp',
                        'size' => 269020,
                    ],
                    [
                        'name' => 'riesgo_ola_calor_verano2022_2023.geojson',
                        'path' => 'datasets/riesgo-humano-por-olas-de-calor-partido-de-escobar/riesgo_ola_calor_verano2022_2023.geojson',
                        'size' => 1510276,
                    ],
                    [
                        'name' => 'riesgo_ola_calor_verano2022_2023.shp',
                        'path' => 'datasets/riesgo-humano-por-olas-de-calor-partido-de-escobar/riesgo_ola_calor_verano2022_2023.shp',
                        'size' => 454196,
                    ],
                ],
            ],
            [
                'title' => 'Índice de Vulnerabilidad Social (IVS) – Partido de Escobar',
                'description' => 'Conjunto de capas geográficas que representan el Índice de Vulnerabilidad Social (IVS) del Partido de Escobar, clasificadas en tres niveles: IVS bajo, IVS medio e IVS alto. El IVS es el resultado de un cálculo basado en el enfoque de Necesidades Básicas Insatisfechas (NBI), el cual permite identificar situaciones de pobreza estructural más allá del ingreso monetario. Este enfoque considera dimensiones de privación material absoluta vinculadas a condiciones habitacionales, acceso a servicios básicos, educación y capacidad de subsistencia del hogar. El índice se utiliza como insumo para el análisis socio-territorial, la planificación de políticas públicas y la priorización de intervenciones sociales.',
                'category' => 'habitat-vivienda-y-desarrollo-social',
                'organization' => 'No disponible',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Elaboración propia del Municipio de Escobar a partir de información del',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'IVS_medio.geojson',
                        'path' => 'datasets/indice-de-vulnerabilidad-social-ivs-partido-de-escobar/IVS_medio.geojson',
                        'size' => 52445,
                    ],
                    [
                        'name' => 'IVS_medio.shp',
                        'path' => 'datasets/indice-de-vulnerabilidad-social-ivs-partido-de-escobar/IVS_medio.shp',
                        'size' => 9220,
                    ],
                    [
                        'name' => 'IVS_alto.geojson',
                        'path' => 'datasets/indice-de-vulnerabilidad-social-ivs-partido-de-escobar/IVS_alto.geojson',
                        'size' => 5205,
                    ],
                    [
                        'name' => 'IVS_alto.shp',
                        'path' => 'datasets/indice-de-vulnerabilidad-social-ivs-partido-de-escobar/IVS_alto.shp',
                        'size' => 1436,
                    ],
                    [
                        'name' => 'IVS_bajo.geojson',
                        'path' => 'datasets/indice-de-vulnerabilidad-social-ivs-partido-de-escobar/IVS_bajo.geojson',
                        'size' => 801657,
                    ],
                    [
                        'name' => 'IVS_bajo.shp',
                        'path' => 'datasets/indice-de-vulnerabilidad-social-ivs-partido-de-escobar/IVS_bajo.shp',
                        'size' => 170108,
                    ],
                ],
            ],
            [
                'title' => 'Radios Censales 2022 – Partido de Escobar',
                'description' => 'Delimitación geográfica de los radios censales correspondientes al Censo Nacional de Población, Hogares y Viviendas 2022 en el Partido de Escobar. Los radios censales constituyen la unidad territorial mínima de relevamiento utilizada por el INDEC y son una referencia fundamental para el análisis demográfico, social y socioeconómico a escala local.',
                'category' => 'habitat-vivienda-y-desarrollo-social',
                'organization' => 'INDEC',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'INDEC (2023). Censo Nacional de Población, Hogares y Viviendas 2022. Resultados Definitivos.',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'Indicadores de personas. Radios, 2022 - Escobar.geojson',
                        'path' => 'datasets/radios-censales-2022-partido-de-escobar/Indicadores de personas. Radios, 2022 - Escobar.geojson',
                        'size' => 509311,
                    ],
                    [
                        'name' => 'Indicadores de personas. Radios, 2022 - Escobar.shp',
                        'path' => 'datasets/radios-censales-2022-partido-de-escobar/Indicadores de personas. Radios, 2022 - Escobar.shp',
                        'size' => 180564,
                    ],
                ],
            ],
            [
                'title' => 'Polideportivos del Partido de Escobar',
                'description' => 'Localización geográfica de los polideportivos públicos del Partido de Escobar, incluyendo instalaciones deportivas municipales destinadas a la práctica recreativa, deportiva y comunitaria. El conjunto de datos permite identificar la distribución territorial de la infraestructura deportiva y constituye un insumo para la planificación, el acceso equitativo al deporte y el diseño de políticas públicas de inclusión y promoción de la actividad física.',
                'category' => 'deporte',
                'organization' => '',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Relevamiento propio del Municipio de Escobar',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'polideportivos.geojson',
                        'path' => 'datasets/polideportivos-del-partido-de-escobar/polideportivos.geojson',
                        'size' => 2149,
                    ],
                    [
                        'name' => 'polideportivos.shp',
                        'path' => 'datasets/polideportivos-del-partido-de-escobar/polideportivos.shp',
                        'size' => 380,
                    ],
                ],
            ],
            [
                'title' => 'Instalaciones de Seguridad del Partido de Escobar',
                'description' => 'Localización geográfica de las instalaciones vinculadas a la seguridad pública en el Partido de Escobar, incluyendo comisarías, subcomisarías, destacamentos, jefaturas, centros de monitoreo, garitas y postas de seguridad. El conjunto de datos tiene como objetivo facilitar el conocimiento general de la infraestructura institucional de seguridad y apoyar el análisis territorial desde una perspectiva de planificación y gestión pública.',
                'category' => 'seguridad',
                'organization' => '',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Relevamiento propio del Municipio de Escobar',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'seguridad.geojson',
                        'path' => 'datasets/instalaciones-de-seguridad-del-partido-de-escobar/seguridad.geojson',
                        'size' => 17078,
                    ],
                    [
                        'name' => 'seguridad.shp',
                        'path' => 'datasets/instalaciones-de-seguridad-del-partido-de-escobar/seguridad.shp',
                        'size' => 1248,
                    ],
                ],
            ],
            [
                'title' => 'Red de Distribución de Agua Potable – Partido de Escobar',
                'description' => 'Capa geográfica en formato polilínea que representa el trazado general de la red de distribución de agua potable en el Partido de Escobar. El conjunto de datos fue elaborado por el municipio a partir de información provista por AySA correspondiente al año 2016 y se presenta con fines de análisis territorial, planificación de infraestructura y visualización general del servicio.',
                'category' => 'infraestructura-y-servicios-publicos',
                'organization' => 'No disponible',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Elaboración propia del Municipio de Escobar con base en información aportada por AySA (2016).',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'AYSA_agua_potable.geojson',
                        'path' => 'datasets/red-de-distribucion-de-agua-potable-partido-de-escobar/AYSA_agua_potable.geojson',
                        'size' => 9829,
                    ],
                    [
                        'name' => 'AYSA_agua_potable.shp',
                        'path' => 'datasets/red-de-distribucion-de-agua-potable-partido-de-escobar/AYSA_agua_potable.shp',
                        'size' => 3028,
                    ],
                ],
            ],
            [
                'title' => 'Cobertura del Servicio de Agua Potable – Partido de Escobar',
                'description' => 'Capa geográfica que representa la cobertura del servicio de agua potable en el Partido de Escobar, elaborada por el municipio a partir de información provista por AySA correspondiente al año 2016. El conjunto de datos permite identificar áreas con acceso al servicio y constituye un insumo para la planificación de infraestructura, el análisis de brechas de cobertura y el diseño de políticas públicas.',
                'category' => 'infraestructura-y-servicios-publicos',
                'organization' => 'Contacto institucional:',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Elaboración propia del Municipio de Escobar con base en información aportada por AySA (2016).',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'AYSA_agua.geojson',
                        'path' => 'datasets/cobertura-del-servicio-de-agua-potable-partido-de-escobar/AYSA_agua.geojson',
                        'size' => 65025,
                    ],
                    [
                        'name' => 'AYSA_agua.shp',
                        'path' => 'datasets/cobertura-del-servicio-de-agua-potable-partido-de-escobar/AYSA_agua.shp',
                        'size' => 20296,
                    ],
                ],
            ],
            [
                'title' => 'Plantas AySA – Infraestructura Sanitaria del Partido de Escobar',
                'description' => 'Capa geográfica en formato punto que identifica la localización de las principales instalaciones de infraestructura sanitaria operadas por AySA en el Partido de Escobar. Incluye plantas de tratamiento de agua potable, plantas depuradoras de efluentes cloacales y estaciones de bombeo. El conjunto de datos fue elaborado por el municipio a partir de información provista por AySA y se utiliza como insumo para la planificación territorial, la gestión de servicios públicos y el análisis de riesgos e infraestructura crítica.',
                'category' => 'infraestructura-y-servicios-publicos',
                'organization' => 'AySA',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Elaboración propia del Municipio de Escobar con base en información aportada por AySA.',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'Plantas_AySA.geojson',
                        'path' => 'datasets/plantas-aysa-infraestructura-sanitaria-del-partido-de-escobar/Plantas_AySA.geojson',
                        'size' => 975,
                    ],
                    [
                        'name' => 'Plantas_AySA.shp',
                        'path' => 'datasets/plantas-aysa-infraestructura-sanitaria-del-partido-de-escobar/Plantas_AySA.shp',
                        'size' => 212,
                    ],
                ],
            ],
            [
                'title' => 'Subestaciones de Energía del Partido de Escobar',
                'description' => 'Localización geográfica de las subestaciones de energía eléctrica del Partido de Escobar, representadas como entidades puntuales. El conjunto de datos permite identificar la infraestructura eléctrica principal del territorio y constituye un insumo para el análisis de servicios urbanos, planificación territorial y evaluación general de la red energética, sin incluir información técnica u operativa sensible.',
                'category' => 'infraestructura-y-servicios-publicos',
                'organization' => 'No disponible',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Información pública de empresas distribuidoras de energía / Relevamiento propio del Municipio de Escobar',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'subestaciones_energia.geojson',
                        'path' => 'datasets/subestaciones-de-energia-del-partido-de-escobar/subestaciones_energia.geojson',
                        'size' => 1617,
                    ],
                    [
                        'name' => 'subestaciones_energia.shp',
                        'path' => 'datasets/subestaciones-de-energia-del-partido-de-escobar/subestaciones_energia.shp',
                        'size' => 212,
                    ],
                ],
            ],
            [
                'title' => 'Red de Distribución Cloacal – Partido de Escobar',
                'description' => 'Capa geográfica en formato polilínea que representa el trazado general de la red de distribución cloacal en el Partido de Escobar. El conjunto de datos fue elaborado por el municipio a partir de información provista por AySA correspondiente al año 2016 y se presenta con fines de análisis territorial, planificación de infraestructura sanitaria y visualización general del servicio.',
                'category' => 'infraestructura-y-servicios-publicos',
                'organization' => 'No disponible',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Elaboración propia del Municipio de Escobar con base en información aportada por AySA (2016).',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'AYSA_cloacas.geojson',
                        'path' => 'datasets/red-de-distribucion-cloacal-partido-de-escobar/AYSA_cloacas.geojson',
                        'size' => 5339,
                    ],
                    [
                        'name' => 'AYSA_cloacas.shp',
                        'path' => 'datasets/red-de-distribucion-cloacal-partido-de-escobar/AYSA_cloacas.shp',
                        'size' => 1732,
                    ],
                ],
            ],
            [
                'title' => 'Estaciones de Ferrocarril del Partido de Escobar',
                'description' => 'Localización geográfica de las estaciones de ferrocarril del Partido de Escobar, representadas como entidades puntuales. El conjunto de datos identifica los principales nodos del sistema ferroviario y constituye un insumo para el análisis de movilidad, accesibilidad al transporte público y planificación territorial.',
                'category' => 'movilidad-y-transito',
                'organization' => 'No disponible',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Relevamiento propio del Municipio de Escobar / Información base de organismos ferroviarios nacionales',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'estaciones_ferrocarril.geojson',
                        'path' => 'datasets/estaciones-de-ferrocarril-del-partido-de-escobar/estaciones_ferrocarril.geojson',
                        'size' => 1062,
                    ],
                    [
                        'name' => 'estaciones_ferrocarril.shp',
                        'path' => 'datasets/estaciones-de-ferrocarril-del-partido-de-escobar/estaciones_ferrocarril.shp',
                        'size' => 240,
                    ],
                ],
            ],
            [
                'title' => 'Línea de Ferrocarril del Partido de Escobar',
                'description' => 'Trazado geográfico de la línea ferroviaria que atraviesa el Partido de Escobar, representada como una entidad lineal. El conjunto de datos permite visualizar la infraestructura ferroviaria existente y constituye un insumo para el análisis de movilidad, conectividad territorial, planificación urbana y articulación con otros sistemas de transporte.',
                'category' => 'movilidad-y-transito',
                'organization' => 'No disponible',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Relevamiento propio del Municipio de Escobar / Información base de organismos ferroviarios nacionales',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'linea_ferrocarril.geojson',
                        'path' => 'datasets/linea-de-ferrocarril-del-partido-de-escobar/linea_ferrocarril.geojson',
                        'size' => 7619,
                    ],
                    [
                        'name' => 'linea_ferrocarril.shp',
                        'path' => 'datasets/linea-de-ferrocarril-del-partido-de-escobar/linea_ferrocarril.shp',
                        'size' => 1704,
                    ],
                ],
            ],
            [
                'title' => 'Ejes de Calles del Partido de Escobar',
                'description' => 'Representación geográfica de los ejes de las calles del Partido de Escobar, modelados como entidades lineales que corresponden al centro geométrico de la traza vial. El conjunto de datos constituye una capa base fundamental para el análisis urbano, la georreferenciación de direcciones, la planificación territorial, la movilidad y la integración con otros datos espaciales municipales.',
                'category' => 'infraestructura-y-servicios-publicos',
                'organization' => 'No disponible',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Cartografía base municipal / Relevamiento propio del Municipio de Escobar',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'ejes_calles.geojson',
                        'path' => 'datasets/ejes-de-calles-del-partido-de-escobar/ejes_calles.geojson',
                        'size' => 4823127,
                    ],
                    [
                        'name' => 'ejes_calles.shp',
                        'path' => 'datasets/ejes-de-calles-del-partido-de-escobar/ejes_calles.shp',
                        'size' => 701592,
                    ],
                ],
            ],
            [
                'title' => 'Terminal de Ómnibus del Partido de Escobar',
                'description' => 'Localización geográfica de la Terminal de Ómnibus del Partido de Escobar, representada como una entidad puntual. El conjunto de datos identifica un nodo clave del sistema de transporte público automotor y constituye un insumo para el análisis de movilidad, conectividad urbana e integración con otros modos de transporte.',
                'category' => 'movilidad-y-transito',
                'organization' => 'No disponible',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Relevamiento propio del Municipio de Escobar',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'terminal_omnibus.geojson',
                        'path' => 'datasets/terminal-de-omnibus-del-partido-de-escobar/terminal_omnibus.geojson',
                        'size' => 508,
                    ],
                    [
                        'name' => 'terminal_omnibus.shp',
                        'path' => 'datasets/terminal-de-omnibus-del-partido-de-escobar/terminal_omnibus.shp',
                        'size' => 128,
                    ],
                ],
            ],
            [
                'title' => 'Vía Nacional en el Partido de Escobar',
                'description' => 'Trazado geográfico de las vías nacionales que atraviesan el Partido de Escobar, representadas como entidades lineales. El conjunto de datos permite identificar la infraestructura vial de jurisdicción nacional dentro del territorio municipal y constituye un insumo para el análisis de conectividad regional, movilidad, logística y planificación territorial.',
                'category' => 'movilidad-y-transito',
                'organization' => 'No disponible',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Información base de organismos viales nacionales / Relevamiento propio del Municipio de Escobar',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'via_nacional.geojson',
                        'path' => 'datasets/via-nacional-en-el-partido-de-escobar/via_nacional.geojson',
                        'size' => 15025,
                    ],
                    [
                        'name' => 'via_nacional.shp',
                        'path' => 'datasets/via-nacional-en-el-partido-de-escobar/via_nacional.shp',
                        'size' => 5224,
                    ],
                ],
            ],
            [
                'title' => 'Unidades de Gestión Comunitaria del Partido de Escobar',
                'description' => 'Localización geográfica de las Unidades de Gestión Comunitaria (UGC) del Partido de Escobar, espacios territoriales de atención descentralizada que articulan la gestión municipal con la comunidad. Las UGC brindan orientación, acompañamiento y acceso a programas y servicios municipales, y el conjunto de datos constituye un insumo para fortalecer la cercanía del Estado local, mejorar la accesibilidad a la gestión pública y apoyar el análisis de cobertura territorial de los servicios municipales.',
                'category' => 'participacion-ciudadana',
                'organization' => '',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Relevamiento propio del Municipio de Escobar',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'UGCs.geojson',
                        'path' => 'datasets/unidades-de-gestion-comunitaria-del-partido-de-escobar/UGCs.geojson',
                        'size' => 11977,
                    ],
                    [
                        'name' => 'UGCs.shp',
                        'path' => 'datasets/unidades-de-gestion-comunitaria-del-partido-de-escobar/UGCs.shp',
                        'size' => 856,
                    ],
                ],
            ],
            [
                'title' => 'Atractivos Turísticos del Partido de Escobar',
                'description' => 'Localización geográfica de los principales atractivos turísticos del Partido de Escobar, incluyendo sitios de interés natural, cultural, histórico, recreativo y patrimonial. El conjunto de datos tiene como objetivo promover el turismo local, facilitar la planificación de recorridos y fortalecer la puesta en valor del patrimonio turístico del municipio.',
                'category' => 'cultura',
                'organization' => '',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Relevamiento propio del Municipio de Escobar',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'atractivos_turisticos.geojson',
                        'path' => 'datasets/atractivos-turisticos-del-partido-de-escobar/atractivos_turisticos.geojson',
                        'size' => 15783,
                    ],
                    [
                        'name' => 'atractivos_turisticos.shp',
                        'path' => 'datasets/atractivos-turisticos-del-partido-de-escobar/atractivos_turisticos.shp',
                        'size' => 604,
                    ],
                ],
            ],
            [
                'title' => 'Ecorregiones del Partido de Escobar',
                'description' => 'Representación geográfica de las ecorregiones presentes en el Partido de Escobar, elaborada a partir de la clasificación de ecorregiones de la Argentina. El conjunto de datos permite contextualizar ambientalmente el territorio y apoyar la planificación, la gestión ambiental y la toma de decisiones con enfoque ecosistémico.',
                'category' => 'ambiente-y-biodiversidad',
                'organization' => 'Estrategia Ambiental y datos',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Brown, A., Martínez Ortiz, U., Acerbi, M., Corcuera, J. (2006). La Situación Ambiental Argentina. Fundación Vida Silvestre Argentina. Buenos Aires, Argentina.',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'ecorregiones.geojson',
                        'path' => 'datasets/ecorregiones-del-partido-de-escobar/ecorregiones.geojson',
                        'size' => 61827,
                    ],
                    [
                        'name' => 'ecorregiones.shp',
                        'path' => 'datasets/ecorregiones-del-partido-de-escobar/ecorregiones.shp',
                        'size' => 20420,
                    ],
                ],
            ],
            [
                'title' => 'Cobertura del Suelo (Land Cover) ESA 2021 – Partido de Escobar',
                'description' => 'Conjunto de datos de cobertura del suelo correspondiente al año 2021, elaborado por la Agencia Espacial Europea (ESA), adaptado y recortado al Partido de Escobar. La capa representa la clasificación del territorio en distintas clases de cobertura del suelo (urbano, vegetación, cuerpos de agua, áreas agrícolas, entre otras) y constituye un insumo clave para el análisis ambiental, el ordenamiento territorial, la planificación urbana y la evaluación de cambios en el uso del suelo.',
                'category' => 'ambiente-y-biodiversidad',
                'organization' => 'Agencia Espacial Europea (ESA)',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'European Space Agency (ESA). Land Cover 2021.',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => [],
                'files' => [
                ],
            ],
            [
                'title' => 'Áreas Verdes Urbanas del Partido de Escobar',
                'description' => 'Conjunto de datos que identifica y delimita las áreas verdes urbanas del Partido de Escobar, obtenido mediante un proceso de clasificación supervisada realizado en Google Earth Engine. La capa permite representar la distribución espacial de la cobertura verde urbana y constituye un insumo clave para el análisis ambiental, la planificación urbana, la evaluación de servicios ecosistémicos y el diseño de políticas de adaptación al cambio climático.',
                'category' => 'ambiente-y-biodiversidad',
                'organization' => 'Estrategia Ambiental y Datos',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Elaboración propia del Municipio de Escobar mediante Google Earth Engine',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'areas_verdes.geojson',
                        'path' => 'datasets/areas-verdes-urbanas-del-partido-de-escobar/areas_verdes.geojson',
                        'size' => 11749266,
                    ],
                    [
                        'name' => 'areas_verdes.shp',
                        'path' => 'datasets/areas-verdes-urbanas-del-partido-de-escobar/areas_verdes.shp',
                        'size' => 5713896,
                    ],
                ],
            ],
            [
                'title' => 'Cursos de Agua del Partido de Escobar',
                'description' => 'Red hidrográfica del Partido de Escobar que incluye ríos, arroyos y cursos de agua permanentes e intermitentes. El conjunto de datos constituye una capa base para la gestión ambiental, el ordenamiento territorial, el análisis de riesgo hídrico y la planificación de infraestructura.',
                'category' => 'ambiente-y-biodiversidad',
                'organization' => 'Estrategia Ambiental y datos',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Cartografía base hidrográfica utilizada por el Municipio de Escobar.',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'cursos_agua.geojson',
                        'path' => 'datasets/cursos-de-agua-del-partido-de-escobar/cursos_agua.geojson',
                        'size' => 273614,
                    ],
                    [
                        'name' => 'cursos_agua.shp',
                        'path' => 'datasets/cursos-de-agua-del-partido-de-escobar/cursos_agua.shp',
                        'size' => 84860,
                    ],
                ],
            ],
            [
                'title' => 'Clasificación de Cobertura del Suelo – MapBiomas 2022 (Partido de Escobar)',
                'description' => 'Clasificación de la cobertura del suelo correspondiente al año 2022, elaborada por el proyecto MapBiomas. El conjunto de datos representa las principales clases de cobertura presentes en el Partido de Escobar y constituye un insumo clave para el análisis ambiental, el ordenamiento territorial y el monitoreo de cambios de uso del suelo.',
                'category' => 'ambiente-y-biodiversidad',
                'organization' => 'Fundación Vida Silvestre Argentina',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'MapBiomas – Colección 2022 de la Serie Anual de Mapas de Cobertura y Uso del Suelo, consultada el octubre 2025 a través del enlace: https://plataforma.argentina.mapbiomas.org/',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'map_biomas_2022.geojson',
                        'path' => 'datasets/clasificacion-de-cobertura-del-suelo-mapbiomas-2022-partido-de-escobar/map_biomas_2022.geojson',
                        'size' => 4484983,
                    ],
                    [
                        'name' => 'map_biomas_2022.shp',
                        'path' => 'datasets/clasificacion-de-cobertura-del-suelo-mapbiomas-2022-partido-de-escobar/map_biomas_2022.shp',
                        'size' => 1574988,
                    ],
                ],
            ],
            [
                'title' => 'Plazas y Parques del Partido de Escobar',
                'description' => 'Localización y delimitación geográfica de las plazas y parques del Partido de Escobar, espacios verdes públicos destinados al uso recreativo, social y ambiental. El conjunto de datos permite identificar la distribución territorial de los principales espacios verdes urbanos y constituye un insumo clave para el análisis de infraestructura verde, calidad ambiental, bienestar urbano y planificación territorial.',
                'category' => 'ambiente-y-biodiversidad',
                'organization' => 'Estrategia Ambiental y datos',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Relevamiento propio del Municipio de Escobar',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['geojson', 'shp'],
                'files' => [
                    [
                        'name' => 'plazas_y_parques.geojson',
                        'path' => 'datasets/plazas-y-parques-del-partido-de-escobar/plazas_y_parques.geojson',
                        'size' => 32676,
                    ],
                    [
                        'name' => 'plazas_y_parques.shp',
                        'path' => 'datasets/plazas-y-parques-del-partido-de-escobar/plazas_y_parques.shp',
                        'size' => 10244,
                    ],
                ],
            ],
            [
                'title' => 'Estadísticas Vitales 2005 -2022 Escobar',
                'description' => 'Dataset Estadísticas Vitales 2005 -2022 Escobar',
                'category' => 'monitoreo-institucional',
                'organization' => 'Municipalidad de Escobar',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Municipalidad de Escobar',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['xlsx'],
                'files' => [
                    [
                        'name' => 'Estadísticas vitales 2005 -2022 Escobar.xlsx',
                        'path' => 'datasets/estadisticas-vitales-2005-2022-escobar/Estadísticas vitales 2005 -2022 Escobar.xlsx',
                        'size' => 12927,
                    ],
                ],
            ],
            [
                'title' => 'Población Por Sexo Según Radio Censal - Censo 2022 Radio',
                'description' => 'Dataset Población Por Sexo Según Radio Censal - Censo 2022 Radio',
                'category' => 'monitoreo-institucional',
                'organization' => 'Municipalidad de Escobar',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Municipalidad de Escobar',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['csv'],
                'files' => [
                    [
                        'name' => 'Población por sexo según radio Censal - Censo_2022_radio.csv',
                        'path' => 'datasets/poblacion-por-sexo-segun-radio-censal-censo-2022-radio/Población por sexo según radio Censal - Censo_2022_radio.csv',
                        'size' => 6824,
                    ],
                ],
            ],
            [
                'title' => 'Farmacias Escobar',
                'description' => 'Dataset Farmacias Escobar',
                'category' => 'salud',
                'organization' => 'Municipalidad de Escobar',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Municipalidad de Escobar',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['xlsx'],
                'files' => [
                    [
                        'name' => 'Farmacias_Escobar.xlsx',
                        'path' => 'datasets/farmacias-escobar/Farmacias_Escobar.xlsx',
                        'size' => 12571,
                    ],
                ],
            ],
            [
                'title' => 'Centros Medicos Unificado Escobar Version Completa',
                'description' => 'Dataset Centros Medicos Unificado Escobar Version Completa',
                'category' => 'salud',
                'organization' => 'Municipalidad de Escobar',
                'version' => '1.0',
                'periodicity' => 'Anual',
                'source' => 'Municipalidad de Escobar',
                'license' => 'Open Data Commons Open Database License (ODbL)',
                'created_date' => Carbon::now()->subMonths(6),
                'last_modified' => Carbon::now()->subDays(1),
                'formats' => ['xlsx'],
                'files' => [
                    [
                        'name' => 'centros_medicos_unificado_escobar_version_completa.xlsx',
                        'path' => 'datasets/centros-medicos-unificado-escobar-version-completa/centros_medicos_unificado_escobar_version_completa.xlsx',
                        'size' => 28252,
                    ],
                ],
            ],
        ];

        foreach ($datasets as $datasetData) {
            $category = Category::where('slug', $datasetData['category'])->first();
            
            if (!$category) {
                echo "⚠ Categoría no encontrada: {$datasetData['category']} para dataset: {$datasetData['title']}\n";
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
                        'file_url' => $this->resolveFileUrl($fileInfo['path']),
                        'file_size' => $fileInfo['size']
                    ];
                }
            }
            
            $dataset->formats()->sync($syncData);
            
            echo "✓ Dataset cargado: {$datasetData['title']}\n";
        }
        
        echo "\n✓ Carga completa: " . count($datasets) . " datasets\n";
    }

    private function resolveFileUrl(string $path): string
    {
        $r2Url = rtrim(config('filesystems.disks.r2.url', ''), '/');

        if ($r2Url) {
            return $r2Url . '/' . $path;
        }

        return '/storage/' . $path;
    }
}
