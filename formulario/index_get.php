<?php

//Método GET:
echo "<br>" . "Método GET: " . "<br>";

$nombre2 = $_GET['nombre'];
$asignatura2 = $_GET['asignatura'];
$frutas2 = $_GET['frutas'];

echo "Nombre alumno: " . $nombre2 . "<br>";
echo "Asignatura: " . $asignatura2 . "<br>";
echo "Fruta: " . $frutas2 . "<br>";