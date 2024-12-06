<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carga de archivo</title>
</head>
<body>
    <h1>Subir archivo con PHP</h1>
<!-- Para poder cargar un archivo en un servidor establecemos el atributo "enctype" 
 a "multipart/form-data" y method siempre a "post"-->
    <form action="carga.php" method="POST" enctype="multipart/form-data" class="formularioAjax">
        <input type="file" name="fichero" accept=".jpg, .png, .jpeg"> <!-- El atributo accept sirve para delimitar el formato de archivos sorpotados.-->
        <!-- Si queremos especificar el tamaño máximo del archivo a subir debemos insertar el siguiente campo oculto antes de campo de tipo
        file. El tamaño es en bytes (lógicamente no debe sersuperior a lo establecido en las directivas php.ini). Ejemplo:
        <input type="hidden" name="MAX_FILE_SIZE" value="30000"> -->
        <br><br>
        <button type="submit">Enviar</button>
    </form>
    <script src="scripts/ajax.js"></script>
</body>
</html>