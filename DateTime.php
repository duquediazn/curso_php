<?php
//La clase DateTime de PHP: https://www.php.net/manual/es/class.datetime.php */

// Ejemplo 1.- Crear una fecha a partir de cualquier cadena.

$fechaMySql="2020-12-31";
$fecha1= new DateTime($fechaMySql);
echo var_dump($fecha1); //object(DateTime)#1 (3) { ["date"]=> string(26) "2020-12-31 00:00:00.000000" ["timezone_type"]=> int(3) ["timezone"]=> string(13) "Europe/Berlin" }

//new DateTime(); //Crea un objeto con la fecha actual del sistema (hora peninsular).
echo "<br>";
//Para poner la zona horaria correcta:
echo  var_dump(new DateTime("now", new DateTimeZone("Europe/London")));

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
echo "<br>";

// FECHA EN ESPAÑOL:
// Forma 1: (Hay que habilitar extension=intl en php.ini)
$ahora = new DateTime();

// Crear un formateador de fechas con la configuración deseada
$formateador = new IntlDateFormatter(
    'es_ES', // Idioma y región
    IntlDateFormatter::FULL, // Estilo de fecha (puedes cambiarlo si deseas algo más breve)
    IntlDateFormatter::FULL, // Estilo de tiempo
    'Europe/Madrid', // Zona horaria
    IntlDateFormatter::GREGORIAN // Calendario
);

// Personalizar el formato de la fecha
$formateador->setPattern("EEEE, d 'de' MMMM 'de' yyyy 'a las' HH:mm:ss 'hora de Madrid'");

// Formatear la fecha
$fecha = $formateador->format($ahora);
echo "Tu última visita fue el $fecha.<br>";


// Forma 2: (manual):
date_default_timezone_set('Europe/Madrid');

$ahora = new DateTime();

// Arrays con nombres de días y meses en español
$dias = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
$meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];

// Obtener valores de fecha
$diaSemana = $dias[$ahora->format('w')]; // Día de la semana (0-6)
$dia = $ahora->format('d');              // Día del mes
$mes = $meses[$ahora->format('m') - 1];  // Mes (1-12, ajustado para array 0-11)
$año = $ahora->format('Y');              // Año
$hora = $ahora->format('H:i:s');         // Hora

// Construir el mensaje
$fecha = "Tu última visita fue el $diaSemana, $dia de $mes de $año a las $hora hora de Madrid.";

echo $fecha;
