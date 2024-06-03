<?php
    $nombre="Nazaret";
    $apellido="Duque";
    //Concatenamos strings mediante el operador "."
    $nombreCompleto = $nombre.$apellido;
    
    echo $nombreCompleto;

    //también se pueden concatenar otro tipo de valores:
    $numero = 36;

    echo "Mi nombre es ".$nombre.", tengo: ".$numero. " años.";

    /*Interpolación de variables: podemos interpolar una variable
    dentro de un string, automáticamente se convierte en string
    sin necesidad de utilizar el operador punto "."*/

    echo "Mi nombre es  $nombre, tengo: $numero  años.";

    /*También se pueden escribir strings con comillas simples '', pero
    estas no interpolan las variables.*/

    echo 'Mi nombre es $nombre'; //Muestra: Mi nombre es $nombre

    //También se pueden interpolar entre llaver {} como en Java.
    echo "Mi nombre es {$nombre}"; //Muestra: Mi nombre es Nazaret