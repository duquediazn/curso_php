<?php

var_dump($_POST['asignatura']); //$_POST['asignatura'] es un array

echo "<br>";

foreach($_POST['asignatura'] as $asignatura) {
    echo $asignatura."<br>";
}

echo "<br>";

$frutas=$_POST['frutas'] ?? null;
if ($frutas !== null) {
    foreach($frutas as $fruta) {
        echo $fruta."<br>";
    }
}
