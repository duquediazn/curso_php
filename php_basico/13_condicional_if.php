<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Condicional simple</title>
</head>

<body>
    <?php
    /*
    Sintaxis: 
    if(expresion) {
        codigo
    }

    //sintaxis alternativa (habitual cuando es incrustado):
    if(expresion):
        codigo
    endif;
    */
    if(9<10){
        echo "Expresión verdadera";
    }

    if(9>10):
        echo "Este texto no se muestra";
    endif;
    ?>
    <!--Si lo que queremos es incrustar código html dentro de nuestro if:-->
    <?php if(9<10): ?>
            <h1>Expresión verdadera</h1>
    <?php endif; ?>

</body>

</html>