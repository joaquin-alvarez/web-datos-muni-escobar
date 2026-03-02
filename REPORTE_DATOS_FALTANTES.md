# Reporte de Información Faltante - Portal de Datos Abiertos

## Estado Actual de la Aplicación

### Datos Reales (Cargados y Verificados)

#### ✅ Categorías de Datasets (15 categorías)
- Ambiente y Biodiversidad
- Cultura  
- Deporte
- Derechos Humanos
- Educación
- Economía y Finanzas
- Hábitat, Vivienda y Desarrollo Social
- Infraestructura y Servicios Públicos
- Monitoreo Institucional
- Movilidad y tránsito
- Ordenamiento Territorial
- Participación Ciudadana
- Riesgo Climático y Gestión de Emergencias
- Salud
- Seguridad

#### ✅ Datasets (32 datasets con archivos reales)
Todos los datasets tienen archivos geoespaciales (.geojson, .shp) y tabulares (.xlsx, .csv) cargados en Cloudflare R2.

#### ❌ Áreas Gubernamentales (18 áreas - Datos Mock)
**Información requerida:**
- **Verificación completa:** Confirmar si las 18 áreas cargadas existen realmente
- **Nombres correctos:** Nombres oficiales de cada área
- **Estructura actual:** Organigrama municipal vigente
- **Datos de contacto:** Emails y teléfonos actualizados
- **Direcciones:** Sedes físicas correctas
- **Orden jerárquico:** Prioridad real de cada área

#### ❌ Organismos (19 organismos - Datos Mock)
**Información requerida:**
- **Confirmación de existencia:** Verificar si todos los organismos listados son reales
- **Nombres oficiales:** Denominaciones correctas
- **Descripciones y funciones:** Textos oficiales de cada organismo
- **Contactos actualizados:** Emails y teléfonos verificables
- **Sedes:** Direcciones físicas confirmadas
- **Estructura interna:** Relaciones entre organismos

#### ❌ Autoridades/Funcionarios (Modelo Official vacío)
**Información requerida:**
- **Cantidad de autoridades:** Número total de funcionarios a cargar
- **Nombres y cargos:** Lista completa con nombres reales
- **Jerarquía:** Quién es el Intendente, secretarios, subsecretarios
- **Áreas de responsabilidad:** A qué área pertenece cada autoridad
- **Datos de contacto:** Emails y teléfonos oficiales
- **Fotos:** URLs de fotografías oficiales
- **Biografías:** Breve perfil profesional
- **CV:** URLs de currículums (si aplica)

#### ❌ Solicitudes de Información (Modelo InformationRequest vacío)
**Información requerida:**
- **Formularios de contacto:** Estructura actual de solicitudes
- **Procedimientos:** Cómo se procesan las solicitudes
- **Estados posibles:** Estados del flujo de trabajo
- **Responsables:** Quién gestiona las solicitudes
- **Tiempos de respuesta:** Plazos oficiales

---

## Listado Sencillo de Datos Solicitados por Email

### 1. Autoridades Municipales
- **Intendente:** Nombre completo, email, teléfono, foto, biografía
- **Secretarios:** Lista de todos los secretarios con:
  - Nombre y apellido
  - Secretaría que dirigen
  - Email y teléfono oficial
  - Foto (opcional)
  - Breve biografía
- **Subsecretarios:** Lista completa con misma información que secretarios
- **Otros cargos relevantes:** Directores, gerentes, etc.

### 2. Estructura Organizativa
- **Organigrama actual:** Confirmar si las 18 áreas cargadas son correctas
- **Nuevas áreas:** Si hay áreas que faltan en el sistema
- **Cambios recientes:** Si hubo modificaciones en la estructura

### 3. Información de Contacto
- **Teléfonos oficiales:** Verificar si los teléfonos cargados son actuales
- **Emails institucionales:** Confirmar direcciones de correo
- **Direcciones físicas:** Verificar sedes de cada área

### 4. Procedimientos de Solicitudes
- **Flujo actual:** Cómo se reciben y procesan las solicitudes de información
- **Plazos oficiales:** Tiempos de respuesta establecidos
- **Formularios:** Si existen formularios específicos
- **Responsables:** Quién atiende las solicitudes

### 5. Datos Adicionales
- **Períodos de actualización:** Con qué frecuencia se actualizan los datasets
- **Fuentes oficiales:** Confirmar fuentes de datos mencionadas
- **Licencias:** Verificar licencias de datos utilizadas

---

## Formato Sugerido para Email de Solicitud

**Asunto:** Información para Portal de Datos Abiertos - Municipalidad de Escobar

**Cuerpo del email:**

Estimados,

Para completar la carga de información en el Portal de Datos Abiertos del Municipio, solicitamos amablemente nos proporcionen los siguientes datos:

### 1. Estructura Organizativa Municipal
- **Organigrama actual:** Lista completa de áreas gubernamentales existentes
- **Nombres oficiales:** Denominaciones correctas de cada área
- **Organismos dependientes:** Lista de organismos que dependen de cada área
- **Cambios recientes:** Modificaciones en la estructura organizativa

### 2. Autoridades Municipales
- **Intendente:** Nombre completo, email, teléfono, foto, biografía
- **Secretarios:** Lista de todos los secretarios con:
  - Nombre y apellido
  - Secretaría que dirigen
  - Email y teléfono oficial
  - Foto (opcional)
  - Breve biografía
- **Subsecretarios:** Lista completa con misma información que secretarios
- **Otros cargos relevantes:** Directores, etc.

### 3. Información de Contacto Institucional
- **Teléfonos oficiales:** Verificar si los teléfonos cargados son actuales
- **Emails institucionales:** Confirmar direcciones de correo
- **Direcciones físicas:** Verificar sedes de cada área y organismo
- **Horarios de atención:** Días y horarios de cada área

### 4. Descripciones y Funciones
- **Funciones oficiales:** Descripciones actualizadas de cada área
- **Misiones y visiones:** Textos institucionales oficiales
- **Responsabilidades:** Competencias específicas de cada organismo

Los datos serán utilizados exclusivamente para el Portal de Datos Abiertos municipal.

Agradecemos su colaboración.

---

## Prioridad de Carga

1. **Alta prioridad:** Estructura organizativa y autoridades
2. **Media prioridad:** Verificación de contactos y descripciones
3. **Baja prioridad:** Procedimientos de solicitudes

---

## Notas Técnicas

- Los modelos `Official` y `InformationRequest` están creados pero vacíos
- Los seeders `GovernmentAreaSeeder` y `OrganismSeeder` tienen datos mock que necesitan verificación
- Los datos de áreas y organismos actuales son referenciales y deben ser validados
- El sistema está preparado para recibir esta información
- Solo los datasets y categorías tienen datos reales confirmados
