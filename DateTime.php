<?php
//La clase DateTime de PHP: https://www.php.net/manual/es/class.datetime.php */

// Ejemplo 1.- Crear una fecha a partir de cualquier cadena.

$fechaMySql="2020-12-31";
$fecha1= new DateTime($fechaMySql);
echo var_dump($fecha1);

//Ejemplo 2.- Pasar la fecha al formato que queramos: 

$fecha=date_format($fecha1, 'd/m/Y');
echo "<br>";
echo var_dump($fecha); //string(10) "31/12/2020"
echo "<br>"; 
echo $fecha; //31/12/2020

//Ejemplo 3.- Sacar el "timestamp" (marca de tiempo a una fecha):

$time_stamp= date_timestamp_get($fecha1);
echo "<br>";
echo var_dump($time_stamp); //int(1609372800)

//Ejemplo 4.- Fechas relativas: https://www.php.net/manual/es/datetime.formats.relative.php

//Fecha de ayer:
$ayer=new DateTime("yesterday");
echo "<br>";
echo date_format($ayer, 'd/m/Y');