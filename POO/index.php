<?php
require_once "Saiyajin.php"; //No hace falta si ya lo incluimos en la clase que hereda de ella
require_once "SuperSaiyajin.php";


$goku = new Saiyayin("Goku", 1000);
echo $goku->Saludar(); //Hola soy Goku
echo "<br>";

/*
Curiosidad: named parameters.
Si no hubiésemos tipado los atributos $nombre y $nivel_pelea, 
podríamos instanciar el objeto incluso cambiando el orden de los parámetros
siempre que lo indiquemos de la siguiente forma (para asegurar que asignamos
parámetros de manera correcta):

$goku = new Saiyayin(nivel_pelea:1000, nombre:"Goku");

Si no señalamos a qué atributo estamos asignando el valor, no sucedería 
ningún error porque las variables no están tipadas, pero al no respetar
el orden tendríamos nivel_pelea=Goku y nombre: 1000.
*/

$vegeta = new Saiyayin("Vegeta", 950);
echo $vegeta->Saludar("Mi nombre es "); //Mi nombre es Vegeta
echo "<br>";
echo $vegeta->NivelDePelea(); //Vegeta tiene un nivel de pela de 950 y pertenece a la clase Saiyajin
echo "<br>";

$gohan = new SuperSaiyajin("Gohan", 700);
echo $gohan->Saludar(); //Hola soy Gohan
echo "<br>";

/*
Encapsulamiento: 
Si nombre fuera protected en la clase padre, esto daría error:
    echo $goku->nombre; //se accede desde la propia clase, pero no se puede acceder desde fuera.
    echo $gohan->nombre; //se hereda del padre, pero no se puede acceder desde fuera.
Sí funcionaría:
    echo $gohan->NivelDePelea(); //Para la versión sobreescrita en la clase hija
porque accede a ese atributo nombre a través de una función pública de la propia clase.

Como nombre es private, la clase hija no podría acceder al atributo nombre y por lo tanto
no lo heredará. El método NivelDePelea() (sobreescrito) del hijo, aunque público, dará error ya que 
tiene ese atributo restringido. Saludar() y NivelDePelea() (padre) sí funcionarán porque esos métodos 
públicos no están sobreescritos en la clase hija, se heredan completamente de la clase padre, por lo 
tanto accede a nombre desde la clase padre. 
*/
echo $gohan->Transformacion(); //Gohan NO se transformó en Super Saiyajin
echo "<br>";
