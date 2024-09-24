<?php
    /*Tipos de datos habituales: boolean, integer, double, string, null...
    En PHP existen funciones específicas para comprobar y establecer el tipo de datos de una variable:

    - var_dump() nos devuelve el tipo de la variable que se le pasa por argumento y su valor o longitud (tipo string).*/
    var_dump(true); //muestra bool(true)
    var_dump(5); //muestra int(5)
    var_dump(-10.56); //muestra double(-10.5600000000000004973799150320701301097869873046875)
    var_dump("Hola mundo"); //muestra string(10) "Hola mundo"
    /*Más sobre var_dump(): https://www.php.net/manual/es/function.var-dump.php

    
    - gettype: obtiene el tipo de la variable que se le pasa como parámetro y devuelve una cadena de texto, que puede ser
    array, boolean, double, integer, object, string, null, resource o unknown type.
    
    Por otra parte tenemos unas funciones (boolean) para comprobar el tipo de dato como:
    is_bool(): Comprueba si una variable es de tipo booleano.
    is_float(): Comprueba si el tipo de una variable es float.
    is_numeric(): Comprueba si una variable es un número o un string numérico.
    is_string(): Comprueba si una variable es de tipo string.
    is_array(): Comprueba si una variable es un array.
    is_object(): Comprueba si una variable es un objeto.
    is_integer(): Comprueba si una variable es de tipo entero.
    is_null(): Comprueba si una variable es null.
    is_resource(): Comprueba si una variable es un recurso.
    is_scalar(): Comprueba si una variable es escalar.

    Análogamente, para establecer el tipo de una variable utilizamos la función:
    - settype: pasándole como parámetros la variable a convertir, y una de las siguientes cadenas: boolean,
    integer, float, string, array, object o null. La función settype devuelve true si la conversión se realizó 
    correctamente, o false en caso contrario.*/

    $a = $b = "3.1416";
    settype($b, "float");
    print "\$a vale $a y es de tipo ".gettype($a); //$a vale 3.1416 y es de tipo string
    print "<br>";
    print "\$b vale $b y es de tipo ".gettype($b); //$b vale 3.1416 y es de tipo double
    
    /*Si realizas una operación con variables de distintos tipos, ambas se convierten primero a un tipo común. 
    Por ejemplo, si sumas un entero con un real, el entero se convierte a real antes de realizar la suma:*/
    $mi_entero = 3;
    $mi_real = 2.3;
    $resultado = $mi_entero + $mi_real; //$resultado es real

    //También se puede forzar la conversión con un cast: 
    $resultado = $mi_entero + (int)$mi_real; //$resultado es entero
    
    /*Php no es case sensitive, es lo mismo poner FALSE que false. 
    Las palabras reservadas se podrán poner en mayúsculas o minúsculas o una combinación de ambas.
    Sin embargo, esto no será cierto para las variables que definamos nosotros. */
    

