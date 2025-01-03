<?php

    /*En PHP también hay otra forma de recorrer los valores de un array. 
    Cada array mantiene un puntero interno, que se puede utilizar con este fin. Utilizando 
    funciones específicas,podemos avanzar, retroceder o inicializar el puntero, 
    así como recuperar los valores del elemento (o de la pareja clave /elemento) 
    al que apunta el puntero en cada momento. Algunas de estas funciones son:

    reset(): Sitúa el puntero interno al comienzo del array.
    next(): Avanza el puntero interno una posición.
    prev(): Mueve el puntero interno una posición hacia atrás.
    end(): Sitúa el puntero interno al final del array      .
    current(): Devuelve el elemento de la posición actual.
    key(): Devuelve la clave de la posición actual.
    Además, avanza el puntero interno una posición.

    Las funciones reset(), next(), prev() y end(), además de mover el puntero interno devuelven, al igual que
    current(), el valor del nuevo elemento en que se posiciona. Si al mover el puntero te sales de los límites del
    array (por ejemplo, si ya estás en el último elemento y haces un next()), cualquiera de ellas devuelve
    false. Sin embargo, al comprobar este valor devuelto no serás capaz de distinguir si te has salido de los límites del
    array, o si estás en una posición válida del array que contiene el valor "false". La función key() devuelve
    null si el puntero interno está fuera de los límites del array.

    Bucle que recorra el array de la siguiente forma:
    */    
    $modulos = ["PR" => "Programación", "BD" => "Bases de datos", "DWES" => "Desarrollo web en entorno servidor"];

    while (current($modulos) != false && key($modulos)!=null) {
        echo "El código del módulo ".current($modulos)." es ".key($modulos)."<br />";
        next($modulos);
    }
    reset($modulos);
    