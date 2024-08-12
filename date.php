<?php
/*
https://www.php.net/manual/es/function.date.php

Antes de usar la función date, debemos definir primero la zona horaria con: 

https://www.php.net/manual/es/function.date-default-timezone-set.php

*/
date_default_timezone_set('Europe/London');

$fecha_us = date("Y-m-d");
echo $fecha_us; //2024-08-10

$fecha_es = date("d-m-Y");
echo $fecha_es; //10-08-2024

$fecha_us = date("l d F Y");
echo $fecha_us; //Saturday 10 August 2024

$hora_12 = date("h:i a");
echo $hora_12; //04:05 pm

$hora_24 = date("H:i:s A");
echo $hora_24; //16:07:29 PM

$fecha_completa = date("d-m-Y h:i A");
echo $fecha_completa; //10-08-2024 04:08 PM

$fecha_completa = date("l d F Y H:i A");
echo $fecha_completa; //Saturday 10 August 2024 16:20 PM

//Fecha en español:
