<?php

namespace Database\Seeders;

use App\Models\GlossaryTerm;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GlossaryTermSeeder extends Seeder
{
    public function run()
    {
        $terms = [
            ['term' => 'API', 'definition' => 'Interfaz de Programación de Aplicaciones (Application Programming Interface). Conjunto de reglas y especificaciones que permiten que distintos programas se comuniquen entre sí para intercambiar datos.'],
            ['term' => 'Catálogo de datos', 'definition' => 'Listado completo y organizado de todos los conjuntos de datos (datasets) disponibles en un portal de datos abiertos, con sus respectivos metadatos descriptivos.'],
            ['term' => 'CSV', 'definition' => 'Valores Separados por Comas (Comma-Separated Values). Formato de archivo de texto plano que almacena datos tabulares donde cada valor está separado por comas.'],
            ['term' => 'Datos abiertos', 'definition' => 'Datos que pueden ser utilizados, reutilizados y redistribuidos libremente por cualquier persona, sujetos únicamente al requerimiento de atribución y de compartirse de la misma manera en que aparecen.'],
            ['term' => 'Dataset', 'definition' => 'Conjunto de datos estructurados y organizados que representan información sobre un tema específico. En el contexto de datos abiertos, un dataset es una unidad de publicación que contiene uno o más recursos.'],
            ['term' => 'Descarga', 'definition' => 'Proceso de transferir un archivo de datos desde el portal hacia el dispositivo del usuario para su uso local.'],
            ['term' => 'Estándar abierto', 'definition' => 'Formato o protocolo de datos cuya especificación está disponible públicamente y puede ser implementado por cualquiera sin restricciones legales o técnicas.'],
            ['term' => 'Formato', 'definition' => 'Estructura específica en la que se organizan y almacenan los datos dentro de un archivo. Los formatos más comunes en datos abiertos incluyen CSV, JSON, XML, XLS y GeoJSON.'],
            ['term' => 'GeoJSON', 'definition' => 'Formato de intercambio de datos geoespaciales basado en JSON. Se utiliza para representar elementos geográficos simples y sus propiedades no espaciales.'],
            ['term' => 'Gobierno abierto', 'definition' => 'Doctrina política que sostiene que los temas de gobierno y administración pública deben ser abiertos a todos los niveles posibles en cuanto a transparencia y participación ciudadana.'],
            ['term' => 'Interoperabilidad', 'definition' => 'Capacidad de diferentes sistemas, organizaciones y aplicaciones para trabajar juntos e intercambiar datos de manera eficiente y precisa.'],
            ['term' => 'JSON', 'definition' => 'Notación de Objetos JavaScript (JavaScript Object Notation). Formato de texto ligero para el intercambio de datos, fácil de leer y escribir tanto para humanos como para máquinas.'],
            ['term' => 'Licencia abierta', 'definition' => 'Licencia que permite a los usuarios acceder, usar, modificar y compartir datos o contenido de forma libre, generalmente con la condición de atribución al autor original.'],
            ['term' => 'Metadatos', 'definition' => 'Datos que describen otros datos. En el contexto de datos abiertos, son la información que describe un dataset: título, descripción, fecha de actualización, organismo responsable, periodicidad, etc.'],
            ['term' => 'Open Data', 'definition' => 'Término en inglés para Datos Abiertos. Filosofía y práctica de publicar datos de manera que sean libremente accesibles y reutilizables.'],
            ['term' => 'Periodicidad', 'definition' => 'Frecuencia con la que un dataset se actualiza. Puede ser diaria, semanal, mensual, trimestral, anual u otra frecuencia definida.'],
            ['term' => 'Portal de datos', 'definition' => 'Plataforma web donde se publican, organizan y ponen a disposición los conjuntos de datos abiertos de una organización gubernamental.'],
            ['term' => 'Recurso', 'definition' => 'Archivo individual dentro de un dataset que contiene datos en un formato específico. Un dataset puede contener múltiples recursos en diferentes formatos.'],
            ['term' => 'Shapefile', 'definition' => 'Formato de archivo geoespacial desarrollado por ESRI. Almacena datos geométricos y de atributos de elementos geográficos como puntos, líneas y polígonos.'],
            ['term' => 'Transparencia', 'definition' => 'Principio de gestión pública que implica la apertura y accesibilidad de la información gubernamental para que los ciudadanos puedan conocer y evaluar las acciones del gobierno.'],
            ['term' => 'URI', 'definition' => 'Identificador Uniforme de Recursos (Uniform Resource Identifier). Cadena de caracteres que identifica de manera única un recurso en Internet.'],
            ['term' => 'XML', 'definition' => 'Lenguaje de Marcas Extensible (Extensible Markup Language). Formato de texto para representar datos estructurados de manera legible tanto para humanos como para máquinas.'],
        ];

        foreach ($terms as $termData) {
            GlossaryTerm::updateOrCreate(
                ['slug' => Str::slug($termData['term'])],
                [
                    'term' => $termData['term'],
                    'definition' => $termData['definition'],
                    'letter' => mb_strtoupper(mb_substr($termData['term'], 0, 1)),
                ]
            );
        }
    }
}
