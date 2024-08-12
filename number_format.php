<?php

$cantidad_1 = 12732.77; //este es el formato habitual en las BBDD, equivale a number_format($cantidad_1, 2, ".", "");

//number_format(cantidad, decimales, separador_decimal, separador_millar);

echo number_format($cantidad_1); //12,733
echo number_format($cantidad_1, 2); //12,732.77
echo number_format($cantidad_1, 2, ".", ","); //12,732.77
