<?php
/*
https://www.php.net/manual/es/book.mysqli.php
Abrir conexiones a base de datos utilizando mysqli:

// utilizando el constructor de la clase
$conProyecto = new mysqli('localhost','gestor', 'proyecto', 'secreto');

// utilizando el método connect
$conProyecto = new mysqli();
$conProyecto->connect('localhost', 'gestor', 'secreto', 'proyecto');

// utilizando llamadas a funciones
$conProyecto = mysqli_connect('localhost', 'gestor', 'secreto', 'proyecto');
*/
/*
    Para comprobar el error, en caso de que se produzca, puedes usar las siguientes propiedades (o funciones
equivalentes) de la clase mysqli:

- connect_errno (o la función mysqli_connect_errno) devuelve el número de error o null si
no se produce ningún error.
- connect_error (o la función mysqli_connect_error) devuelve el mensaje de error o null si
no se produce ningún error.

El siguiente código comprueba el establecimiento de una conexión con la base
de datos "proyecto" y finaliza la ejecución si se produce algún error:*/
@$conProyecto = new mysqli('localhost', 'gestor', 'secreto', 'proyecto');
$error = $conProyecto->connect_errno;
if ($error != null) {
    echo "<p>Error $error conectando a la base de datos: $conProyecto->connect_error</p>";
    die();
}

//https://www.php.net/manual/es/language.operators.errorcontrol.php

/*
Si una vez establecida la conexión, quieres cambiar la base de datos puedes usar el
método "select_db" (o la función "mysqli_select_db" de forma equivalente) para indicar el
nombre de la nueva, lógicamente el usuario con el que hemos iniciado la conexión debe
tener permisos en la nueva.

// utilizando el método connect

$conProyecto->select_db('otra_bd');

Una vez finalizadas las tareas con la base de datos, utiliza el método "close" (o la función
"mysqli_close") para cerrar la conexión con la base de datos y liberar los recursos que
utiliza.*/
$conProyecto->close();
