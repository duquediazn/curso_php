<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar formularios con GET y POST</title>
</head>
<!-- 
El atributo action del elemento FORM indica la página a la que se le enviarán los datos del formulario. 
En nuestro caso se tratará de un script PHP. Por su parte, el atributo method especifica el método usado 
para enviar la información. Este atributo puede tener dos valores:
    - GET: con este método los datos del formulario se agregan al URI utilizando un signo deinterrogación 
    "?" como separador, si hay varios se separan por "&".
    - POST: con este método los datos se incluyen en el cuerpo del formulario y se envíanutilizando el 
    protocolo HTML.
-->  
<body>
    <h1>Método POST</h1>
    <form action="index_post.php" method="post">
        <div>
            <label for="nombre">Nombre: </label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <br>

        <label for="asignatura">Asignatura: </label>
        <select name="asignatura" id="asignatura">
            <option value="Ingles" default>Inglés</option>
            <option value="Matemáticas">Matemáticas</option>
            <option value="Ciencia">Biología</option>
            <option value="Lengua">Lengua</option>
        </select>

        <br><br>

        <label for="opcion-1"> Fruta:
            <input type="checkbox" value="Manzana" id="opcion-1" name="frutas">
        </label>

        <br><br><br>

        <button>Enviar</button>
    </form>
    <br>
    <h1>Método GET</h1>
    <form action="index_get.php" method="get">
        <div>
            <label for="nombre">Nombre: </label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <br>

        <label for="asignatura">Asignatura: </label>
        <select name="asignatura" id="asignatura">
            <option value="Inglés" default>Inglés</option>
            <option value="Matemáticas">Matemáticas</option>
            <option value="Ciencia">Biología</option>
            <option value="Lengua">Lengua</option>
        </select>

        <br><br>

        <label for="opcion-1"> Fruta:
            <input type="checkbox" value="Manzana" id="opcion-1" name="frutas">
        </label>

        <br><br><br>

        <button>Enviar</button>
    </form>

    <h1>Selección múltiple</h1>
    <form action="index_multiple.php" method="post">
        <label for="asignatura">Asignatura: </label>
        <!-- En el name, indicamos que será un array "[]" y añadimos el atributo "multiple"-->
        <select name="asignatura[]" id="asignatura" multiple>
            <option value="Ingés">Inglés</option>
            <option value="Matemáticas">Matemáticas</option>
            <option value="Ciencia">Biología</option>
            <option value="Lengua">Lengua</option>
        </select>

        <br><br>
        <!--Aquí no hace falta indicar "ultiple" sino que el name coincida-->
        <label for="opcion-1"> Manzana
            <input type="checkbox" value="Manzana" id="opcion-1" name="frutas[]">
        </label>
        <label for="opcion-2"> Fresa
            <input type="checkbox" value="Fresa" id="opcion-2" name="frutas[]">
        </label>
        <label for="opcion-3"> Uva:
            <input type="checkbox" value="Uva" id="opcion-3" name="frutas[]">
        </label>

        <br><br><br>

        <button>Enviar</button>
    </form>
</body>

</html>