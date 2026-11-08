# Nitro Handball · Diseño de sesiones

Plugin de WordPress en castellano para diseñar sesiones de deportes de equipo, con ejemplos de balonmano. Incluye 12 familias de objetivos, 66 relaciones con referencias, 12 arquitecturas de 90 minutos, ocho estrategias de secuenciación y un editor imprimible.

## Instalación en pruebas

1. Usa WordPress 6.4 o posterior y PHP 7.4 o posterior. Ejecuta `bash scripts/empaquetar.sh` para crear `dist/nitro-sesiones.zip`.
2. En WordPress, abre **Plugins → Añadir nuevo → Subir plugin**. Selecciona el ZIP y actívalo.
3. En una página de pruebas, inserta un bloque **Shortcode** con `[nitro_sesiones]`. Usa una plantilla de ancho completo si quieres mostrar más columnas de la matriz a la vez.
4. Comprueba la página publicada de pruebas con un usuario sin privilegios. Revisa la navegación con teclado, el desplazamiento lateral de la matriz, los filtros, los enlaces y la exportación.

## Uso

- Empieza por **La sesión**, una adaptación de *Tema 5. La sesión* con las cinco fases, un ejemplo de 90 minutos y dos prácticas con retroalimentación.

- Abre una familia para consultar su propósito, ejemplo e indicador. En la matriz, selecciona una pareja o filtra sus fichas por familia, tipo o evidencia.
- Filtra los ejemplos por contexto. Cada arquitectura combina dos objetivos y contiene un plan de 90 minutos, material, indicador y secuencia.
- Carga un ejemplo en el configurador. Cambia la combinación, el objetivo y el orden de las tareas. La duración prevista debe coincidir con la suma de las tareas.
- Pulsa **Imprimir o guardar como PDF**. En el diálogo del navegador, elige una impresora o **Guardar como PDF**. El documento contiene solo la sesión editada.

El configurador conserva los cambios mientras la página está abierta. Cambiar de arquitectura o restaurar el ejemplo sustituye las tareas editadas. La biblioteca, las fichas y los ejemplos se sirven como HTML y se pueden consultar sin JavaScript. Los filtros, el editor y la salida de impresión requieren JavaScript.

## Datos y evidencia

Los archivos de `nitro-sesiones/datos/` contienen el catálogo editorial. En `relaciones.tsv` cada línea tiene seis campos separados por `|`: familia A, familia B, tipo, evidencia, claves de citas separadas por comas y nota. Mantén el orden de familias de `familias.json` y una sola ficha por pareja. Las claves de cita deben existir en `fuentes.json`.

Las etiquetas **Directa (componente)**, **Indirecta** y **Criterio práctico** describen la aplicabilidad de las fuentes a cada relación. Incluso una fuente directa puede respaldar un solo componente y una población concreta. La matriz y los ejemplos son una síntesis editorial para planificar y ajustar tareas. La revisión de enlaces contrastó el registro del artículo, su resumen y la pertinencia de la cita. Los enlaces con DOI pueden llevar al registro editorial y requerir suscripción para acceder al texto completo.

## Pruebas y paquete

```sh
php tests/biblioteca.php
find nitro-sesiones tests -name '*.php' -exec php -l '{}' \;
node --check nitro-sesiones/assets/sesiones.js
bash scripts/empaquetar.sh
```

Las pruebas verifican las 66 parejas, sus citas, los minutos y datos de cada ejemplo, el HTML del shortcode y los ID entre instancias. La automatización de GitHub también prueba el teclado, los filtros, el editor y la salida de impresión en Chromium y genera el ZIP en cada ejecución. El paquete incluye únicamente los archivos del plugin.

El plugin no crea tablas, opciones ni usuarios y no envía el plan a ningún servidor. Para retirarlo, elimina el bloque Shortcode de la página y desactiva el plugin.
