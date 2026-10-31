# Casos de prueba - StayBook

**Responsable:** Stiven - Líder de pruebas  
**Estado:** Diseño inicial - Ejecución parcial.

## 1. Módulo de alojamientos

| Código | Prueba | Datos de entrada | Resultado esperado |
|---|---|---|---|
| CP-01 | Registrar alojamiento válido | Nombre, descripción, ubicación, precio y capacidad válidos | Registrar el alojamiento correctamente |
| CP-02 | Registrar sin nombre | Nombre vacío | Mostrar mensaje de validación y rechazar el registro |
| CP-03 | Registrar precio negativo | Precio: -100 | Rechazar el registro y mostrar validación |
| CP-04 | Consultar alojamientos | Solicitar listado de alojamientos | Mostrar los alojamientos registrados |
| CP-05 | Editar alojamiento | Modificar ciudad y precio | Guardar correctamente los cambios |
| CP-06 | Eliminar alojamiento | Seleccionar un alojamiento existente | Eliminar el alojamiento del listado |

## 2. Módulo de reservas

| Código | Prueba | Datos de entrada | Resultado esperado |
|---|---|---|---|
| CP-07 | Registrar reserva válida | Alojamiento existente, fechas válidas y cantidad de huéspedes permitida | Registrar la reserva y calcular el precio total |
| CP-08 | Fecha de salida igual a entrada | Entrada: 10/11, salida: 10/11 | Rechazar la reserva y mostrar validación |
| CP-09 | Alojamiento inexistente | Identificador de alojamiento que no existe | Rechazar la reserva |
| CP-10 | Fecha de salida anterior a entrada | Entrada: 10/11, salida: 09/11 | Rechazar la reserva y mostrar validación |

## 3. Registro de ejecución

Los siguientes resultados corresponden a las pruebas realizadas en la aplicación StayBook hasta el momento.

| Código | Resultado real | Estado | Observaciones |
|---|---|---|---|
| CP-01 | El alojamiento se registró correctamente y permaneció en el listado después de actualizar la página | Aprobado | Evidencias 18 y 19. |
| CP-02 | Pendiente de ejecución | Pendiente | Falta comprobar el registro sin nombre. |
| CP-03 | Pendiente de ejecución | Pendiente | Falta comprobar el rechazo de un precio negativo. |
| CP-04 | Se consultó el listado y el detalle del alojamiento correctamente | Aprobado | Evidencias 24 y 26. |
| CP-05 | Se actualizaron correctamente la ciudad y el precio del alojamiento | Aprobado | Evidencia 22. |
| CP-06 | El alojamiento desapareció del listado después de eliminarlo | Aprobado | Evidencia 23. |
| CP-07 | La reserva se registró correctamente y quedó en estado pendiente | Aprobado | Evidencia 25. Se recomienda una comprobación adicional del cálculo del precio. |
| CP-08 | La aplicación rechazó la reserva porque la fecha de salida no era posterior a la entrada | Aprobado | Evidencia 27. |
| CP-09 | Se comprobó en el código la validación de existencia del alojamiento, pero falta la prueba funcional | Pendiente | Evidencia 28. |
| CP-10 | Pendiente de ejecución | Pendiente | Falta comprobar funcionalmente el rechazo de una fecha de salida anterior a la entrada. |

### 3.1 Resumen de ejecución

- Total de casos diseñados: 10.
- Casos aprobados funcionalmente: 6.
- Casos pendientes: 4.
- Casos fallidos: 0.

**Nota:** La revisión del código correspondiente a CP-09 no se contabiliza como prueba funcional aprobada. Los casos pendientes deberán ejecutarse para completar la validación.

## 4. Observaciones

Los casos de prueba se definieron teniendo en cuenta las funcionalidades implementadas en StayBook y sus respectivas validaciones.

La ejecución se realiza progresivamente. Los resultados se actualizan de acuerdo con las pruebas realizadas y las evidencias obtenidas.

Las pruebas pendientes deberán ejecutarse para verificar el comportamiento de la aplicación ante datos incorrectos y condiciones no válidas.