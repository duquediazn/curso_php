<?php 
/*
En el servidor web Apache, existe una utilidad en línea de comandos, htpasswd, 
que permite almacenar en un fichero una lista de usuarios y sus respectivas contraseñas. 
La información relativa a las contraseñas se almacena cifrada; aun así, es conveniente 
crear este fichero en un lugar no accesible por los usuarios del servidor web. 
Puedes tener información de este comando y sus opciones escribiendo en la terminal "htpasswd --help".

Por ejemplo, para crear el fichero de usuarios "proyecto.pass" y añadirle el usuario "gestor",
puedes hacer:

sudo htpasswd -c proyecto.pass gestor

e introducir la contraseña correspondiente a ese usuario a continuación.

La opción "–c" indica que se debe crear el fichero, por lo que solo deberás usarla cuando
introduzcas el primer usuario y contraseña. Fíjate que en el ejemplo anterior, el fichero
"proyecto.pass" se crea en la ruta "/etc/apache2/users", que en principio no es accesible vía
web.

Para indicarle al servidor Apache qué recursos tienen acceso restringido, una opción es crear
un fichero .htaccess en el directorio en que se encuentren, con las siguientes directivas:

AuthName "Contenido restringido"
AuthType Basic
AuthUserFile /etc/apache2/users/proyecto.pass
require valid-user

Además tendrás que asegurarte de que en la configuración de Apache se utiliza la directiva
AllowOverride para que se aplique correctamente la configuración que figura en los ficheros
.htaccess. En apache2.conf añadir: 

<Directory /ruta/del/archivo/>
    AllowOverride All
    Require all granted
</Directory>

Desde PHP puedes acceder a la información de autentificación HTTP
que ha introducido el usuario utilizando el array "superglobal"
$_SERVER.

$_SERVER['PHP_AUTH_USER'] - Nombre de usuario que se ha introducido.
$_SERVER['PHP_AUTH_PW'] - Contraseña introducida.
$_SERVER['AUTH_TYPE'] - Método HTTP usado para autentificar. Puede ser Basic o Digest.

Además, en PHP puedes usar la función header para forzar a que el servidor envíe un error
de "Acceso no autorizado" (código 401). De esta forma no es necesario utilizar ficheros
.htaccess para indicarle a Apache qué recursos están restringidos. 

Si utilizas la función header para forzar al navegador a solicitar credenciales
HTTP, el usuario introducirá un nombre y una contraseña. Pero el servidor no
verificará esta información; deberás ser tú quien provea un método para
comprobar que las credenciales que ha introducido el usuario son correctas.

El método más simple es incluir en el código PHP de tu página las sentencias
necesarias para comparar los datos introducidos con otros datos fijos. Por
ejemplo, para permitir el acceso a un usuario "gestor" con contraseña
"secreto", puedes hacer:

<?php
    //Si no .htaccess
    if ($_SERVER['PHP_AUTH_USER']!='gestor' || $_SERVER['PHP_AUTH_PW']!='secreto') {
        header('WWW-Authenticate: Basic Realm="Contenido restringido"');
        header('HTTP/1.0 401 Unauthorized');
        echo "Usuario no reconocido!";
        exit;
    }
?>

El primer header: Envía una cabecera HTTP que solicita la autenticación básica. El "Realm" especifica el ámbito
de la autenticación, que en este caso es "Contenido restringido". Esto indica al navegador que debe pedir al 
usuario un nombre de usuario y una contraseña.

El segundo: Envía una respuesta HTTP con el código de estado 401, que significa "No autorizado". 
Esto indica que el acceso al recurso está prohibido porque no se proporcionaron credenciales válidas.

Recuerda que el código PHP no se envía al navegador, por lo que la información de
autentificación que introduzcas en el código no será visible por el usuario. Sin embargo,
esto hará tu código menos portable. Si necesitas modificar el nombre de usuario o la
contraseña, tendrás que hacer modificaciones en el código. Además, no podrás permitir al
usuario introducir su propia contraseña.

Una solución mejor es utilizar un almacenamiento externo para los nombres de usuario y
sus contraseñas. Para esto podrías emplear un fichero de texto, o mejor aún, una base de
datos. La información de autentificación podrá estar aislada en su propia base de datos, o
compartir espacio de almacenamiento con los datos que utilice tu aplicación web.

Aunque se podrían almacenar las contraseñas en texto plano, por privacidad y
seguridad es mejor hacerlo en formato encriptado, por ejemplo, usando hash 
(con el algoritmo sha256). 

- En PHP puedes usar la función hash, por ejemplo hash('sha256',$cadena) devuelve el hash 
utilizando el algoritmo sha256.
- En MySQL select sha2('secreto',  256) nos devolverá el hash (utilizando el mismo algoritmo 
sha256).
*/