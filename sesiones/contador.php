<?php
session_name("LOGIN");
session_start();

/*
Mientras la sesión permanece abierta, puedes utilizar la variable superglobal $_SESSION para
añadir información a la sesión del usuario, o para acceder a la información almacenada en
la sesión. Por ejemplo, para contar el número de veces que el usuario visita la página,
puedes hacer:
*/

if (isset($_SESSION['contador'])) { //https://www.php.net/manual/en/reserved.variables.session.php
    $_SESSION['contador']++;
} else {
    $_SESSION['contador'] = 1;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesiones en PHP</title>
</head>

<body>
    <?php
    echo "Hola " . $_SESSION['Nombre'] . "<br>";

    echo "Has recargado esta página " . $_SESSION["contador"] . " veces.";
    ?>
    <br>
    <a href="index.php">Inicio</a>
    <br>
    <a href="cerrar.php">Eliminar sesión</a>
</body>

</html>