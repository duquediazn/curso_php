<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar formularios con GET y POST</title>
</head>

<body>
    <h1>Método POST</h1>
    <form action="index.php" method="post">
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
    <form action="index.php" method="get">
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
</body>

</html>