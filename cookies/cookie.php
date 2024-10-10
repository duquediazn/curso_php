<?php
/*
Las cookies son un mecanismo por el que se almacenan datos en el 
navegador para monitorizar o identificar a los usuarios que vuelvan 
al sitio web. En otras palabras, podemos decir que las cookies son 
pequeños archivos donde almacenamos datos, estos archivos se almacenan
en el navegador del cliente. 

Las cookies se deben crear antes del Doctype, ya que han de ser 
generadas antes de que el navegador procese el código HTML, son 
enviadas utilizando los encabezados del protocolo HTTP.

Ejemplo de uso de cookies: preferencias de idioma, seguimiento de 
anuncios, etc. 

setcookie(
    string $name,
    string $value = "",
    int $expires = 0, //En caso de no figurar este parámetro, la cookie se eliminará cuando se cierre el navegador
    string $path = "",
    string $domain = "",
    bool $secure = false,
    bool $httponly = false
): bool

//https://www.php.net/manual/es/function.setcookie.php
*/

setcookie("Idioma", "es", time() + 60 * 60 * 24 * 365, "/", "localhost", false, true);
//Nombre cookie, valor, expira al año, cualquier directorio del servidor, solo en localhost, no protocolo seguro, accesible con protocolo http. 

/*
El proceso de recuperación de la información que almacena una cookie es muy simple.
Cuando accedes a un sitio web, el navegador le envía de forma automática todo el
contenido de las cookies que almacene relativas a ese sitio en concreto. Desde PHP
puedes acceder a esta información por medio del array $_COOKIE.

Siempre que utilices cookies en una aplicación web, debes tener en cuenta que
en última instancia su disponibilidad está controlada por el cliente. Por ejemplo,
algunos usuarios deshabilitan las cookies en el navegador porque piensan que la
información que almacenan puede suponer un potencial problema de seguridad.
O la información que almacenan puede llegar a perderse porque el usuario
decide formatear el equipo o simplemente eliminarlas de su sistema.
*/

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookies</title>
</head>

<body>
    <h1>Hola mundo</h1>
    <h2>Mostrando datos de la coockie:</h2>
    <p>
        <?php
        echo $_COOKIE["Idioma"];
        ?>
    </p>
</body>

</html>