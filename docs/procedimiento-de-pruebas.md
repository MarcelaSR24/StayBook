# Procedimiento de pruebas - StayBook

**Responsable:** Stiven - Líder de pruebas.

## 1. Objetivo

Establecer los pasos para realizar las pruebas funcionales y automatizadas de la plataforma StayBook, con el fin de verificar que sus funcionalidades cumplan con los resultados esperados.

## 2. Preparación

Antes de ejecutar las pruebas se debe:

- Verificar que el proyecto Laravel esté disponible.
- Revisar que las dependencias estén instaladas.
- Comprobar la conexión con MySQL.
- Verificar que la aplicación pueda ejecutarse correctamente.
- Revisar los casos de prueba definidos en `casos-de-prueba.md`.
- Comprobar que los datos necesarios para las pruebas estén disponibles.

## 3. Ejecución de pruebas funcionales

Para realizar las pruebas funcionales se deben seguir estos pasos:

1. Abrir la aplicación StayBook.
2. Ingresar al módulo que se desea probar.
3. Ejecutar los pasos definidos en el caso de prueba correspondiente.
4. Comparar el resultado obtenido con el resultado esperado.
5. Registrar el resultado en `registro-de-pruebas.md`.
6. Guardar las evidencias correspondientes, cuando sea necesario.
7. Marcar cada caso de prueba como aprobado, fallido o pendiente, según el resultado.

## 4. Ejecución de pruebas automatizadas

Cuando se encuentren configuradas las pruebas automatizadas de Laravel, se debe:

1. Abrir la terminal en la carpeta del proyecto.
2. Ejecutar el siguiente comando:

   ```bash
   php artisan test
   ```

3. Revisar los resultados de ejecución.
4. Identificar las pruebas fallidas.
5. Registrar los resultados obtenidos.
6. Reportar los defectos encontrados.

## 5. Reporte de errores

Cuando se encuentre un defecto durante las pruebas, se debe:

- Asignar un identificador al defecto.
- Describir el problema encontrado.
- Indicar los pasos necesarios para reproducirlo.
- Registrar el resultado esperado y el resultado obtenido.
- Adjuntar la evidencia correspondiente.
- Registrar el defecto en `registro-de-errores.md`.
- Comunicarlo al responsable de desarrollo para su revisión y corrección.

## 6. Verificación de correcciones

Cuando el equipo informe que un defecto fue corregido, se deben realizar los siguientes pasos:

1. Repetir el caso de prueba que presentó el problema.
2. Comprobar que la funcionalidad opere correctamente.
3. Actualizar el estado del defecto en el registro de errores.
4. Ejecutar pruebas de regresión cuando corresponda, para comprobar que la corrección no afecte otras funcionalidades.

## 7. Responsabilidad

El líder de pruebas, Stiven, coordina el diseño, la ejecución, el seguimiento y la documentación de las pruebas de StayBook. También debe registrar los resultados y comunicar los defectos encontrados al equipo de desarrollo.

## 8. Estado

**Estado del documento:** Procedimiento definido para la ejecución y seguimiento de las pruebas.

El procedimiento podrá actualizarse cuando se incorporen nuevas funcionalidades o cambie la estructura de la aplicación.