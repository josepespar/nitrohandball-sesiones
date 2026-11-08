<?php
// Prueba autónoma de datos y renderizado. WordPress Playground cubre la instalación real.
define( 'ABSPATH', __DIR__ );
error_reporting( E_ALL );
set_error_handler( static function ( $nivel, $mensaje ) {
    throw new RuntimeException( $mensaje, $nivel );
} );

function add_action( $evento, $funcion ) { $GLOBALS['acciones'][ $evento ] = $funcion; }
function add_shortcode( $etiqueta, $funcion ) { $GLOBALS['shortcodes'][ $etiqueta ] = $funcion; }
function wp_enqueue_script( $nombre ) { $GLOBALS['scripts'][] = $nombre; }
function wp_enqueue_style( $nombre ) { $GLOBALS['estilos'][] = $nombre; }
function wp_register_script( $nombre ) { $GLOBALS['registrados'][] = $nombre; }
function plugins_url( $ruta ) { return '/' . $ruta; }
function wp_unique_id( $prefijo ) { static $id = 0; return $prefijo . ++$id; }
function esc_attr( $texto ) { return esc_html( $texto ); }
function esc_html( $texto ) { return htmlspecialchars( (string) $texto, ENT_QUOTES, 'UTF-8' ); }
function esc_url( $url, $protocolos ) {
    return in_array( parse_url( $url, PHP_URL_SCHEME ), $protocolos, true ) ? esc_attr( $url ) : '';
}
function wp_json_encode( $datos, $opciones ) { return json_encode( $datos, $opciones ); }

function comprobar( $condicion, $mensaje ) {
    if ( ! $condicion ) {
        throw new RuntimeException( $mensaje );
    }
}

require __DIR__ . '/../nitro-sesiones/nitro-sesiones.php';
$datos = nitro_sesiones_datos();
$familias = array_keys( $datos['familias'] );
comprobar( count( $familias ) === 12, 'Se esperan 12 familias.' );
comprobar( count( $datos['arquitecturas'] ) === 12, 'Se esperan 12 arquitecturas.' );
comprobar( count( $datos['relaciones'] ) === 66, 'Se esperan 66 parejas únicas.' );

foreach ( $familias as $i => $a ) {
    foreach ( array_slice( $familias, $i + 1 ) as $b ) {
        comprobar( isset( $datos['relaciones'][ "$a-$b" ] ), "Falta la relación $a-$b." );
    }
}
foreach ( $datos['relaciones'] as list( $a, $b, $tipo, $nivel, $citas, $nota ) ) {
    comprobar( in_array( $tipo, array( 'sinergia', 'interferencia', 'condicionada' ), true ), "Tipo de relación inválido en $a-$b." );
    comprobar( in_array( $nivel, array( 'directa', 'indirecta', 'criterio' ), true ), "Evidencia inválida en $a-$b." );
    comprobar( trim( $nota ) !== '', "Falta nota en $a-$b." );
    foreach ( explode( ',', $citas ) as $cita ) {
        comprobar( isset( $datos['fuentes'][ $cita ] ), "Falta la fuente $cita." );
    }
}
foreach ( $datos['fuentes'] as list( $autor, $titulo, $url, $resumen ) ) {
    comprobar( filter_var( $url, FILTER_VALIDATE_URL ) && parse_url( $url, PHP_URL_SCHEME ) === 'https', "Enlace inválido para $autor." );
    comprobar( $titulo && $resumen, "Ficha bibliográfica incompleta para $autor." );
}
foreach ( $datos['secuencias'] as list( $nombre, $ventaja, $riesgo, $cita ) ) {
    comprobar( $nombre && $ventaja && $riesgo && isset( $datos['fuentes'][ $cita ] ), 'Secuencia incompleta.' );
}
$prioridades = array();
foreach ( $datos['arquitecturas'] as list( $nombre, $a, $b, $secuencia, $contexto, $objetivo, $material, $indicador, $tareas ) ) {
    comprobar( isset( $datos['relaciones'][ "$a-$b" ] ) || isset( $datos['relaciones'][ "$b-$a" ] ), "Objetivos inválidos en $nombre." );
    comprobar( isset( $datos['secuencias'][ $secuencia ] ) && $contexto && $objetivo && $material && $indicador, "Ejemplo incompleto en $nombre." );
    comprobar( array_sum( array_column( $tareas, 0 ) ) === 90, "$nombre no suma 90 minutos." );
    foreach ( $tareas as list( $minutos, $actividad ) ) {
        comprobar( is_int( $minutos ) && $minutos > 0 && $actividad, "Tarea inválida en $nombre." );
    }
    $prioridades[ $a ] = true;
}
comprobar( count( $prioridades ) === 12, 'Cada familia debe tener un ejemplo prioritario.' );
$GLOBALS['acciones']['wp_enqueue_scripts']();
comprobar( $GLOBALS['estilos'] === array( 'nitro-sesiones' ), 'Falta la hoja de estilos.' );
comprobar( $GLOBALS['registrados'] === array( 'nitro-sesiones' ), 'Falta el registro de JavaScript.' );
$shortcode = $GLOBALS['shortcodes']['nitro_sesiones'];
$primero = $shortcode();
$segundo = $shortcode();
comprobar( $GLOBALS['scripts'][0] === 'nitro-sesiones', 'El shortcode debe cargar JavaScript.' );
comprobar( substr_count( $primero, 'data-ns-celda ' ) === 66, 'El shortcode debe mostrar 66 enlaces en la matriz.' );
comprobar( substr_count( $primero, 'data-ns-ficha=' ) === 66, 'El shortcode debe mostrar 66 fichas.' );
comprobar( substr_count( $primero, 'data-ns-arquitectura=' ) === 12, 'El shortcode debe mostrar 12 ejemplos.' );
preg_match_all( '/\sid="([^"]+)"/', $primero . $segundo, $coincidencias );
comprobar( count( $coincidencias[1] ) === count( array_unique( $coincidencias[1] ) ), 'Hay ID repetidos entre instancias.' );

if ( in_array( '--html', $argv, true ) ) {
    echo '<!doctype html><html lang="es"><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Pruebas Nitro</title>';
    echo '<link rel="stylesheet" href="/nitro-sesiones/assets/sesiones.css"><body><main>' . $primero . $segundo . '</main>';
    echo '<script src="/nitro-sesiones/assets/sesiones.js" defer></script></body></html>';
} else {
    echo "Datos, recursos y renderizado correctos.\n";
}
