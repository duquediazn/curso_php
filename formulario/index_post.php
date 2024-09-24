<?php
//Formularios: método POST:
echo "Método POST: " . "<br>";

$nombre = $_POST['nombre'];
$asignatura = $_POST['asignatura'];
$frutas = $_POST['frutas'];

echo "Nombre alumno: " . $nombre . "<br>";
echo "Asignatura: " . $asignatura . "<br>";
echo "Fruta: " . $frutas . "<br>";


