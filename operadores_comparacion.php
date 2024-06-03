<?php
    /* Como en otro lenguajes como JavaScript:
    == igual 
    === idéntico (compara tipos también)
    != diferente
    <> diferente
    !== no idéntico (compara tipos también)
    < menor que
    > mayor que 
    <= menor o igual
    >= mayor o igual 

    Los string sí se pueden comparar con estos operadores.
    */ 
    $nombre1="Nazaret";
    $nombre2="nazaret";
    echo var_dump($nombre1!==$nombre2); //bool(true)
    echo var_dump($nombre1===$nombre2); //bool(false)
    echo $nombre1!==$nombre2; // 1
    echo $nombre1===$nombre2; // no devuelve nada