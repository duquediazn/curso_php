<?php
/*
https://www.php.net/manual/es/function.date.php

Antes de usar la función date, debemos definir primero la zona horaria con: 

https://www.php.net/manual/es/function.date-default-timezone-set.php

*/
date_default_timezone_set('Europe/London');

$fecha_us = date("Y-m-d");
echo $fecha_us . "<br>"; //2024-08-10

$fecha_es = date("d-m-Y");
echo $fecha_es . "<br>"; //10-08-2024

$fecha_us = date("l d F Y");
echo $fecha_us . "<br>"; //Saturday 10 August 2024

$hora_12 = date("h:i a");
echo $hora_12 . "<br>"; //04:05 pm

$hora_24 = date("H:i:s A");
echo $hora_24 . "<br>"; //16:07:29 PM

$fecha_completa = date("d-m-Y h:i A");
echo $fecha_completa . "<br>"; //10-08-2024 04:08 PM

$fecha_completa = date("l d F Y H:i A");
echo $fecha_completa . "<br>"; //Saturday 10 August 2024 16:20 PM

//Fecha en español:
function fecha_espanol_larga()
{
    $fecha_dia = date("d");
    $fecha_mes = date("m");
    $fecha_year = date("Y");

    $dia_semana = [
        "Monday" => "Lunes",
        "Tuesday" => "Martes",
        "Wednesday" => "Miércoles",
        "Thursday" => "Jueves",
        "Friday" => "Viernes",
        "Saturday" => "Sábado",
        "Sunday" => "Domingo"
    ];

    $mes_year = [
        "01" => "Enero",
        "02" => "Febrero",
        "03" => "Marzo",
        "04" => "Abril",
        "05" => "Mayo",
        "06" => "Junio",
        "07" => "Julio",
        "08" => "Agosto",
        "09" => "Septiembre",
        "10" => "Octubre",
        "11" => "Noviembre",
        "12" => "Diciembre"
    ];

    $fecha_final = $dia_semana[date("l")] . " " . $fecha_dia . " de " . $mes_year[$fecha_mes] . " de " . $fecha_year;

    return $fecha_final;
}

echo fecha_espanol_larga() . "<br>"; //Martes 24 de Septiembre de 2024


function fecha_espanol_corta($fecha = "")
{

    if ($fecha == "") {
        $fecha = date("d-m-Y");
    } else {
        $fecha = date("d-m-Y", strtotime($fecha)); //strtotime() convierte una cadena de texto a fecha.
    }

    $fecha = explode("-", $fecha); //https://www.php.net/manual/es/function.explode.php

    $fecha_dia = $fecha[0];
    $fecha_mes = $fecha[1];
    $fecha_year = $fecha[2];

    $dia_semana = [
        "Monday" => "Lunes",
        "Tuesday" => "Martes",
        "Wednesday" => "Miércoles",
        "Thursday" => "Jueves",
        "Friday" => "Viernes",
        "Saturday" => "Sábado",
        "Sunday" => "Domingo"
    ];

    $mes_year = [
        "01" => "Enero",
        "02" => "Febrero",
        "03" => "Marzo",
        "04" => "Abril",
        "05" => "Mayo",
        "06" => "Junio",
        "07" => "Julio",
        "08" => "Agosto",
        "09" => "Septiembre",
        "10" => "Octubre",
        "11" => "Noviembre",
        "12" => "Diciembre"
    ];

    $fecha_final = $fecha_dia . " de " . $mes_year[$fecha_mes] . " de " . $fecha_year;

    return $fecha_final;
}

echo fecha_espanol_corta() . "<br>"; //24 de Septiembre de 2024
echo fecha_espanol_corta("01-01-2020") . "<br>"; //01 de Enero de 2020

/*Fecha en español 2 :
De igual manera para que los días de la semana o el nombre de los meses aparezca en español deberás indicar los "locales" de la siguiente forma:
setlocale(LC_ALL,'es_ES.UTF-8');

Debes tener en cuenta que la función date() no lee los "locales", para hacer uso de los nombres en español (lunes, enero...)
deberás usar la función strftime() (DEPRECATED)
 
 https://www.php.net/manual/es/function.setlocale.php
 https://www.php.net/manual/es/function.strftime.php
*/

