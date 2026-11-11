# StayBook

Plataforma web de gestión y reservas de alojamientos desarrollada con Laravel, PHP, Blade, Bootstrap y MySQL.

## Descripción del proyecto

StayBook es una aplicación web orientada a la gestión de alojamientos y reservas. Su propósito es facilitar la administración de la información de los alojamientos y el registro de las reservas realizadas por los huéspedes.

## Objetivo

Desarrollar una aplicación web que permita gestionar alojamientos y sus respectivas reservas, manteniendo organizada la información y facilitando su consulta y administración.

## Tecnologías utilizadas

- **Backend:** Laravel 13.39.0 y PHP 8.3.33.
- **Frontend:** Blade y Bootstrap.
- **Base de datos:** MySQL.
- **Control de versiones:** Git y GitHub.

## Equipo de trabajo

| Integrante | Responsabilidad |
|---|---|
| Marcela Saldarriaga | Líder técnica y responsable de calidad. |
| Stiven Arcila | Responsable de pruebas. |
| Camila Triana | Responsable de documentación y organización de evidencias. |

## Funcionalidades principales

- Registrar alojamientos.
- Consultar alojamientos registrados.
- Actualizar la información de los alojamientos.
- Gestionar reservas asociadas a los alojamientos.
- Validar la información ingresada por los usuarios.

## Estructura de la documentación

La documentación del proyecto se organiza en la carpeta `docs/`:

- `especificacion.md`: especificación de requisitos y funcionalidades.
- `plan-de-pruebas.md`: planificación y resultados de las pruebas.
- `informe-calidad.md`: registro de actividades y resultados relacionados con la calidad.
- `evidencias/`: capturas y soportes del desarrollo y las pruebas.

## Instalación y ejecución

Los siguientes pasos corresponden al procedimiento habitual de instalación de un proyecto Laravel. El equipo debe verificarlos en el entorno del proyecto antes de considerarlos definitivos.

1. Clonar el repositorio:

   ```bash
   git clone https://github.com/MarcelaSR24/StayBook.git
   ```

2. Ingresar a la carpeta:

   ```bash
   cd StayBook
   ```

3. Instalar las dependencias de PHP:

   ```bash
   composer install
   ```

4. Crear el archivo de configuración:

   ```bash
   cp .env.example .env
   ```

5. Generar la clave de la aplicación:

   ```bash
   php artisan key:generate
   ```

6. Configurar en el archivo `.env` la conexión a la base de datos MySQL.

7. Ejecutar las migraciones, una vez configurada la base de datos:

   ```bash
   php artisan migrate
   ```

8. Iniciar el servidor local:

   ```bash
   php artisan serve
   ```

La aplicación estará disponible en la dirección local que indique Laravel al iniciar el servidor.

**Nota:** Si el proyecto requiere dependencias o compilación del frontend, también deberán ejecutarse los comandos correspondientes de Node.js según la configuración del repositorio.

## Pruebas

Para ejecutar las pruebas automatizadas:

```bash
php artisan test
```

Los casos, resultados y observaciones de las pruebas se encuentran documentados en `docs/plan-de-pruebas.md`. El informe de calidad se encuentra en `docs/informe-calidad.md`.

## Tablero de seguimiento

El avance y la distribución de actividades del equipo se gestionan mediante Trello.

**Enlace al tablero:** [Agregar aquí el enlace del tablero de StayBook].

## Estado del proyecto

Proyecto en desarrollo.