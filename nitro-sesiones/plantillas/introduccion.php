<?php defined( 'ABSPATH' ) || exit;

$fases = array(
    'Fase principal o de logro de objetivos',
    'Fase de reflexión',
    'Fase de información',
    'Fase final o de readaptación (vuelta a la calma)',
    'Fase inicial o de adaptación (calentamiento)',
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
<h4>Qué es una sesión de entrenamiento</h4>
<p>Una sesión es el momento en que llevas a la práctica una parte de la programación. Antes de salir a pista, decide qué quieres conseguir. A partir de ese objetivo, elige las actividades y ordénalas de modo que cada una ayude a avanzar hacia la meta.</p>
<h4>Cuatro finalidades de una sesión</h4>
<p><strong>Aprendizaje.</strong> El grupo descubre una técnica nueva o sigue practicando una que ya conoce, pero todavía no domina.</p>
<p><strong>Acondicionamiento físico.</strong> La carga de trabajo ocupa el centro de la sesión. Según cómo la ajustes, puedes desarrollar una capacidad física, mantenerla o favorecer la recuperación.</p>
<p><strong>Juego y recreación.</strong> La prioridad es que el grupo disfrute de la actividad física y tenga ganas de participar. El juego es el propósito de la sesión.</p>
<p><strong>Evaluación.</strong> El grupo aplica lo que ha practicado en sesiones anteriores. Observa cómo lo hace para comprobar hasta qué punto lo ha aprendido.</p>
<p>En iniciación, en el deporte escolar y en la práctica recreativa, la competición es un recurso para avanzar hacia objetivos educativos. En el deporte federado, el calendario competitivo y los resultados ayudan a orientar el trabajo físico, técnico y táctico de la semana.</p>
<h4>ANTES · Planificación, adecuación y diseño</h4>
<p><strong>Planificación.</strong> Ubica la sesión en el microciclo. Revisa el partido anterior, el próximo y la exposición individual reciente. Elige un objetivo prioritario y, en una sesión mixta, un secundario con dosis e indicador propios. Formula conducta, condición y criterio antes de elegir tareas.</p>
<p><strong>Adecuación.</strong> Contrasta edades, experiencia, asistencia, disponibilidad, espacio, material, tiempo y supervisión. Prevé una variante para una portería, un grupo impar o distinta tolerancia a saltos, lanzamientos y contacto. Dibuja las zonas y separa trayectorias.</p>
<p><strong>Diseño.</strong> Establece el orden, las tandas, las pausas, las rotaciones y el responsable de observar. Define qué cuenta como oportunidad y prepara una variante fácil y otra exigente. Fija un motivo de ajuste, como dos tandas con pocas oportunidades de leer la ayuda. En cadetes, prepara dos espacios de práctica y reserva una muestra de diez oportunidades de decisión.</p>
<p class="ns-ceja">DURANTE · Desarrollo de la sesión</p>
<h4>Las cinco fases de la sesión</h4>
<p>Una sesión puede durar desde unos 30 minutos hasta dos horas. Ajusta la duración a las características del grupo y al tipo de trabajo. La tabla muestra cómo repartir 90 minutos entre las cinco fases.</p>
<div class="ns-desplazable" tabindex="0" role="region" aria-label="Fases de una sesión con un ejemplo de 90 minutos"><table><caption>Fases de una sesión con un ejemplo de 90 minutos</caption><thead><tr><th scope="col">Fase</th><th scope="col">Función</th><th scope="col">Ejemplo en pista</th></tr>
</thead><tbody><tr><th scope="row">Fase de información · 5 min</th><td>Presentar el objetivo con una consigna breve y comprobar que se entiende.</td><td>Preguntar qué señal indica que conviene pasar al pivote.</td></tr>
<tr><th scope="row">Fase inicial o de adaptación (calentamiento) · 15 min</th><td>Elevar la exigencia progresivamente y preparar las acciones centrales. Puede pasar de tareas generales a específicas.</td><td>Movilidad, desplazamientos, recepciones en movimiento y apoyos con oposición suave.</td></tr>
<tr><th scope="row">Fase principal o de logro de objetivos · 55 min</th><td>Dedicar la práctica al objetivo. Puede contener tareas técnicas, tácticas, físicas, lúdicas o socioeducativas.</td><td>15 min de recepción orientada, 20 de 2 contra 1 y 20 de 3 contra 3 con pivote.</td></tr>
<tr><th scope="row">Fase final o de readaptación (vuelta a la calma) · 10 min</th><td>Descender el ritmo según lo trabajado y facilitar el cierre.</td><td>Pases suaves, hidratación y movilidad cómoda.</td></tr>
<tr><th scope="row">Fase de reflexión · 5 min</th><td>Revisar logros, escuchar al grupo y enlazar con la sesión siguiente.</td><td>Comparar decisiones registradas, acordar una consigna y repartir la recogida del material.</td></tr>
</tbody></table>
</div>
<div class="ns-fase"><h5>Fase de información</h5>
<p><strong>Definición y propósito.</strong> Apertura breve que alinea al grupo con el reto del día y permite comprobar si puede empezar de forma autónoma.</p>
<p><strong>Objetivos específicos.</strong> Identificar la conducta que se quiere mejorar, reconocer una señal de éxito y saber cómo empezar, cambiar de rol y reiniciar.</p>
<p><strong>Fundamento científico.</strong> La teoría de establecimiento de metas relaciona metas específicas y feedback con la dirección del esfuerzo. En tareas nuevas o complejas conviene orientar la atención hacia una estrategia de aprendizaje. La aplicación a esta charla de pista es indirecta [<?php echo nitro_sesiones_enlace( $fuentes['metas'] ); ?>].</p>
<p><strong>Criterios metodológicos.</strong> Comunica un objetivo, una señal y una regla operativa. Usa una demostración breve si la disposición espacial cuesta imaginar. Pide que un jugador reformule la señal y que otro muestre el primer reinicio.</p>
<p><strong>Organización y tiempo.</strong> 2–5 min. Coloca al grupo donde pueda ver la demostración y oír sin distracciones. Deja petos y balones preparados y comunica desde el inicio cualquier variante de participación.</p>
<p><strong>Intervención del entrenador.</strong> Pregunta «¿qué mirarás antes de soltar el balón?». Espera la respuesta y completa con una sola referencia observable. Si falla el montaje, vuelve a mostrar quién inicia y desde dónde.</p>
<p><strong>Ejemplo en balonmano.</strong> Ante una ayuda que cierra el avance, busca al pivote si queda libre. Si la ayuda protege el pase y deja espacio de avance, penetra. Dos jugadores representan ambas respuestas en pocos segundos.</p>
<p><strong>Errores e indicadores.</strong> Evita una charla larga o enunciar «mejorar el ataque» sin una conducta. Comprueba cuántos tríos empiezan sin ayuda y cuántos identifican correctamente la señal en dos ejemplos.</p>
</div>
<div class="ns-fase"><h5>Fase inicial o de adaptación (calentamiento)</h5>
<p><strong>Definición y propósito.</strong> Progresión de la actividad que prepara al grupo para las demandas físicas y perceptivas de la primera tarea exigente.</p>
<p><strong>Objetivos específicos.</strong> Elevar gradualmente el esfuerzo, ensayar frenadas, apoyos y recepciones, preparar hombro y tronco para el lanzamiento y reconocer señales sencillas de oposición.</p>
<p><strong>Fundamento científico.</strong> Una síntesis encontró beneficios agudos del calentamiento en numerosas medidas de rendimiento [<?php echo nitro_sesiones_enlace( $fuentes['calentamiento'] ); ?>]. En balonmano juvenil, un programa neuromuscular repetido durante la temporada redujo lesiones agudas de rodilla y tobillo [<?php echo nitro_sesiones_enlace( $fuentes['prevencion'] ); ?>]. Un ensayo de hombro en élite fue favorable [<?php echo nitro_sesiones_enlace( $fuentes['hombro'] ); ?>], mientras que una síntesis posterior obtuvo una estimación conjunta imprecisa [<?php echo nitro_sesiones_enlace( $fuentes['hombro_revision'] ); ?>]. Estos resultados corresponden a programas y poblaciones concretos.</p>
<p><strong>Criterios metodológicos.</strong> Aumenta velocidad, amplitud, oposición o intensidad del lanzamiento de forma escalonada. Conserva la señal del bloque siguiente cuando introduzcas balón. Ajusta por exposición previa, frío, pausa y disponibilidad.</p>
<p><strong>Organización y tiempo.</strong> 8–18 min. En 15 min, usa 4 de activación general, 5 de preparación neuromuscular y 6 de aproximación específica. Monta calles paralelas y separa el tránsito de las zonas de lanzamiento.</p>
<p><strong>Intervención del entrenador.</strong> Observa el apoyo de frenada y el control al aterrizar. Escala el lanzamiento de suave a moderado. Si se pierde control o aparece una molestia nueva, interrumpe esa tarea para ajustar la participación.</p>
<p><strong>Ejemplo en balonmano.</strong> Desplazamientos y frenadas progresivas, recepciones en carrera y 2 contra 1 a velocidad creciente. El defensor ofrece una señal clara antes de pasar a oposición libre.</p>
<p><strong>Errores e indicadores.</strong> Evita saltar del trote a lanzamientos máximos, saturar con colas o llegar fatigado al primer bloque. Observa distribución de oportunidades, calidad en los apoyos y tolerancia a las últimas acciones específicas.</p>
</div>
<div class="ns-fase"><h5>Fase principal o de logro de objetivos</h5>
<p><strong>Definición y propósito.</strong> Núcleo de práctica donde se dosifican las tareas que deben provocar el cambio previsto o aportar evidencia sobre él.</p>
<p><strong>Objetivos específicos.</strong> Generar oportunidades suficientes por jugador, mejorar la decisión y su ejecución, aplicar lo aprendido con oposición y cumplir la exposición prevista del objetivo secundario.</p>
<p><strong>Fundamento científico.</strong> El marco del punto de desafío relaciona la dificultad útil con el nivel y la información disponible [<?php echo nitro_sesiones_enlace( $fuentes['desafio'] ); ?>]. En balonmano, variar el espacio cambia el estímulo de los juegos reducidos [<?php echo nitro_sesiones_enlace( $fuentes['espacio'] ); ?>]. Una intervención en juveniles de élite respalda el juego específico como opción de acondicionamiento bajo una dosis definida [<?php echo nitro_sesiones_enlace( $fuentes['juego'] ); ?>].</p>
<p><strong>Criterios metodológicos.</strong> Mantén las señales que guían la decisión. Reduce opciones si el grupo apenas reconoce la ayuda, y amplía el reto cuando la conducta aparece con estabilidad. Cambia una restricción cada vez. Protege la calidad con pausas suficientes y, si entrenas bajo fatiga, controla y registra esa condición.</p>
<p><strong>Organización y tiempo.</strong> 35–60 min. En 55 min, reserva 15 para recepción orientada con defensor guiado, 20 para un 2 contra 1 y 20 para un 3 contra 3 con pivote. Incluye demostración, pausas, rotaciones y cambios de tarea. Asigna un observador y roles rotativos.</p>
<p><strong>Intervención del entrenador.</strong> Observa varias repeticiones antes de intervenir. Entre tandas, describe una conducta y pregunta qué vio el jugador. Detén de inmediato por seguridad. Si deciden bien y falla el pase, conserva la señal y ajusta distancia o presión sobre el gesto.</p>
<p><strong>Ejemplo en balonmano.</strong> Alterna ayudas que cierran la penetración con ayudas que protegen al pivote. Termina con oposición libre y registra las decisiones adecuadas por oportunidad elegible y los pases completados por intento.</p>
<p><strong>Errores e indicadores.</strong> Evita premiar siempre el pase al pivote o usar goles como única medida. Registra decisiones adecuadas, oportunidades válidas, distribución por rol y ejecución. Si cae la calidad, identifica si cambió la oposición, la fatiga o la comprensión.</p>
</div>
<div class="ns-fase"><h5>Fase final o de readaptación (vuelta a la calma)</h5>
<p><strong>Definición y propósito.</strong> Transición desde la exigencia del último bloque hacia una actividad baja y el cierre de pista.</p>
<p><strong>Objetivos específicos.</strong> Reducir ritmo e impacto, facilitar hidratación y comprobar el estado inmediato antes de pasar al intercambio grupal.</p>
<p><strong>Fundamento científico.</strong> La revisión de Van Hooren y Peake encontró que la vuelta a la calma activa acelera la eliminación de lactato en sangre, con beneficios poco consistentes para el rendimiento posterior y evidencia insuficiente sobre prevención de lesiones. Usa la transición por su función práctica y regula la dosis según el bloque previo [<?php echo nitro_sesiones_enlace( $fuentes['vuelta'] ); ?>].</p>
<p><strong>Criterios metodológicos.</strong> Usa desplazamientos, pases o movilidad cómodos. Adecúa el volumen al esfuerzo previo y a la disponibilidad individual. Si eliges movilidad, define su propósito y mantenla tolerable.</p>
<p><strong>Organización y tiempo.</strong> 4–10 min. En una sesión exigente puedes reservar 10 min para bajar ritmo, hidratarse y dejar libre la zona de juego. Una sesión de baja carga puede necesitar una transición breve.</p>
<p><strong>Intervención del entrenador.</strong> Marca el cambio de intensidad, supervisa que los pases se mantengan suaves y escucha en privado a quien comunique malestar. Prepara un espacio tranquilo para el cierre.</p>
<p><strong>Ejemplo en balonmano.</strong> Pase por parejas caminando, sin salto ni oposición, seguido de hidratación y movilidad cómoda de las zonas que trabajaron.</p>
<p><strong>Errores e indicadores.</strong> Evita convertir el cierre en una competición de lanzamientos. Comprueba que cesaron los esfuerzos intensos, que la mayoría puede conversar con comodidad y que se registraron las incidencias que requieren seguimiento.</p>
</div>
<div class="ns-fase"><h5>Fase de reflexión</h5>
<p><strong>Definición y propósito.</strong> Conversación breve con los jugadores, aún dentro de la sesión, que transforma lo practicado en una observación y una acción para el próximo entrenamiento.</p>
<p><strong>Objetivos específicos.</strong> Recuperar la señal clave, comparar percepciones con un dato de pista y acordar una conducta que el grupo pueda probar de nuevo.</p>
<p><strong>Fundamento científico.</strong> Un metaanálisis sobre revisiones estructuradas de la acción encontró mejoras de desempeño en contextos formativos y profesionales. La aplicación al balonmano es indirecta y orienta el uso de preguntas, evidencia y un siguiente paso concreto [<?php echo nitro_sesiones_enlace( $fuentes['reflexion'] ); ?>].</p>
<p><strong>Criterios metodológicos.</strong> Ordena la conversación en hechos, interpretación y siguiente intento. Da voz al grupo antes de sintetizar. Recoge observaciones discrepantes y reserva las devoluciones personales extensas para otro momento.</p>
<p><strong>Organización y tiempo.</strong> 3–6 min. Dedica 1 min a pensar por parejas, 2 a compartir evidencias y 1–2 a acordar y anotar el próximo intento.</p>
<p><strong>Intervención del entrenador.</strong> Pregunta «¿qué hizo la ayuda en la acción que funcionó?». Pide un ejemplo, contrástalo con el registro y cierra con una acción. Si faltan datos, anota qué observaréis la próxima vez.</p>
<p><strong>Ejemplo en balonmano.</strong> El grupo explica dos decisiones correctas, una de pase y otra de penetración. Se compromete a identificar la posición del defensor antes del primer bote en la siguiente sesión.</p>
<p><strong>Errores e indicadores.</strong> Evita un monólogo, valoraciones globales o reducir el éxito a ganar el minipartido. Comprueba que varios jugadores aportaron ejemplos y que queda escrita una acción con momento de comprobación.</p>
</div>
<h4>DESPUÉS · Análisis, feedback y nivel de logro de objetivos</h4>
<p><strong>Análisis.</strong> Fuera de pista, contrasta lo planificado con lo ejecutado. Registra asistencia, tiempo efectivo, cambios de reglas, exposición individual y contexto de observación. Separa calidad de la decisión, ejecución y resultado. Compara muestras bajo condiciones equivalentes.</p>
<p><strong>Nivel de logro.</strong> Usa el criterio previo. Con umbral del 60 % y mínimo de 10 oportunidades, 8/12 equivale al 67 % y alcanza el criterio en esa tarea, mientras que 5/9 resulta insuficiente para clasificar esa tanda. Si cambia la oposición, describe la diferencia. Repite sin recordatorio otro día para explorar retención y cambia el contexto para explorar transferencia.</p>
<p><strong>Feedback y decisión.</strong> Devuelve al equipo un hecho, su interpretación y el ajuste previsto. Ejemplo. «En la última tanda elegimos bien en 8 de 12 oportunidades. Mantendremos la regla y probaremos la misma lectura con un defensor distinto». Guarda por separado la devolución individual y decide qué conservar, ajustar o volver a medir.</p>
<h4>Una ficha que se pueda usar en pista</h4>
<p>Anota en la ficha el número de sesión, la duración, los objetivos, los contenidos y las actividades. Indica en qué orden harás las tareas, cuánto tiempo dedicarás a cada una, cómo organizarás al grupo y qué instalaciones y materiales necesitas. Describe cómo vas a enseñar y qué observarás para evaluar la sesión. Un croquis te permite recordar de un vistazo dónde se coloca cada grupo y por dónde se mueve.</p>
<p>Añade a la ficha el propósito del día dentro de la semana, el objetivo principal, un objetivo secundario compatible, la dosificación por tarea y una variante ante cambios de asistencia o de espacio. Distingue minutos de bloque, tiempo efectivo y pausas. Registra lo que realmente se hizo para orientar la siguiente sesión.</p>
<h4>Dirigir y ajustar sobre la marcha</h4>
<ul><li>Motiva a partir de necesidades e intereses del grupo. Ofrece papeles activos y retos al alcance de cada deportista.</li>
<li>Explica propósito, organización y regla esencial en pocas frases. Demuestra si ayuda y pide a una pareja que muestre el primer reinicio.</li>
<li>Prepara esfuerzos progresivos y alterna trabajo y descanso según el objetivo. La adaptación depende del estímulo acumulado y de la recuperación, además de las características individuales.</li>
<li>Reduce colas y transiciones improductivas con grupos pequeños, materiales listos y rotaciones previsibles. Conserva las pausas necesarias para repetir a la calidad prevista.</li>
<li>Anima, corrige conductas observables, reconoce avances y ofrece variantes. Puedes decir «mira al defensor antes de recibir» y observar qué cambia en la siguiente repetición.</li>
</ul>
<h4>El papel de la competición</h4>
<div class="ns-desplazable" tabindex="0" role="region" aria-label="Orientaciones según la finalidad competitiva"><table><caption>Orientaciones según la finalidad competitiva</caption><thead><tr><th scope="col">Dimensión</th><th scope="col">Deporte de base</th><th scope="col">Alto rendimiento</th></tr>
</thead><tbody><tr><th scope="row">General</th><td>Aprender, disfrutar y sostener la participación.</td><td>Competir para rendir y aprovechar las capacidades del equipo.</td></tr>
<tr><th scope="row">Individual</th><td>Probar acciones entrenadas y aprender del resultado.</td><td>Aprovechar fortalezas propias e identificar oportunidades ante el rival.</td></tr>
<tr><th scope="row">Colectiva</th><td>Dar a todos un papel y repartir oportunidades de juego.</td><td>Estudiar patrones rivales, preparar respuestas y prever un plan alternativo.</td></tr>
<tr><th scope="row">Reglamento</th><td>Respetar decisiones y volver la atención al juego.</td><td>Dominar el reglamento y usar sus opciones con respeto al arbitraje.</td></tr>
</tbody></table>
</div>
<p>La edad, la categoría y la filosofía de la entidad condicionan la competición. Un reto proporcionado puede favorecer la implicación. Vigila presión por el resultado, hostilidad y pérdida de disfrute. Pacta conductas de respeto hacia rivales, arbitraje y compañeros. Usa instrucciones breves bajo presión y reserva la devolución individual extensa para un momento adecuado.</p>
<p>En iniciación, evalúa si el equipo probó lo aprendido, incluso si perdió. En rendimiento, separa calidad del plan, ejecución y resultado. Registra acciones en contexto y relaciona la observación con el siguiente entrenamiento. El partido aporta información valiosa sobre transferencia y está condicionado por rival, marcador, minutos y roles.</p>

    <p><small>Fuente didáctica: <cite>Tema 5. La sesión</cite>, págs. 1–10. Adaptación al balonmano con bibliografía complementaria y la nomenclatura acordada para NitroHandball.</small></p>
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
