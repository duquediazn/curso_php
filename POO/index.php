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
/*Una vez creado un objeto, puedes utilizar el operador instanceof 
para comprobar si es o nouna instancia de una clase determinada.

Además, a partir de PHP5 se incluyen una serie de funciones útiles para el desarrollo deaplicaciones utilizando POO:
- get_class(objeto) : devuelve el nombre de la clase del objeto
- class_exist(Clase) 
- get_declared_classes() : devuelve un array con el nombre de las clases definidas. 
- class_alias(nombreClase, alias): crea un alias para una clase.
- get_class_methods : devuelve un array con los nombres de los métodos de una clase que son accesibles
desde dónde se hace la llamada. 
- method_exists(nombreClase, nombreMetodo) 
- get_class_vars(nombreClase) : devuelve un array con los nombres de los atributos de una clase que son 
accesibles desde donde se hace la llamada
- get_object_vars(objeto)
- property_exists(nombreClase, nombrePropiedad) : devuelve true si existe el atributo en el objeto o la clase 
que se le indica, o false en caso contrario.  
*/
$goku instanceof Saiyajin; //true
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
no lo heredará. El método NivelDePelea() (sobrescrita) del hijo, aunque público, dará error ya que 
tiene ese atributo restringido. Saludar() y NivelDePelea() (padre) sí funcionarán porque esos métodos 
públicos no están definidos en la clase hija, se heredan completamente de la clase padre, por lo 
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

/*
Utilización de objetos (asignación por referencia y clone): 
Antiguamente en PHP los objetos se comportaban como otras variables, es decir, cuando por ejemplo
se hacía:
$p = new Producto();
$p->nombre = 'Samsung Galaxy S'; 
$a = $p

$a era otro objeto copia de $p, es decir, se asignaba a $a el valor de $p por copia. 

Pero a partir de PHP 5 esta asignación crea un nuevo identificador para el mismo objeto. 
Es decir, se le está asignando a $a por referencia el objeto $p.

Así que para poder copiar un objeto se debe utilizar la función clone(): 
$a = clone($p);

Además, existe una forma sencilla de personalizar la copia para cada clase particular. Por
ejemplo, puede suceder que quieras copiar todos los atributos menos alguno. 
Si éste fuera el caso, puedes crear un método de nombre __clone en la clase. 
Este método se llamará automáticamente después de copiar
todos los atributos en el nuevo objeto.
*/

/*
Utilización de objetos (comparación simple y estricta): 
A veces tienes dos objetos y quieres saber su relaciónexacta. Para eso, en
PHP puedes utilizar los operadores "==" y "===".

Si utilizas el operador de comparación "==", comparas los valores de los atributos de los
objetos. Por tanto dos objetos serán iguales si son instancias de la misma clase y, además, 
sus atributos tienen los mismos valores.

Sin embargo, si utilizas el operador "===", el resultado de la comparación será
true sólo cuando las dos variables sean referencias al mismo objeto.
*/

/*
Objetos en sesiones y bases de datos: 
Todas las variablesalmacenan su información en memoria de una forma u otrasegún su tipo. 
Los objetos, sin embargo, no tienen un único tipo. Cada objeto tendrá unosatributos u otros en 
función de su clase. Por tanto, para almacenar los objetos en la sesióndel usuario, hace falta 
convertirlos a un formato estándar. Este proceso se llamaserialización.

En PHP, para serializar un objeto se utiliza la función serialize(). 
El resultado obtenido es un string que contiene un flujo de bytes, 
en el que se encuentran definidos todos los valores del objeto.

$p=new Producto();
$a=serialize($p);

Esta cadena se puede almacenar en cualquier parte, como puede ser la sesión del usuario, 
o una base de datos. A partir de ella, es posible reconstruir el objeto original utilizando 
la función unserialize().

$p = unserialize($a);

Si simplemente queremos almacenar un objeto en la sesión del usuario, deberíamos hacerpor tanto:

session_start();
$_SESSION['producto']=serialize($p);

Pero en PHP esto aún es más fácil. Los objetos que se añadan a la sesión del usuario
son serializados automáticamente. Por tanto, no es necesario usar serialize() ni unserialize().

session_start();
$_SESSION['producto']=$p;

Para poder deserializar un objeto, debe estar definida su clase. Al igual que antes, 
si lo recuperamos de la información almacenada en la sesión del usuario, no será necesario 
utilizar la función unserialize.

session_start();
$p=$_SESSION['producto'];

Para almacenar la información en una base de datos sí habría que serializar y deserializar
la información, pues en este caso PHP no lo hace automáticamente como con las sesiones. 

En PHP además tienes la opción de personalizar el proceso de serialización y deserialización
de un objeto, utilizando los métodos mágicos "__sleep()" y "__wakeup()". Si en la clase está
definido un método con nombre "__sleep()", se ejecuta antes de serializar un objeto. 
Igualmente, si existe un método "__wakeup()", se ejecuta con cualquier llamada a la función
unserialize().
https://www.php.net/manual/es/language.oop5.magic.php#language.oop5.magic.sleep
*/