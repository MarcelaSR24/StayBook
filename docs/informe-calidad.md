# INFORME DE CALIDAD – STAYBOOK

## 1. Objetivo

Documentar la evaluación de calidad del proyecto StayBook mediante pruebas manuales, pruebas automatizadas e inspecciones técnicas del código, con el propósito de verificar el funcionamiento de sus principales funcionalidades, identificar defectos y registrar recomendaciones de mantenimiento.

## 2. Alcance

La evaluación de calidad comprende los siguientes aspectos:

- Registro, inicio y cierre de sesión de usuarios.
- Roles, permisos y control de acceso.
- Paneles y navegación según el tipo de usuario.
- Registro, consulta y administración de alojamientos.
- Creación, consulta, confirmación y cancelación de reservas.
- Privacidad de las reservas entre clientes.
- Validación de fechas, huéspedes, capacidad y disponibilidad.
- Inspección de controladores, políticas, rutas y middleware.
- Ejecución de pruebas automatizadas.
- Revisión de dependencias y posibles vulnerabilidades conocidas.

Las verificaciones manuales recibidas están identificadas desde PA-04 hasta PA-58.

## 3. Criterios de calidad

| Criterio | Aspecto evaluado |
|---|---|
| Funcionalidad | Cumplimiento de las operaciones principales del sistema. |
| Seguridad | Control de acceso según los roles y protección de las operaciones. |
| Privacidad | Restricción de consulta de información según el usuario autenticado. |
| Integridad | Conservación de los datos y relaciones entre usuarios, alojamientos y reservas. |
| Validación | Aplicación de las reglas establecidas para los datos ingresados. |
| Usabilidad | Claridad de formularios, mensajes y navegación. |
| Mantenibilidad | Organización del código, controladores y políticas. |
| Dependencias | Revisión de vulnerabilidades conocidas en los paquetes instalados. |

## 4. Actividades de evaluación de calidad

Para evaluar la calidad de StayBook se realizaron las siguientes actividades:

1. Inspección de los controladores relacionados con alojamientos y reservas.
2. Revisión de las políticas de autorización.
3. Consulta de las rutas registradas y sus respectivos middleware.
4. Ejecución de pruebas automatizadas de roles, permisos y reservas.
5. Realización de verificaciones manuales de las funcionalidades principales.
6. Revisión de dependencias mediante Composer.
7. Registro de los hallazgos y aspectos que requieren seguimiento.

## 5. Resultados de las pruebas automatizadas

Se ejecutaron pruebas automatizadas utilizando las herramientas integradas de Laravel.

Los resultados registrados fueron los siguientes:

| Prueba | Pruebas aprobadas | Aserciones |
|---|---:|---:|
| ReservaIndexAuthorizationTest | 4 | 10 |
| RoleAndReservationTest | 12 | 39 |
| Suite completa | 18 | 51 |

La ejecución de la suite completa mediante `php artisan test` reportó 18 pruebas aprobadas, 51 aserciones y cero fallos.

Estas pruebas permitieron verificar escenarios relacionados con roles, permisos, privacidad de reservas y operaciones del sistema.

## 6. Resultados de las verificaciones manuales

Se realizaron pruebas manuales identificadas desde PA-04 hasta PA-58, revisando aspectos como:

- Registro, inicio y cierre de sesión.
- Acceso de administrador, propietario y cliente.
- Consulta y administración de alojamientos.
- Registro y edición de alojamientos.
- Creación, consulta, confirmación y cancelación de reservas.
- Privacidad de reservas entre clientes.
- Restricciones de acceso según los roles.
- Validación de capacidad y disponibilidad.
- Navegación de los paneles.

Durante estas verificaciones se identificaron los siguientes hallazgos:

| Identificador | Descripción del hallazgo |
|---|---|
| PA-51 | La interfaz permitió calcular incorrectamente las noches y el precio al introducir una fecha de entrada pasada. |
| PA-52 | La interfaz mostró cero noches y cero precio cuando la fecha de salida era anterior a la fecha de entrada. |
| PA-53 | Se comprobó la restricción visual de capacidad, pero no toda posible manipulación del formulario. |
| PA-55 | Se observó el mensaje de reserva ocupada, sin realizar un nuevo envío para comprobar posibles duplicados. |
| PA-57 | Se comprobó la validación del campo nombre, pero no todos los campos obligatorios. |

Los hallazgos anteriores permiten identificar aspectos que requieren verificaciones adicionales. No se cuenta con evidencia suficiente para afirmar que todos hayan sido corregidos.

## 7. Revisión técnica y de seguridad

Durante la auditoría técnica se inspeccionaron los siguientes archivos:

- `app/Http/Controllers/ReservaController.php`
- `app/Policies/ReservaPolicy.php`
- `app/Http/Controllers/AlojamientoController.php`
- `app/Policies/AlojamientoPolicy.php`
- `resources/views/reservas/create.blade.php`

También se verificó que Laravel reconoce las políticas de autorización de reservas y alojamientos.

Entre las verificaciones realizadas se encuentran:

| Comando | Propósito |
|---|---|
| `php artisan --version` | Consultar la versión de Laravel. |
| `composer show "symfony/*"` | Inspeccionar los componentes Symfony instalados. |
| `composer audit` | Revisar avisos de vulnerabilidades conocidas en dependencias. |
| `php artisan route:list` | Consultar las rutas registradas. |
| `php artisan route:list -v` | Revisar las rutas y sus middleware. |

**Resultado de la revisión de dependencias:** el comando `composer audit` no reportó avisos de vulnerabilidades de seguridad en las dependencias revisadas.

El controlador de reservas contiene validaciones del lado del servidor relacionadas con fechas, capacidad, disponibilidad y cálculo del precio, según la inspección técnica reportada.

Estas verificaciones representan resultados de una revisión técnica y no constituyen una garantía de ausencia total de vulnerabilidades o defectos.

## 8. Hallazgos y recomendaciones de mantenimiento

A partir de los resultados obtenidos se establecen las siguientes recomendaciones:

| Hallazgo | Recomendación |
|---|---|
| PA-51 | Revisar el comportamiento del formulario cuando se introduce una fecha de entrada anterior al día actual. |
| PA-52 | Verificar la validación de fechas y presentar mensajes claros cuando la salida sea anterior a la entrada. |
| PA-53 | Completar las pruebas de capacidad mediante diferentes valores y posibles manipulaciones del formulario. |
| PA-55 | Realizar un nuevo intento de envío de una reserva ocupada para comprobar el bloqueo efectivo de operaciones duplicadas. |
| PA-57 | Comprobar todos los campos obligatorios y sus respectivos mensajes de validación. |

Las recomendaciones deben convertirse en actividades de mantenimiento y seguimiento. Su ejecución debe documentarse mediante evidencias y nuevas pruebas.

## 9. Estado de los cambios realizados

De acuerdo con el registro técnico recibido, durante la auditoría se realizaron inspecciones de código, pruebas automatizadas y verificaciones manuales.

Se deja constancia de los siguientes aspectos:

- Se inspeccionaron controladores y políticas de autorización.
- Se revisaron las rutas y los middleware registrados en Laravel.
- Se ejecutaron las pruebas automatizadas y la suite completa.
- Se realizaron verificaciones manuales de las funcionalidades principales.
- Se ejecutó la revisión de dependencias mediante Composer.
- No se modificó el código fuente ni se agregaron funcionalidades durante esta auditoría.
- Los hallazgos identificados quedaron registrados para su revisión y seguimiento.

Por lo tanto, los defectos y observaciones documentados no se consideran corregidos hasta contar con evidencia de los cambios y de las pruebas posteriores.

## 10. Responsables

| Integrante | Responsabilidad |
|---|---|
| Marcela Saldarriaga | Liderazgo técnico, revisión del código y supervisión de la calidad. |
| Stiven Arcila | Diseño y ejecución de pruebas, verificaciones técnicas y registro de resultados. |
| Camila Triana | Organización de la documentación y recopilación de evidencias del proyecto. |

## 11. Conclusión

La evaluación de calidad de StayBook permitió verificar diferentes funcionalidades relacionadas con la autenticación, los roles de usuario, la gestión de alojamientos y las reservas.

Los resultados de las pruebas automatizadas fueron favorables, con 18 pruebas aprobadas, 51 aserciones y cero fallos en la suite completa. Asimismo, la revisión de dependencias mediante Composer no reportó avisos de vulnerabilidades de seguridad.

Sin embargo, las verificaciones manuales identificaron situaciones que requieren atención, especialmente en el cálculo de fechas y precios, la validación de capacidad, el control de reservas ocupadas y la comprobación de los campos obligatorios.

En conclusión, StayBook cuenta con resultados técnicos y funcionales favorables, pero también presenta aspectos que deben continuar en seguimiento. La corrección de los hallazgos deberá comprobarse mediante nuevas pruebas y evidencias antes de considerarlos cerrados.

---

**Proyecto:** StayBook – Plataforma de gestión y reservas de alojamientos.

**Asignatura:** Ingeniería de Software II.

**Etapa:** Entrega final – 2026.