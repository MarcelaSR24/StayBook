# Casos de prueba - StayBook

**Responsable:** Stiven - Líder de pruebas  
**Estado:** Diseño inicial - Pendiente de ejecución.

## 1. Módulo de alojamientos

| Código | Prueba | Datos de entrada | Resultado esperado |
|---|---|---|---|
| CP-01 | Registrar alojamiento válido | Nombre, descripción, ubicación y precio válido | Registro exitoso |
| CP-02 | Registrar sin nombre | Nombre vacío | Mostrar validación |
| CP-03 | Registrar precio negativo | Precio: -100 | Rechazar el registro |
| CP-04 | Consultar alojamientos | Solicitar listado | Mostrar alojamientos registrados |
| CP-05 | Editar alojamiento | Modificar nombre y precio | Guardar cambios |
| CP-06 | Eliminar alojamiento | Seleccionar alojamiento existente | Eliminar o desactivar según las reglas |

## 2. Módulo de reservas

| Código | Prueba | Datos de entrada | Resultado esperado |
|---|---|---|---|
| CP-07 | Registrar reserva válida | Alojamiento existente y fechas válidas | Reserva registrada |
| CP-08 | Fecha de salida anterior a entrada | Entrada: 10/11, salida: 09/11 | Rechazar reserva |
| CP-09 | Fechas iguales | Entrada: 10/11, salida: 10/11 | Rechazar reserva |
| CP-10 | Alojamiento inexistente | ID que no existe | Rechazar reserva |

## 3. Registro de ejecución

Los resultados se completarán cuando la aplicación esté disponible.

| Código | Resultado real | Estado | Observaciones |
|---|---|---|---|
| CP-01 | Pendiente | No ejecutado | |
| CP-02 | Pendiente | No ejecutado | |
| CP-03 | Pendiente | No ejecutado | |
| CP-04 | Pendiente | No ejecutado | |
| CP-05 | Pendiente | No ejecutado | |
| CP-06 | Pendiente | No ejecutado | |
| CP-07 | Pendiente | No ejecutado | |
| CP-08 | Pendiente | No ejecutado | |
| CP-09 | Pendiente | No ejecutado | |
| CP-10 | Pendiente | No ejecutado | |

## 4. Observaciones

Los casos son preliminares. Se ajustarán según los campos, validaciones y reglas que implemente el equipo en StayBook.