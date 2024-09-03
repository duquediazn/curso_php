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
    <form action="carga.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="fichero" accept=".jpg, .png, .jpeg"> <!-- El atributo accept sirve para delimitar el formato de archivos sorpotados.-->
        <br><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>