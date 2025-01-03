<?php
/*
- echo: Para incluir contenido en la página web se puede usar "echo" (void)

- printf: También se puede usar print (int), solo toma un parámetro y devuelve 1.
(no son realmente funciones, así que no hacen falta los paréntesis).

- printf (print con formato): es otra opción para generar una salida desde PHP. Puede recibir
varios parámetros, el primero de los cuales es siempre una cadena de texto que indica el
formato que se ha de aplicar. Esa cadena debe contener un especificador de conversión por
cada uno de los demás parámetros que se le pasen a la función, y en el mismo orden en
que figuran en la lista de parámetros.

https://www.php.net/manual/es/function.printf.php

Cada especificador de conversión va precedido del caracter % y se compone de las siguientes partes:
    - signo (opcional). Indica si se pone signo a los número negativos (por defecto) o también a los positivos 
    (se indica con un signo +).
    - relleno (opcional). Indica que carácter se usará para ajustar el tamaño de una cadena. Las opciones son el 
    carácter 0 o el carácter espacio (por defecto se usa el espacio).
    - alineación (opcional). Indica que tipo de alineación se usará para generar la salida: 
    justificación derecha (por defecto) o izquierda (se indica con el carácter -).
    - ancho (opcional). Indica el mínimo número de caracteres de salida para un parámetro dado.
    - precisión (opcional). Indica el número de dígitos decimales que se mostrarán para un número real. 
    Se escribe como un dígito precedido por un punto.
    - tipo (obligatorio). Indica cómo se debe tratar el valor del parámetro correspondiente. En la siguiente tabla 
    puedes ver una lista con todos los especificadores de tipo.

- sprintf: Existe una función similar a printf pero en vez de generar una salida con la cadena
obtenida, permite guardarla en una variable: sprintf.

***Especificadores de tipo para las funciones printf y sprintf: https://www.php.net/manual/es/function.sprintf.php

*/
$modulo = "DWES";
$ciclo = "DAW";

print "<p>";
printf("%s es un módulo de %d curso de %s", $modulo, 2, $ciclo);
print "</p>";

$txt_pi = sprintf("El número PI vale %+.2f", 3.1416);
echo $txt_pi;