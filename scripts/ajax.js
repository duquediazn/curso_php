/*
El archivo ajax.js tiene el objetivo de interceptar el envío de formularios para realizar la 
solicitud mediante fetch (una API moderna para hacer peticiones HTTP):*/

/*Selección de formularios:
Aquí, el script selecciona todos los formularios en la página que tengan la clase formularioAjax.*/
const formularios_ajax = document.querySelectorAll('.formularioAjax');

/*
Proceso de envío con AJAX:
- e.preventDefault(): Impide que el formulario se envíe de manera tradicional.
- Confirmación: Pregunta al usuario si realmente desea enviar el formulario.
- FormData: Captura todos los datos del formulario.
- Configuración y envío de la solicitud: La solicitud se envía al servidor utilizando 
fetch con la configuración especificada, como el método (GET o POST) y la URL de destino (action del formulario).
- Manejo de la respuesta: La respuesta del servidor se muestra en una alerta.
*/
function enviar_formulario_ajax(e) {
    e.preventDefault();

    const enviar = confirm("¿Seguro que quieres enviar el formualario?");

    if (enviar == true) {
        const data = new FormData(this);
        const method = this.getAttribute("method");
        const action = this.getAttribute("action");

        const encabezados = new Headers();

        const config = {
            method: method,
            headers: encabezados,
            mode: 'cors',
            cache: 'no-cache',
            body: data
        }

        fetch(action, config)
            .then(respuesta => respuesta.text())
            .then(respuesta => {
                alert(respuesta);
            });
    }
}

/*Intercepción del envío del formulario:
Se añade un evento submit a cada formulario seleccionado para que, cuando se intente enviar, 
en lugar de proceder con el envío tradicional, se ejecute la función enviar_formulario_ajax.*/
formularios_ajax.forEach(formularios => {
    formularios.addEventListener("submit", enviar_formulario_ajax);
});

/*
¿Para qué es útil este script?
-Evitar recargas de página: Permite que los formularios se envíen y procesen sin recargar 
la página, lo cual es útil en aplicaciones web donde la interactividad y la velocidad son 
importantes.
- Mejor experiencia de usuario: Al no recargar la página, los usuarios permanecen en la misma 
vista, lo que hace que la interacción sea más fluida.
- Interacciones más rápidas: Solo se envían y reciben los datos necesarios, reduciendo la 
cantidad de información transferida.
*/