<?php
    /*
    Una función es un conunto de instrucciones a la que podemos recurrir siempre que queramos.
    Éstas pueden recibir parámetros y realizar todo tipo de tareas, ya sean complejas o sencillas.

    Un nombre de función válido comienza con una letra o guión bajo, seguido de cualquier 
    número de letras, números o guiones bajos.a

    Sintaxis:

    function nombre_funcion($parametros) {
        Código de la función
    }

    Ejemplo:
    */

    /*
    function saludar() {
        echo "Hola mundo!";
    }

    saludar();

    function saludar2() {
        return "Hola mundo!";
    }
    
    $saludo = saludar2();
    echo $saludo;
    echo saludar2();
    
    function saludo($nombre) {
        return "Hola, mi nombre es $nombre";
    }

    $saludo = saludo("Nicole");
    echo $saludo;

    echo saludo("María");

    $nombre = "Stephen";
    echo saludo($nombre);
    */
    function calculo_promedio($nota1,$nota2,$nota3) {
        $promedio = ($nota1+$nota2+$nota3)/3;
        return $promedio;
    }

    //echo "El promedio es: ".calculo_promedio(10,9,8);