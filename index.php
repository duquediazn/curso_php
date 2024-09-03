<?php
echo "Hello World! <br>";
/*La etiqueta de cierre  "?>" solo es necesaria cuando el código php 
 está incrustado en html, cuando solo hay php se puede omitir (y es 
 práctica recomendada hacerlo) */

//Formularios: método POST:
echo "Método POST: " . "<br>";

$nombre = $_POST['nombre'];
$asignatura = $_POST['asignatura'];
$frutas = $_POST['frutas'];

echo "Nombre alumno: " . $nombre . "<br>";
echo "Asignatura: " . $asignatura . "<br>";
echo "Fruta: " . $frutas . "<br>";

echo "<br>" . "Método GET: " . "<br>";

$nombre2 = $_GET['nombre'];
$asignatura2 = $_GET['asignatura'];
$frutas2 = $_GET['frutas'];

echo "Nombre alumno: " . $nombre2 . "<br>";
echo "Asignatura: " . $asignatura2 . "<br>";
echo "Fruta: " . $frutas2 . "<br>";
