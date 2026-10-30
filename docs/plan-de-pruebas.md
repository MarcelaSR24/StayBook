# Plan de pruebas - StayBook

## 1. Objetivo

Definir las pruebas necesarias para verificar que la plataforma StayBook funcione correctamente y cumpla con los requisitos establecidos por el equipo.

## 2. Alcance

Se realizarán pruebas sobre las funcionalidades de gestión de alojamientos y reservas.

Se verificará:
- Registro de alojamientos.
- Consulta y listado de alojamientos.
- Edición de alojamientos.
- Eliminación de alojamientos.
- Registro de reservas.
- Validación de fechas de reserva.
- Persistencia de la información en la base de datos.

## 3. Tipos de pruebas

- **Pruebas funcionales:** verifican que cada funcionalidad opere correctamente.
- **Pruebas de validación:** comprueban que los datos ingresados sean correctos.
- **Pruebas de integración:** verifican la comunicación entre la aplicación y la base de datos.
- **Pruebas automatizadas:** permiten ejecutar casos de prueba mediante herramientas del proyecto.
- **Pruebas de regresión:** verifican que los cambios no dañen funcionalidades existentes.

## 4. Casos de prueba iniciales

| Código | Caso de prueba | Resultado esperado |
|---|---|---|
| CP-01 | Registrar un alojamiento con datos válidos | El alojamiento queda guardado |
| CP-02 | Registrar un alojamiento sin nombre | El sistema muestra un error de validación |
| CP-03 | Registrar un alojamiento con precio negativo | El sistema rechaza el valor |
| CP-04 | Consultar los alojamientos registrados | Se muestran los alojamientos guardados |
| CP-05 | Editar un alojamiento | Los cambios quedan guardados |
| CP-06 | Eliminar un alojamiento | Se elimina o desactiva según las reglas del sistema |
| CP-07 | Registrar una reserva para un alojamiento existente | La reserva queda guardada |
| CP-08 | Registrar una reserva con fecha de salida anterior o igual a la entrada | El sistema rechaza las fechas |
| CP-09 | Registrar una reserva para un alojamiento inexistente | El sistema rechaza la operación |

## 5. Herramientas

- Laravel.
- PHPUnit o Pest, según la configuración del proyecto.
- MySQL.
- Visual Studio Code.
- Git y GitHub.

## 6. Registro de resultados

Los resultados de cada caso de prueba se documentarán después de ejecutar las pruebas sobre la aplicación.

Por ahora, los casos están definidos y pendientes de ejecución.

## 7. Responsable

Stiven - Líder de pruebas.