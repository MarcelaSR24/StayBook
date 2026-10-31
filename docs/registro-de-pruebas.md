# Registro de ejecución de pruebas - StayBook

**Responsable:** Stiven - Líder de pruebas.

**Estado general:** Ejecución parcial.

## 1. Objetivo

Registrar los resultados obtenidos durante la ejecución de los casos de prueba de StayBook, permitiendo llevar un seguimiento de las funcionalidades verificadas, los resultados obtenidos y las pruebas que todavía se encuentran pendientes.

## 2. Matriz de ejecución

| Código | Fecha | Resultado esperado | Resultado obtenido | Estado |
|---|---|---|---|---|
| CP-01 | 31/10/2026 | Alojamiento registrado correctamente. | El alojamiento fue registrado y apareció en el listado. | Aprobado |
| CP-02 | Pendiente | Validación de nombre obligatorio. | Pendiente de confirmar mediante ejecución funcional. | Pendiente |
| CP-03 | Pendiente | Rechazar precio negativo. | Pendiente de confirmar mediante ejecución funcional. | Pendiente |
| CP-04 | 31/10/2026 | Mostrar alojamientos registrados. | Se consultó el listado y se visualizaron los detalles de un alojamiento. | Aprobado |
| CP-05 | 31/10/2026 | Guardar modificaciones del alojamiento. | Se actualizaron correctamente la ciudad a Palmira y el precio a $180.000. | Aprobado |
| CP-06 | 31/10/2026 | Eliminar alojamiento. | El alojamiento dejó de aparecer en el listado después de eliminarlo. | Aprobado |
| CP-07 | 31/10/2026 | Registrar una reserva válida. | La reserva se registró correctamente y quedó en estado pendiente. | Aprobado |
| CP-08 | 31/10/2026 | Rechazar fechas iguales o inválidas. | El sistema rechazó la fecha de salida igual a la fecha de entrada y mostró un mensaje de validación. | Aprobado |
| CP-09 | Pendiente | Rechazar alojamiento inexistente. | Se comprobó la validación en el código, pero falta realizar la prueba funcional. | Pendiente |

## 3. Resumen de resultados

- **Total de casos diseñados:** 9.
- **Casos ejecutados funcionalmente:** 7.
- **Casos aprobados:** 7.
- **Casos fallidos:** 0.
- **Casos pendientes:** 2.

**Nota:** CP-09 cuenta con una revisión del código fuente, pero no se incluye como prueba funcional ejecutada. Los casos CP-02 y CP-03 están pendientes de confirmar.

## 4. Evidencias de ejecución

Las evidencias correspondientes a las pruebas realizadas se organizan de la siguiente manera:

| Evidencia | Descripción |
|---|---|
| Evidencia 18 | Registro exitoso de alojamiento. |
| Evidencia 19 | Persistencia del alojamiento después de actualizar la página. |
| Evidencia 20 | Prueba de registro de alojamiento sin nombre. |
| Evidencia 21 | Prueba de registro con precio negativo. |
| Evidencia 22 | Modificación de alojamiento. |
| Evidencia 23 | Eliminación de alojamiento. |
| Evidencia 24 | Consulta de alojamientos. |
| Evidencia 25 | Registro de reserva válida. |
| Evidencia 26 | Visualización de detalles del alojamiento. |
| Evidencia 27 | Validación de fechas de reserva. |
| Evidencia 28 | Revisión de la validación de alojamiento en el controlador de reservas. |

## 5. Observaciones

Las pruebas realizadas permitieron comprobar el funcionamiento de las principales operaciones de gestión de alojamientos y reservas.

Se verificó el registro, consulta, modificación y eliminación de alojamientos, además del registro de una reserva y la validación de fechas incorrectas.

Los casos CP-02 y CP-03 requieren confirmar sus resultados mediante ejecución funcional. El caso CP-09 requiere una prueba funcional adicional para comprobar el rechazo de un alojamiento inexistente.

El registro se actualizará a medida que se completen las pruebas pendientes y se obtengan nuevas evidencias.

## 6. Conclusión

La ejecución de pruebas de StayBook presenta resultados satisfactorios en los casos funcionales realizados hasta el momento.

Se cuenta con evidencias de las operaciones principales del sistema y se identificaron pruebas adicionales que deben completarse para ampliar la verificación de las validaciones de la aplicación.

Este documento permite mantener un seguimiento organizado de las pruebas ejecutadas y de los resultados obtenidos durante el proceso de aseguramiento de calidad.