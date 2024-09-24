<?php
    /*
    Una función es un conunto de instrucciones a la que podemos recurrir siempre que queramos.
    Éstas pueden recibir parámetros y realizar todo tipo de tareas, ya sean complejas o sencillas.

    Un nombre de función válido comienza con una letra o guión bajo, seguido de cualquier 
    número de letras, números o guiones bajos.a

    Sintaxis:

    function nombre_funcion($parametros) {
        Código de la función
    }

    Ejemplo:
    */

    /*
    function saludar() {
        echo "Hola mundo!";
    }

    saludar();

    function saludar2() {
        return "Hola mundo!";
    }
    
    $saludo = saludar2();
    echo $saludo;
    echo saludar2();
    
    function saludo($nombre) {
        return "Hola, mi nombre es $nombre";
    }

    $saludo = saludo("Nicole");
    echo $saludo;

    echo saludo("María");

    $nombre = "Stephen";
    echo saludo($nombre);
    */
    function calculo_promedio($nota1,$nota2,$nota3) {
        $promedio = ($nota1+$nota2+$nota3)/3;
        return $promedio;
    }

    //echo "El promedio es: ".calculo_promedio(10,9,8);


    /*
    Al definir la función, puedes indicar valores por defecto para los argumentos, de forma quecuando hagas una llamada a la función 
    puedes no indicar el valor de un argumento; en este caso se toma el valor por defecto indicado. 
    Puede haber valores por defecto definidos para varios argumentos, pero en lalista de argumentos de la función todos ellos deben 
    estar a la derecha decualquier otro argumento sin valor por defecto.
    */
    function precioConIva($precio, $iva=0.18) {
        return $precio * (1 + $iva);
    }
    $precio = 10;
    $precioIva = precioConIva($precio); //al no especificar tomará el valor 0.18
    echo "El precio con IVA es $precioIva";


    /*
    A partir de la versión 7.0 de PHP, se puede especificar el tipo de dato que le pasamos a la función y lo que va a devolver la misma.
    Fíjate en el código siguiente:
    */
    function precioConIva2(float $precio) :float{ //con :float especificamos el tipo de dato a devolver
        return $precio * 1.18;
    }
    $precio = 10;
    $precioIva = precioConIva2($precio);
    echo  "El precio con IVA es $precioIva";

    /*
    Ámbito: 
    Si la variable aparece por primera vez dentro de una función, esa variable es local a la función. 
    Si aparece una asignación fuera de la función, se le considerará una variable distinta.

    $a=1;

    funcion prueba() {
        $b = $a; //$b vale null
    }

    Si en una función quisieras utilizar la variable una variable externa, podrías hacerlo utilizando 
    la palabra global delante de la variable dentro de la función. De esta forma le dices a PHP que no 
    cree una nueva variable local, sino que utilice la ya existente.

    $a = 1;

    function prueba() {
        global $a; //$a vale 1
        $b = $a; //$b vale 1
        $a = 3; //$a vale 3
    }

    echo $a."<br>"; // 1
    prueba();  
    echo $a."<br>"; // 3


    Para trabajar con variable globales también podemos usar el array asociativo: $GLOBALS.

    $a = 1;

    function prueba() {
        $a = 2; 

        echo $a. "<br>"; // 2
        echo $GLOBALS["a"]; 1
    }

    Las variables locales a una función desparecen cuando acaba la función y su valor se pierde. 
    Si quisieras mantener el valor de una variable local entre distintas llamadas a la función, 
    deberás declarar la variable como estática utilizando la palabra static.
    
    function contador() {
        static $a=0;

        $a++;

        echo $a."<br>";
    }

    contador(); //1
    contador(); //2
    contador(); //3

    https://www.php.net/manual/es/language.variables.scope.php
    */




