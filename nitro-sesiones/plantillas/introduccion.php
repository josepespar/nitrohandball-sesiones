<?php defined( 'ABSPATH' ) || exit;

$fases = array(
    'Parte principal',
    'Análisis',
    'Información',
    'Vuelta a la calma o readaptación',
    'Calentamiento o adaptación',
);

$actividades = array(
    array(
        'Ordena las fases',
        'Selecciona la fase que corresponde a cada posición. Usa cada fase una sola vez.',
        array(
            array( '1.ª fase', $fases, 2, 'Presenta el objetivo y qué observará el equipo.' ),
            array( '2.ª fase', $fases, 4, 'Eleva la exigencia de forma gradual y prepara las acciones del bloque central.' ),
            array( '3.ª fase', $fases, 0, 'Dedica este bloque a las tareas que trabajan directamente el objetivo.' ),
            array( '4.ª fase', $fases, 3, 'Reduce la intensidad para facilitar la transición al reposo.' ),
            array( '5.ª fase', $fases, 1, 'Revisa con el grupo qué ocurrió y qué conviene retomar.' ),
        ),
    ),
    array(
        'Decide como entrenador',
        'Elige una respuesta para cada situación y comprueba tu razonamiento.',
        array(
            array(
                'Después de la movilidad general, el equipo va a entrenar el lanzamiento en salto. ¿Qué encaja en el calentamiento específico?',
                array( 'Un partido completo con oposición máxima', 'Aproximaciones y lanzamientos de exigencia creciente', 'La valoración del trabajo realizado' ),
                1,
                'Los apoyos, saltos y lanzamientos progresivos acercan al equipo a lo que hará en la parte principal.',
            ),
            array(
                'Se forma una cola larga en una tarea de pase. ¿Qué cambio conserva el objetivo y aumenta la participación?',
                array( 'Mantener una fila y alargar la tarea', 'Eliminar a quienes fallen', 'Montar dos estaciones y rotar en grupos pequeños' ),
                2,
                'Con estaciones paralelas hay más oportunidades por jugador. Conserva las pausas que requiera la tarea.',
            ),
            array(
                'Quieres saber si el equipo reconoce cuándo pasar al pivote. ¿Qué anotarías en la ficha de evaluación?',
                array( 'Decisiones adecuadas por oportunidad de pase', 'Solo los goles totales', 'Solo el tiempo de juego' ),
                0,
                'Observar decisiones por oportunidad vincula el registro al objetivo, incluso si el lanzamiento posterior no acaba en gol.',
            ),
            array(
                'En iniciación, el equipo pierde el partido pero prueba la acción que trabajó. ¿Cómo cierras la jornada?',
                array( 'Valorar únicamente el marcador', 'Reconocer los intentos y comentar una decisión que se puede mejorar', 'Reducir la participación de quienes se equivocaron' ),
                1,
                'En iniciación, el partido sirve para aprender y evaluar la aplicación de lo practicado. El resultado es un dato más.',
            ),
        ),
    ),
);
?>
<section class="ns-seccion" id="<?php echo esc_attr( $id . '-introduccion' ); ?>">
    <p class="ns-ceja">00 · Fundamentos</p>
    <h3>La sesión de entrenamiento</h3>
    <p>La sesión lleva a la pista lo previsto en la programación. Antes de elegir ejercicios, concreta qué quieres que el grupo aprenda, practique o demuestre. Después, ordena tareas que permitan trabajar ese objetivo y observar el resultado. Ajusta la duración, las pausas y la dificultad al grupo, a la instalación y al propósito de la sesión.</p>
    <p>El tema distingue sesiones de aprendizaje, acondicionamiento físico, recreación y evaluación. El acondicionamiento puede orientarse al mantenimiento, el desarrollo o la recuperación. Más abajo, la biblioteca desglosa estos propósitos en doce familias para diseñar sesiones mixtas.</p>

    <h4>Las cinco fases</h4>
    <p>Este ejemplo de 90 minutos enseña a decidir entre penetrar y pasar al pivote. La duración de cada fase se ajusta al objetivo y al grupo.</p>
    <ol>
        <li><strong>Información · 5 min.</strong> Explica con una consigna breve qué se pretende y cómo se reconocerá una buena decisión. Pide al grupo que identifique la señal defensiva que deberá observar.</li>
        <li><strong>Calentamiento o adaptación · 15 min.</strong> Empieza con movilidad y desplazamientos. Pasa después a recepciones orientadas, cambios de dirección y pases con una oposición suave, preparando las acciones del trabajo central.</li>
        <li><strong>Parte principal · 55 min.</strong> Dedica 15 min a practicar la recepción orientada, 20 min a leer la ayuda en 2 contra 1 y 20 min a aplicar la decisión en 3 contra 3. Aumenta la dificultad cuando la consigna se vea en el juego. Puedes combinar tareas técnicas, tácticas, físicas, lúdicas o recreativas según el objetivo.</li>
        <li><strong>Vuelta a la calma o readaptación · 10 min.</strong> Reduce el ritmo con pases sin oposición y movilidad cómoda. Ajusta el cierre a la exigencia que tuvo el bloque principal.</li>
        <li><strong>Análisis · 5 min.</strong> Pregunta qué señal facilitó el pase al pivote. Compara la respuesta con lo observado y acuerda qué probaréis en la próxima sesión.</li>
    </ol>

    <h4>De la ficha a la pista</h4>
    <p>Anota la duración, los objetivos, los contenidos y cómo se enlazan las tareas. Incluye la forma de enseñar, la organización de los grupos, el espacio, el material y el criterio de evaluación. Un croquis puede ayudar cuando hay varias zonas o rotaciones.</p>
    <p>Al dirigir, vincula la tarea a los intereses del grupo, explica con claridad y demuestra si hace falta. Alterna esfuerzo y descanso, prepara las transiciones para reducir esperas y adapta la exigencia a cada participante. Corrige una acción concreta, reconoce los avances y ofrece una variante cuando el grupo domine la tarea.</p>

    <h4>La competición como contexto de aprendizaje</h4>
    <p>En iniciación, valora la participación, el disfrute y la aplicación de lo practicado. Cuando el rendimiento competitivo sea prioritario, incorpora el plan de partido, los recursos del equipo y las posibles respuestas al rival. En ambos contextos, cuida el respeto, la comunicación y la gestión de la presión. Usa lo observado en el partido para orientar el siguiente entrenamiento.</p>
    <p><small>Adaptación didáctica de <cite>Tema 5. La sesión</cite>, págs. 1–10, con un ejemplo y actividades propios de balonmano.</small></p>

    <h4>Practica lo aprendido</h4>
    <?php foreach ( $actividades as list( $titulo, $consigna, $preguntas ) ) : ?>
        <details class="ns-tarjeta ns-practica">
            <summary><?php echo esc_html( $titulo ); ?></summary>
            <p><?php echo esc_html( $consigna ); ?></p>
            <form data-ns-practica hidden>
                <?php foreach ( $preguntas as list( $pregunta, $opciones, $correcta, $explicacion ) ) : ?>
                    <div class="ns-pregunta" data-ns-respuesta="<?php echo esc_attr( $correcta ); ?>">
                        <label><?php echo esc_html( $pregunta ); ?>
                            <select required>
                                <option value="">Elige una opción</option>
                                <?php foreach ( $opciones as $indice => $opcion ) : ?>
                                    <option value="<?php echo esc_attr( $indice ); ?>"><?php echo esc_html( $opcion ); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                        <p data-ns-feedback hidden><strong></strong> <?php echo esc_html( $explicacion ); ?></p>
                    </div>
                <?php endforeach; ?>
                <button type="submit">Comprobar respuestas</button>
                <button type="reset">Volver a empezar</button>
                <p role="status" data-ns-puntuacion></p>
            </form>
            <details>
                <summary>Consultar soluciones</summary>
                <ol>
                    <?php foreach ( $preguntas as list( $pregunta, $opciones, $correcta, $explicacion ) ) : ?>
                        <li><strong><?php echo esc_html( $opciones[ $correcta ] ); ?>.</strong> <?php echo esc_html( $explicacion ); ?></li>
                    <?php endforeach; ?>
                </ol>
            </details>
        </details>
    <?php endforeach; ?>
</section>
