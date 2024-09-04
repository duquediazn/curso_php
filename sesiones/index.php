<?php
/*Las sesiones se inician siempre al pricipio del archivo.
Al inicial una sesión se crea automáticamente un cookie con la session id. */

session_name("LOGIN"); //https://www.php.net/manual/es/function.session-start.php
//session_id("php"); //https://www.php.net/manual/es/function.session-id.php
session_start();//https://www.php.net/manual/es/function.session-start.php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesiones en PHP</title>
</head>
<body>
    <form action="login.php" method="post">
        <label>Usuario:
            <input type="text" name="usuario">
        </label>
        <br>
        <label>Contraseña:
            <input type="password" name="clave">
        </label>
        <br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>