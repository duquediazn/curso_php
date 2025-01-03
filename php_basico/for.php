<?php
$numero = $_POST['numero'];
for ($i = 0; $i < 11; $i++) {
    echo $numero . " X " . $i . " = " . $i * $numero . "<br>";
}
