# Guía para Completar Datos Institucionales

## ✅ Implementaciones Completadas

### 1. Localización en Español Argentino
- Laravel configurado con locale `es` y faker locale `es_AR`
- Filament panel traducido al español
- Archivos de traducción creados:
  - `lang/es/validation.php`
  - `lang/es/pagination.php`
  - `lang/es/passwords.php`
  - `lang/es/auth.php`

### 2. Funcionalidad de Compartir Datasets
- Botones funcionales para compartir en redes sociales (Facebook, Twitter, WhatsApp)
- Botón para copiar enlace al portapapeles
- URLs dinámicas que incluyen título y enlace del dataset

### 3. Modelo Institution (Datos Institucionales Centrales)
- Tabla `institutions` creada con todos los campos necesarios
- Recurso Filament completo para administrar datos institucionales
- Layout actualizado para usar datos dinámicos de la institución

### 4. Enlaces del Header y Footer
- Enlaces de redes sociales ahora dinámicos (se ocultan si no están configurados)
- Datos de contacto extraídos de la tabla `institutions`
- Enlace "Contacto" apunta a la página de áreas de contacto

### 5. Mejoras a Recursos Filament
- **DatasetResource**: Botón "Compartir" y acción de exportación
- **GovernmentAreaResource**: Validaciones requeridas, acción de exportación
- **CategoryResource**: Secciones organizadas, textos de ayuda, acción de exportación
- **OfficialResource**: Ya implementado completamente en español

## 📋 Datos Faltantes que Necesitan Completarse

### 1. Datos Institucionales Centrales (Tabla: institutions)

Acceder al panel de administración → **Configuración** → **Instituciones** → Editar registro

**Campos a completar:**

#### Información General
- ✅ Nombre: "Municipalidad de Escobar" (ya cargado)
- ✅ Descripción: Ya tiene descripción básica
- ⚠️ **Sitio web**: Confirmar si `https://www.escobar.gob.ar` es correcto

#### Datos de Contacto
- ⚠️ **Dirección**: Cambiar "Por definir - Dirección del Palacio Municipal" por la dirección real
  - Ejemplo: "Av. San Martín 150, Belén de Escobar, Buenos Aires"
- ✅ Teléfono: `(0348) 444-1000` (verificar si es correcto)
- ✅ Email: `datos@escobar.gob.ar` (verificar si es correcto)
- ⚠️ **Horario**: Confirmar horarios de atención al público
  - Ejemplo actual: "Lunes a Viernes de 8:00 a 14:00 hs"

#### Redes Sociales (todos NULL actualmente)
- ❌ **Facebook**: Agregar URL completa (ej: `https://www.facebook.com/MunicipioEscobar`)
- ❌ **Instagram**: Agregar URL completa (ej: `https://www.instagram.com/municipioescobar`)
- ❌ **Twitter**: Agregar URL completa (ej: `https://twitter.com/MuniEscobar`)
- ❌ **YouTube**: Agregar URL completa (opcional)
- ❌ **WhatsApp**: Agregar número con código de país (ej: `5491123456789`)

### 2. Áreas Gubernamentales (Tabla: government_areas)

Acceder al panel de administración → **Gobierno** → **Áreas de Contacto**

**18 áreas cargadas con datos mock - Verificar cada una:**

Para cada área se necesita:
- ✅ Nombre del área (verificar si es correcto)
- ⚠️ Responsable (verificar nombre real)
- ⚠️ Cargo del responsable (verificar cargo real)
- ❌ **Dirección** (actualmente todas tienen direcciones genéricas)
- ❌ **Teléfono** (verificar números reales)
- ❌ **Email** (verificar emails institucionales)
- ❌ **Horario de atención** (completar horarios reales)

### 3. Organismos (Tabla: organisms)

Acceder al panel de administración → **Gobierno** → **Organismos**

**19 organismos cargados con datos mock - Verificar:**

- Nombres oficiales correctos
- Descripciones actualizadas
- Datos de contacto verificables
- Direcciones físicas confirmadas

### 4. Autoridades Municipales (Tabla: officials)

Acceder al panel de administración → **Gobierno** → **Funcionarios**

**Tabla vacía - Necesita cargarse completamente:**

#### Intendente
- Nombre completo
- Email oficial
- Teléfono
- Biografía breve
- URL de foto oficial
- Marcar como "Es Intendente"
- Marcar como "Es parte del Gabinete"
- Orden: 1

#### Secretarios
Para cada secretario:
- Nombre y apellido
- Cargo: "Secretario/a de [Área]"
- Categoría: "Secretario/a"
- Área que dirigen
- Email oficial
- Teléfono
- Biografía (opcional)
- URL de foto (opcional)
- Marcar como "Es parte del Gabinete"
- Asignar orden jerárquico

#### Subsecretarios
Para cada subsecretario:
- Datos similares a secretarios
- Categoría: "Subsecretario/a"
- Marcar como "Es parte del Gabinete" si aplica

#### Directores y otros cargos
- Categoría: "Director/a"
- Completar según corresponda

### 5. Solicitudes de Información (Tabla: information_requests)

Este modelo está vacío y se llena automáticamente cuando los ciudadanos envían solicitudes desde el portal público.

**No requiere acción**, pero verificar que el formulario público funcione correctamente.

## 🎯 Procedimiento Recomendado

### Paso 1: Datos Institucionales (ALTA PRIORIDAD)
1. Acceder a `/admin` (panel Filament)
2. Ir a **Configuración** → **Instituciones**
3. Editar el único registro existente
4. Completar **todos** los campos de redes sociales
5. Verificar y corregir dirección, teléfono y horarios
6. Guardar

### Paso 2: Autoridades (ALTA PRIORIDAD)
1. Recopilar información de todas las autoridades
2. Acceder a **Gobierno** → **Funcionarios**
3. Crear registro para el Intendente
4. Crear registros para todos los secretarios
5. Crear registros para subsecretarios y directores

### Paso 3: Áreas de Contacto (MEDIA PRIORIDAD)
1. Acceder a **Gobierno** → **Áreas de Contacto**
2. Editar cada área una por una
3. Verificar y corregir todos los campos
4. Asegurar que direcciones, teléfonos y emails sean reales

### Paso 4: Organismos (MEDIA PRIORIDAD)
1. Acceder a **Gobierno** → **Organismos**
2. Verificar nombres y descripciones
3. Actualizar datos de contacto

## 📝 Formato de Datos

### Direcciones
```
Calle/Avenida Número, Localidad, Provincia
Ejemplo: Av. San Martín 150, Belén de Escobar, Buenos Aires
```

### Teléfonos
```
(Código de área) Número con guiones
Ejemplo: (0348) 444-1000
```

### Emails
```
nombre@escobar.gob.ar
Ejemplo: secretaria.cultura@escobar.gob.ar
```

### Horarios
```
Días de Semana de HH:MM a HH:MM hs
Ejemplo: Lunes a Viernes de 8:00 a 14:00 hs
```

### URLs de Redes Sociales
```
https://www.facebook.com/NombrePagina
https://www.instagram.com/nombreusuario
https://twitter.com/nombreusuario
https://www.youtube.com/@nombrecanal
```

### WhatsApp
```
Código país + Código área + Número (sin espacios, guiones ni paréntesis)
Ejemplo: 5491123456789
```

## ✨ Beneficios de Completar los Datos

### Una vez completados los datos institucionales:
- ✅ El header mostrará enlaces funcionales a redes sociales
- ✅ El footer mostrará información de contacto real
- ✅ Los ciudadanos podrán contactar directamente a las áreas
- ✅ Las páginas de autoridades mostrarán información oficial
- ✅ El sitio será completamente funcional y transparente

## 🔧 Acceso al Panel de Administración

**URL**: `/admin`

**Credenciales**: Usar las credenciales de administrador creadas durante la instalación.

Si no se creó un usuario administrador, ejecutar:
```bash
php artisan db:seed --class=AdminUserSeeder
```

## 📞 Contacto para Soporte Técnico

Para cualquier duda sobre cómo cargar los datos o problemas técnicos, consultar con el equipo de desarrollo.
