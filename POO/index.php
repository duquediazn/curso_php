<?php
/* 
require_once "Traits/TecnicasSimples.php";
require_once "Traits/TecnicasEspeciales.php";
require_once "Traits/TecnicasCombinadas.php";
require_once "Clases/Saiyajin.php";
require_once "Otras/Saiyajin.php";
require_once "Clases/SuperSaiyajin.php"; 
*/

/*
AUTOLOAD
En lugar de tener que cargar cada una de las clases de nuestra aplicación manualmente, 
podemos crear un autoloader. Como su nombre indica, el autoloader está destinado a cargar
de forma automática las cases utilizadas. 

Cada vez que se intenta inicializar una clase y la clase no existe, el nombre de esta clase
se pasa al autoloader y este es ejecutado. En el autoloader podremos automatizar el proceso
de carga sin tener que incluir manualmente cada archivo y además nos permite hacer el código
más rápido, pues sólo se cargarán las clases que efectivamente se utilicen. 
*/
spl_autoload_register(function ($clase): void { //Se ejecuta cuando no se encuentra el archivo de una clase.
    $nombre_archivo = str_replace('\\', '/', $clase) . ".php";
    $nombre_archivo = str_replace("POO/", "", $nombre_archivo);

    if (file_exists($nombre_archivo)) {
        require_once $nombre_archivo;
    }
});


//Si hacemos:
use POO\Clases\Saiyajin;
use POO\Clases\SuperSaiyajin;
use POO\Otras\Saiyajin as OtroSaiyajin;
//No tendremos que usar la ruta completa de la clase cuando trabajamos con namespaces.

$goku = new Saiyajin("Goku", 1000);
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

$vegeta = new Saiyajin("Vegeta", 950);
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


echo Saiyajin::$cabello; // :: (operador de resolución, para acceder a miembros estáticos de la clase)
echo "<br>";
echo Saiyajin::MostrarColorCabello();
echo "<br>";
echo SuperSaiyajin::$cabello;
echo "<br>";
echo $gohan->MostrarColorCabello(); //Un método estático sí puede ser accedido desde una instancia.

echo "<br>";
echo "<br>";

echo $goku->AumentarKi();
echo "<br>";
echo $gohan->AumentarVelocidad();
echo "<br>";
echo $gohan->UsarKameKameHa();
echo "<br>";

echo "<br>";
echo "<br>";

$goten = new OtroSaiyajin("Goten", 1000);
echo $goten->Saludar();
