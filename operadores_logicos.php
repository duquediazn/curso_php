<?php
    /*Funcionan como otros lenguajes:
    and (o AND)
    or (u OR)
    ! (not)
    && (and)
    || (or)
    */
    $valor_1=7;
    $valor_2=2;

    var_dump($valor_1==7 && 2>3); //bool(false)
    var_dump($valor_1==7 and 2>3); //bool(false)
    var_dump($valor_1==7 || 2>3); //bool(true)
    var_dump($valor_1==7 or 2>3); //bool(true)