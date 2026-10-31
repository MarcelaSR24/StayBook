# Plan de pruebas - StayBook

## 1. Objetivo

Definir y documentar las pruebas necesarias para verificar que la plataforma StayBook funcione correctamente y cumpla con los requisitos establecidos por el equipo de desarrollo.

El plan busca comprobar el funcionamiento de los módulos de gestión de alojamientos y reservas, validar los datos ingresados y verificar que la información se almacene correctamente en la base de datos.

## 2. Alcance

Las pruebas se realizarán sobre las funcionalidades principales de la plataforma StayBook.

Se verificará:

- Registro de alojamientos.
- Consulta y listado de alojamientos.
- Visualización de los detalles de un alojamiento.
- Edición de alojamientos.
- Eliminación de alojamientos.
- Registro de reservas.
- Validación de fechas de reserva.
- Validación de alojamientos existentes.
- Persistencia de la información en la base de datos.
- Validación de los datos ingresados en los formularios.

## 3. Tipos de pruebas

- **Pruebas funcionales:** verifican que cada funcionalidad de la aplicación opere correctamente según lo esperado.
- **Pruebas de validación:** comprueban que los datos ingresados cumplan las reglas establecidas por el sistema.
- **Pruebas de integración:** verifican la comunicación entre la aplicación Laravel y la base de datos MySQL.
- **Pruebas automatizadas:** permiten ejecutar casos de prueba mediante herramientas como PHPUnit o Pest, según la configuración del proyecto.
- **Pruebas de regresión:** permiten comprobar que los cambios realizados no afecten funcionalidades que anteriormente funcionaban correctamente.

## 4. Herramientas utilizadas

Para el desarrollo y ejecución de las pruebas se utilizan las siguientes herramientas:

- **Laravel:** framework utilizado para el desarrollo de la aplicación.
- **PHP:** lenguaje de programación del proyecto.
- **MySQL:** sistema de gestión de base de datos.
- **Visual Studio Code:** editor utilizado para revisar el código y documentar las pruebas.
- **Laragon:** entorno local utilizado para ejecutar la aplicación.
- **Git y GitHub:** herramientas utilizadas para el control de versiones y almacenamiento del proyecto.
- **Navegador web:** utilizado para interactuar con la aplicación y comprobar sus funcionalidades.
- **PHPUnit o Pest:** herramientas disponibles para pruebas automatizadas, según la configuración del proyecto.

## 5. Criterios de aceptación y rechazo

Un caso de prueba se considera **aprobado** cuando el resultado obtenido coincide con el resultado esperado.

Un caso de prueba se considera **rechazado** cuando el sistema no cumple con el resultado esperado o presenta un comportamiento incorrecto.

Un caso de prueba se considera **pendiente** cuando todavía no se ha ejecutado o no se cuenta con evidencia suficiente para confirmar su resultado.

Las pruebas deben contar con una descripción, el resultado esperado, el resultado obtenido y su respectiva evidencia cuando corresponda.

## 6. Casos de prueba

### CP-01. Registro exitoso de alojamiento

- **Objetivo:** verificar que el sistema permita registrar un alojamiento con información válida.
- **Precondición:** ingresar a la plataforma y acceder al formulario de registro de alojamientos.
- **Datos de prueba:** nombre, tipo, dirección, ciudad, precio, capacidad y estado del alojamiento.
- **Pasos:**
  1. Abrir el formulario de registro.
  2. Ingresar los datos solicitados.
  3. Presionar el botón para guardar.
  4. Consultar el listado de alojamientos.
- **Resultado esperado:** el sistema registra el alojamiento y muestra un mensaje de confirmación.
- **Resultado obtenido:** el alojamiento fue registrado correctamente y apareció en el listado.
- **Estado:** Aprobado.
- **Evidencia:** evidencia 18.

### CP-02. Registro de alojamiento sin nombre

- **Objetivo:** comprobar que el sistema valide el campo nombre como obligatorio.
- **Precondición:** acceder al formulario de registro de alojamientos.
- **Datos de prueba:** formulario con los demás datos diligenciados y el campo nombre vacío.
- **Pasos:**
  1. Abrir el formulario.
  2. Completar los campos restantes.
  3. Dejar vacío el campo nombre.
  4. Intentar guardar el alojamiento.
- **Resultado esperado:** el sistema debe impedir el registro y mostrar un mensaje de validación.
- **Resultado obtenido:** pendiente de confirmar mediante ejecución funcional.
- **Estado:** Pendiente.
- **Evidencia:** evidencia 20.

### CP-03. Registro de alojamiento con precio negativo

- **Objetivo:** verificar que el sistema no permita registrar alojamientos con precios negativos.
- **Precondición:** acceder al formulario de registro de alojamientos.
- **Datos de prueba:** precio de alojamiento igual a -50000.
- **Pasos:**
  1. Abrir el formulario de registro.
  2. Ingresar los datos del alojamiento.
  3. Introducir un precio negativo.
  4. Intentar guardar el registro.
- **Resultado esperado:** el sistema debe rechazar el precio negativo y mostrar un mensaje de validación.
- **Resultado obtenido:** pendiente de confirmar mediante ejecución funcional.
- **Estado:** Pendiente.
- **Evidencia:** evidencia 21.

### CP-04. Consulta de alojamientos registrados

- **Objetivo:** comprobar que los alojamientos registrados se puedan consultar correctamente.
- **Precondición:** tener alojamientos almacenados en la base de datos.
- **Datos de prueba:** alojamientos previamente registrados.
- **Pasos:**
  1. Ingresar a la sección de alojamientos.
  2. Consultar el listado.
  3. Seleccionar un alojamiento para visualizar sus detalles.
- **Resultado esperado:** el sistema debe mostrar los alojamientos registrados y permitir consultar la información de cada uno.
- **Resultado obtenido:** se visualizó el listado y se consultaron los detalles del alojamiento seleccionado.
- **Estado:** Aprobado.
- **Evidencia:** evidencia 24 y evidencia 26.

### CP-05. Modificación de alojamiento

- **Objetivo:** verificar que el sistema permita actualizar la información de un alojamiento.
- **Precondición:** tener un alojamiento registrado.
- **Datos de prueba:** cambio de ciudad de Cali a Palmira y modificación del precio de $150.000 a $180.000.
- **Pasos:**
  1. Ingresar al listado de alojamientos.
  2. Seleccionar un alojamiento.
  3. Presionar la opción de editar.
  4. Modificar la ciudad y el precio.
  5. Guardar los cambios.
  6. Consultar nuevamente el alojamiento.
- **Resultado esperado:** el sistema debe guardar y mostrar la información actualizada.
- **Resultado obtenido:** el sistema guardó correctamente los cambios. El alojamiento Hotel Prueba StayBook quedó con ciudad Palmira y precio de $180.000.
- **Estado:** Aprobado.
- **Evidencia:** evidencia 22.

### CP-06. Eliminación de alojamiento

- **Objetivo:** comprobar que el sistema permita eliminar un alojamiento registrado.
- **Precondición:** tener un alojamiento existente en el listado.
- **Datos de prueba:** alojamiento seleccionado para eliminación.
- **Pasos:**
  1. Ingresar al listado de alojamientos.
  2. Seleccionar el alojamiento.
  3. Ejecutar la opción de eliminar.
  4. Consultar nuevamente el listado.
- **Resultado esperado:** el alojamiento debe dejar de aparecer en el listado después de eliminarlo.
- **Resultado obtenido:** el sistema realizó la eliminación y, al consultar nuevamente el listado, el alojamiento ya no apareció.
- **Estado:** Aprobado.
- **Evidencia:** evidencia 23.

### CP-07. Registro de reserva con datos válidos

- **Objetivo:** verificar que el sistema permita registrar una reserva para un alojamiento existente y disponible.
- **Precondición:** iniciar sesión y contar con un alojamiento disponible.
- **Datos de prueba:** Hotel Prueba StayBook, 2 huéspedes, fecha de entrada 10/11/2026 y fecha de salida 11/12/2026.
- **Pasos:**
  1. Iniciar sesión en la plataforma.
  2. Ingresar al formulario de creación de reservas.
  3. Seleccionar un alojamiento disponible.
  4. Ingresar la cantidad de huéspedes.
  5. Seleccionar las fechas de entrada y salida.
  6. Verificar el precio estimado.
  7. Confirmar el registro de la reserva.
- **Resultado esperado:** el sistema debe registrar la reserva y mostrar un mensaje de confirmación con el valor correspondiente.
- **Resultado obtenido:** la reserva se registró correctamente y el sistema mostró el mensaje “¡Tu reserva se ha registrado correctamente!”. Se observó un total de $5.580.000 y estado pendiente. El precio estimado se actualizó al completar la fecha de salida.
- **Estado:** Aprobado para el registro de la reserva.
- **Observación:** se recomienda realizar una prueba adicional controlada para verificar el cálculo del total con la cantidad de noches esperada.
- **Evidencia:** evidencia 25.

### CP-08. Validación de fechas de reserva

- **Objetivo:** comprobar que el sistema no permita registrar reservas cuando la fecha de salida sea igual o anterior a la fecha de entrada.
- **Precondición:** iniciar sesión y acceder al formulario de creación de reservas.
- **Datos de prueba:** fecha de entrada y fecha de salida iguales.
- **Pasos:**
  1. Iniciar sesión.
  2. Abrir el formulario de reservas.
  3. Seleccionar un alojamiento.
  4. Ingresar una fecha de entrada.
  5. Ingresar la misma fecha como fecha de salida.
  6. Intentar registrar la reserva.
- **Resultado esperado:** el sistema debe rechazar las fechas y mostrar un mensaje de validación.
- **Resultado obtenido:** el sistema rechazó el registro y mostró el mensaje: “The fecha salida field must be a date after fecha entrada.”
- **Estado:** Aprobado.
- **Evidencia:** evidencia 27.

### CP-09. Validación de alojamiento inexistente

- **Objetivo:** comprobar que el sistema no permita registrar una reserva asociada a un alojamiento que no exista.
- **Precondición:** acceder al módulo de reservas.
- **Datos de prueba:** identificador de alojamiento inexistente.
- **Pasos:**
  1. Revisar la validación del campo alojamiento_id en el controlador de reservas.
  2. Comprobar que se utilice una regla para verificar la existencia del alojamiento.
  3. Verificar que el sistema busque el alojamiento antes de continuar con el registro.
  4. Realizar posteriormente una prueba funcional con un identificador inexistente, si el entorno de pruebas lo permite.
- **Resultado esperado:** el sistema debe rechazar la operación cuando el alojamiento no exista.
- **Resultado obtenido:** durante la revisión de ReservaController.php se encontró la validación `'alojamiento_id' => 'required|exists:alojamientos,id'` y la búsqueda del alojamiento mediante `Alojamiento::findOrFail($datos['alojamiento_id'])`. La prueba funcional todavía está pendiente.
- **Estado:** Pendiente de prueba funcional.
- **Evidencia:** evidencia 28.

## 7. Estrategia de ejecución

Las pruebas se realizan en el entorno local de desarrollo de StayBook, utilizando Laravel, MySQL y el navegador web.

Para cada caso se siguen los pasos definidos, se compara el resultado obtenido con el resultado esperado y se registra su estado.

Las evidencias se organizan mediante capturas de pantalla y revisiones del código fuente, de acuerdo con el tipo de comprobación realizada.

Cuando se identifica un resultado pendiente o un comportamiento incorrecto, se deja registrado para su posterior revisión y ejecución.

## 8. Responsables

- **Stiven - Líder de pruebas:** encargado de planificar, ejecutar y documentar los casos de prueba, registrar los resultados y organizar las evidencias.
- **Marcela Saldarriaga - Desarrollo:** encargada del desarrollo de la aplicación y de apoyar la revisión y corrección de los comportamientos identificados.
- **Camila - Documentación:** encargada de apoyar la organización y presentación de la documentación del proyecto.

## 9. Registro general de resultados

| Código | Caso de prueba | Estado |
|---|---|---|
| CP-01 | Registro exitoso de alojamiento | Aprobado |
| CP-02 | Registro de alojamiento sin nombre | Pendiente |
| CP-03 | Registro de alojamiento con precio negativo | Pendiente |
| CP-04 | Consulta de alojamientos registrados | Aprobado |
| CP-05 | Modificación de alojamiento | Aprobado |
| CP-06 | Eliminación de alojamiento | Aprobado |
| CP-07 | Registro de reserva con datos válidos | Aprobado |
| CP-08 | Validación de fechas de reserva | Aprobado |
| CP-09 | Validación de alojamiento inexistente | Pendiente de prueba funcional |

**Resumen:** 6 casos aprobados, 3 casos pendientes de completar o verificar funcionalmente.

## 10. Conclusión

Durante la ejecución de las pruebas de StayBook se verificó el funcionamiento de las principales operaciones relacionadas con la gestión de alojamientos y el registro de reservas.

Se comprobó el registro, consulta, modificación y eliminación de alojamientos, así como el registro de una reserva y la validación de fechas incorrectas.

También se realizó una revisión del código del controlador de reservas para comprobar la existencia de validaciones relacionadas con los alojamientos.

Los casos que todavía se encuentran pendientes deberán ejecutarse y documentarse para completar la verificación del sistema.

En general, las pruebas realizadas permiten evaluar el funcionamiento de las funcionalidades principales de StayBook e identificar los aspectos que requieren comprobaciones adicionales.