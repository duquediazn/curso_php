/*
El archivo ajax.js tiene el objetivo de interceptar el envío de formularios para realizar la 
solicitud mediante fetch (una API moderna para hacer peticiones HTTP):*/

/*Selección de formularios:
Aquí, el script selecciona todos los formularios en la página que tengan la clase formularioAjax.*/
const formularios_ajax = document.querySelectorAll('.formularioAjax');


//Proceso de envío con AJAX:
function enviar_formulario_ajax(e) {
    e.preventDefault(); //Evita el comportamiento por defecto del formulario (como recargar la página al enviarse).

    const enviar = confirm("¿Seguro que quieres enviar el formulario?"); //Muestra un cuadro de confirmación al usuario preguntando si está seguro de enviar el formulario.
    //La respuesta (true o false) se guarda en la variable `enviar`.
    if (enviar == true) {
        const data = new FormData(this); // Crea un objeto `FormData` a partir del formulario (`this` refiere al formulario actual).
        //Este objeto captura todos los datos del formulario como pares clave-valor.
        const method = this.getAttribute("method"); //Obtiene el atributo `method` del formulario (GET, POST, etc.) y lo guarda en `method`.
        const action = this.getAttribute("action"); // Obtiene el atributo `action` del formulario (URL a donde se enviarán los datos) y lo guarda en `action`.

        const encabezados = new Headers(); //Crea un nuevo objeto `Headers` que permite configurar los encabezados HTTP de la solicitud.

        const config = {
            method: method, //Especifica el método HTTP (GET, POST, etc.) tomado del formulario.
            headers: encabezados, // Configura los encabezados para la solicitud HTTP.
            mode: 'cors', // Habilita `CORS` (Cross-Origin Resource Sharing) para permitir solicitudes entre diferentes dominios, si el servidor lo permite.
            cache: 'no-cache', // Indica que no se debe usar una versión en caché de la solicitud.
            body: data //Envía los datos del formulario capturados por `FormData` en el cuerpo de la solicitud.
        }

        fetch(action, config) // Realiza una solicitud HTTP utilizando `fetch`, pasando como parámetro la URL del atributo `action` y las configuraciones definidas en `config`.
            .then(respuesta => respuesta.text()) //Cuando la solicitud se completa, procesa la respuesta y la convierte en texto.
            .then(respuesta => {
                alert(respuesta); // Muestra la respuesta del servidor como una alerta al usuario.
            });
    }
}

/*Intercepción del envío del formulario:
Se añade un evento submit a cada formulario seleccionado para que, cuando se intente enviar, 
en lugar de proceder con el envío tradicional, se ejecute la función enviar_formulario_ajax.*/
formularios_ajax.forEach(formulario => {
    formulario.addEventListener("submit", enviar_formulario_ajax);
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