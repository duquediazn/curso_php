<?php

$c = 1;
while ($c <= 20) {
    echo $c . "<br>";
    if ($c == 10) {
        break; //El bucle termina en 10, solo se muestra los números hasta el 10. 
    }
    $c++;
}

$pc = ["SO", "SSD", "GPU", "RAM", "CPU"];
foreach ($pc as $componente) {
    if ($componente == "GPU") {
        continue; //Nos saltamos GPU (no se muestra), es como un break para esa condición únicamente. 
    }
    echo $componente . "<br>";
}


for ($i = 1; $i <= 10; $i++) {
    if ($i == 5) {
        continue;
    }
    echo $i . "<br>";
}

//Esta misma situación con un ciclo while en vez de for:
$i = 1;
while ($i <= 10) {
    if ($i == 5) {
        $i++; //Debemos colocar aquí también el incremento, antes del continue
        //de lo contrario entraríamos en un bucle infinito
        continue;
    }
    echo $i . "<br>";
    $i++;
}
