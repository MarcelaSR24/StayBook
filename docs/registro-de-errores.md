# Registro de errores y defectos - StayBook

**Responsable:** Stiven - Líder de pruebas.

**Estado:** Registro inicial.

## 1. Objetivo

Documentar los errores y defectos identificados durante las pruebas de la plataforma StayBook, facilitando su seguimiento, clasificación y corrección por parte del equipo de desarrollo.

Este registro permite llevar un control de los problemas encontrados y verificar que las soluciones implementadas funcionen correctamente.

## 2. Clasificación de severidad

| Nivel | Descripción |
|---|---|
| Crítica | Impide utilizar una funcionalidad esencial o compromete gravemente el funcionamiento del sistema. |
| Alta | Afecta una funcionalidad importante de la aplicación. |
| Media | Genera problemas durante el uso, pero existe una alternativa para continuar. |
| Baja | Corresponde a errores visuales o detalles menores que no impiden utilizar el sistema. |

## 3. Registro de defectos

Actualmente no se cuenta con defectos confirmados durante las pruebas realizadas. Los casos que se encuentran pendientes de ejecución o verificación no se registran como errores.

| ID | Fecha | Módulo | Descripción | Severidad | Estado |
|---|---|---|---|---|---|
| DEF-001 | Sin registro | Sin identificar | No se han confirmado defectos hasta el momento. | No aplica | Sin defectos confirmados |

## 4. Información que debe registrarse por cada defecto

Cuando se identifique un defecto, se deberá documentar la siguiente información:

- **Identificador:** código único del defecto.
- **Fecha:** día en que se encontró el problema.
- **Módulo afectado:** sección de la aplicación donde ocurre.
- **Caso de prueba relacionado:** código del caso de prueba que permitió identificarlo.
- **Descripción:** explicación clara del problema.
- **Pasos para reproducirlo:** acciones necesarias para volver a encontrar el error.
- **Resultado esperado:** comportamiento correcto que debería presentar el sistema.
- **Resultado obtenido:** comportamiento que realmente presentó.
- **Severidad:** nivel de impacto del defecto.
- **Evidencia:** captura de pantalla o archivo que demuestre el problema.
- **Responsable de corregirlo:** integrante encargado de solucionarlo.
- **Estado:** situación actual del defecto.

## 5. Estados de los defectos

| Estado | Descripción |
|---|---|
| Nuevo | Error identificado durante una prueba. |
| Reportado | Error comunicado al equipo de desarrollo. |
| En corrección | El equipo de desarrollo está trabajando en la solución. |
| Corregido | El equipo informa que el error fue solucionado. |
| Verificado | Se repitió la prueba y se confirmó que la solución funciona. |
| Reabierto | El error continúa o volvió a aparecer después de su corrección. |

## 6. Seguimiento de defectos

Cuando se identifique un defecto, se asignará un código consecutivo, comenzando por DEF-001.

Cada defecto deberá tener seguimiento hasta comprobar que fue solucionado o determinar su situación final.

Las evidencias deberán conservarse en la carpeta de documentación del proyecto para facilitar su revisión.

## 7. Observaciones

Este registro se actualizará a medida que se ejecuten nuevas pruebas en StayBook.

No se registrarán defectos ficticios ni se marcarán errores como corregidos sin realizar una verificación.

Los casos de prueba pendientes se mantendrán documentados en el plan de pruebas hasta que puedan ejecutarse y evaluarse.