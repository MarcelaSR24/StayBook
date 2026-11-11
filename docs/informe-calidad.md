# INFORME DE CALIDAD – STAYBOOK

## 1. Objetivo

Documentar la evaluación de calidad de StayBook mediante pruebas manuales, pruebas automatizadas e inspección del código, identificando los resultados obtenidos, los defectos encontrados y las actividades de mantenimiento pendientes.

## 2. Alcance

La revisión comprende:

- Registro e inicio de sesión de usuarios.
- Roles, permisos y control de acceso.
- Paneles y navegación según el rol.
- Registro, consulta, edición y privacidad de alojamientos.
- Creación, consulta, confirmación y cancelación de reservas.
- Validación de fechas, huéspedes, capacidad y disponibilidad.
- Privacidad de las reservas entre clientes.
- Inspección de controladores, políticas, rutas y middleware.
- Ejecución de pruebas automatizadas.
- Revisión de dependencias mediante Composer.

La auditoría manual documenta las pruebas PA-04 a PA-58. No se encontró evidencia de PA-01 a PA-03 en el material revisado.

## 3. Criterios de calidad

| Criterio | Aspecto evaluado |
|---|---|
| Funcionalidad | Cumplimiento de las operaciones principales del sistema. |
| Seguridad | Acceso según roles y protección de las operaciones. |
| Privacidad | Cada usuario consulta únicamente la información que le corresponde. |
| Integridad | Conservación de los datos y relaciones entre usuarios, alojamientos y reservas. |
| Validación | Cumplen las reglas del sistema. |
| Usabilidad | Claridad de formularios, mensajes y navegación. |
| Mantenibilidad | Organización del código, controladores y políticas. |
| Dependencias | Revisión de vulnerabilidades conocidas en los paquetes instalados. |

## 4. Resultados de las pruebas manuales

Se documentaron 55 pruebas manuales, clasificadas de la siguiente manera:

| Estado | Cantidad |
|---|---:|
| Aprobado | 40 |
| Aprobado con observaciones | 9 |
| No aprobado | 4 |
| Parcial | 1 |
| Pendiente | 1 |
| **Total** | **55** |

Las pruebas respaldan el funcionamiento de varios escenarios de registro, acceso por roles, gestión de alojamientos y reservas. También se identificaron situaciones que requieren revisión adicional.

### 4.1 Pruebas no aprobadas

- **PA-12:** el cliente no visualizó alojamientos que aparecían registrados en el panel administrativo.
- **PA-14:** el formulario de nueva reserva indicó que no había alojamientos disponibles, aunque el panel administrativo mostraba alojamientos disponibles.
- **PA-51:** el formulario permitió seleccionar una fecha de entrada anterior al día actual y presentó un cálculo visual incorrecto de noches y valor.
- **PA-52:** al seleccionar una fecha de salida anterior a la fecha de entrada, se mostró un total de cero noches y cero pesos, sin un mensaje claro de validación.

En PA-51 y PA-52 no se documentó el envío efectivo de la reserva con esos datos. La revisión estática encontró reglas de validación en el controlador, pero esto no sustituye la prueba de envío desde el formulario.

### 4.2 Prueba parcial y pendiente

- **PA-57 – Validación de campos obligatorios:** se comprobó la validación del campo Nombre, pero no se verificaron individualmente los demás campos obligatorios.
- **PA-19 – Mis alojamientos:** quedó pendiente en su ficha original. Otras pruebas posteriores muestran un alojamiento asociado al propietario, pero la ficha PA-19 no fue actualizada.

## 5. Resultados de las pruebas automatizadas

La suite completa se ejecutó con los siguientes resultados:

| Prueba | Resultado |
|---|---|
| ReservaIndexAuthorizationTest | 4 pruebas aprobadas, 10 aserciones y 0 fallos. |
| RoleAndReservationTest | 12 pruebas aprobadas, 39 aserciones y 0 fallos. |
| Suite completa | 18 pruebas aprobadas, 51 aserciones y 0 fallos. |

La suite completa fue reportada en dos ejecuciones, con duraciones de 11,49 y 17,42 segundos. Se conservan ambos registros porque corresponden a ejecuciones distintas.

Las pruebas automatizadas cubren escenarios de roles, permisos, consulta privada de reservas, cálculo del total, capacidad, fechas superpuestas, cancelación, confirmación e historial.

La revisión RT-06 identificó que la cobertura automatizada de autorización de alojamientos es parcial. La ausencia de una prueba específica no significa por sí sola que la funcionalidad falle.

## 6. Revisión técnica y de dependencias

Se inspeccionaron controladores, políticas, rutas, middleware y configuración de pruebas.

Entre los resultados documentados se encuentran:

- Las rutas registradas fueron revisadas mediante `php artisan route:list`.
- Se inspeccionaron `ReservaController`, `AlojamientoController`, `ReservaPolicy` y `AlojamientoPolicy`.
- Se verificó la configuración de PHPUnit con SQLite en memoria.
- La revisión de dependencias mediante `composer audit` no reportó avisos de vulnerabilidades.
- Se identificó cobertura automatizada parcial para algunos permisos de alojamientos.

Estos resultados corresponden a inspecciones y verificaciones técnicas; no deben interpretarse como garantía de ausencia total de defectos.

## 7. Registro de defectos y hallazgos

Los siguientes hallazgos fueron registrados en la auditoría. Según el material recibido, no existe evidencia de que hayan sido corregidos.

| ID | Evidencia relacionada | Descripción | Estado |
|---|---|---|---|
| H-1 | PA-51 | El resumen de fechas muestra un cálculo visual incorrecto y no presenta una advertencia clara. | Pendiente de corrección y verificación. |
| H-2 | PA-52 | No se muestra un mensaje claro cuando la fecha de salida es anterior a la entrada. | Pendiente de corrección y verificación. |
| H-3 | PA-12 y PA-14 | Existe una inconsistencia entre los alojamientos visibles para el administrador y los disponibles para el cliente. | Pendiente de investigar. |
| H-4 | PA-09 y PA-10 | Se observan usuarios sin rol asignado y alojamientos sin propietario asignado. | Pendiente de aclarar si son datos de prueba o errores. |
| H-5 | PA-48 | La ruta `/admin/reservas` devuelve 404; esto no demuestra por sí solo una autorización correcta. | Pendiente de documentar la ruta real. |
| H-6 | PA-57 | Solo se verificó uno de los campos obligatorios del formulario de alojamiento. | Verificación parcial. |
| H-7 | PA-53, PA-54 y PA-55 | Faltan comprobaciones completas de validación del servidor, disponibilidad y bloqueo de reservas duplicadas. | Pendiente de ampliar pruebas. |
| H-8 | PA-19, PA-24 y PA-56 | Hay comprobaciones incompletas de alojamientos asociados, reservas recibidas y acceso a alojamientos de otros propietarios. | Pendiente de verificación. |
| H-9 | RT-06 | La cobertura automatizada de autorización de alojamientos es parcial. | Pendiente de ampliar pruebas. |
| H-10 | RT-06 | Se observó un posible problema de codificación en el dato de ciudad «BogotÃ¡». | Pendiente de confirmar la causa. |

## 8. Actividades de mantenimiento pendientes

De acuerdo con los hallazgos, se proponen las siguientes actividades:

1. Revisar el cálculo de noches y el resumen de precios del formulario de reservas.
2. Verificar los mensajes de validación para fechas inválidas.
3. Investigar por qué algunos alojamientos disponibles no aparecen para el cliente.
4. Revisar los usuarios y alojamientos que aparecen sin asignación.
5. Confirmar las rutas reales para la consulta de reservas.
6. Ampliar las pruebas de campos obligatorios.
7. Verificar las restricciones de capacidad y las reservas duplicadas desde el servidor.
8. Ampliar las pruebas de autorización entre propietarios.
9. Agregar pruebas automatizadas para los permisos de alojamientos que aún no están cubiertos.
10. Confirmar si el texto «BogotÃ¡» corresponde a un problema de codificación.

## 9. Registro de cambios y correcciones

Según el informe de auditoría recibido:

- **Verificado:** escenarios manuales y automatizados descritos en este documento.
- **Inspeccionado:** controladores, políticas, rutas, middleware y configuración de pruebas.
- **Corregido:** no se recibió evidencia de correcciones de código.
- **Actualizado en el entorno:** se reportó la actualización de tres paquetes Symfony de la versión 7.4.22 a la 7.4.23 mediante Composer.
- **Agregado a los datos de prueba:** un usuario, un alojamiento, una modificación de descripción y reservas utilizadas durante la auditoría.
- **No modificado, según el informe:** controladores, políticas, archivos de pruebas, `composer.json` y `phpunit.xml`.

La actualización de dependencias y los cambios en los datos de prueba no se presentan como correcciones de los defectos H-1 a H-10.

## 10. Responsables

| Integrante | Responsabilidad |
|---|---|
| Marcela Saldarriaga | Liderazgo técnico y supervisión de calidad. |
| Stiven Arcila | Diseño y ejecución de pruebas, y registro de resultados. |
| Camila Triana | Organización de la documentación y evidencias. |

## 11. Conclusión

La auditoría de StayBook evidencia resultados favorables en varios escenarios de autenticación, roles, privacidad de reservas, gestión de alojamientos y operaciones de reserva. La suite automatizada reportó 18 pruebas aprobadas, 51 aserciones y 0 fallos.

Sin embargo, las pruebas manuales también identificaron cuatro escenarios no aprobados, uno parcial y uno pendiente. Además, se registraron hallazgos que requieren investigación, corrección o verificación adicional.

Con la información recibida no es posible afirmar que los defectos registrados hayan sido corregidos. Por tanto, el equipo debe completar las actividades de mantenimiento, documentar los cambios reales y ejecutar nuevamente las pruebas correspondientes para confirmar los resultados.