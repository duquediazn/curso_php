<?php
    if($_POST['usuario']=="Carlos" && $_POST['clave']=="1234") {
        session_name("LOGIN");
        session_start();

        $_SESSION["Nombre"]="Carlos";
        $_SESSION["Apellido"]="Alaro";
        $_SESSION["País"]="El Salvador";

        echo "Sesión iniciada.";
    } else {
        echo "Datos incorrectos";
    }