# Especificación del sistema StayBook

## Especificaciones del sistema

### Descripción general

StayBook es una aplicación web desarrollada para facilitar la consulta y gestión de alojamientos y el registro de reservas. El sistema permite a los usuarios crear una cuenta, iniciar sesión, consultar alojamientos disponibles y realizar reservas indicando las fechas de entrada y salida y la cantidad de huéspedes.

La aplicación busca ofrecer una experiencia sencilla, organizada y segura, centralizando la información de los alojamientos y las reservas en una base de datos.

### Objetivo de las especificaciones

Establecer los requisitos funcionales y no funcionales que debe cumplir StayBook, definiendo sus principales características, restricciones y condiciones de funcionamiento.

### Especificaciones funcionales

El sistema StayBook debe cumplir con los siguientes requisitos funcionales, los cuales describen las operaciones que pueden realizar los usuarios dentro de la aplicación.

| Código | Requisito funcional | Descripción |
|---|---|---|
| RF01 | Registro de usuarios | Permitir que los usuarios creen una cuenta mediante nombre, correo electrónico y contraseña. |
| RF02 | Inicio de sesión | Permitir el acceso mediante correo electrónico y contraseña. |
| RF03 | Cierre de sesión | Permitir que el usuario cierre su sesión de forma segura. |
| RF04 | Consulta de alojamientos | Mostrar los alojamientos registrados y su información principal. |
| RF05 | Registro de alojamientos | Permitir registrar alojamientos con sus características y precios. |
| RF06 | Modificación de alojamientos | Permitir actualizar la información de los alojamientos. |
| RF07 | Eliminación de alojamientos | Permitir eliminar alojamientos registrados. |
| RF08 | Registro de reservas | Permitir que los usuarios autenticados registren reservas. |
| RF09 | Consulta de reservas | Mostrar al usuario sus propias reservas. |
| RF10 | Cálculo de precios | Calcular el valor total según el precio por noche y la cantidad de noches. |
| RF11 | Validación de disponibilidad | Impedir reservas cuyas fechas se crucen con otras reservas pendientes o confirmadas. |
| RF12 | Validación de capacidad | Evitar reservas que superen la capacidad máxima del alojamiento. |
| RF13 | Cancelación de reservas | Permitir cancelar una reserva y actualizar su estado. |
| RF14 | Consulta de detalles | Mostrar la información completa de una reserva. |

### Especificaciones no funcionales

| Código | Requisito | Descripción |
|---|---|---|
| RNF01 | Usabilidad | La interfaz debe ser sencilla, intuitiva y fácil de utilizar. |
| RNF02 | Compatibilidad | La aplicación debe funcionar en navegadores web modernos. |
| RNF03 | Diseño adaptable | La interfaz debe ajustarse a diferentes tamaños de pantalla. |
| RNF04 | Seguridad | Las contraseñas deben almacenarse mediante mecanismos de protección y no en texto plano. |
| RNF05 | Autenticación | Las operaciones de reserva deben requerir una sesión iniciada. |
| RNF06 | Integridad de datos | La información debe almacenarse de manera organizada y mantener relaciones entre usuarios, alojamientos y reservas. |
| RNF07 | Validación | El sistema debe validar los datos ingresados para evitar registros incorrectos. |
| RNF08 | Mantenibilidad | El código debe estar organizado mediante la estructura de Laravel para facilitar futuras modificaciones. |
| RNF09 | Rendimiento | Las operaciones habituales de consulta y registro deben ejecutarse sin demoras innecesarias. |
| RNF10 | Disponibilidad | El sistema debe poder utilizarse cuando el servidor y la infraestructura donde está instalado se encuentren disponibles. |

### Especificaciones tecnológicas

StayBook utiliza las siguientes tecnologías:

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

### Estructura general de la información

La base de datos contempla las siguientes entidades principales:

- **Usuarios:** almacena los datos de las personas registradas en la plataforma.
- **Alojamientos:** almacena el nombre, descripción, tipo, dirección, ciudad, precio, capacidad y estado de cada alojamiento.
- **Reservas:** almacena el usuario que realiza la reserva, el alojamiento seleccionado, las fechas, la cantidad de huéspedes, el precio total y el estado.

Las reservas se relacionan con un usuario y un alojamiento mediante claves foráneas, permitiendo mantener la integridad de la información.