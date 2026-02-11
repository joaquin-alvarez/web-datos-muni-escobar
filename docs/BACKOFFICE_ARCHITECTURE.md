# Arquitectura del Backoffice - Portal de Datos Abiertos Escobar

## Objetivo

Desarrollar un panel de administración (backoffice) que permita gestionar todos los datos publicados en el portal de datos abiertos sin necesidad de intervención técnica directa en la base de datos.

## Funcionalidades requeridas

### Gestión de Datos
- **Datasets**: CRUD completo (crear, leer, actualizar, eliminar).
- **Categorías**: Administrar categorías y sus iconos.
- **Formatos**: Gestionar formatos disponibles y subir archivos.
- **Metadatos**: Editar versión, periodicidad, fuente, licencia de cada dataset.

### Gestión de Gobierno
- **Funcionarios**: CRUD con carga de foto y CV.
- **Organismos**: Administrar estructura orgánica jerárquica.
- **Áreas de contacto**: Gestionar datos de contacto por área.

### Gestión del Portal
- **Glosario**: CRUD de términos.
- **Solicitudes de información**: Ver, responder y cambiar estado.
- **Usuarios administradores**: Gestión de accesos.

---

## Opción A: Laravel + Filament (Recomendada)

### Descripción
Filament es un panel de administración para Laravel que genera interfaces CRUD automáticamente a partir de los modelos existentes.

### Ventajas
- **Integración nativa**: Funciona directamente con los modelos Eloquent existentes.
- **Desarrollo rápido**: Genera formularios y tablas automáticamente.
- **Personalizable**: Widgets, dashboards, y componentes custom.
- **Mismo proyecto**: Se instala dentro del proyecto Laravel actual.
- **Autenticación incluida**: Sistema de login y roles built-in.

### Stack
- Laravel 12 (proyecto actual)
- Filament v3
- Livewire (incluido con Filament)
- SQLite/PostgreSQL (base de datos actual)

### Implementación estimada
```bash
composer require filament/filament
php artisan filament:install --panels
php artisan make:filament-resource Dataset
php artisan make:filament-resource Category
php artisan make:filament-resource Official
php artisan make:filament-resource Organism
php artisan make:filament-resource GovernmentArea
php artisan make:filament-resource GlossaryTerm
php artisan make:filament-resource InformationRequest
```

### Ejemplo de Resource
```php
// app/Filament/Resources/DatasetResource.php
class DatasetResource extends Resource
{
    protected static ?string $model = Dataset::class;
    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')->required(),
            TextInput::make('slug')->required()->unique(ignoreRecord: true),
            Textarea::make('description')->required(),
            Select::make('category_id')
                ->relationship('category', 'name')->required(),
            TextInput::make('organization')->required(),
            TextInput::make('version')->default('1.0'),
            Select::make('periodicity')
                ->options([
                    'Diaria' => 'Diaria',
                    'Semanal' => 'Semanal',
                    'Mensual' => 'Mensual',
                    'Trimestral' => 'Trimestral',
                    'Semestral' => 'Semestral',
                    'Anual' => 'Anual',
                ]),
            TextInput::make('source'),
            TextInput::make('license'),
            DateTimePicker::make('created_date'),
            DateTimePicker::make('last_modified'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->searchable()->sortable(),
            TextColumn::make('category.name')->sortable(),
            TextColumn::make('organization')->searchable(),
            TextColumn::make('version'),
            TextColumn::make('last_modified')->dateTime('d/m/Y'),
        ]);
    }
}
```

### Ruta de acceso
El backoffice estaría disponible en `/admin` con autenticación separada.

---

## Opción B: SPA separada con React/Next.js + API

### Descripción
Aplicación frontend independiente que consume la API del portal.

### Ventajas
- **Separación completa**: Frontend y backend desacoplados.
- **UX moderna**: SPA con navegación fluida.
- **Reutiliza la API**: Consume los mismos endpoints.

### Desventajas
- **Mayor complejidad**: Dos proyectos a mantener.
- **Desarrollo más lento**: Construir toda la UI desde cero.
- **Autenticación separada**: Requiere JWT/Sanctum configurado.

### Stack sugerido
- Next.js 14 (App Router)
- TailwindCSS + shadcn/ui
- React Query para data fetching
- NextAuth.js para autenticación

---

## Opción C: Laravel Nova

### Descripción
Panel de administración premium para Laravel por el equipo de Laravel.

### Ventajas
- Integración premium con Laravel.
- Ecosistema de plugins amplio.
- Soporte oficial.

### Desventajas
- **Licencia paga**: USD 199/sitio.
- Menos flexible que Filament en personalización visual.

---

## Recomendación

Se recomienda la **Opción A (Filament)** por las siguientes razones:

1. **Cero costo**: Es open source.
2. **Mismos modelos**: Aprovecha los modelos Eloquent ya creados.
3. **Mismo proyecto**: No requiere infraestructura adicional.
4. **Desarrollo rápido**: En pocas horas se tiene un CRUD completo para todas las entidades.
5. **Comunidad activa**: Filament tiene una comunidad grande y activa en el ecosistema Laravel.

### Pasos para implementación
1. Instalar Filament en el proyecto actual.
2. Crear Resources para cada modelo (Dataset, Category, Official, etc.).
3. Configurar roles (Admin, Editor).
4. Agregar widgets al dashboard (estadísticas de datasets, solicitudes pendientes).
5. Configurar uploads para fotos de funcionarios y archivos de datasets.
