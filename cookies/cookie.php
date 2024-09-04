<?php
/*
Las cookies son un mecanismo por el que se almacenan datos en el 
navegador para monitorizar o identificar a los usuarios que vuelvan 
al sitio web. En otras palabras, podemos decir que las cookies son 
pequeños archivos donde almacenamos datos, estos archivos se almacenan
en el navegador del cliente. 

Las cookies se deben crear antes del Doctype, ya que han de ser 
generadas antes de que el navegador procese el código HTML.

Ejemplo de uso de cookies: preferencias de idioma, seguimiento de 
anuncios, etc. 

setcookie(
    string $name,
    string $value = "",
    int $expires = 0,
    string $path = "",
    string $domain = "",
    bool $secure = false,
    bool $httponly = false
): bool

//https://www.php.net/manual/es/function.setcookie.php
*/

setcookie("Idioma", "es", time()+60*60*24*365, "/", "localhost", false, true); 
//Nombre cookie, valor, expira al año, cualquier directorio del servidor, solo en localhost, no protocolo seguro, accesible con protocolo http. 

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