<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo isset. Tabla multiplicar.</title>
    <link rel="stylesheet" href="styles/style_isset_ejemplo.css">
</head>
<body>
    <h1>Ejemplo Tabla de Multiplicar</h1>
    <h2>Escoge un número</h2>
    <form action="" method="post">
        <label for="numero">Tabla del:</label>
        <input id="numero" type="number" name="numero">
        <button>Enviar</button>
    </form>

    <h2>Cálculo de tabla de multiplicar</h2>
    <div>
        <?php 
            if(isset($_POST['numero']) && $_POST['numero']!="" ) {
                include "for.php";
            }
        ?>
    </div>
</body>
</html>