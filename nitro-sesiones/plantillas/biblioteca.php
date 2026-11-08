<?php defined( 'ABSPATH' ) || exit; ?>
<section class="nitro-sesiones" aria-labelledby="<?php echo esc_attr( $id . '-titulo' ); ?>" lang="es">
    <header class="ns-cabecera">
        <p class="ns-marca">Nitro Handball <span>·</span> Recursos para entrenadores</p>
        <h2 id="<?php echo esc_attr( $id . '-titulo' ); ?>">Diseña tu próxima sesión</h2>
        <p>Elige qué entrenar, combina objetivos y ordena tus tareas con ejemplos de balonmano y referencias científicas.</p>
        <nav aria-label="Secciones del recurso">
            <?php foreach ( array( 'introduccion' => 'La sesión', 'familias' => 'Objetivos', 'matriz' => 'Matriz', 'arquitecturas' => 'Sesiones de 90 min', 'configurador' => 'Configurador', 'fuentes' => 'Bibliografía' ) as $ancla => $nombre ) : ?>
                <a href="#<?php echo esc_attr( $id . '-' . $ancla ); ?>"><?php echo esc_html( $nombre ); ?></a>
            <?php endforeach; ?>
        </nav>
    </header>

    <?php require __DIR__ . '/introduccion.php'; ?>

    <section class="ns-seccion" id="<?php echo esc_attr( $id . '-familias' ); ?>">
        <p class="ns-ceja">01 · Clasificación</p>
        <h3>Doce familias de objetivos</h3>
        <p>Define primero qué conducta o capacidad quieres observar. Una tarea puede servir a varios objetivos según sus reglas y su carga.</p>
        <div class="ns-tarjetas">
            <?php foreach ( $familias as $familia ) : ?>
                <details class="ns-tarjeta">
                    <summary><?php echo esc_html( $familia[0] ); ?></summary>
                    <p><?php echo esc_html( $familia[1] ); ?></p>
                    <p><strong>Ejemplo.</strong> <?php echo esc_html( $familia[2] ); ?></p>
                    <p><strong>Indicador.</strong> <?php echo esc_html( $familia[3] ); ?></p>
                </details>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="ns-seccion" id="<?php echo esc_attr( $id . '-matriz' ); ?>">
        <p class="ns-ceja">02 · Compatibilidad</p>
        <h3>Matriz de sinergias e interferencias</h3>
        <p id="<?php echo esc_attr( $id . '-leyenda' ); ?>">Selecciona una celda para consultar la propuesta y su fuente. Cada pareja aparece una vez. Desplaza la tabla lateralmente para ver todas las columnas.</p>
        <ul class="ns-leyenda">
            <?php foreach ( $tipos as $clave => $nombre ) : ?>
                <li class="ns-<?php echo esc_attr( $clave ); ?>"><?php echo esc_html( $simbolos[ $clave ] . ' ' . $nombre ); ?></li>
            <?php endforeach; ?>
        </ul>
        <details class="ns-metodo">
            <summary>Cómo interpretar la matriz y los niveles de evidencia</summary>
            <p>Sinergia indica una oportunidad de integración. Interferencia indica que un objetivo puede restar calidad o disponibilidad al otro. Condicionada indica que la compatibilidad depende de la dosis, el orden o el contexto.</p>
            <ul>
                <li><strong>Directa (componente).</strong> El estudio midió en balonmano al menos un efecto o una respuesta central para el vínculo. La secuencia propuesta puede ser una extrapolación.</li>
                <li><strong>Indirecta.</strong> La fuente estudia una población, una tarea o un desenlace próximo al vínculo.</li>
                <li><strong>Criterio práctico.</strong> La propuesta aplica principios relacionados al diseño. La fuente aporta contexto y la relación carece de una prueba específica en la bibliografía incluida.</li>
            </ul>
            <p>La escala describe la aplicabilidad de las fuentes. Una celda no cuantifica un efecto ni equivale a una evaluación formal de certeza.</p>
        </details>
        <div class="ns-desplazable" tabindex="0" role="region" aria-label="Matriz desplazable de objetivos">
            <table aria-describedby="<?php echo esc_attr( $id . '-leyenda' ); ?>">
                <caption>Compatibilidad entre familias de objetivos</caption>
                <thead><tr><th scope="col">Objetivo</th>
                    <?php foreach ( $familias as $familia ) : ?>
                        <th scope="col"><?php echo esc_html( $familia[0] ); ?></th>
                    <?php endforeach; ?>
                </tr></thead>
                <tbody>
                    <?php foreach ( $familias as $a => $familia ) : ?>
                        <tr><th scope="row"><?php echo esc_html( $familia[0] ); ?></th>
                        <?php foreach ( $familias as $b => $otra ) : ?>
                            <?php $par = $relaciones[ $a . '-' . $b ] ?? null; ?>
                            <td>
                                <?php if ( $par ) : ?>
                                    <a class="ns-celda ns-<?php echo esc_attr( $par[2] ); ?>" data-ns-celda href="#<?php echo esc_attr( $id . '-' . $a . '-' . $b ); ?>" aria-label="<?php echo esc_attr( $familia[0] . ' y ' . $otra[0] . ', ' . $tipos[ $par[2] ] ); ?>"><?php echo esc_html( $simbolos[ $par[2] ] ); ?></a>
                                <?php else : ?>
                                    <span aria-hidden="true">·</span>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <h4>Fichas de relaciones</h4>
        <div class="ns-filtros" data-ns-controles hidden>
            <label>Familia <select data-ns-familia><option value="">Todas</option>
                <?php foreach ( $familias as $clave => $familia ) : ?>
                    <option value="<?php echo esc_attr( $clave ); ?>"><?php echo esc_html( $familia[0] ); ?></option>
                <?php endforeach; ?>
            </select></label>
            <label>Relación <select data-ns-tipo><option value="">Todas</option>
                <?php foreach ( $tipos as $clave => $nombre ) : ?>
                    <option value="<?php echo esc_attr( $clave ); ?>"><?php echo esc_html( $nombre ); ?></option>
                <?php endforeach; ?>
            </select></label>
            <label>Evidencia <select data-ns-nivel><option value="">Todos los niveles</option>
                <?php foreach ( $niveles as $clave => $nombre ) : ?>
                    <option value="<?php echo esc_attr( $clave ); ?>"><?php echo esc_html( $nombre ); ?></option>
                <?php endforeach; ?>
            </select></label>
            <p class="ns-estado" role="status" data-ns-cuenta></p>
        </div>
        <?php foreach ( $relaciones as $clave => list( $a, $b, $tipo, $nivel, $citas, $nota ) ) : ?>
            <details class="ns-ficha" id="<?php echo esc_attr( $id . '-' . $clave ); ?>" data-ns-ficha="<?php echo esc_attr( "$a $b $tipo $nivel" ); ?>">
                <summary><span class="ns-etiqueta ns-<?php echo esc_attr( $tipo ); ?>"><?php echo esc_html( $simbolos[ $tipo ] . ' ' . $tipos[ $tipo ] ); ?></span> <?php echo esc_html( $familias[ $a ][0] . ' + ' . $familias[ $b ][0] ); ?></summary>
                <div>
                    <p><strong>Evidencia.</strong> <?php echo esc_html( $niveles[ $nivel ] ); ?></p>
                    <p><?php echo esc_html( $nota ); ?></p>
                    <ul>
                        <?php foreach ( explode( ',', $citas ) as $cita ) : ?>
                            <li><?php echo nitro_sesiones_enlace( $fuentes[ $cita ] ); ?>. <?php echo esc_html( $fuentes[ $cita ][3] ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </details>
        <?php endforeach; ?>
    </section>

    <section class="ns-seccion" id="<?php echo esc_attr( $id . '-arquitecturas' ); ?>">
        <p class="ns-ceja">03 · De la idea a la pista</p>
        <h3>Doce arquitecturas de 90 minutos</h3>
        <p>Los tiempos incluyen pausas, explicaciones y transiciones. Las propuestas prepartido y pospartido incluyen trabajo fuera de pista.</p>
        <label class="ns-filtro-contexto" data-ns-controles hidden>Contexto <select data-ns-contexto>
            <option value="">Todos</option>
            <?php foreach ( array_unique( array_column( $arquitecturas, 4 ) ) as $contexto ) : ?>
                <option><?php echo esc_html( $contexto ); ?></option>
            <?php endforeach; ?>
        </select></label>
        <p class="ns-estado" role="status" data-ns-cuenta-arquitecturas></p>
        <div class="ns-tarjetas">
            <?php foreach ( $arquitecturas as $indice => list( $nombre, $a, $b, $orden, $contexto, $objetivo, $material, $medida, $tareas ) ) : ?>
                <details class="ns-tarjeta" data-ns-arquitectura="<?php echo esc_attr( $contexto ); ?>">
                    <summary><?php echo esc_html( $nombre ); ?> <small><?php echo esc_html( $contexto ); ?></small></summary>
                    <p><strong><?php echo esc_html( $familias[ $a ][0] . ' + ' . $familias[ $b ][0] ); ?></strong></p>
                    <p><?php echo esc_html( $objetivo ); ?></p>
                    <p><strong>Material.</strong> <?php echo esc_html( $material ); ?></p>
                    <ol>
                        <?php foreach ( $tareas as list( $minutos, $tarea ) ) : ?>
                            <li><strong><?php echo esc_html( $minutos ); ?> min</strong> · <?php echo esc_html( $tarea ); ?></li>
                        <?php endforeach; ?>
                    </ol>
                    <p><strong>Indicador.</strong> <?php echo esc_html( $medida ); ?></p>
                    <p><strong>Secuencia.</strong> <?php echo esc_html( $secuencias[ $orden ][0] ); ?></p>
                    <button type="button" data-ns-cargar="<?php echo esc_attr( $indice ); ?>" hidden>Usar en el configurador</button>
                </details>
            <?php endforeach; ?>
        </div>
        <h4>Ventajas y desventajas de cada secuencia</h4>
        <div class="ns-tarjetas">
            <?php foreach ( $secuencias as list( $nombre, $ventaja, $riesgo, $cita ) ) : ?>
                <details class="ns-tarjeta">
                    <summary><?php echo esc_html( $nombre ); ?></summary>
                    <p><strong>Ventaja.</strong> <?php echo esc_html( $ventaja ); ?></p>
                    <p><strong>Desventaja.</strong> <?php echo esc_html( $riesgo ); ?></p>
                    <p>Fuente de contexto. <?php echo nitro_sesiones_enlace( $fuentes[ $cita ] ); ?></p>
                </details>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="ns-seccion ns-config" id="<?php echo esc_attr( $id . '-configurador' ); ?>">
        <p class="ns-ceja">04 · Plan de entrenamiento</p>
        <h3>Configurador de sesión</h3>
        <noscript><p>Activa JavaScript para editar y exportar el plan. Los ejemplos y las referencias siguen disponibles arriba.</p></noscript>
        <form data-ns-form hidden>
            <div class="ns-filtros">
                <label>Arquitectura <select name="modelo">
                    <?php foreach ( $arquitecturas as $indice => $arquitectura ) : ?>
                        <option value="<?php echo esc_attr( $indice ); ?>"><?php echo esc_html( $arquitectura[0] ); ?></option>
                    <?php endforeach; ?>
                </select></label>
                <button type="button" data-ns-restaurar>Restaurar ejemplo</button>
                <label>Duración prevista (min) <input name="duracion" type="number" min="5" max="240" required value="90"></label>
            </div>
            <p>Seleccionar una arquitectura carga su ejemplo. Ajusta el orden, la duración y el texto de las tareas a tu equipo.</p>
            <div class="ns-filtros">
                <label>Objetivo principal <select name="principal">
                    <?php foreach ( $familias as $clave => $familia ) : ?>
                        <option value="<?php echo esc_attr( $clave ); ?>"><?php echo esc_html( $familia[0] ); ?></option>
                    <?php endforeach; ?>
                </select></label>
                <label>Objetivo secundario <select name="secundario">
                    <?php foreach ( $familias as $clave => $familia ) : ?>
                        <option value="<?php echo esc_attr( $clave ); ?>"><?php echo esc_html( $familia[0] ); ?></option>
                    <?php endforeach; ?>
                </select></label>
                <label>Secuencia <select name="secuencia">
                    <?php foreach ( $secuencias as $clave => $secuencia ) : ?>
                        <option value="<?php echo esc_attr( $clave ); ?>"><?php echo esc_html( $secuencia[0] ); ?></option>
                    <?php endforeach; ?>
                </select></label>
            </div>
            <p data-ns-compatibilidad aria-live="polite"></p>
            <p data-ns-orden></p>
            <label>Nombre de la sesión <input name="titulo" type="text" required maxlength="120"></label>
            <label>Objetivo operativo <textarea name="objetivo" rows="2" maxlength="400" required></textarea></label>
            <label>Material y organización <textarea name="material" rows="2" maxlength="400"></textarea></label>
            <label>Indicador de éxito <textarea name="indicador" rows="2" maxlength="400" required></textarea></label>
            <fieldset><legend>Tareas en orden de ejecución</legend>
                <div data-ns-tareas></div>
                <button type="button" data-ns-agregar>Añadir tarea</button>
            </fieldset>
            <p data-ns-total role="status"></p>
            <button class="ns-accion" type="submit">Imprimir o guardar como PDF</button>
        </form>
        <script type="application/json" data-ns-datos><?php
            // Los indicadores HEX impiden cerrar el bloque de datos desde una cadena.
            echo wp_json_encode( array( 'arquitecturas' => $arquitecturas, 'relaciones' => $relaciones, 'secuencias' => $secuencias, 'tipos' => $tipos, 'niveles' => $niveles, 'fuentes' => $fuentes ), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT );
        ?></script>
    </section>

    <section class="ns-seccion" id="<?php echo esc_attr( $id . '-fuentes' ); ?>">
        <p class="ns-ceja">05 · Lecturas</p>
        <h3>Bibliografía</h3>
        <p>Los títulos están descritos en castellano. Los enlaces llevan al registro o al texto original.</p>
        <ol class="ns-bibliografia">
            <?php foreach ( $fuentes as $fuente ) : ?>
                <li><?php echo nitro_sesiones_enlace( $fuente ); ?>. <strong><?php echo esc_html( $fuente[1] ); ?>.</strong> <?php echo esc_html( $fuente[3] ); ?></li>
            <?php endforeach; ?>
        </ol>
    </section>
</section>
