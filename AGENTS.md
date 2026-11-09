# Mantenimiento con Codex

- El plugin está en `nitro-sesiones/`. Mantén el shortcode `[nitro_sesiones]` y el directorio del plugin para que las páginas existentes y la actualización por ZIP sigan funcionando.
- En `plantillas/introduccion.php`, conserva la nomenclatura y el orden de las cinco fases. Mantén los procesos de ANTES y DESPUÉS fuera de las fases.
- El orden de `datos/familias.json` determina el orden canónico de cada pareja. En `relaciones.tsv`, escribe ocho campos separados por `|`. Usa familia A, familia B, tipo, aplicabilidad, claves de citas, secuencia y ejemplo, ventaja y limitación. Mantén una ficha por pareja.
- `datos/arquitecturas.json` conserva los doce planes. Comprueba los 90 minutos, la prioridad, los indicadores y la separación funcional de las fases. El configurador usa los minutos agregados de cada bloque.
- En `datos/fuentes.json`, comprueba autoría, año, enlace y qué población, desenlace y comparación sustentan la cita. Diferencia evidencia directa para un componente, extrapolación y criterio práctico. Añade enlaces a PDFs solo tras comprobar procedencia y acceso.
- Escapa al renderizar y conserva la consulta sin JavaScript. Mantén filtros, focos e identificadores aislados entre shortcodes. Conserva la impresión del configurador.
- Ejecuta las pruebas PHP y Chromium de README. Genera el ZIP con `scripts/empaquetar.sh`. Mantén alineada la versión del plugin con la de sus recursos. Trabaja en rama y PR, y pide autorización explícita antes de publicar en producción.
