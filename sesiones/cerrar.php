<?php
session_name("LOGIN");
session_start();

/*
Aunque como ya viste, puedes configurar PHP para que elimine de forma automática los
datos de una sesión pasado cierto tiempo, en ocasiones puede ser necesario cerrarla de
forma manual en un momento determinado. Por ejemplo, si utilizas sesiones para recordar
la información de autentificación, deberás darle al usuario del sitio web la posibilidad de
cerrar la sesión cuando lo crea conveniente.

En PHP tienes dos funciones para eliminar la información almacenada en la sesión:
- session_unset. Elimina las variables almacenadas en la sesión actual, pero no elimina
la información de la sesión del dispositivo de almacenamiento usado.
- session_destroy. Elimina completamente la información de la sesión del dispositivo de
almacenamiento.
*/

session_destroy(); //https://www.php.net/manual/en/function.session-destroy.php

echo "<script> window.location.href='index.php'; </script>";
