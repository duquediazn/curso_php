<?php
/*
El término sesión hace referencia al conjunto de
información relativa a un usuario concreto. Esta información puede ser tan simple como el
nombre del propio usuario, o más compleja, como los artículos que ha depositado en la
cesta de compra de una tienda online.

Cada usuario distinto de un sitio web tiene su propia información de sesión. Para distinguir
una sesión de otra se usan los identificadores de sesión (SID). Un SID es un atributo que se
asigna a cada uno de los visitantes de un sitio web y lo identifica. De esta forma, si el
servidor web conoce el SID de un usuario, puede relacionarlo con toda la información que
posee sobre él, que se mantiene en la sesión del usuario. Esa información se almacena en
el servidor web, generalmente en ficheros aunque también se pueden utilizar otros
mecanismos de almacenamiento como bases de datos.

Existen dos maneras de mantenerlo entre las páginas de un sitio web que visita el usuario:
- Utilizando cookies.
- Propagándolo en un parámetro de la URL. El SID se añade como una parte más de la
misma, de la forma:

http://www.misitioweb.com/tienda/listado.php&PHPSESSID=34534fg4ffg34ty

En el ejemplo anterior, el SID es el valor del parámetro PHPSESSID.

Ninguna de las dos maneras es perfecta. Ya sabes los problemas que tiene la utilización de
cookies. Pese a ello, es el mejor método y el más utilizado. Propagar el SID como parte de
la URL conlleva mayores desventajas, como la imposibilidad de mantener el SID entre
distintas sesiones, o el hecho de que compartir la URL con otra persona implica compartir
también el identificador de sesión.

A la información que se almacena en la sesión de un usuario también se le
conoce como cookies del lado del servidor (server side cookies). Debes tener en
cuenta que aunque esta información no viaja entre el cliente y el servidor, sí lo
hace el SID, bien como parte de la URL o en un encabezado HTTP si se guarda
en una cookie. En ambos casos, esto plantea un posible problema de seguridad.
El SID puede ser conseguido por otra persona, y a partir del mismo obtener la
información de la sesión del usuario. La manera más segura de utilizar sesiones
es almacenando los SID en cookies y utilizar HTTPS para encriptar la
información que se transmite entre el servidor web y el cliente. Algunos consejos
sobre sesiones y seguridad los puedes encontrar en el documento web
siguiente.

https://www.php.net/manual/es/session.security.php

Directivas de configuración de PHP relacionadas con el manejo de
sesiones (php.ini):
session.use_cookies
session.use_only_cookies
session.save_handler
session.name
session.auto_start
session.cookie_lifetime
session.gc_maxlifetime

https://es.php.net/manual/es/session.configuration.php


TL;DR:
Las sesiones se inician siempre al pricipio del archivo.
Al iniciar una sesión se crea AUTOMÁTICAMENTE una cookie con la session id, 
por lo que no tenemos que crearla nosotros.
*/
session_name("LOGIN");
//session_id("php"); //https://www.php.net/manual/es/function.session-id.php
/*
Si no se configura el inicio automático de sesión deberás iniciar la sesión con la función: session_start(). 
Esta función devuelve false en caso de no poder iniciar o restaurar una sesión, y true en caso contrario.*/
session_start(); //https://www.php.net/manual/es/function.session-start.php
/*
Como el inicio de sesión requiere utilizar cookies, y éstas se transmiten en los
encabezados HTTP, debes tener en cuenta que para poder iniciar una sesión
utilizando session_start, tendrás que hacer las llamadas a esta función antes de
que la página web muestre información en el navegador.
*/
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
            <input type="text" name="usuario" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ() ]{3,10}" maxlength="10">
        </label>
        <br>
        <label>Contraseña:
            <input type="password" name="clave" pattern="[a-zA-Z0-9$@.-]{4,30}" maxlength="30">
        </label>
        <br><br>
        <button type="submit">Login</button>
    </form>
</body>

</html>