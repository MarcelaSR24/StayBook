Registro de verificaciones técnicas – StayBook

Responsable: Calidad y verificación técnica
Proyecto: StayBook
Rama de trabajo: auditoria-seguimiento-2
Fecha: Noviembre de 2026

1. Verificaciones realizadas desde la terminal de VS Code

Entorno y dependencias

- "php artisan --version": verificación de la versión de Laravel.
- "composer show "symfony/*"": inspección de los componentes Symfony instalados.
- "composer audit": revisión de avisos de vulnerabilidades conocidas en dependencias.
- "php artisan route:list": consulta de las rutas registradas.
- "php artisan route:list -v": revisión de rutas y middleware.

Pruebas automatizadas

- "php artisan test --filter=ReservaIndexAuthorizationTest": revisión de autorización y privacidad de reservas.
- "php artisan test --filter=RoleAndReservationTest": revisión de roles, permisos y operaciones de reservas.
- "php artisan test": ejecución de la suite completa.

Resultados registrados:

- ReservaIndexAuthorizationTest: 4 pruebas aprobadas, 10 aserciones.
- RoleAndReservationTest: 12 pruebas aprobadas, 39 aserciones.
- Suite completa: 18 pruebas aprobadas, 51 aserciones.
- Composer Audit: no se encontraron avisos de vulnerabilidades de seguridad.

2. Revisión técnica del código

Se inspeccionaron los siguientes archivos:

- "app/Http/Controllers/ReservaController.php"
- "app/Policies/ReservaPolicy.php"
- "app/Http/Controllers/AlojamientoController.php"
- "app/Policies/AlojamientoPolicy.php"
- "resources/views/reservas/create.blade.php"

También se verificó que Laravel reconoce las políticas de autorización de reservas y alojamientos.

3. Pruebas manuales realizadas

Se realizaron verificaciones identificadas desde PA-04 hasta PA-58.

Se revisaron:

- Registro, inicio y cierre de sesión.
- Acceso de administrador, propietario y cliente.
- Consulta y administración de alojamientos.
- Registro y edición de alojamientos.
- Creación, consulta, confirmación y cancelación de reservas.
- Privacidad de reservas entre clientes.
- Restricciones de acceso por roles.
- Validación de capacidad y disponibilidad.
- Navegación de los paneles.

4. Hallazgos importantes

- PA-51: la interfaz permitió calcular incorrectamente las noches y el precio al introducir una fecha de entrada pasada.
- PA-52: la interfaz mostró cero noches y cero precio cuando la fecha de salida era anterior a la entrada.
- PA-53: se comprobó la restricción visual de capacidad, pero no toda posible manipulación del formulario.
- PA-55: se observó el mensaje de reserva ocupada, sin realizar un nuevo envío duplicado.
- PA-57: se comprobó la validación del campo nombre, pero no todos los campos obligatorios.

El controlador de reservas contiene validaciones del lado del servidor para fechas, capacidad, disponibilidad y cálculo del precio.

5. Estado de los cambios

Durante esta revisión se realizaron inspecciones de código, pruebas automatizadas y pruebas manuales.

No se modificó el código fuente ni se agregaron funcionalidades durante esta auditoría.

Los hallazgos se registran para que puedan ser revisados y documentados por el equipo.

6. Alcance de esta entrega

Este registro corresponde al trabajo de verificación técnica y calidad realizado desde VS Code.

No sustituye el README, el informe general de calidad ni la documentación del proyecto que está organizando Camila.