# ESPECIFICACIÓN DEL SISTEMA STAYBOOK

## 1. Descripción general

StayBook es una aplicación web desarrollada para facilitar la consulta y gestión de alojamientos y el registro de reservas. El sistema permite a los usuarios crear una cuenta, iniciar sesión, consultar alojamientos disponibles y realizar reservas indicando las fechas de entrada y salida y la cantidad de huéspedes.

La aplicación busca ofrecer una experiencia sencilla, organizada y segura, centralizando la información de los alojamientos y las reservas en una base de datos.

El sistema contempla diferentes roles de usuario: administrador, propietario y cliente. Cada uno dispone de funcionalidades y permisos de acuerdo con sus responsabilidades dentro de la plataforma.

## 2. Objetivo de las especificaciones

Establecer los requisitos funcionales y no funcionales que debe cumplir StayBook, definiendo sus principales características, restricciones y condiciones de funcionamiento.

## 3. Especificaciones funcionales

Los requisitos funcionales describen las operaciones que pueden realizar los usuarios dentro de la aplicación.

| Código | Requisito funcional | Descripción |
|---|---|---|
| RF01 | Registro de usuarios | Permitir que los usuarios creen una cuenta mediante nombre, correo electrónico y contraseña. |
| RF02 | Inicio de sesión | Permitir el acceso mediante correo electrónico y contraseña. |
| RF03 | Cierre de sesión | Permitir que el usuario cierre su sesión de forma segura. |
| RF04 | Consulta de alojamientos | Permitir consultar los alojamientos disponibles y mostrar su información principal, de acuerdo con las condiciones de visibilidad del sistema. |
| RF05 | Registro de alojamientos | Permitir registrar alojamientos con sus características y precios. |
| RF06 | Modificación de alojamientos | Permitir actualizar la información de los alojamientos según los permisos del usuario. |
| RF07 | Eliminación de alojamientos | Permitir eliminar alojamientos registrados de acuerdo con los permisos establecidos. |
| RF08 | Registro de reservas | Permitir que los usuarios autenticados registren reservas. |
| RF09 | Consulta de reservas | Mostrar al usuario sus propias reservas, respetando los permisos de acceso. |
| RF10 | Cálculo de precios | Calcular el valor total según el precio por noche y la cantidad de noches. |
| RF11 | Validación de disponibilidad | Impedir reservas cuyas fechas se crucen con otras reservas pendientes o confirmadas. |
| RF12 | Validación de capacidad | Evitar reservas que superen la capacidad máxima del alojamiento. |
| RF13 | Cancelación de reservas | Permitir cancelar una reserva y actualizar su estado según las condiciones del sistema. |
| RF14 | Consulta de detalles | Mostrar la información completa de una reserva. |

## 4. Especificaciones no funcionales

Los requisitos no funcionales establecen las características de calidad y las condiciones que debe cumplir la aplicación.

| Código | Requisito | Descripción |
|---|---|---|
| RNF01 | Usabilidad | La interfaz debe ser sencilla, intuitiva y fácil de utilizar. |
| RNF02 | Compatibilidad | La aplicación debe funcionar en navegadores web modernos. |
| RNF03 | Diseño adaptable | La interfaz debe ajustarse a diferentes tamaños de pantalla. |
| RNF04 | Seguridad | Las contraseñas deben almacenarse mediante mecanismos de protección y no en texto plano. |
| RNF05 | Autenticación y autorización | Las operaciones protegidas deben requerir autenticación y respetar los permisos correspondientes al rol del usuario. |
| RNF06 | Integridad de datos | La información debe almacenarse de manera organizada y mantener relaciones entre usuarios, alojamientos y reservas. |
| RNF07 | Validación | El sistema debe validar los datos ingresados para evitar registros incorrectos. |
| RNF08 | Mantenibilidad | El código debe estar organizado mediante la estructura de Laravel para facilitar futuras modificaciones. |
| RNF09 | Rendimiento | Las operaciones habituales de consulta y registro deben ejecutarse sin demoras innecesarias. |
| RNF10 | Disponibilidad | El sistema debe poder utilizarse cuando el servidor y la infraestructura donde está instalado se encuentren disponibles. |

## 5. Especificaciones tecnológicas

StayBook utiliza las siguientes tecnologías y herramientas:

| Tecnología | Aplicación dentro del proyecto |
|---|---|
| Laravel 13.39.0 | Framework para el desarrollo de la aplicación web. |
| PHP 8.3.33 | Lenguaje de programación del lado del servidor. |
| MySQL | Sistema gestor de base de datos. |
| HTML5 | Estructura de las páginas web. |
| CSS3 | Presentación y estilos de la interfaz. |
| Bootstrap 5.3.3 | Diseño adaptable y componentes visuales. |
| JavaScript | Interacciones y cálculo estimado de precios en los formularios. |
| Git y GitHub | Control de versiones y colaboración entre integrantes. |
| Laragon | Entorno local de desarrollo. |

## 6. Roles de usuario

La plataforma contempla tres roles principales:

- **Administrador:** encargado de las actividades de administración y supervisión de la plataforma, según los permisos establecidos.
- **Propietario:** encargado de gestionar sus alojamientos y consultar las reservas relacionadas con ellos.
- **Cliente:** usuario que puede consultar alojamientos disponibles y realizar y gestionar sus propias reservas.

El acceso a las operaciones debe respetar los permisos definidos para cada tipo de usuario.

## 7. Estructura general de la información

La base de datos contempla las siguientes entidades principales:

- **Usuarios:** almacena los datos de las personas registradas en la plataforma.
- **Alojamientos:** almacena el nombre, descripción, tipo, dirección, ciudad, precio, capacidad y estado de cada alojamiento.
- **Reservas:** almacena el usuario que realiza la reserva, el alojamiento seleccionado, las fechas, la cantidad de huéspedes, el precio total y el estado.

Las reservas se relacionan con un usuario y un alojamiento mediante claves foráneas, permitiendo mantener la integridad de la información.

## 8. Relación con las pruebas del proyecto

Los requisitos funcionales y no funcionales definidos en esta especificación sirven como referencia para el diseño y ejecución de las pruebas de StayBook.

Su verificación se documenta en los siguientes archivos:

- `docs/plan-de-pruebas.md`: contiene los casos de prueba, resultados y observaciones.
- `docs/informe-calidad.md`: contiene los resultados de las verificaciones técnicas, los hallazgos y las recomendaciones de mantenimiento.

La definición de un requisito no implica que su cumplimiento haya sido comprobado en su totalidad. Para considerarlo verificado se deben contar con las pruebas y evidencias correspondientes.

---

**Proyecto:** StayBook – Plataforma de gestión y reservas de alojamientos.

**Etapa:** Entrega final – 2026.