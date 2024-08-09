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