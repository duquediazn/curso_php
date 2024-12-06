<?php
/*
https://www.php.net/manual/es/language.variables.superglobals.php

- $_SERVER: Contiene información sobre el entorno del servidor web y de ejecución.
    Entre la información que nos ofrece esta variable, tenemos:
    $_SERVER['PHP_SELF'] : guion que se está ejecutando actualmente.
    $_SERVER['SERVER_ADDR'] : dirección IP del servidor web.
    $_SERVER['SERVER_NAME'] : nombre del servidor web.
    $_SERVER['DOCUMENT_ROOT'] : directorio raíz bajo el que se ejecuta el guión actual.
    $_SERVER['REMOTE_ADDR'] : dirección IP desde la que el usuario está viendo la página.
    $_SERVER['REQUEST_METHOD'] : método utilizado para acceder a la página ('GET','HEAD','POST'o'PUT')
    
- $_GET, $_POST y $_COOKIE: contienen las variables que se han pasado al guión actual utilizando 
respectivamente los métodos GET, POST y Cookies.
- $_REQUEST: junta en uno solo el contenido de los tres arrays anteriores, $_GET, $_POST y $_COOKIE
- $_ENV: contiene las variables que se puedan haber pasado a PHP desde el entorno en que se ejecuta.
- $_FILES: contiene los ficheros que se puedan haber subido al servidor utilizando el método POST
- $_SESSION: contiene las variables de sesión disponibles para el guion actual.
- $GLOBALS: Es un array asociativo que contiene las referencias a todas la variables que están definidas 
en el ámbito global del script. Los nombres de las variables son las claves del array.
*/