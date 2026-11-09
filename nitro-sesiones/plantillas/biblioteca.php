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
        <p>Describe la sesión por finalidad, objetivos, posición en el calendario, organización y carga. Una sesión de víspera puede ser táctica por contenido, de ensayo por secuencia y de baja carga por dosificación.</p>
        <p>Una sesión focalizada tiene un objetivo prioritario. Una sesión mixta reserva dosis, oportunidades y criterios de logro para al menos dos objetivos. Puede jerarquizarlos, organizarlos por bloques o integrarlos en la misma tarea.</p>
        <p><strong>Objetivo observable.</strong> Escribe conducta, contexto y criterio. Por ejemplo, ante una ayuda que cierra la penetración en 3 contra 3, el jugador identifica el pase al pivote libre en al menos 6 de 10 oportunidades elegibles. Ajusta la meta a la línea de base y registra por separado decisión y ejecución.</p>
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
            <p>Las etiquetas se refieren a la pareja en un escenario típico. La dirección importa: el orden A → B puede dar un resultado distinto de B → A. Sinergia indica una oportunidad de integración. Interferencia indica que un objetivo puede restar calidad o disponibilidad al otro. Condicionada indica que la compatibilidad depende de la dosis, el orden o el contexto.</p>
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
        <?php foreach ( $relaciones as $clave => list( $a, $b, $tipo, $nivel, $citas, $nota, $ventaja, $limite ) ) : ?>
            <details class="ns-ficha" id="<?php echo esc_attr( $id . '-' . $clave ); ?>" data-ns-ficha="<?php echo esc_attr( "$a $b $tipo $nivel" ); ?>">
                <summary><span class="ns-etiqueta ns-<?php echo esc_attr( $tipo ); ?>"><?php echo esc_html( $simbolos[ $tipo ] . ' ' . $tipos[ $tipo ] ); ?></span> <?php echo esc_html( $familias[ $a ][0] . ' + ' . $familias[ $b ][0] ); ?></summary>
                <div>
                    <p><strong>Evidencia.</strong> <?php echo esc_html( $niveles[ $nivel ] ); ?></p>
                    <p><strong>Secuencia y aplicación al balonmano.</strong> <?php echo esc_html( $nota ); ?></p>
                    <p><strong>Ventaja.</strong> <?php echo esc_html( $ventaja ); ?></p>
                    <p><strong>Limitación.</strong> <?php echo esc_html( $limite ); ?></p>
                    <p><strong>Referencias y alcance.</strong></p>
                    <ul>
                        <?php foreach ( explode( ',', $citas ) as $cita ) : ?>
                            <li><?php echo nitro_sesiones_enlace( $fuentes[ $cita ] ); ?>. <?php echo esc_html( $fuentes[ $cita ][3] ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </details>
        <?php endforeach; ?>
        <h4>Tres mecanismos de interferencia</h4>
        <dl class="ns-mecanismos">
            <dt>Fatiga aguda</dt><dd>La primera tarea cambia el rendimiento de la segunda. Por ejemplo, mide velocidad y precisión de lanzamiento por separado antes y después de oleadas. <?php echo nitro_sesiones_enlace( $fuentes['fatiga'] ); ?></dd>
            <dt>Adaptación a largo plazo</dt><dd>Una adaptación resulta menor al combinar estímulos que al aplicar uno por separado. La fuerza explosiva mostró mayor sensibilidad al trabajo concurrente en la misma sesión que la fuerza máxima o la hipertrofia. Si importa la fuerza dinámica de piernas y se combina con resistencia, el orden fuerza → resistencia cuenta con respaldo para ese desenlace. <?php echo nitro_sesiones_enlace( $fuentes['concurrente'] ); ?> · <?php echo nitro_sesiones_enlace( $fuentes['orden_concurrente'] ); ?></dd>
            <dt>Interferencia pedagógica u organizativa</dt><dd>Dos consignas, escaso espacio o roles desiguales restan oportunidades a la prioridad. Un 6 contra 6 puede ofrecer pocas recepciones útiles por puesto. Reduce la complejidad, reorganiza los roles y vuelve a medir. <?php echo nitro_sesiones_enlace( $fuentes['desafio'] ); ?> · <?php echo nitro_sesiones_enlace( $fuentes['reducidos'] ); ?></dd>
        </dl>
        <p><strong>Cómo resolver un conflicto.</strong> Identifica el objetivo que pierde calidad. Ajusta una variable, como orden, dosis, pausas o espacio. Comprueba el indicador en la tanda siguiente. Separa los bloques en el microciclo si ambos pierden calidad cuando se realizan en segundo lugar.</p>
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
            <?php foreach ( $arquitecturas as $indice => list( $nombre, $a, $b, $orden, $contexto, $objetivo, $material, $medida, $tareas, $ventaja, $limite ) ) : ?>
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
                    <p><strong>Ventaja.</strong> <?php echo esc_html( $ventaja ); ?></p>
                    <p><strong>Límite y ajuste.</strong> <?php echo esc_html( $limite ); ?></p>
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

    <?php require __DIR__ . '/taller.php'; ?>

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
        <p>Los títulos se describen en castellano. Los enlaces llevan al registro o al texto original. Las notas resumen el resultado y su alcance para el diseño de sesiones.</p>
        <div class="ns-filtros" data-ns-controles hidden>
            <label>Buscar referencias <input type="search" data-ns-buscar-fuente placeholder="Autor, título o tema"></label>
            <?php foreach ( array( 4 => 'Tema', 5 => 'Diseño de estudio' ) as $campo => $etiqueta ) : ?>
                <label><?php echo esc_html( $etiqueta ); ?> <select data-ns-filtro-fuente="<?php echo esc_attr( $campo ); ?>">
                    <option value="">Todos</option>
                    <?php foreach ( array_unique( array_column( $fuentes, $campo ) ) as $opcion ) : ?>
                        <option value="<?php echo esc_attr( $opcion ); ?>"><?php echo esc_html( $opcion ); ?></option>
                    <?php endforeach; ?>
                </select></label>
            <?php endforeach; ?>
            <button type="button" data-ns-limpiar-fuentes>Limpiar búsqueda</button>
            <p class="ns-estado" role="status" data-ns-cuenta-fuentes></p>
        </div>
        <ol class="ns-bibliografia">
            <?php foreach ( $fuentes as $fuente ) : ?>
                <li data-ns-fuente data-tema="<?php echo esc_attr( $fuente[4] ); ?>" data-diseno="<?php echo esc_attr( $fuente[5] ); ?>">
                    <p class="ns-ceja"><?php echo esc_html( $fuente[4] . ' · ' . $fuente[5] ); ?></p>
                    <p><strong><?php echo esc_html( $fuente[1] ); ?>.</strong> <?php echo esc_html( $fuente[3] ); ?></p>
                    <p><?php echo nitro_sesiones_enlace( $fuente ); ?>
                    <?php foreach ( array( 6 => 'Texto completo', 7 => 'PDF del artículo' ) as $campo => $etiqueta ) : ?>
                        <?php if ( $fuente[ $campo ] ) : ?>
                            · <a href="<?php echo esc_url( $fuente[ $campo ], array( 'https' ) ); ?>" aria-label="<?php echo esc_attr( $etiqueta . ' · ' . $fuente[0] ); ?>"><?php echo esc_html( $etiqueta ); ?></a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </p>
                </li>
            <?php endforeach; ?>
        </ol>
    </section>
</section>
