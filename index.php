<?php
echo "Hello World! <br>";
/*La etiqueta de cierre  "?>" solo es necesaria cuando el código php 
está incrustado en html, cuando solo hay php se puede omitir (y es 
práctica recomendada hacerlo) 

Para incluir contenido en la página web se puede usar "echo" (void)
O también se puede usar print (int), solo toma un parámetro y devuelve 1.
(no son realmente funciones, así que no hacen falta los paréntesis).

printf (print con formato) es otra opción para generar una salida desde PHP. Puede recibir
varios parámetros, el primero de los cuales es siempre una cadena de texto que indica el
formato que se ha de aplicar. Esa cadena debe contener un especificador de conversión por
cada uno de los demás parámetros que se le pasen a la función, y en el mismo orden en
que figuran en la lista de parámetros.
 */
$modulo = "DWES";
$ciclo = "DAW";

print "<p>";
printf("%s es un módulo de %d curso de %s", $modulo, 2, $ciclo);
print "</p>";

//https://www.php.net/manual/es/function.printf.php
