# Plan de pruebas – StayBook

## 1. Objetivo

Definir y documentar las pruebas utilizadas para verificar el funcionamiento de StayBook, comprobar el cumplimiento de los requisitos funcionales y no funcionales e identificar aspectos que requieren corrección, seguimiento o verificación adicional.

## 2. Alcance

El plan contempla las siguientes pruebas y verificaciones:

- Registro, inicio y cierre de sesión.
- Roles, permisos y control de acceso.
- Paneles y navegación según el tipo de usuario.
- Registro, consulta y modificación de alojamientos.
- Creación, consulta, confirmación y cancelación de reservas.
- Privacidad de la información de usuarios y reservas.
- Validación de fechas, huéspedes, capacidad y disponibilidad.
- Pruebas automatizadas de roles, autorización y reservas.
- Inspección de controladores, políticas, rutas y dependencias.

Las verificaciones manuales recibidas del responsable de pruebas están identificadas desde PA-04 hasta PA-58.

## 3. Entorno de pruebas

- **Aplicación:** StayBook.
- **Framework:** Laravel 13.39.0.
- **Lenguaje:** PHP 8.3.33.
- **Base de datos de la aplicación:** MySQL 8.4.3.
- **Entorno:** local.
- **Pruebas automatizadas:** PHPUnit, utilizando SQLite en memoria según la configuración revisada.
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

Los resultados de las pruebas se documentan mediante códigos de identificación, descripciones y evidencias disponibles.

### 6.1. Pruebas manuales

Se realizaron verificaciones identificadas desde PA-04 hasta PA-58, relacionadas con:

- Registro, inicio y cierre de sesión.
- Acceso de administrador, propietario y cliente.
- Consulta y administración de alojamientos.
- Registro y edición de alojamientos.
- Creación, consulta, confirmación y cancelación de reservas.
- Privacidad de reservas entre clientes.
- Restricciones de acceso según los roles.
- Validación de capacidad y disponibilidad.
- Navegación de los paneles.

Durante la revisión se identificaron los siguientes hallazgos:

| Identificador | Hallazgo | Observación |
|---|---|---|
| PA-51 | Fecha de entrada pasada | La interfaz permitió calcular incorrectamente las noches y el precio al introducir una fecha de entrada anterior a la fecha actual. |
| PA-52 | Fecha de salida anterior a la entrada | La interfaz mostró cero noches y cero precio cuando la fecha de salida era anterior a la fecha de entrada. |
| PA-53 | Validación de capacidad | Se comprobó la restricción visual de capacidad, pero no toda posible manipulación del formulario. |
| PA-55 | Reserva ocupada | Se observó el mensaje de reserva ocupada, pero no se realizó un nuevo envío para comprobar posibles duplicados. |
| PA-57 | Campos obligatorios | Se comprobó la validación del campo nombre, pero no todos los campos obligatorios. |

Estos hallazgos deben conservarse como observaciones y verificaciones incompletas. No se consideran correcciones confirmadas.

### 6.2. Pruebas automatizadas

Se realizaron ejecuciones mediante los comandos de Laravel para comprobar los permisos, la autorización y las operaciones relacionadas con las reservas.

Los resultados registrados fueron:

| Prueba automatizada | Resultado | Aserciones |
|---|---|---:|
| ReservaIndexAuthorizationTest | 4 pruebas aprobadas | 10 |
| RoleAndReservationTest | 12 pruebas aprobadas | 39 |
| Suite completa (`php artisan test`) | 18 pruebas aprobadas | 51 |

La suite completa finalizó con 18 pruebas aprobadas y 51 aserciones.

Las pruebas automatizadas permitieron revisar escenarios relacionados con roles, permisos, privacidad de reservas y operaciones del sistema.

### 6.3. Comandos utilizados

Para consultar la versión de Laravel:

```bash
php artisan --version
```

Para inspeccionar los componentes Symfony instalados:

```bash
composer show "symfony/*"
```

Para revisar las dependencias y posibles vulnerabilidades conocidas:

```bash
composer audit
```

Para consultar las rutas registradas:

```bash
php artisan route:list
```

Para revisar las rutas y sus middleware:

```bash
php artisan route:list -v
```

Para ejecutar la prueba de autorización de reservas:

```bash
php artisan test --filter=ReservaIndexAuthorizationTest
```

Para ejecutar las pruebas de roles y reservas:

```bash
php artisan test --filter=RoleAndReservationTest
```

Para ejecutar la suite completa:

```bash
php artisan test
```

### 6.4. Verificación de dependencias

Se ejecutó `composer audit` para revisar las dependencias del proyecto.

**Resultado registrado:** no se encontraron avisos de vulnerabilidades de seguridad en las dependencias revisadas.

Este resultado corresponde a la revisión realizada y no representa una garantía absoluta de ausencia de vulnerabilidades en toda la aplicación.

## 7. Clasificación de resultados

Para mantener un registro uniforme, las pruebas se clasifican de la siguiente manera:

- **Aprobada:** la prueba cumple el resultado esperado.
- **Aprobada con observaciones:** el escenario principal funciona, pero existen aspectos que requieren revisión.
- **No aprobada:** el resultado obtenido no cumple lo esperado.
- **Parcial:** solamente se comprobó una parte del escenario.
- **Pendiente:** falta ejecutar la prueba o completar la verificación y su evidencia.

La clasificación debe corresponder a los resultados observados y a las evidencias disponibles. La existencia de una ruta, método o regla en el código no constituye por sí sola una prueba funcional aprobada.


## 8. Evidencias

Las evidencias de ejecución se organizan dentro de la carpeta:

`docs/evidencias/`

Se deben conservar los soportes disponibles de:

- Pruebas manuales.
- Pruebas automatizadas.
- Verificaciones técnicas.
- Resultados de ejecución de comandos.
- Hallazgos y observaciones identificados.

Cada evidencia debe relacionarse con el código de prueba correspondiente para facilitar su consulta y seguimiento.

## 9. Responsable

**Stiven Arcila:** responsable de diseñar, ejecutar y actualizar las pruebas del proyecto StayBook, registrar los resultados y comunicar los defectos encontrados.

**Camila Triana:** responsable de organizar y mantener la documentación y las evidencias de las actividades realizadas.

**Marcela Saldarriaga:** responsable de revisar los resultados de calidad, inspeccionar el código y proponer acciones de mantenimiento.

---

**Proyecto:** StayBook – Plataforma de gestión y reservas de alojamientos.

**Asignatura:** Ingeniería de Software II.

**Etapa:** Entrega final – 2026.