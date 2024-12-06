<?php
    /*Los arrays en php son mapas de datos ordenados o arrays asociativos (valor-clave). 
    Pueden almacenar distintos tipos de datos (como los arrays en javascipt).
    Por lo tanto soporta tanto arrays escalares (índice numérico), como asociativos, como arrays multidimensionales.
    
    Podemos definir un array utilizando el constructor array() */
    $estudiantes= array("Carlos", "María", "Juan", "Vanesa");
    echo $estudiantes[3]; //Muestra: Vanesa
    /*o utilizando la notación de corchetes []. 
    Si no se indican los valores estaremos creando un array vacío.*/
    $estudiantes[3] = "Isabel"; //reasignación de valor
    echo $estudiantes[3]; //Muestra: Isabel

    /*Array escalar: */
    $numeros = [0,1,2,3,4];
    echo $numeros[3]; //muestra 3

    //Array asociativo: ["clave1"=>"valor1", "clave2"=>"valor2"...]
    $tutor =[
        "nombre"=>"Carlos",
        "apellidos"=>"Alfaro", 
        "edad"=>27
    ];
    $tutor["edad"]=37;
    echo $tutor["edad"];

    //Array multidimensional: 
    $tutor2 =[
        "nombre"=>"Isabel",
        "apellidos"=>"Pantoja", 
        "edad"=>65,
        "cursos"=>["PHP", "Python", "C++"]
    ];
    echo $tutor2["cursos"][0];

    //En PHP se permite asignar valores a un array sin especificar el índice: lo añade al final del array.  
    $numeros[]=5;
    echo $numeros[5]; //muestra 5

    //Contar elementos de un array: count():
    echo count($numeros); //devuelve 6

    //Para contar los elementos de un array multidimensoinal podemos indicar la constante COUNT_RECURSIVE como segundo argumento:
    $matrizNumeros = [[2,4,6,8], [5,10,15,20], [10,20,30,40]];
    echo count($matrizNumeros); //devuelve 3 
    echo count($matrizNumeros, COUNT_RECURSIVE); //devuelve 15 (12 de cada array interior + 3 del array superior)
    echo count($matrizNumeros[0]); //devuelve 4