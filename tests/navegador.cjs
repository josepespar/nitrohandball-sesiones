'use strict';

const assert = require('node:assert/strict');
const { execFileSync } = require('node:child_process');
const { readFileSync } = require('node:fs');
const path = require('node:path');
const { chromium } = require('playwright-core');

const raiz = path.resolve(__dirname, '..');
const html = execFileSync(process.env.PHP_BIN || 'php', ['tests/biblioteca.php', '--html'], { cwd: raiz });
const recursos = {
    '/': ['text/html; charset=utf-8', html],
    '/nitro-sesiones/assets/sesiones.js': ['application/javascript; charset=utf-8', readFileSync(path.join(raiz, 'nitro-sesiones/assets/sesiones.js'))],
    '/nitro-sesiones/assets/sesiones.css': ['text/css; charset=utf-8', readFileSync(path.join(raiz, 'nitro-sesiones/assets/sesiones.css'))],
};

async function servir(pagina) {
    await pagina.route('https://nitro.test/**', ruta => {
        const recurso = recursos[new URL(ruta.request().url()).pathname];
        return recurso ? ruta.fulfill({ contentType: recurso[0], body: recurso[1] }) : ruta.abort();
    });
    await pagina.goto('https://nitro.test/');
}

async function ejecutar() {
    const navegador = await chromium.launch({ executablePath: process.env.CHROMIUM_BIN || undefined });
    try {
        const pagina = await navegador.newPage({ viewport: { width: 375, height: 810 }, locale: 'es-ES' });
        const errores = [];
        pagina.on('pageerror', error => errores.push(error.message));
        await servir(pagina);

        const [primera, segunda] = await pagina.locator('.nitro-sesiones').all();
        const forma = primera.locator('[data-ns-form]');
        assert.equal(await primera.locator('[data-ns-ficha]:visible').count(), 66);
        assert.equal(await primera.locator('[data-ns-arquitectura]:visible').count(), 12);
        assert.equal(await pagina.evaluate(() => document.documentElement.scrollWidth), 375);
        const buscar = primera.getByRole('searchbox', { name: 'Buscar referencias' });
        const totalFuentes = await primera.locator('[data-ns-fuente]').count();
        await buscar.fill('povoas');
        assert.equal(await primera.locator('[data-ns-fuente]:visible').count(), 1);
        assert.equal(await segunda.locator('[data-ns-fuente]:visible').count(), totalFuentes);
        await primera.getByRole('combobox', { name: 'Tema', exact: true }).selectOption('Prevención');
        assert.equal(await primera.locator('[data-ns-fuente]:visible').count(), 0);
        assert.match(await primera.locator('[data-ns-cuenta-fuentes]').textContent(), /Sin referencias/);
        await primera.getByRole('button', { name: 'Limpiar búsqueda' }).click();
        await primera.getByRole('combobox', { name: 'Diseño de estudio' }).selectOption('Metaanálisis');
        assert.ok(await primera.locator('[data-ns-fuente]:visible').count() < totalFuentes);
        await primera.getByRole('button', { name: 'Limpiar búsqueda' }).click();
        assert.equal(await primera.locator('[data-ns-fuente]:visible').count(), totalFuentes);
        const ejercicio = primera.locator('.ns-practica').first();
        await ejercicio.getByText('Ordena las fases', { exact: true }).click();
        const respuestas = await ejercicio.getByRole('combobox').all();
        const orden = ['2', '4', '0', '3', '1'];
        for (const [indice, respuesta] of respuestas.entries()) {
            await respuesta.selectOption(orden[indice]);
        }
        await ejercicio.getByRole('button', { name: 'Comprobar respuestas' }).click();
        assert.equal(await ejercicio.getByRole('status').textContent(), '5 de 5 respuestas correctas.');
        await respuestas[0].selectOption('0');
        await ejercicio.getByRole('button', { name: 'Comprobar respuestas' }).click();
        assert.equal(await ejercicio.getByRole('status').textContent(), '4 de 5 respuestas correctas.');
        assert.match(await ejercicio.locator('[data-ns-feedback]').first().textContent(), /Revisa esta respuesta/);
        await ejercicio.getByRole('button', { name: 'Volver a empezar' }).click();
        assert.equal(await respuestas[0].inputValue(), '');
        assert.equal(await ejercicio.locator('[data-ns-feedback]:visible').count(), 0);
        await primera.getByRole('combobox', { name: /^Familia/ }).selectOption('fisica');
        assert.equal(await primera.locator('[data-ns-ficha]:visible').count(), 11);
        await primera.getByRole('combobox', { name: /^Evidencia/ }).selectOption('directa');
        assert.ok(await primera.locator('[data-ns-ficha]:visible').count() < 11);
        const celda = primera.locator('[data-ns-celda]').first();
        const destino = primera.locator(await celda.getAttribute('href'));
        await celda.focus();
        await pagina.keyboard.press('Enter');
        assert.equal(await destino.getAttribute('open'), '');
        assert.equal(await destino.locator('summary').evaluate(nodo => nodo === document.activeElement), true);
        assert.ok(await destino.locator('a[href^="https://"]').count() > 0);
        assert.equal(await segunda.locator('[data-ns-ficha]:visible').count(), 66);
        await primera.getByRole('combobox', { name: /^Contexto/ }).selectOption('Pospartido');
        assert.equal(await primera.locator('[data-ns-arquitectura]:visible').count(), 1);
        await primera.locator('[data-ns-arquitectura]:visible summary').click();
        await primera.getByRole('button', { name: 'Usar en el configurador' }).click();
        assert.equal(await forma.getByLabel('Nombre de la sesión').inputValue(), 'Día posterior con dos rutas');

        const tareas = forma.locator('.ns-tarea');
        const texto = await tareas.nth(1).getByLabel('Actividad').inputValue();
        await tareas.nth(1).getByRole('button', { name: 'Subir' }).click();
        assert.equal(await tareas.first().getByLabel('Actividad').inputValue(), texto);
        await forma.getByRole('button', { name: 'Añadir tarea' }).click();
        assert.equal(await tareas.count(), 6);
        assert.match(await forma.locator('[data-ns-total]').textContent(), /Sobran 5 min/);
        assert.equal(await forma.evaluate(nodo => nodo.checkValidity()), false);
        await tareas.last().getByRole('button', { name: 'Quitar' }).click();
        assert.equal(await tareas.count(), 5);
        await forma.getByLabel('Objetivo secundario').selectOption('recuperacion');
        assert.equal(await forma.evaluate(nodo => nodo.checkValidity()), false);
        await forma.getByLabel('Objetivo secundario').selectOption('fisica');
        assert.match(await forma.locator('[data-ns-compatibilidad]').textContent(), /Interferencia/);
        await forma.getByLabel('Nombre de la sesión').fill('<img src=x onerror=alert(1)> Sesión');
        await pagina.emulateMedia({ media: 'print' });
        await pagina.evaluate(() => {
            window.print = () => {
                const ficha = document.querySelector('.ns-documento');
                window.resultadoImpresion = {
                    titulo: ficha.querySelector('h1').textContent,
                    tareas: [...ficha.querySelectorAll('li')].map(li => li.textContent),
                    visible: getComputedStyle(ficha).display !== 'none',
                    sitioOculto: getComputedStyle(document.querySelector('main')).display === 'none',
                    imagenes: ficha.querySelectorAll('img').length,
                };
                window.dispatchEvent(new Event('afterprint'));
            };
        });
        await forma.getByRole('button', { name: 'Imprimir o guardar como PDF' }).click();
        const impreso = await pagina.evaluate(() => window.resultadoImpresion);
        assert.equal(impreso.titulo, '<img src=x onerror=alert(1)> Sesión');
        assert.equal(impreso.tareas.length, 5);
        assert.ok(impreso.tareas[0].endsWith(texto));
        assert.ok(impreso.visible && impreso.sitioOculto);
        assert.equal(impreso.imagenes, 0);
        assert.equal(await pagina.locator('.ns-documento').count(), 0);
        assert.deepEqual(errores, []);

        const sinJS = await navegador.newPage({ javaScriptEnabled: false });
        await servir(sinJS);
        const biblioteca = sinJS.locator('.nitro-sesiones').first();
        assert.equal(await biblioteca.locator('[data-ns-ficha]:visible').count(), 66);
        await biblioteca.locator('[data-ns-ficha] summary').first().click();
        assert.ok(await biblioteca.locator('[data-ns-ficha] a:visible').count() > 0);
        assert.equal(await biblioteca.locator('[data-ns-form]').isVisible(), false);
        const practicaEstatica = biblioteca.locator('.ns-practica').first();
        await practicaEstatica.getByText('Ordena las fases', { exact: true }).click();
        await practicaEstatica.getByText('Consultar soluciones', { exact: true }).click();
        assert.ok(await practicaEstatica.getByRole('listitem').filter({ hasText: 'Presenta el objetivo y qué observará el equipo.' }).isVisible());
        console.log('Prácticas, matriz, teclado, filtros, editor, impresión y lectura sin JavaScript correctos.');
    } finally {
        await navegador.close();
    }
}

ejecutar().catch(error => {
    console.error(error);
    process.exitCode = 1;
});
