<?php
//Validación en servidor:
if (!preg_match("/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ() ]{3,10}/", $_POST['usuario'])) {
    //https://www.php.net/manual/es/function.preg-match.php
    echo "El usuario no coincide con el formato solicitado.";
    exit();
}

if (!preg_match("/^[a-zA-Z0-9$@.-]{4,30}/", $_POST['clave'])) {
    //https://www.php.net/manual/es/function.preg-match.php
    echo "La clave no coincide con el formato solicitado.";
    exit();
}

/*
Mientras la sesión permanece abierta, puedes utilizar la variable superglobal $_SESSION para
añadir información a la sesión del usuario, o para acceder a la información almacenada en
la sesión.
*/

if ($_POST['usuario'] == "Carlos" && $_POST['clave'] == "1234") {
    session_name("LOGIN");
    session_start();

    $_SESSION["Nombre"] = "Carlos";
    $_SESSION["Apellido"] = "Alaro";
    $_SESSION["País"] = "El Salvador";

    //echo "Sesión iniciada.";
    if (headers_sent()) { //https://www.php.net/manual/es/function.headers-sent.php
        //No se puede enviar una cabecera si ya hay una enviada.
        echo "<script> window.location.href='contador.php'; </script>"; //Redirigimos al inicio usando JavaScript como alternativa a header("Location:")
    } else {
        header("Location: contador.php"); //Redirige a contador.php
        /*https://www.php.net/manual/es/function.header.php
            header() debe ser llamado antes de mostrar nada por pantalla, etiquetas HTML, líneas en blanco desde un fichero o desde PHP.*/
    }
} else {
    echo "Datos incorrectos";
}
