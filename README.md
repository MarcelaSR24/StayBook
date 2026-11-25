# StayBook

Plataforma web de gestión y reservas de alojamientos, desarrollada con Laravel, PHP, Blade, Bootstrap y MySQL.

## 1. Descripción del proyecto

StayBook es una aplicación web orientada a la gestión de alojamientos y reservas. Su propósito es facilitar la administración de la información de los alojamientos y el registro, consulta y gestión de las reservas realizadas por los huéspedes.

La plataforma contempla diferentes roles de usuario, entre ellos administrador, propietario y cliente, con funcionalidades y permisos según sus responsabilidades.

## 2. Objetivo

Desarrollar una aplicación web que permita gestionar alojamientos y sus respectivas reservas, manteniendo organizada la información, facilitando su consulta y administración y aplicando validaciones para garantizar el correcto funcionamiento de las operaciones.

## 3. Tecnologías utilizadas

- **Backend:** Laravel 13.39.0 y PHP 8.3.33.
- **Frontend:** Blade y Bootstrap.
- **Base de datos:** MySQL.
- **Control de versiones:** Git y GitHub.
- **Pruebas:** PHPUnit y herramientas de pruebas integradas de Laravel.

## 4. Equipo de trabajo y roles

| Integrante | Responsabilidad |
|---|---|
| Marcela Saldarriaga | Líder técnica y responsable de calidad. |
| Stiven Arcila | Responsable de pruebas. |
| Camila Triana | Responsable de documentación y organización de evidencias. |

### Responsabilidades del equipo

- **Marcela Saldarriaga:** Coordina el alcance, la arquitectura y la integración de los cambios. Revisa el código, registra defectos y propone acciones de mantenimiento.
- **Stiven Arcila:** Diseña los casos de prueba, realiza verificaciones funcionales y coordina la automatización de las pruebas.
- **Camila Triana:** Mantiene el README.md, organiza los documentos del proyecto y recopila las evidencias de las entregas.

## 5. Funcionalidades principales

- Registro y administración de alojamientos.
- Consulta de alojamientos registrados.
- Actualización de la información de los alojamientos.
- Gestión de reservas asociadas a los alojamientos.
- Registro, consulta, confirmación y cancelación de reservas.
- Validación de fechas, capacidad y disponibilidad.
- Control de acceso según los roles de usuario.
- Protección de la privacidad de las reservas.

## 6. Estructura del proyecto

La documentación del proyecto se encuentra organizada de la siguiente manera:

```text
StayBook/
│
├── README.md
│
├── docs/
│   ├── especificacion.md
│   ├── plan-de-pruebas.md
│   ├── informe-calidad.md
│   └── evidencias/
│
├── app/
├── database/
├── resources/
├── routes/
├── tests/
│
└── composer.json
```

### Documentación

- **especificacion.md:** Contiene los requisitos funcionales, no funcionales y criterios de aceptación del proyecto.
- **plan-de-pruebas.md:** Contiene los casos de prueba diseñados, las verificaciones realizadas y sus resultados.
- **informe-calidad.md:** Registra las verificaciones técnicas, los hallazgos identificados y las recomendaciones de mantenimiento.
- **evidencias/:** Contiene los soportes y capturas de las actividades realizadas durante el desarrollo y las entregas.

## 7. Instalación y ejecución

Para ejecutar el proyecto en un entorno local se deben seguir los siguientes pasos:

**1. Clonar el repositorio:**

```bash
git clone https://github.com/MarcelaSR24/StayBook.git
```

**2. Ingresar a la carpeta del proyecto:**

```bash
cd StayBook
```

**3. Instalar las dependencias:**

```bash
composer install
```

**4. Crear el archivo de configuración:**

```bash
cp .env.example .env
```

**5. Generar la clave de la aplicación:**

```bash
php artisan key:generate
```

**6. Configurar la conexión a MySQL:**

Editar el archivo `.env` con los datos de conexión de la base de datos local.

**7. Ejecutar las migraciones:**

```bash
php artisan migrate
```

**8. Iniciar el servidor local:**

```bash
php artisan serve
```

La aplicación estará disponible en la dirección local indicada por Laravel al iniciar el servidor.

**Nota:** Se requiere tener instalados PHP, Composer y MySQL, además de las extensiones necesarias para Laravel.

## 8. Pruebas y verificaciones

Durante el proceso de desarrollo y seguimiento del proyecto se realizaron pruebas automatizadas y verificaciones manuales para evaluar el funcionamiento de las funcionalidades principales, los permisos de acceso y la gestión de reservas.

### Resultados de las pruebas automatizadas

- **ReservaIndexAuthorizationTest:** 4 pruebas aprobadas y 10 aserciones.
- **RoleAndReservationTest:** 12 pruebas aprobadas y 39 aserciones.
- **Suite completa:** 18 pruebas aprobadas y 51 aserciones.

### Verificaciones de seguridad y dependencias

Se ejecutó el comando `composer audit` para revisar las dependencias instaladas. En la revisión reportada no se encontraron avisos de vulnerabilidades de seguridad.

### Pruebas manuales

Se realizaron verificaciones identificadas desde PA-04 hasta PA-58, relacionadas con:

- Registro, inicio y cierre de sesión.
- Acceso según roles de usuario.
- Administración y consulta de alojamientos.
- Creación, consulta, confirmación y cancelación de reservas.
- Privacidad de las reservas.
- Validación de capacidad y disponibilidad.
- Navegación de los paneles de usuario.

Los resultados detallados, observaciones y hallazgos se encuentran en `docs/plan-de-pruebas.md` y `docs/informe-calidad.md`.

## 9. Tablero de seguimiento

La gestión y distribución de actividades del equipo se realizó mediante Trello, donde se organizaron las tareas, responsables, avances y actividades correspondientes a las diferentes etapas del proyecto.

**Enlace al tablero de Trello:**

https://trello.com/invite/b/6ac6557da7aa67f61c8e2ea7/ATTId5c34748a0c854219e8c39f090b32755882EF6FF/taller-final

## 10. Control de versiones

El desarrollo del proyecto se gestionó mediante Git y GitHub, utilizando ramas y commits para registrar los cambios realizados por los integrantes del equipo.

Repositorio:

https://github.com/MarcelaSR24/StayBook

## 11. Estado del proyecto

Proyecto desarrollado y sometido a verificaciones funcionales, pruebas automatizadas y revisión de calidad.

La documentación reúne los resultados de los seguimientos realizados y las actividades de preparación de la entrega final.

---

**Proyecto académico:** Ingeniería de Software II  
**Nombre del proyecto:** StayBook  
**Institución:** Corporación de Estudios Tecnológicos del Norte del Valle – Cotecnova  
**Periodo académico:** 2026-2