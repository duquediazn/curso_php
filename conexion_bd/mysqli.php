<?php
/*
ABRIR CONEXIONES DE DATOS UTILIZANDO MYSQLI:
https://www.php.net/manual/es/book.mysqli.php

// utilizando el constructor de la clase
$conProyecto = new mysqli('localhost','admin_db', 'proyecto_db', 'secreto');

// utilizando el método connect
$conProyecto = new mysqli();
$conProyecto->connect('localhost', 'admin_db', 'secreto', 'proyecto_db');

// utilizando llamadas a funciones
$conProyecto = mysqli_connect('localhost', 'admin_db', 'secreto', 'proyecto_db');
*/
/*
Para comprobar el error, en caso de que se produzca, puedes usar las siguientes propiedades (o funciones
equivalentes) de la clase mysqli:

- connect_errno (o la función mysqli_connect_errno): Devuelve el código de error de la última llamada,
 cero significa que no hay error.
- connect_error (o la función mysqli_connect_error) devuelve el mensaje de error o null si
no se produce ningún error.

El siguiente código comprueba el establecimiento de una conexión con la base
de datos "proyecto_db" y finaliza la ejecución si se produce algún error:

@$conProyecto = new mysqli('localhost', 'admin_db', 'secreto', 'proyecto_db');
$error = $conProyecto->connect_errno;
if ($error != 0) {
    echo "<p>Error $error conectando a la base de datos: $conProyecto->connect_error</p>";
    die();
}

Operador @:
/https://www.php.net/manual/es/language.operators.errorcontrol.php

Si una vez establecida la conexión, quieres cambiar la base de datos puedes usar el
método "select_db" (o la función "mysqli_select_db" de forma equivalente) para indicar el
nombre de la nueva, lógicamente el usuario con el que hemos iniciado la conexión debe
tener permisos en la nueva.

// utilizando el método connect
$conProyecto->select_db('otra_bd');

Una vez finalizadas las tareas con la base de datos, utiliza el método "close" (o la función
"mysqli_close") para cerrar la conexión con la base de datos y liberar los recursos que
utiliza.

$conProyecto->close();

La forma más inmediata de ejecutar una consulta, si utilizas esta
extensión, es el método query, equivalente a la función mysqli_query.
Si se ejecuta una consulta de acción que no devuelve datos (como
una sentencia SQL de tipo UPDATE, INSERT o DELETE), la llamada
devuelve true si se ejecuta correctamente o false en caso contrario.
El número de registros afectados se puede obtener con la propiedad
affected_rows (o con la función mysqli_affected_rows).
*/

$conProyecto = new mysqli('localhost', 'admin_db', 'secreto', 'proyecto_db');

// Verificamos la conexión
if ($conProyecto->connect_errno) {
    echo "Error en la conexión: " . $conProyecto->connect_error;
    exit();
}

// Comprobar registros antes de eliminar
$resultado = $conProyecto->query('SELECT * FROM stocks WHERE unidades=0');
if ($resultado) {
    echo "<p>Registros con unidades = 0: " . $resultado->num_rows . "</p>";
} else {
    echo "Error en la consulta: " . $conProyecto->error;
}

// Ejecutar la consulta de eliminación
$resultado = $conProyecto->query('DELETE FROM stocks WHERE unidades=0');

if ($resultado) {
    echo "<p>Se han borrado $conProyecto->affected_rows registros.</p>";
} else {
    echo "Error en la consulta: " . $conProyecto->error;
}

/*
El método "query()" tiene un parámetro opcional que afecta a cómo se obtienen
internamente los resultados, pero no a la forma de utilizarlos posteriormente. En la opción
por defecto, MYSQLI_STORE_RESULT, los resultados se recuperan todos juntos de la base de
datos y se almacenan de forma local. Si cambiamos esta opción por el valor
MYSQLI_USE_RESULT, los datos se van recuperando del servidor según se vayan necesitando.

$resultado = $conProyecto->query('SELECT producto, unidades FROM stock', MYSQLI_USE_RESULT);

Otra forma que puedes utilizar para ejecutar una consulta es el método
real_query (o la función mysqli_real_query), que siempre devuelve true o false
según se haya ejecutado correctamente o no. Si la consulta devuelve un
conjunto de resultados, se podrán recuperar de forma completa utilizando el
método store_result, o según vaya siendo necesario gracias al método
use_result.

https://www.php.net/manual/es/mysqli.real-query.php

Es importante tener en cuenta que los resultados obtenidos se almacenarán en memoria
mientras los estés usando. Cuando ya no los necesites, los puedes liberar con el método
free de la clase mysqli_result (o con la función mysqli_free_result):

$resultado->free();

TRANSACCIONES:
Si necesitas utilizar transacciones deberás
asegurarte de que estén soportadas por el motor de almacenamiento
que gestiona tus tablas en MySQL. Si utilizas InnoDB, por defecto
cada consulta individual se incluye dentro de su propia transacción.
Puedes gestionar este comportamiento con el método autocommit
(función mysqli_autocommit).

$conProyecto->autocommit(false);
 
Al deshabilitar las transacciones automáticas, las siguientes operaciones sobre la base de
datos iniciarán una transacción que deberás finalizar utilizando:
- commit (o la función mysqli_commit). Realizar una operación "commit" de la transacción
actual, devolviendo true si se ha realizado correctamente o false en caso contrario.
- rollback (o la función mysqli_rollback). Realizar una operación "rollback" de la
transacción actual, devolviendo true si se ha realizado correctamente o false en caso
contrario. 
Ejemplo:
$conProyecto->query('DELETE FROM stock WHERE unidades=0');  // Inicia una transacción

$conProyecto->query('UPDATE stock SET unidades=3 WHERE producto="STYLUSSX515W"');

$conProyecto->commit();  // Confirma los cambios

OBTENCIÓN Y UTILIZACIÓN DE CONJUNTOS DE RESULTADOS:
Al ejecutar una consulta que devuelve datos obtienes
un objeto de la clase mysqli_result. 

Para trabajar con los datos obtenidos del servidor, tienes varias
posibilidades:
- fetch_array (función mysqli_fetch_array). Obtiene un registro
completo del conjunto de resultados, lo almacena en un array y  
mueve el puntero de datos interno hacia delante. Por defecto el 
array contiene tanto claves numéricas como asociativas. 
*/

$resultado = $conProyecto->query('SELECT producto, unidades FROM stocks WHERE unidades<2');
/*
$stock = $resultado->fetch_array();  // Obtenemos el primer registro

$producto = $stock['producto'];  // O también $stock[0];

$unidades = $stock['unidades'];  // O también $stock[1];

echo "<p>Producto $producto: $unidades unidades.</p>";

Este comportamiento por defecto se puede modificar utilizando un parámetro opcional,
que puede tomar los siguientes valores:
    1.- MYSQLI_NUM. Devuelve un array con claves numéricas.
    2.- MYSQLI_ASSOC. Devuelve un array asociativo.
    3.- MYSQLI_BOTH. Es el comportamiento por defecto, en el que devuelve un array con
    claves numéricas y asociativas.

- fetch_assoc (función mysqli_fetch_assoc). Idéntico a fetch_array pasando como
parámetro MYSQLI_ASSOC.
- fetch_row (función mysqli_fetch_row). Idéntico a fetch_array pasando como parámetro
MYSQLI_NUM.
- fetch_object (función mysqli_fetch_object). Similar a los métodos anteriores, pero
devuelve un objeto en lugar de un array. Las propiedades del objeto devuelto se
corresponden con cada uno de los campos del registro.

Parar recorrer todos los registros de un array, puedes hacer un bucle teniendo en cuenta
que cualquiera de los métodos o funciones anteriores devolverán null cuando no haya más
registros en el conjunto de resultados.*/

$stock = $resultado->fetch_object();

while ($stock != null) {
    echo "<p>Producto $stock->producto: $stock->unidades unidades.</p>";
    $stock = $resultado->fetch_object();
}

/*
Más sobre mysqli_result: https://www.php.net/manual/es/class.mysqli-result.php

CONSULTAS PREPARADAS:
Cada vez que se envía una consulta al servidor, éste debe analizarla
antes de ejecutarla. Algunas sentencias SQL, como las que insertan
valores en una tabla, deben repetirse de forma habitual en un
programa. Para acelerar este proceso, MySQL admite consultas
preparadas. Estas consultas se almacenan en el servidor listas para
ser ejecutadas cuando sea necesario.
Por otra parte existe un riesgo de seguridad muy importante al usar
formularios para insertar, consultar, modificar, borrar datos en una
base de datos, la "inyección SQL" . Unos de los métodos que se recomiendan para evitar
este tipo de ataques es precisamente usar consultas parametrizadas ya que los valores de
los parámetros, son transmitidos después, usando un protocolo diferente y no necesitan ser
escapados.
Para trabajar con consultas preparadas con la extensión MySQLi de PHP, debes utilizar la
clase mysqli_stmt. Utilizando el método stmt_init de la clase mysqli (o la función
mysqli_stmt_init) obtienes un objeto de dicha clase.

Los pasos que debes seguir para ejecutar una consulta preparada son:
- Preparar la consulta en el servidor MySQL utilizando el método prepare (función
mysqli_stmt_prepare).
- Ejecutar la consulta, tantas veces como sea necesario, con el método execute (función
mysqli_stmt_execute).
- Una vez que ya no se necesita más, se debe ejecutar el método close (función
mysqli_stmt_close).
Por ejemplo, para preparar y ejecutar una consulta que inserta un nuevo registro en la tabla
familia:

$stmt = $conProyecto->stmt_init();

$stmt->prepare('INSERT INTO familias (cod, nombre) VALUES ("TABLET", "Tablet PC")');

$stmt->execute();

$stmt->close();

$conProyecto->close();

Para preparar una consulta con
parámetros, en lugar de poner los valores debes indicar con un signo de interrogación su
posición dentro de la sentencia SQL.

$stmt->prepare('INSERT INTO familias (cod, nombre) VALUES (?, ?)');

Y antes de ejecutar la consulta tienes que utilizar el método bind_param (o la función
mysqli_stmt_bind_param) para sustituir cada parámetro por su valor. El primer parámetro del
método bind_param es una cadena de texto en la que cada carácter indica el tipo de un
parámetro, según la siguiente tabla.

Carácter. Tipo del parámetro.
i.        Número entero.
i.        Número real (doble precisión).
s.        Cadena de texto.
b.        Contenido en formato binario (BLOB).

$stmt = $conProyecto->stmt_init();

$stmt->prepare('INSERT INTO familias (cod, nombre) VALUES (?, ?)');

$cod_producto = "TABLET";

$nombre_producto = "Tablet PC";

$stmt->bind_param('ss', $cod_producto, $nombre_producto);

$stmt->execute();

$stmt->close();

$conProyecto->close();

Cuando uses bind_param para enlazar los parámetros de una consulta preparada
con sus respectivos valores, deberás usar siempre variables como en el ejemplo
anterior. Si intentas utilizar literales, por ejemplo:

$stmt->bind_param('ss', 'TABLET', 'Tablet PC');  // Genera un error

Obtendrás un error. El motivo es que los parámetros del método bind_param se
pasan por referencia. 

En el caso de las consultas que devuelven valores, se puede utilizar el método bind_result
(función mysqli_stmt_bind_result) para asignar a variables los campos que se obtienen tras
la ejecución. Utilizando el método fetch (mysqli_stmt_fetch) se recorren los registros
devueltos. Observa el siguiente código:
*/
$stmt = $conProyecto->stmt_init();

$stmt->prepare('SELECT producto, unidades FROM stocks WHERE unidades<2');

$stmt->execute();

$stmt->bind_result($producto, $unidades);

while ($stmt->fetch()) {
    echo "<p>Producto $producto: $unidades unidades.</p>";
}

$stmt->close();

$conProyecto->close();

//https://www.php.net/manual/es/class.mysqli-stmt.php

/*
Recomendación:
Tanto $stmt->prepare() como $stmt->execute() devuelven un dato de tipo
booleano, podemos usar esto para controlar errores, fíjate en el ejemplo
siguiente:

$stmt=$conProyecto->stmt_init();

$cod=1;

$consulta="select nombre from productos where id=?";

if(!($stmt->prepare($consulta))){
    echo "Se ha producido un error: " . $conProyecto->error();
    die();
}

$stmt->bind_param('i', $cod);

if(!$stmt->execute()){

    //error
}*/