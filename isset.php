<?php

//Para saber si una variable es nula: 
$numero=9;

unset($numero); //Eliminamos el valor de una variable -> $numero=null

if(is_null($numero)) { //Si la variable es nula devuelve true. 
    echo "Es nula";
} else {
    echo "No es nula";
}

echo "<br>";

if(empty($numero)) { //Si la variable está vacía devuelve true.
    echo "Está vacía";
} else {
    echo "No está vacía";
}

/*
https://www.php.net/manual/es/function.empty.php
Los siguientes valores son considerados como vacíos:

"" (una cadena vacía)
0 (0 como un integer)
0.0 (0 como un float)
"0" (0 como un string)
null
false
array() (un array vacío)
*/

echo "<br>";
//https://www.php.net/manual/es/function.isset.php
if(isset($numero)) { //Si la variable está definida y no es null devuelve true.
    echo "Está definida";
} else {
    echo "No está definida";
}
