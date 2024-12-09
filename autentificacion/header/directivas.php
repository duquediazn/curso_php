<?php
//Si no .htaccess
if ($_SERVER['PHP_AUTH_USER']!='gestor' || $_SERVER['PHP_AUTH_PW']!='secreto') {
    header('WWW-Authenticate: Basic Realm="Contenido restringido"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Usuario no reconocido!";
    exit;
}

echo "<h1>Directivas PHP_AUTH</h1>";

echo "<p>Usuario:".$_SERVER['PHP_AUTH_USER']."</p>";
echo "<p>Contraseña:".$_SERVER['PHP_AUTH_PW']."</p>";
echo "<p>MétodoAutentificación:".$_SERVER['AUTH_TYPE']."</p>";