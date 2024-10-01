<?php

/*
PHP Data Objects (PDO)
https://www.php.net/manual/es/class.pdo.php

Para establecer una conexión con una base de datos utilizando
PDO, debes instanciar un objeto de la clase PDO pasándole los
siguientes parámetros (solo el primero es obligatorio):
- Origen de datos (DSN). Es una cadena de texto que indica
qué controlador se va a utilizar y a continuación, separadas
por el carácter dos puntos, los parámetros específicos
necesarios por el controlador, como por ejemplo el nombre o
dirección IP del servidor y el nombre de la base de datos.
- Nombre de usuario con permisos para establecer la conexión.
- Contraseña del usuario.
- Opciones de conexión, almacenadas en forma de array.
*/

$host = "localhost";
$db = "proyecto";
$user = "gestor";
$pass = "secreto";
$dsn = "mysql:host=$host;dbname=$db";
$conProyecto = new PDO($dsn, $user, $pass);
//se recomienda guardar los datos(host, user...) en variables porque si estos cambian
//solo tenemos que actualizar el valor de estas variables

/*Si como en el ejemplo, se utiliza el controlador para MySQL, los parámetros específicos
para utilizar en la cadena DSN (separadas unas de otras por el carácter punto y coma) a
continuación del prefijo mysql: son los siguientes:
- host. Nombre o dirección IP del servidor.
- port. Número de puerto TCP en el que escucha el servidor.
- dbname. Nombre de la base de datos.
- unix_socket. Socket de MySQL en sistemas Unix.
Si quisieras indicar al servidor MySQL que utilice codificación UTF-8 o UTF8mb4 (utf8 con
soporte para "emojis" muy recomendable) para los datos que se transmitan, aunque hay
más formas de hacerlo la siguiente es la más sencilla.*/

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

//https://www.php.net/manual/es/pdo.drivers.php

/*Una vez establecida la conexión, puedes utilizar el método getAttribute para obtener
información del estado de la conexión y setAttribute para modificar algunos parámetros que
afectan a la misma. Por ejemplo, para obtener la versión del servidor puedes hacer:
https://www.php.net/manual/es/pdo.getattribute.php
https://www.php.net/manual/es/pdo.setattribute.php
*/

$version = $conProyecto->getAttribute(PDO::ATTR_SERVER_VERSION);
echo "Versión: $version";

//Y si quieres por ejemplo que te devuelva todos los nombres de columnas en mayúsculas:

$version = $conProyecto->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);

/*Y muy importante para controlar los errores tendremos el atributo: ATTR_ERRMODE con los
posible valores:
- ERRMODE_SILENT: El modo por defecto, no muestra errores (se recomienda en entornos
en producción).
- ERRMODE_WARNING: Además de establecer el código de error, emitirá un mensaje
E_WARNING, es el modo empleado para depurar o hacer pruebas para ver errores sin
interrumpir el flujo de la aplicación.
- ERRMODE_EXCEPTION: Además de establecer el código de error, lanzará una PDOException
que podemos capturar en un bloque try catch(). */

$conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*Para cerrar la conexión hay que saber que la misma permanecerá activa durante el tiempo
de vida del objeto PDO. Para cerrarla, es necesario destruir el objeto asegurándose de que
todas las referencias a él existentes sean eliminadas; esto se puede hacer asignando null a
la variable que contiene el objeto.

$conProyecto = null;

En el caso de las consultas de acción, como INSERT, DELETE o UPDATE,
el método exec devuelve el número de registros afectados.*/

$registros = $conProyecto->exec('DELETE FROM stocks WHERE unidades=0');
echo "<p>Se han borrado $registros registros.</p>";

/*Si la consulta genera un conjunto de datos, como es el caso de SELECT, debes utilizar el
método query, que devuelve un objeto de la clase PDOStatement.*/

$conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$resultado = $conProyecto->query("SELECT producto, unidades FROM stock");

/*
Por defecto PDO trabaja en modo "autocommit", esto es, confirma de forma automática cada
sentencia que ejecuta el servidor. Para trabajar con transacciones, PDO incorpora tres
métodos:
- beginTransaction. Deshabilita el modo "autocommit" y comienza una nueva transacción,
que finalizará cuando ejecutes uno de los dos métodos siguientes.
- commit. Confirma la transacción actual.
- rollback. Revierte los cambios llevados a cabo en la transacción actual.
Una vez ejecutado un commit o un rollback, se volverá al modo de confirmación automática.*/

$ok = true;
$conProyecto->beginTransaction();
if (!$conProyecto->exec('DELETE FROM stocks WHERE unidades=0')) $ok = false;

if ($ok) $conProyecto->commit();  // Si todo fue bien confirma los cambios
else $conProyecto->rollback(); // y si no, los revierte

/*Ten en cuenta que no todos los motores soportan transacciones. Tal es el caso 
del motor MyISAM de MySQL. En este caso concreto, PDO ejecutará el método
beginTransaction sin errores, pero naturalmente no será capaz de revertir los cambios si
fuera necesario ejecutar un rollback.*/