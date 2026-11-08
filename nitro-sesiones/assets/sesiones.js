(() => {
    'use strict';

    function elemento(etiqueta, texto) {
        const nodo = document.createElement(etiqueta);
        nodo.textContent = texto;
        return nodo;
    }

    function iniciarPracticas(raiz) {
        for (const practica of raiz.querySelectorAll('[data-ns-practica]')) {
            const preguntas = [...practica.querySelectorAll('[data-ns-respuesta]')];
            const puntuacion = practica.querySelector('[data-ns-puntuacion]');

            practica.addEventListener('submit', evento => {
                evento.preventDefault();
                let aciertos = 0;
                for (const pregunta of preguntas) {
                    const correcta = pregunta.querySelector('select').value === pregunta.dataset.nsRespuesta;
                    const feedback = pregunta.querySelector('[data-ns-feedback]');
                    feedback.querySelector('strong').textContent = correcta ? 'Correcto.' : 'Revisa esta respuesta.';
                    feedback.hidden = false;
                    aciertos += Number(correcta);
                }
                puntuacion.textContent = `${aciertos} de ${preguntas.length} respuestas correctas.`;
            });

            practica.addEventListener('change', evento => {
                evento.target.closest('[data-ns-respuesta]').querySelector('[data-ns-feedback]').hidden = true;
                puntuacion.textContent = '';
            });

            practica.addEventListener('reset', () => {
                practica.querySelectorAll('[data-ns-feedback]').forEach(feedback => { feedback.hidden = true; });
                puntuacion.textContent = '';
            });

            practica.hidden = false;
        }
    }

    function iniciarFiltros(raiz) {
        const fichas = [...raiz.querySelectorAll('[data-ns-ficha]')];
        const ejemplos = [...raiz.querySelectorAll('[data-ns-arquitectura]')];
        const filtros = ['familia', 'tipo', 'nivel'].map(nombre => raiz.querySelector(`[data-ns-${nombre}]`));
        const contexto = raiz.querySelector('[data-ns-contexto]');
        const cuenta = raiz.querySelector('[data-ns-cuenta]');
        const cuentaEjemplos = raiz.querySelector('[data-ns-cuenta-arquitecturas]');
        const destinos = new Map(fichas.map(ficha => ['#' + ficha.id, ficha]));

        function filtrarFichas() {
            const [familia, tipo, nivel] = filtros.map(filtro => filtro.value);
            let visibles = 0;
            for (const ficha of fichas) {
                const [a, b, relacion, evidencia] = ficha.dataset.nsFicha.split(' ');
                ficha.hidden = Boolean((familia && familia !== a && familia !== b)
                    || (tipo && tipo !== relacion) || (nivel && nivel !== evidencia));
                visibles += Number(!ficha.hidden);
            }
            cuenta.textContent = `${visibles} de ${fichas.length} relaciones`;
        }

        function filtrarEjemplos() {
            let visibles = 0;
            for (const ejemplo of ejemplos) {
                ejemplo.hidden = Boolean(contexto.value && ejemplo.dataset.nsArquitectura !== contexto.value);
                visibles += Number(!ejemplo.hidden);
            }
            cuentaEjemplos.textContent = `${visibles} de ${ejemplos.length} sesiones`;
        }

        function abrirFicha(ancla) {
            const ficha = destinos.get(ancla);
            if (!ficha) return;
            if (ficha.hidden) {
                filtros.forEach(filtro => { filtro.value = ''; });
                filtrarFichas();
            }
            ficha.open = true;
            ficha.querySelector('summary').focus({ preventScroll: true });
            ficha.scrollIntoView({ block: 'nearest' });
        }

        filtros.forEach(filtro => filtro.addEventListener('change', filtrarFichas));
        contexto.addEventListener('change', filtrarEjemplos);
        raiz.querySelectorAll('[data-ns-celda]').forEach(celda => {
            celda.addEventListener('click', evento => {
                if (evento.altKey || evento.ctrlKey || evento.metaKey || evento.shiftKey) return;
                evento.preventDefault();
                if (window.location.hash !== celda.hash) window.history.pushState(null, '', celda.hash);
                abrirFicha(celda.hash);
            });
        });
        window.addEventListener('hashchange', () => abrirFicha(window.location.hash));
        filtrarFichas();
        filtrarEjemplos();
        raiz.querySelectorAll('[data-ns-controles]').forEach(control => { control.hidden = false; });
        abrirFicha(window.location.hash);
    }

    function imprimir(ficha) {
        if (document.body.classList.contains('ns-imprimiendo')) return;
        ficha.className = 'ns-documento';
        document.body.append(ficha);
        document.body.classList.add('ns-imprimiendo');

        function retirar() {
            window.removeEventListener('afterprint', retirar);
            document.body.classList.remove('ns-imprimiendo');
            ficha.remove();
        }

        window.addEventListener('afterprint', retirar);
        try {
            window.print();
        } catch (error) {
            retirar();
            throw error;
        }
    }

    function iniciarConfigurador(raiz, datos) {
        const formulario = raiz.querySelector('[data-ns-form]');
        const campo = nombre => formulario.elements.namedItem(nombre);
        const lista = raiz.querySelector('[data-ns-tareas]');
        const total = raiz.querySelector('[data-ns-total]');
        const compatibilidad = raiz.querySelector('[data-ns-compatibilidad]');
        const orden = raiz.querySelector('[data-ns-orden]');
        const agregar = raiz.querySelector('[data-ns-agregar]');
        const limiteTareas = 30;

        function tareas() {
            return [...lista.children].map(fila => ({
                minutos: fila.querySelector('input'),
                texto: fila.querySelector('textarea'),
            }));
        }

        function actualizarTotal() {
            const suma = tareas().reduce((minutos, tarea) => minutos + Number(tarea.minutos.value), 0);
            const prevista = Number(campo('duracion').value);
            const diferencia = prevista - suma;
            const aviso = diferencia > 0 ? ` Faltan ${diferencia} min.` : ` Sobran ${-diferencia} min.`;
            total.textContent = `${suma} de ${prevista} min.${diferencia ? aviso : ''}`;
            campo('duracion').setCustomValidity(diferencia ? 'La duración prevista debe coincidir con la suma de las tareas.' : '');
        }

        function actualizarRelacion() {
            const a = campo('principal').value;
            const b = campo('secundario').value;
            const par = datos.relaciones[a + '-' + b] || datos.relaciones[b + '-' + a];
            campo('secundario').setCustomValidity(par ? '' : 'Elige dos familias distintas.');
            if (!par) {
                compatibilidad.textContent = 'Elige dos familias distintas para consultar su relación.';
                return;
            }
            compatibilidad.textContent = `${datos.tipos[par[2]]} · ${datos.niveles[par[3]]}. ${par[5]} `;
            par[4].split(',').forEach((clave, indice) => {
                const [autor, , url] = datos.fuentes[clave];
                const enlace = elemento('a', autor);
                enlace.href = url;
                if (indice) compatibilidad.append(' · ');
                compatibilidad.append(enlace);
            });
        }

        function actualizarOrden() {
            const [, ventaja, riesgo] = datos.secuencias[campo('secuencia').value];
            orden.textContent = `Ventaja. ${ventaja} Desventaja. ${riesgo}`;
        }

        function numerar() {
            const filas = [...lista.children];
            filas.forEach((fila, indice) => {
                fila.querySelector('legend').textContent = `Tarea ${indice + 1}`;
                const [subir, bajar, quitar] = fila.querySelectorAll('button');
                subir.disabled = indice === 0;
                bajar.disabled = indice === filas.length - 1;
                quitar.disabled = filas.length === 1;
            });
            agregar.disabled = filas.length >= limiteTareas;
            actualizarTotal();
        }

        function crearTarea(minutos, texto) {
            const fila = elemento('fieldset', '');
            fila.className = 'ns-tarea';
            const leyenda = elemento('legend', '');
            const duracion = elemento('input', '');
            duracion.type = 'number';
            duracion.min = '1';
            duracion.max = '240';
            duracion.required = true;
            duracion.value = minutos;
            const actividad = elemento('textarea', '');
            actividad.rows = 2;
            actividad.maxLength = 300;
            actividad.required = true;
            actividad.value = texto;
            const etiquetaDuracion = elemento('label', 'Minutos');
            etiquetaDuracion.append(duracion);
            const etiquetaActividad = elemento('label', 'Actividad');
            etiquetaActividad.append(actividad);
            const acciones = elemento('div', '');
            acciones.className = 'ns-acciones-tarea';

            function boton(titulo, accion) {
                const control = elemento('button', titulo);
                control.type = 'button';
                control.addEventListener('click', accion);
                acciones.append(control);
            }

            boton('Subir', () => {
                lista.insertBefore(fila, fila.previousElementSibling);
                numerar();
                actividad.focus();
            });
            boton('Bajar', () => {
                lista.insertBefore(fila.nextElementSibling, fila);
                numerar();
                actividad.focus();
            });
            boton('Quitar', () => {
                const vecina = fila.nextElementSibling || fila.previousElementSibling;
                fila.remove();
                numerar();
                vecina.querySelector('textarea').focus();
            });
            fila.append(leyenda, etiquetaDuracion, etiquetaActividad, acciones);
            lista.append(fila);
            return actividad;
        }

        function cargarEjemplo(indice) {
            const [titulo, principal, secundario, secuencia, , objetivo, material, indicador, bloques] = datos.arquitecturas[indice];
            const valores = { modelo: indice, titulo, principal, secundario, secuencia, objetivo, material, indicador, duracion: 90 };
            Object.entries(valores).forEach(([nombre, valor]) => { campo(nombre).value = valor; });
            lista.replaceChildren();
            bloques.forEach(([minutos, texto]) => crearTarea(minutos, texto));
            numerar();
            actualizarRelacion();
            actualizarOrden();
        }

        formulario.addEventListener('input', actualizarTotal);
        campo('principal').addEventListener('change', actualizarRelacion);
        campo('secundario').addEventListener('change', actualizarRelacion);
        campo('secuencia').addEventListener('change', actualizarOrden);
        campo('modelo').addEventListener('change', () => cargarEjemplo(Number(campo('modelo').value)));
        raiz.querySelector('[data-ns-restaurar]').addEventListener('click', () => cargarEjemplo(Number(campo('modelo').value)));
        agregar.addEventListener('click', () => {
            const actividad = crearTarea(5, '');
            numerar();
            actividad.focus();
        });
        raiz.querySelectorAll('[data-ns-cargar]').forEach(boton => {
            boton.addEventListener('click', () => {
                cargarEjemplo(Number(boton.dataset.nsCargar));
                campo('titulo').focus();
            });
            boton.hidden = false;
        });

        formulario.addEventListener('submit', evento => {
            evento.preventDefault();
            const entradas = [campo('titulo'), campo('objetivo'), campo('indicador'), ...tareas().map(tarea => tarea.texto)];
            const vacia = entradas.find(entrada => !entrada.value.trim());
            if (vacia) {
                vacia.value = '';
                vacia.reportValidity();
                return;
            }
            const ficha = document.createElement('article');
            ficha.lang = 'es';
            ficha.append(elemento('p', 'NITRO HANDBALL · PLAN DE ENTRENAMIENTO'), elemento('h1', campo('titulo').value.trim()));
            const principal = campo('principal').selectedOptions[0].textContent;
            const secundario = campo('secundario').selectedOptions[0].textContent;
            ficha.append(elemento('p', `${campo('duracion').value} min · ${principal} + ${secundario}`));
            ficha.append(elemento('p', 'Objetivo. ' + campo('objetivo').value.trim()));
            if (campo('material').value.trim()) ficha.append(elemento('p', 'Material. ' + campo('material').value.trim()));
            ficha.append(elemento('p', 'Secuencia. ' + campo('secuencia').selectedOptions[0].textContent));
            ficha.append(elemento('h2', 'Tareas'));
            const bloques = document.createElement('ol');
            let inicio = 0;
            tareas().forEach(tarea => {
                const fin = inicio + Number(tarea.minutos.value);
                bloques.append(elemento('li', `${inicio}–${fin} min · ${tarea.texto.value.trim()}`));
                inicio = fin;
            });
            ficha.append(bloques, elemento('p', 'Indicador. ' + campo('indicador').value.trim()));
            imprimir(ficha);
        });

        cargarEjemplo(0);
        formulario.hidden = false;
    }

    document.querySelectorAll('.nitro-sesiones').forEach(raiz => {
        iniciarPracticas(raiz);
        iniciarFiltros(raiz);
        iniciarConfigurador(raiz, JSON.parse(raiz.querySelector('[data-ns-datos]').textContent));
    });
})();
