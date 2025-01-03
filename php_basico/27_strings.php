<?php
    $nombre = "Nazaret";
    $apellido = "Duque";
    //Concatenamos strings mediante el operador "."
    $nombreCompleto = $nombre . $apellido;

    echo $nombreCompleto;
    echo "<br>";

    //también se pueden concatenar otro tipo de valores:
    $numero = 36;

    echo "Mi nombre es " . $nombre . ", tengo: " . $numero . " años.";
    echo "<br>";

    /*Interpolación de variables: podemos interpolar una variable
        dentro de un string, automáticamente se convierte en string
        sin necesidad de utilizar el operador punto "."*/

    echo "Mi nombre es  $nombre, tengo: $numero  años.";
    echo "<br>";

    //También se pueden interpolar entre llaves {} como en Java.
    echo "Mi nombre es {$nombre}"; //Muestra: Mi nombre es Nazaret
    echo "<br>";
    /*También se pueden escribir strings con comillas simples '', pero
        estas no interpolan las variables.*/

    echo 'Mi nombre es $nombre'; //Muestra: Mi nombre es $nombre
    echo '<br>';
   /* Cuando se usan comillas simples, sólo se realizan dos sustituciones dentro de la cadena:
        1.- Cuando se encuentra la secuencia de caracteres \', se muestra en la salida una comilla simple.
        2.- Cuando se encuentra la secuencia \\, se muestra en la salida una barra invertida.


    En PHP tienes otra alternativa para crear cadenas: la sintaxis heredoc  . Consiste en ponerel operador
    "<<<" seguido de un identificador de tu elección, y a continuación y empezando en la línea siguiente, la 
    cadena de texto sin utilizar comillas. La cadena finaliza cuando escribes ese mismo identificador en una 
    nueva línea. Esta línea de cierre no debe llevar más caracteres, ni siquiera espacios o sangría, 
    salvo quizás un punto y coma después del identificador.
    */

    $a = <<<MICADENA
    Desarrollo de aplicaciones web<br>
    Desarrollo web en entorno servidor
    MICADENA;

    print $a;

    /*
    El texto se procesa de igual forma que si fuera una cadena entre comillas dobles, sustituyendo variables 
    y secuencias de escape. Si no quisieras que se realizara ninguna sustitución, debes poner el identificador 
    de apertura entre comillas simples.
    */
    $b = <<<'MICADENA'
    Holi
    MICADENA;
        
    //Más sobre el tipo string: https://www.php.net/language.types.string (secuencias de escape)

