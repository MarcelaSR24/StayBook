# Plan de pruebas – StayBook

## 1. Objetivo

Definir las pruebas para verificar el funcionamiento de StayBook y comprobar que cumple los requisitos funcionales y no funcionales establecidos en la especificación del proyecto.

## 2. Alcance

Se contemplan pruebas relacionadas con el registro e inicio de sesión de usuarios, la gestión de alojamientos, las reservas y la validación de las características de calidad de la aplicación.

## 3. Entorno de pruebas

- **Aplicación:** StayBook.
- **Tecnologías:** Laravel, PHP y MySQL.
- **Entorno:** local.
- **Navegadores:** los utilizados durante las pruebas.
- **Responsable:** Stiven Arcila.

## 4. Pruebas funcionales

| Requisitos | Prueba | Resultado esperado |
|---|---|---|
| RF01–RF03 | Registro, inicio y cierre de sesión | El usuario puede gestionar el acceso a su cuenta. |
| RF04 | Consultar alojamientos | Se muestran los alojamientos disponibles. |
| RF05–RF07 | Registrar, modificar y eliminar alojamientos | La información se administra correctamente. |
| RF08–RF09 | Crear y consultar reservas | El usuario puede realizar y consultar sus reservas. |
| RF10–RF12 | Calcular precios y validar disponibilidad y capacidad | Las reservas cumplen las condiciones establecidas. |
| RF13 | Cancelar reservas | El usuario puede cancelar una reserva según las condiciones del sistema. |
| RF14 | Consultar detalles de una reserva | Se muestra la información correspondiente a la reserva. |

## 5. Pruebas no funcionales

| Requisito | Aspecto por verificar |
|---|---|
| RNF01 | Facilidad de uso de la aplicación. |
| RNF02 | Compatibilidad con navegadores. |
| RNF03 | Adaptación a diferentes tamaños de pantalla. |
| RNF04 | Protección y almacenamiento seguro de contraseñas. |
| RNF05 | Restricción de operaciones según la autenticación. |
| RNF06 | Integridad y relaciones de los datos. |
| RNF07 | Validación de los datos ingresados. |
| RNF08 | Organización y mantenibilidad del código. |
| RNF09 | Tiempo de respuesta de la aplicación. |
| RNF10 | Disponibilidad de la aplicación durante su funcionamiento. |

## 6. Registro de resultados

Los resultados se registran de acuerdo con las pruebas realizadas y las evidencias disponibles. Cada prueba puede clasificarse como:

- **Aprobada:** cumple el resultado esperado.
- **Parcial:** cumple solo una parte de lo esperado.
- **Pendiente:** falta ejecutar, verificar o completar la evidencia.

Las pruebas pendientes continuarán en seguimiento y podrán completarse durante las siguientes etapas del proyecto.

## 7. Evidencias

Las capturas y demás soportes de las pruebas se organizarán en las carpetas correspondientes dentro de `docs/evidencias/`.

## 8. Responsable

**Stiven Arcila:** responsable de diseñar, ejecutar y actualizar las pruebas del proyecto StayBook.
