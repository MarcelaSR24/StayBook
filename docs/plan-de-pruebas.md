# Plan de pruebas – StayBook

## 1. Objetivo

Definir y documentar las pruebas utilizadas para verificar el funcionamiento de StayBook, comprobar el cumplimiento de los requisitos funcionales y no funcionales e identificar aspectos que requieren corrección o verificación adicional.

## 2. Alcance

Se contemplan pruebas relacionadas con:

- Registro, inicio y cierre de sesión.
- Roles, permisos y control de acceso.
- Paneles y navegación según el tipo de usuario.
- Registro, consulta y modificación de alojamientos.
- Creación, consulta, confirmación y cancelación de reservas.
- Privacidad de la información de usuarios y reservas.
- Validación de fechas, huéspedes, capacidad y disponibilidad.
- Pruebas automatizadas de roles, autorización y reservas.
- Inspección de controladores, políticas, rutas y dependencias.

La auditoría manual recibida contiene las pruebas PA-04 a PA-58. No se encontró evidencia de PA-01 a PA-03 en el material revisado.

## 3. Entorno de pruebas

- **Aplicación:** StayBook.
- **Framework:** Laravel 13.39.0.
- **Lenguaje:** PHP.
- **Base de datos:** MySQL 8.4.3 para la aplicación.
- **Entorno:** local.
- **Pruebas automatizadas:** PHPUnit, con SQLite en memoria según la configuración revisada.
- **Responsable de pruebas:** Stiven Arcila.

## 4. Pruebas funcionales

| Requisitos | Prueba | Resultado esperado |
|---|---|---|
| RF01–RF03 | Registro, inicio y cierre de sesión | El usuario puede gestionar el acceso a su cuenta. |
| RF04 | Consultar alojamientos | Se muestran los alojamientos disponibles. |
| RF05–RF07 | Registrar, modificar y eliminar alojamientos | La información se administra de acuerdo con los permisos del usuario. |
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
| RNF05 | Restricción de operaciones según la autenticación y los permisos. |
| RNF06 | Integridad y relaciones de los datos. |
| RNF07 | Validación de los datos ingresados. |
| RNF08 | Organización y mantenibilidad del código. |
| RNF09 | Tiempo de respuesta de la aplicación. |
| RNF10 | Disponibilidad de la aplicación durante su funcionamiento. |

## 6. Ejecución y registro de resultados

Los resultados de las pruebas se documentan mediante códigos de identificación y evidencias.

### 6.1 Pruebas manuales

La auditoría recibida registra 55 pruebas manuales, clasificadas así:

| Estado | Cantidad |
|---|---:|
| Aprobado | 40 |
| Aprobado con observaciones | 9 |
| No aprobado | 4 |
| Parcial | 1 |
| Pendiente | 1 |
| **Total** | **55** |

Las pruebas no aprobadas fueron:

- PA-12: consulta de alojamientos desde la cuenta del cliente.
- PA-14: acceso al formulario de nueva reserva.
- PA-51: selección de fecha de entrada anterior al día actual.
- PA-52: selección de fecha de salida anterior a la fecha de entrada.

También se registraron:
- PA-57: validación parcial de los campos obligatorios del formulario de alojamiento.
- PA-19: consulta de alojamientos del propietario pendiente de comprobación en su ficha original.

Los resultados con observaciones y las verificaciones incompletas deben conservarse para su seguimiento. No se consideran correcciones confirmadas.

### 6.2 Pruebas automatizadas

Se documentaron las siguientes ejecuciones:

| Prueba | Resultado |
|---|---|
| ReservaIndexAuthorizationTest | 4 pruebas aprobadas, 10 aserciones y 0 fallos. |
| RoleAndReservationTest | 12 pruebas aprobadas, 39 aserciones y 0 fallos. |
| Suite completa (`php artisan test`) | 18 pruebas aprobadas, 51 aserciones y 0 fallos. |

Las pruebas automatizadas cubren escenarios de roles, permisos, privacidad de reservas, cálculo de precios, capacidad, fechas superpuestas, cancelaciones, confirmaciones e historial.

La revisión RT-06 identificó cobertura parcial de autorización de alojamientos. Por esta razón, se requiere ampliar las pruebas automatizadas de permisos.

### 6.3 Comandos utilizados

Para ejecutar las pruebas automatizadas se utilizó:

```bash
php artisan test
```

Para ejecutar pruebas específicas:

```bash
php artisan test --filter=ReservaIndexAuthorizationTest
php artisan test --filter=RoleAndReservationTest
```

## 7. Clasificación de resultados

Los resultados se clasifican de la siguiente manera:

- **Aprobado:** la prueba cumple el resultado esperado.
- **Aprobado con observaciones:** el escenario principal funciona, pero existen aspectos que requieren revisión.
- **No aprobado:** el resultado obtenido no cumple lo esperado.
- **Parcial:** solo se comprobó una parte del escenario.
- **Pendiente:** falta ejecutar o completar la verificación.

Los resultados deben corresponder a las evidencias disponibles. La existencia de una ruta, método o regla en el código no se considera por sí sola una prueba funcional aprobada.

## 8. Pruebas y verificaciones por ampliar

De acuerdo con los hallazgos de la auditoría, se requiere continuar con las siguientes verificaciones:

1. Revisar la consulta de alojamientos y su disponibilidad para clientes.
2. Comprobar el formulario de reservas con fechas inválidas y verificar los mensajes mostrados.
3. Validar individualmente los campos obligatorios de los formularios.
4. Comprobar la capacidad máxima mediante validaciones del servidor.
5. Verificar el bloqueo efectivo de reservas duplicadas.
6. Comprobar el acceso directo de un propietario a alojamientos de otros propietarios.
7. Ampliar las pruebas automatizadas de autorización de alojamientos.
8. Verificar las operaciones de edición y archivado según los permisos.
9. Aclarar las rutas utilizadas para consultar reservas.
10. Completar las evidencias pendientes identificadas en la auditoría.

## 9. Evidencias

Las evidencias de ejecución se organizan en las carpetas correspondientes dentro de:

`docs/evidencias/`

Se conservan los soportes de pruebas manuales, pruebas automatizadas y verificaciones técnicas recibidos del equipo.

Los resultados deben mantenerse relacionados con sus códigos de prueba para facilitar su consulta y seguimiento.

## 10. Responsable

**Stiven Arcila:** responsable de diseñar, ejecutar y actualizar las pruebas del proyecto StayBook, registrar sus resultados y comunicar los defectos encontrados.

La documentación de calidad y la organización de evidencias se realizan con el apoyo del equipo del proyecto.