<?php
    /*
    A partir de PHP 8.
    La comprobación es de identidad "==="
    Sintaxis: 

    match(variable) {
        $variable => codigo a ejecutar,

        default => codigo a ejecutar
    };

    Ejemplo: 
    */
    $x = "1";
    $y = 1;
    $z = 2;

    $resultado = match($x) {
        //$y,$z => "Igual a y o a z",
        $y => "Igual a y",
        $z => "Igual a z",
        default => "No coincide con ninguna variable."
    };

    echo $resultado;

    //$variable también puede ser una condición.
    $edad = 18;

    $resultado = match(true) {
        $edad >= 60 => "Eres de la tercera edad.",
        $edad >= 30 => "Eres adulto.",
        $edad >= 18 => "Eres adulto jóven.",
        default => "Eres niño"
    };

    echo $resultado;