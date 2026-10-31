# INFORME DE CALIDAD – STAYBOOK

## 2. Plan de calidad

### 2.1. Objetivo

Establecer las actividades, los criterios y los procedimientos necesarios para verificar la calidad del sistema StayBook, comprobando que sus funcionalidades cumplan con los requisitos establecidos y que la aplicación funcione correctamente.

### 2.2. Alcance

El plan de calidad comprende la verificación de las siguientes funcionalidades y características del sistema:

- Registro de usuarios.
- Inicio y cierre de sesión.
- Consulta y gestión de alojamientos.
- Registro, consulta y cancelación de reservas.
- Cálculo de precios de las reservas.
- Validación de fechas y disponibilidad de alojamientos.
- Validación de la capacidad de los alojamientos.
- Seguridad y control de acceso.
- Funcionamiento y presentación de la interfaz.

### 2.3. Criterios de calidad

Para evaluar la calidad de StayBook, se establecen los siguientes criterios:

| Criterio | Descripción | Condición de aceptación |
|---|---|---|
| Funcionalidad | Las funciones del sistema deben cumplir con lo solicitado. | Las operaciones principales deben ejecutarse correctamente. |
| Usabilidad | La plataforma debe ser fácil de utilizar. | Los formularios y las opciones deben ser comprensibles para el usuario. |
| Seguridad | El sistema debe controlar el acceso a las operaciones protegidas. | Los usuarios sin sesión iniciada no deben acceder al módulo de reservas. |
| Integridad | Los datos deben conservar sus relaciones correctamente. | Cada reserva debe estar asociada al usuario y al alojamiento correspondientes. |
| Confiabilidad | El sistema debe responder correctamente ante datos inválidos. | Se deben impedir los registros que incumplan las validaciones establecidas. |
| Compatibilidad | La aplicación debe visualizarse correctamente en navegadores modernos. | Las páginas deben funcionar adecuadamente en navegadores actuales. |
| Mantenibilidad | El proyecto debe facilitar los cambios y las correcciones. | El código debe mantener una estructura organizada. |

### 2.4. Actividades de aseguramiento y control de calidad

Para garantizar la calidad de StayBook, se realizarán las siguientes actividades:

1. **Revisión del código:** verificar que el código fuente mantenga una estructura organizada y cumpla con las funciones establecidas.
2. **Validación de formularios:** comprobar que los campos obligatorios y las reglas de validación funcionen correctamente.
3. **Pruebas funcionales:** verificar el funcionamiento del registro de usuarios, inicio de sesión, gestión de alojamientos y reservas.
4. **Pruebas de validación:** comprobar que el sistema rechace fechas incorrectas, precios negativos y cantidades de huéspedes que superen la capacidad.
5. **Pruebas de seguridad:** verificar que las operaciones protegidas requieran iniciar sesión y que cada usuario pueda consultar únicamente sus propias reservas.
6. **Pruebas de integración:** comprobar que los módulos de usuarios, alojamientos y reservas funcionen correctamente en conjunto.
7. **Corrección de defectos:** registrar los errores encontrados, realizar las correcciones necesarias y repetir las pruebas correspondientes.
8. **Verificación final:** revisar que las funcionalidades cumplan los requisitos establecidos y que los resultados de las pruebas estén documentados.

### 2.5. Plan de pruebas de calidad

Se establece un conjunto de casos de prueba para verificar el funcionamiento de las principales características de StayBook. Cada prueba permitirá comprobar que el sistema cumpla con los requisitos definidos y responda correctamente ante diferentes situaciones.

| Código | Caso de prueba | Descripción |
|---|---|---|
| CP01 | Registro de usuario | Verificar que se pueda crear una cuenta con datos válidos. |
| CP02 | Inicio de sesión | Comprobar que un usuario pueda ingresar con credenciales correctas. |
| CP03 | Cierre de sesión | Verificar que el usuario pueda cerrar su sesión correctamente. |
| CP04 | Registro de alojamiento | Comprobar que se pueda registrar un alojamiento con datos válidos. |
| CP05 | Modificación de alojamiento | Verificar que los datos de un alojamiento puedan actualizarse. |
| CP06 | Eliminación de alojamiento | Comprobar que se pueda eliminar un alojamiento. |
| CP07 | Registro de reserva | Verificar que se pueda registrar una reserva válida. |
| CP08 | Consulta de detalles de reserva | Comprobar que se puedan consultar los detalles de una reserva. |
| CP09 | Cálculo de precios | Verificar que el sistema calcule correctamente el precio según la cantidad de noches. |
| CP10 | Validación de disponibilidad | Comprobar que el sistema impida reservar fechas que ya estén ocupadas. |
| CP11 | Validación de capacidad | Verificar que no se permita reservar con una cantidad de huéspedes superior a la capacidad del alojamiento. |
| CP12 | Cancelación de reserva | Comprobar que se pueda cancelar una reserva pendiente. |
| CP13 | Seguridad de acceso | Verificar que no se pueda acceder al módulo de reservas sin iniciar sesión. |

**Nota:** los casos de prueba se ejecutarán y sus resultados se documentarán durante el proceso de verificación. No se considerarán aprobados hasta contar con las evidencias correspondientes.

### 2.6. Responsables

Para llevar a cabo las actividades de aseguramiento y control de calidad, se establecen las siguientes responsabilidades dentro del equipo de trabajo:

| Responsable | Rol | Funciones |
|---|---|---|
| Marcela Saldarriaga | Líder técnico y responsable de calidad | Definir los requisitos, desarrollar el código, supervisar las pruebas, identificar defectos y realizar las correcciones necesarias. |
| Stiven | Responsable de pruebas | Ejecutar los casos de prueba, registrar los resultados, recopilar evidencias e informar los defectos encontrados. |
| Camila | Responsable de documentación | Organizar los resultados, las evidencias, los procedimientos y los documentos del proyecto. |

### 2.7. Indicadores de calidad

Para evaluar la calidad del sistema, se utilizarán los siguientes indicadores:

| Indicador | Descripción | Fórmula |
|---|---|---|
| Porcentaje de casos aprobados | Mide la proporción de casos de prueba que finalizaron correctamente. | (Casos aprobados / Total de casos ejecutados) × 100 |
| Porcentaje de defectos corregidos | Mide la cantidad de defectos encontrados que fueron corregidos. | (Defectos corregidos / Defectos encontrados) × 100 |
| Cumplimiento de requisitos | Mide la proporción de requisitos implementados en el sistema. | (Requisitos implementados / Total de requisitos) × 100 |
| Tasa de pruebas fallidas | Mide la proporción de casos de prueba que presentaron resultados incorrectos. | (Casos fallidos / Total de casos ejecutados) × 100 |

**Nota:** estos indicadores se calcularán cuando se hayan recopilado los resultados reales de las pruebas.

### 2.8. Criterios de aceptación final

El sistema StayBook se considerará aceptable cuando cumpla con las siguientes condiciones:

1. Las funcionalidades principales deben estar implementadas de acuerdo con los requisitos establecidos.
2. Los usuarios deben poder registrarse e iniciar sesión correctamente.
3. Los alojamientos deben poder consultarse, registrarse, modificarse y eliminarse.
4. Los usuarios deben poder registrar y consultar sus reservas.
5. El sistema debe calcular correctamente el precio total de las reservas según la cantidad de noches.
6. El sistema debe validar las fechas de reserva y la capacidad de los alojamientos.
7. Los usuarios deben poder cancelar sus reservas de acuerdo con las reglas establecidas.
8. Las pruebas funcionales y de seguridad deben ejecutarse y sus resultados deben quedar documentados.
9. Los defectos encontrados deben corregirse o quedar debidamente documentados.
10. La documentación del proyecto debe estar organizada y completa.

## 3. Conclusión

El desarrollo de la especificación del sistema y del plan de calidad permite establecer las características, los requisitos y los procedimientos necesarios para evaluar el funcionamiento de StayBook.

Mediante los criterios de calidad y los casos de prueba definidos, se busca comprobar que la aplicación funcione correctamente, permita gestionar alojamientos y reservas, proteja la información de los usuarios y ofrezca una experiencia organizada y confiable.

Además, la ejecución y documentación de las pruebas permitirá identificar posibles errores, realizar las correcciones necesarias y verificar el cumplimiento de los requisitos establecidos para el proyecto.