<?php
    /*
    operacion ? valor1 : valor2;
    variable = (operacion) ? valor1 : valor2;
    
    Operador de coalescencia a la izquierda (?:), que se conoce comúnmente como el operador ternario simplificado o operador Elvis:
    variable ?: otroValor
    Funcionamiento:
    Esta expresión evalúa la variable. Si la variable es evaluada como "verdadera" (es decir, no es false, null, 0, '', [], etc.), 
    entonces devuelve su propio valor. Si es evaluada como "falsa" (por ejemplo, si $resultados es null, false, 0, etc.), entonces devuelve "otroValor".
    Equivalente en una forma más extensa: variable ? variable : otroValor;