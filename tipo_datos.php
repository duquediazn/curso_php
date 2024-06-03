<?php
    //Tipos de datos habituales: boolean, integer, double, string 
    //el médoto var_dump() nos devuelve el tipo de la variable que se le pasa por argumento y su valor o longitud (tipo string).
    var_dump(true); //muestra bool(true)
    var_dump(5); //muestra int(5)
    var_dump(-10.56); //muestra double(-10.5600000000000004973799150320701301097869873046875)
    var_dump("Hola mundo"); //muestra string(10) "Hola mundo"

    #Más sobre var_dump(): https://www.php.net/manual/es/function.var-dump.php

    /*Php no es case sensitive, es lo mismo poner FALSE que false. 
    Las palabras reservadas se podrán poner en mayúsculas o minúsculas o una combinación de ambas.
    Sin embargo, esto no será cierto para las variables que definamos nosotros. */

?>