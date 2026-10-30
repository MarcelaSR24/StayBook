# Procedimiento de pruebas - StayBook

**Responsable:** Stiven - Líder de pruebas.

## 1. Objetivo

Establecer los pasos para realizar las pruebas funcionales y automatizadas de la plataforma StayBook.

## 2. Preparación

Antes de ejecutar las pruebas se debe:

- Verificar que el proyecto Laravel esté disponible.
- Revisar que las dependencias estén instaladas.
- Comprobar la conexión con MySQL.
- Verificar que la aplicación pueda ejecutarse.
- Revisar los casos de prueba definidos.

## 3. Ejecución de pruebas funcionales

1. Abrir la aplicación StayBook.
2. Ingresar al módulo que se desea probar.
3. Ejecutar los pasos definidos en el caso de prueba.
4. Comparar el resultado obtenido con el resultado esperado.
5. Registrar el resultado en `registro-de-pruebas.md`.
6. Guardar evidencias cuando sea necesario.

## 4. Ejecución de pruebas automatizadas

Cuando Laravel esté configurado:

1. Abrir la terminal en la carpeta del proyecto.
2. Ejecutar las pruebas automatizadas con:

   `php artisan test`

3. Revisar los resultados de ejecución.
4. Identificar las pruebas fallidas.
5. Reportar los defectos encontrados.

## 5. Reporte de errores

Cuando se encuentre un defecto:

- Asignar un identificador.
- Describir el problema.
- Indicar los pasos para reproducirlo.
- Registrar el resultado esperado y el obtenido.
- Adjuntar evidencia.
- Comunicarlo al responsable de desarrollo.

## 6. Verificación de correcciones

Cuando el equipo informe que un error fue corregido:

1. Repetir el caso de prueba que presentó el problema.
2. Comprobar que funcione correctamente.
3. Actualizar el estado del defecto.
4. Ejecutar pruebas de regresión cuando corresponda.

## 7. Responsabilidad

El líder de pruebas coordina el diseño, ejecución, seguimiento y documentación de las pruebas de StayBook.

## 8. Estado

Documento de preparación. Se actualizará según la estructura y funcionalidades definitivas de la aplicación.