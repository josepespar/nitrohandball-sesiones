<?php
/**
 * Plugin Name: Nitro Handball · Diseño de sesiones
 * Description: Biblioteca y configurador de sesiones de entrenamiento con matriz de objetivos y referencias científicas.
 * Version: 1.1.0
 * Requires at least: 6.4
 * Requires PHP: 7.4
 * Author: Nitro Handball
 * License: GPL-2.0-or-later
 * Text Domain: nitro-sesiones
 */

defined( 'ABSPATH' ) || exit;

function nitro_sesiones_recursos() {
    // Cargar la hoja en la cabecera también cuando un maquetador renderiza el shortcode tarde.
    wp_enqueue_style( 'nitro-sesiones', plugins_url( 'assets/sesiones.css', __FILE__ ), array(), '1.1.0' );
    wp_register_script( 'nitro-sesiones', plugins_url( 'assets/sesiones.js', __FILE__ ), array(), '1.1.0', true );
}
add_action( 'wp_enqueue_scripts', 'nitro_sesiones_recursos' );

function nitro_sesiones_datos() {
    static $datos;
    if ( isset( $datos ) ) {
        return $datos;
    }

    $datos = array();
    foreach ( array( 'familias', 'arquitecturas', 'secuencias', 'fuentes' ) as $archivo ) {
        $ruta = __DIR__ . '/datos/' . $archivo . '.json';
        $datos[ $archivo ] = is_readable( $ruta ) ? json_decode( file_get_contents( $ruta ), true ) : null;
    }
    $datos['relaciones'] = array();
    $ruta = __DIR__ . '/datos/relaciones.tsv';
    if ( is_readable( $ruta ) ) {
        foreach ( file( $ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES ) as $linea ) {
            $relacion = explode( '|', $linea, 6 );
            if ( count( $relacion ) === 6 ) {
                $datos['relaciones'][ $relacion[0] . '-' . $relacion[1] ] = $relacion;
            }
        }
    }
    return $datos;
}

function nitro_sesiones_enlace( $fuente ) {
    return sprintf( '<a href="%s">%s</a>', esc_url( $fuente[2], array( 'https' ) ), esc_html( $fuente[0] ) );
}

function nitro_sesiones_shortcode() {
    $datos = nitro_sesiones_datos();
    if ( count( $datos['relaciones'] ) !== 66 || in_array( null, $datos, true ) ) {
        return '<p>La biblioteca de sesiones no está disponible en este momento.</p>';
    }

    wp_enqueue_script( 'nitro-sesiones' );
    $id = wp_unique_id( 'nitro-sesiones-' );
    $tipos = array( 'sinergia' => 'Sinergia', 'interferencia' => 'Interferencia', 'condicionada' => 'Condicionada' );
    $simbolos = array( 'sinergia' => '+', 'interferencia' => '−', 'condicionada' => '±' );
    $niveles = array( 'directa' => 'Directa (componente)', 'indirecta' => 'Indirecta', 'criterio' => 'Criterio práctico' );
    $familias = $datos['familias'];
    $arquitecturas = $datos['arquitecturas'];
    $secuencias = $datos['secuencias'];
    $fuentes = $datos['fuentes'];
    $relaciones = $datos['relaciones'];

    ob_start();
    require __DIR__ . '/plantillas/biblioteca.php';
    return ob_get_clean();
}
add_shortcode( 'nitro_sesiones', 'nitro_sesiones_shortcode' );
