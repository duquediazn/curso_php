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
$db = "proyecto_db";
$user = "admin_db";
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

$conProyecto = new PDO($dsn, $user, $pass);
$version = $conProyecto->getAttribute(PDO::ATTR_SERVER_VERSION);
echo "Versión: $version";

/*Y si quieres por ejemplo que te devuelva todos los nombres de columnas en mayúsculas:

$version = $conProyecto->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);

Y muy importante para controlar los errores tendremos el atributo: ATTR_ERRMODE con los
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
método query, que devuelve un objeto de la clase PDOStatement.

$conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$resultado = $conProyecto->query("SELECT producto, unidades FROM stock");

Por defecto PDO trabaja en modo "autocommit", esto es, confirma de forma automática cada
sentencia que ejecuta el servidor. Para trabajar con transacciones, PDO incorpora tres
métodos:
- beginTransaction. Deshabilita el modo "autocommit" y comienza una nueva transacción,
que finalizará cuando ejecutes uno de los dos métodos siguientes.
- commit. Confirma la transacción actual.
- rollback. Revierte los cambios llevados a cabo en la transacción actual.
Una vez ejecutado un commit o un rollback, se volverá al modo de confirmación automática.

$ok = true;
$conProyecto->beginTransaction();
if (!$conProyecto->exec('DELETE FROM stocks WHERE unidades=0')) $ok = false;

if ($ok) $conProyecto->commit();  // Si todo fue bien confirma los cambios
else $conProyecto->rollback(); // y si no, los revierte

Ten en cuenta que no todos los motores soportan transacciones. Tal es el caso 
del motor MyISAM de MySQL. En este caso concreto, PDO ejecutará el método
beginTransaction sin errores, pero naturalmente no será capaz de revertir los cambios si
fuera necesario ejecutar un rollback.


Obtención y utilización de conjuntos de resultados

Al igual que con la extensión MySQLi, en PDO tienes varias
posibilidades para tratar con el conjunto de resultados devuelto por el
método query, que devuelve un objeto PDOStatement, o false en caso de error. 
La más utilizada es el método fetch de la clase
PDOStatement. Este método devuelve un registro del conjunto de
resultados, o false si ya no quedan registros por recorrer.
*/

$resultado = $conProyecto->query("SELECT producto, unidades FROM stocks");
while ($registro = $resultado->fetch()) {
    echo "Producto " . $registro['producto'] . ": " . $registro['unidades'] . "<br />";
}

/*
Por defecto, el método fetch genera y devuelve a partir de cada registro un array con claves
numéricas y asociativas. Para cambiar su comportamiento, admite un parámetro opcional
que puede tomar uno de los siguientes valores:
- PDO::FETCH_ASSOC. Devuelve solo un array asociativo.
- PDO::FETCH_NUM. Devuelve solo un array con claves numéricas.
- PDO::FETCH_BOTH. Devuelve un array con claves numéricas
 y asociativas. Es el
comportamiento por defecto.
- PDO::FETCH_OBJ. Devuelve un objeto cuyas propiedades se corresponden con los
campos del registro.*/

$resultado = $conProyecto->query("SELECT producto, unidades FROM stocks");
while ($registro = $resultado->fetch(PDO::FETCH_OBJ)) {
    echo "Producto " . $registro->producto . ": " . $registro->unidades . "<br />";
}

/*
- PDO::FETCH_LAZY. Devuelve tanto el objeto como el array con clave dual anterior.
- PDO::FETCH_BOUND. Devuelve true y asigna los valores del registro a variables, según se
indique con el método bindColumn. Este método debe ser llamado una vez por cada
columna, indicando en cada llamada el número de columna (empezando en 1) y la
variable a asignar.

$resultado->bindColumn(1, $producto);
$resultado->bindColumn(2, $unidades);
while ($registro = $resultado->fetch(PDO::FETCH_OBJ)) {
    echo "Producto " . $producto . ": " . $unidades . "<br />";
}


También podemos utilizar fecthAll() que te trae todos los datos de golpe, sin abrir ningún
puntero, almacenándolos en un array. Se recomienda cuando no se esperan demasiados
resultados, que podrían provocar problemas de memoria al querer guardar de golpe en un
array muchas filas provenientes de una consulta.
*/

$resultado = $conProyecto->query("SELECT nombre, nombre_corto FROM productos");
$registros = $resultado->fetchAll(PDO::FETCH_ASSOC);
foreach ($registros as $row) {
    echo "Nombre: " . $row["nombre"] . " - Nombre corto: " . $row["nombre_corto"] . "<br>";
}

/*
CONSULTAS PREPARADAS
Para preparar la consulta en el servidor MySQL, deberás utilizar el
método prepare de la clase PDO. Este método devuelve un objeto de
la clase PDOStatement. Los parámetros se pueden marcar utilizando
signos de interrogación 


$stmt = $conProyecto->prepare('INSERT INTO familia (cod, nombre) VALUES (?, ?)');

//O también utilizando parámetros con nombre, precediéndolos por el símbolo de dos puntos.

$consulta = $conProyecto->prepare('INSERT INTO familia (cod, nombre) VALUES (:cod, :nombre)');

Antes de ejecutar la consulta hay que asignar un valor a los parámetros utilizando el método
bindParam de la clase PDOStatement. Si utilizas signos de interrogación para marcar los
parámetros.

$cod_producto = "TABLET";
$nombre_producto = "Tablet PC";
$consulta->bindParam(1, $cod_producto);
$consulta->bindParam(2, $nombre_producto);

Si utilizas parámetros con nombre, debes indicar ese nombre en la llamada a bindParam.

$nombre = "Monitores";
$codigo = "MONI";

$consulta->bindParam(":cod", $codigo);
$consulta->bindParam(":nombre", $nombre);

Tal y como sucedía con la extensión MySQLi, cuando uses bindParam para
asignar los parámetros de una consulta preparada, deberás usar siempre
variables como en el ejemplo anterior.

Una vez preparada la consulta y enlazados los parámetros con sus valores, se ejecuta la
consulta utilizando el método execute.

$consulta->execute();

Todo lo anterior preparado en un bloque try-catch:
*/
try {
    $conProyecto = new PDO($dsn, $user, $pass);
    $conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $consulta = $conProyecto->prepare('INSERT INTO familias (cod, nombre) VALUES (:cod, :nombre)');
    $nombre = "Monitores";
    $codigo = "MONI";

    $consulta->bindParam(":cod", $codigo);
    $consulta->bindParam(":nombre", $nombre);

    $consulta->execute();
    echo "Registro insertado correctamente.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

/*
También existe otra forma de pasar valores a los parámetros. Hay un método
funciona pasando los valores mediante un array, al método execute().
lazy , que funciona pasando los valores mediante un array, al método execute().

$consulta->execute([ ':cod'=>$codigo, ':nombre'=>$nombre]);

ó:

$parametros = [
    ':cod'=>$codigo,
    ':nombre'=>$nombre
];

$consulta->execute($parametros);

https://www.php.net/manual/es/class.pdostatement.php

ERRORES Y MANEJO DE EXCEPCIONES:
https://www.php.net/manual/es/errorfunc.constants.php

Para hacer referencia a cada uno de los
niveles de error, PHP define una serie de constantes.
Por ejemplo, la constante E_NOTICE hace referencia a avisos que
pueden indicar un error al ejecutar el guión, y la constante E_ERROR engloba errores fatales
que provocan que se interrumpa forzosamente la ejecución. 

La configuración inicial de cómo se va a tratar cada error según su nivel se realiza en
php.ini el fichero de configuración de PHP. Entre los principales parámetros que puedes
ajustar están:
- error_reporting. Indica qué tipos de errores se notificarán. Su valor se forma utilizando
los operadores a nivel de bit para combinar las constantes anteriores. Su valor
predeterminado es E_ALL & ~E_NOTICE que indica que se notifiquen todos los errores
(E_ALL) salvo los avisos en tiempo de ejecución (E_NOTICE).
- display_errors. En su valor por defecto (On), hace que los mensajes se envíen a la
salida estándar (y por lo tanto se muestren en el navegador). Se debe desactivar (Off)
en los servidores que no se usan para desarrollo sino para producción.

https://www.php.net/manual/es/errorfunc.configuration.php

Al usar la función error_reporting solo controlas qué tipo de errores va a notificar PHP. A
veces puede ser suficiente, pero para obtener más control sobre el proceso existe también
la posibilidad de reemplazar la gestión de los mismos por la que tú definas. Es decir, puedes
programar una función para que sea la que se ejecuta cada vez que se produce un error. El
nombre de esa función se indica utilizando set_error_handler y debe tener como mínimo dos
parámetros obligatorios (el nivel del error y el mensaje descriptivo) y hasta otros tres
opcionales con información adicional sobre el error (el nombre del fichero en que se
produce, el número de línea, y un volcado del estado de las variables en ese momento).
La función restore_error_handler restaura el manejador de errores original de PHP (más
concretamente, el que se estaba usando antes de la llamada a set_error_handler).

EXEPCIONES:
A partir de la versión 5 se introdujo en PHP un modelo de
excepciones similar al existente en otros lenguajes de programación:
- El código susceptible de producir algún error se introduce en un
bloque try.
- Cuando se produce algún error, se lanza una excepción
utilizando la instrucción throw.
- Después del bloque try debe haber como mínimo un bloque
 catch encargado de procesar el error.
- Si una vez acabado el bloque try no se ha lanzado ninguna excepción, se continúa
con la ejecución en la línea siguiente al bloque o bloques catch

PHP ofrece una clase base Exception para utilizar como manejador (handler) de
excepciones. Para lanzar una excepción no es necesario indicar ningún parámetro, aunque
de forma opcional se puede pasar un mensaje de error. 

Entre los métodos que puedes usar con los objetos de la clase Exception están:
- getMessage. Devuelve el mensaje, en caso de que se haya puesto alguno.
- getCode. Devuelve el código de error si existe.
Las funciones internas de PHP y muchas extensiones como MySQLi usan el sistema de
errores visto anteriormente. Solo las extensiones más modernas orientadas a objetos, como
es el caso de PDO, utilizan este modelo de excepciones. En este caso, lo más común es
que la extensión defina sus propios manejadores de errores heredando de la clase Exception

https://www.php.net/manual/es/class.errorexception.php
*/
