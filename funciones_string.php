<?php

//Funciones de string:
$cadena_texto = "Hola mundo";

echo strtolower($cadena_texto); //hola mundo
echo strtoupper($cadena_texto); //HOLA MUNDO
echo ucfirst($cadena_texto); //Hola mundo
echo ucwords($cadena_texto); //Hola Mundo
echo strlen($cadena_texto); //10
echo str_word_count($cadena_texto); //2


//Convertir un string a un array: https://www.php.net/manual/es/function.explode.php
//Sintaxis: explode(delimitador, string, limitador);
$fecha = "2021/11/29";
$fecha2 = "2021-11-30";
$numeros = "Uno Dos Tres Cuatro Cinco Seis Siete";

$array_fecha = explode("/", $fecha);
echo $array_fecha[0]; //2021
echo $array_fecha[1]; //11
echo $array_fecha[2]; //29

$array_fecha2 = explode("-", $fecha2);
echo $array_fecha2[0]; //2021
echo $array_fecha2[1]; //11
echo $array_fecha2[2]; //30

$array_numeros = explode(" ", $numeros);
echo $array_numeros[0]; //Uno
echo $array_numeros[1]; //Dos
echo $array_numeros[2]; //Tres
echo $array_numeros[3]; //Cuatro
echo $array_numeros[4]; //Cinco
echo $array_numeros[5]; //Seis
echo $array_numeros[6]; //Siete

/*Si el parámetro limit es positivo, el array devuelto contendrá el máximo de limit elementos, 
y el último elemento contendrá el resto del string.:*/
$array_numeros = explode(" ", $numeros, 2);
echo $array_numeros[0]; //Uno
echo $array_numeros[1]; //Dos Tres Cuatro Cinco Seis Siete

$array_numeros = explode(" ", $numeros, 3);
echo $array_numeros[0]; //Uno
echo $array_numeros[1]; //Dos
echo $array_numeros[2]; //Tres Cuatro Cinco Seis Siete

/*Si el parámetro limit es negativo, se devolverán todos los componentes a excepción del último -limit.
Si el parámetro limit es cero, se tratará como 1.*/
$array_numeros = explode(" ", $numeros, -2);
echo $array_numeros[0]; //Uno
echo $array_numeros[1]; //Dos
echo $array_numeros[2]; //Tres
echo $array_numeros[3]; //Cuatro
echo $array_numeros[4]; //Cinco