# Arquitectura de la API - Portal de Datos Abiertos Escobar

## Estado actual (Pre-producción)

La API actual está implementada como rutas web dentro del mismo proyecto Laravel, retornando JSON. Esto es funcional para desarrollo y pruebas, pero para producción se recomienda evolucionar hacia una de las siguientes arquitecturas.

### Endpoints actuales

| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | `/api/datasets` | Lista paginada de datasets con filtros |
| GET | `/api/datasets/{slug}` | Detalle de un dataset |
| GET | `/api/categories` | Lista de categorías con conteo |
| GET | `/api/glossary` | Términos del glosario |
| GET | `/api/officials` | Lista de funcionarios |
| GET | `/api/organisms` | Estructura de organismos |
| GET | `/api/government-areas` | Contacto de áreas |

---

## Opción A: API REST dentro del mismo proyecto Laravel (Recomendada para MVP)

### Descripción
Mantener la API dentro del proyecto Laravel existente, pero migrando las rutas al archivo `routes/api.php` con middleware adecuado.

### Ventajas
- **Mínimo esfuerzo**: No requiere nuevo proyecto ni infraestructura.
- **Datos consistentes**: Misma base de datos, mismos modelos.
- **Rápida implementación**: Ya está parcialmente implementado.

### Cambios necesarios
1. Mover rutas de `routes/web.php` a `routes/api.php`.
2. Agregar middleware `throttle` para rate limiting.
3. Agregar versionado: `/api/v1/datasets`.
4. Implementar API Resources de Laravel para controlar la respuesta JSON.
5. Agregar documentación con OpenAPI/Swagger.
6. Implementar CORS con `config/cors.php`.

### Ejemplo de API Resource
```php
// app/Http/Resources/DatasetResource.php
class DatasetResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'organization' => $this->organization,
            'metadata' => [
                'version' => $this->version,
                'periodicity' => $this->periodicity,
                'source' => $this->source,
                'license' => $this->license,
                'created_date' => $this->created_date?->toIso8601String(),
                'last_modified' => $this->last_modified?->toIso8601String(),
            ],
            'formats' => FormatResource::collection($this->whenLoaded('formats')),
        ];
    }
}
```

---

## Opción B: API separada con Laravel + Sanctum

### Descripción
Proyecto Laravel separado dedicado exclusivamente a la API, con autenticación via tokens (Sanctum).

### Ventajas
- **Escalabilidad independiente**: API y portal escalan por separado.
- **Autenticación**: Tokens para consumidores de la API.
- **Rate limiting avanzado**: Por consumidor/token.

### Desventajas
- Requiere sincronización de base de datos o base compartida.
- Mayor complejidad de infraestructura.

### Stack sugerido
- Laravel 12 + Sanctum
- PostgreSQL (compartida o replicada)
- Redis para caché y rate limiting
- Documentación con Scramble o L5-Swagger

---

## Opción C: API Gateway + microservicio

### Descripción
Para una evolución a largo plazo, separar en microservicios con un API Gateway.

### Arquitectura
```
[Consumidores] → [API Gateway (Kong/Traefik)] → [Servicio de Datos]
                                                → [Servicio de Gobierno]
                                                → [Servicio de Auth]
```

### Ventajas
- Máxima escalabilidad y desacoplamiento.
- Cada servicio es independiente.

### Desventajas
- Complejidad operativa alta.
- Solo justificable con alto volumen de tráfico.

---

## Recomendación

Para el estado actual del proyecto, se recomienda la **Opción A** como punto de partida inmediato. Es la evolución natural del código existente y permite tener una API funcional con mínimo esfuerzo.

A medida que el portal crezca en volumen de datos y consumidores, migrar a la **Opción B** sería el siguiente paso lógico.

La **Opción C** solo se justifica si el portal se convierte en una plataforma regional con múltiples municipios o alto volumen de consultas.
