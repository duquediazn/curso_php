<?php
    /*Las funciones include y require sirven para añadir otros ficheros a nuestros scripts en PHP.
    
    include: inserta en nuestro script un código procedente de otro archivo, si no existe dicho archivo
    o si contiene algún tipo de error nos mostrará un warning por pantalla y el script seguirá ejecutándose.
    La ubicación del fichero puede especificarse utilizando una ruta absoluta, pero lo más usual es con una ruta relativa. 
    En este caso, se toma como base la ruta que se especifica en la directiva include_path del fichero php.ini. Si no se
    encuentra en esa ubicación, se buscará también en el directorio del guion actual, y en el directorio de ejecución.
    
    require: hace la misma operación que include, pero en caso de no existir el archivo o error en el mismo
    mostrará un fatal error y el script no se sigue ejecutando.
    
    Sintaxis: 
    include("ruta_archivo.php");
    include "ruta_archivo.php";
    
    include_once("ruta_archivo.php"); //Solo se incluye una vez
    include_once "ruta_archivo.php";

    require("ruta_archivo.php");
    require "ruta_archivo.php";
    
    require_once("ruta_archivo.php");
    require_once "ruta_archivo.php";
    */