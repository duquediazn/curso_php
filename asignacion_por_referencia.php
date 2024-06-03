<?php
    $texto="El Salvador";

    $variable1=$texto; //Asignación por copia
    $variable2= &$texto; /*Asignación por referencia (& no es un puntero
    pero actúa de manera parecida, "apunta" al mismo valor que $texto 
    y no a la dirección de memoria.)*/

    echo $variable1;
    echo $variable2; //muestran lo mismo: El Salvador

    //Pero si ahora cambiamos $texto:
    $texto="Tenerife";

    echo $variable1; //Sigue mostrando: El Salvador
    echo $variable2; //Muestra: Tenerife