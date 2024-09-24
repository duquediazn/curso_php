<?php
    /*Para recorrer arrays. 
    Sintaxis 1: 

    foreach($array as $valor) {
        $valor tendrá en cada iteración un valor del array
    }

    Sintaxis 2:

    foreach($array as $clave => $valor) {
        $clave tendrá en cada iteración una clave del array

        $valor tendrá en cada iteración un valor del array
    }
    */

    $laptop=["Acer Nitro 5", "Windows 11", "AMD Ryzen 5 4600H", "SSD 256GB", "RAM 4GB"];

    $frutas = [
        "Fresas" => 100,
        "Peras" => 30,
        "Sandías" => 10,
        "Melocotones" => 17,
        "Manzanas" => 9
    ];

    //array multidimensional
    $productos=[
        ["codigo" => "A0001", "descripción" => "Mouse"],
        ["codigo" => "A0002", "descripción" => "Teclado"],
        ["codigo" => "A0003", "descripción" => "Monitor"]
    ];

    foreach($laptop as $valor) {
        echo $valor."<br>";
    }

    foreach($laptop as $clave => $valor) {
        echo $clave.": ".$valor."<br>";
    }

    foreach($frutas as $clave => $valor) {
        echo $clave.": ".$valor."<br>";
    }

    //array multidimensional
    foreach($productos as $prod) {
        echo $prod["codigo"].": ".$prod["descripción"]."<br>";
    }
    
    /*
    Si quieres buscar un elemento concreto dentro de un array, puedes utilizar la función
    in_array(). Recibe como parámetros el elemento a buscar y la variable de tipo array
    en la que buscar, y devuelve true si encontró el elemento o false en caso contrario.
    */
    $modulos = ["Programación", "Bases de datos", "Desarrollo web en entorno servidor"];

    $modulo = "Bases de datos";

    $inArray=in_array($modulo, $modulos) ? "Existe el módulo de nombre $modulo" : "No existe el módulo de nombre $modulo";
    echo $inArray;

    /*Otra posibilidad es la función array_search(), que recibe los mismos parámetros pero devuelve 
    la clave correspondiente al elemento, o false si no lo encuentra. Y si lo que quieres buscar es una 
    clave en un array, tienes la función array_key_exists(), que devuelve true o false.*/

    if ($clave_modulo = array_search($modulo, $modulos)) echo "Existe el módulo de nombre $modulo, cuya clave es $clave_modulo"; 
    
    $arrayKeyExist = array_key_exists(3, $modulos) ? "Existe la clave" : "No existe la clave";
    echo $arrayKeyExist;