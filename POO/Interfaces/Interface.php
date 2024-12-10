<?php

/*
Un interface es como una clase vacía que solamente contiene declaraciones de métodos. 
Se definen utilizando la palabra interface. Veamos un ejemplo: 
*/

class Producto
{
    public $codigo;
    public $nombre;
    public $nombre_corto;
    public $pvp;
    public function __construct($row)
    {
        $this->codigo = $row['cod'];
        $this->nombre = $row['nombre'];
        $this->nombre_corto = $row['nombre_corto'];
        $this->pvp = $row['pvp'];
    }
    public function muestra()
    {
        echo "<p>" . $this->codigo . "</p>";
    }
}

/*
class TV extends Producto{
    public $pulgadas;
    public $tecnologia;
    public function __construct($row) {
        parent::__construct($row);
        $this->pulgadas = $row['pulgadas'];
        $this->tecnologia = $row['tecnologia'];
    }
    public function muestra() {
        echo "<p>".$this->pulgadas."</p>";
    }
}

Si quieres asegurarte de que todos los tipos de productos tengan un método muestra, 
puedes crear un interface como el siguiente:
*/

interface iMuestra
{
    public function muestra();
}

/*Y cuando crees las subclases deberás indicar con la palabra
implements que tienen que implementar los métodos declarados en este interface
.*/

class TV extends Producto implements iMuestra
{
    public $pulgadas;
    public $tecnologia;
    public function __construct($row)
    {
        parent::__construct($row);
        $this->pulgadas = $row['pulgadas'];
        $this->tecnologia = $row['tecnologia'];
    }
    public function muestra()
    {
        echo "<p>" . $this->pulgadas . "</p>";
    }
}

/*Todos los métodos que se declaren en un
interface deben ser públicos. Además de métodos, los
interfaces podrán contener constantes pero no atributos.

Un interface es como un contrato que la clase debe cumplir. 
Al implementar todos los métodos declarados en el interface
se asegura la interoperabilidad entre clases. Si sabes que una clase implementa un
interface determinado, sabes qué nombre tienen sus métodos, qué parámetros les debes 
pasar y, probablemente, podrás averiguar fácilmente con qué objetivo han sido escritos.
Por ejemplo, en la librería de PHP está definido el interface "Countable".

Countable {
    abstract public int count(void);
}

Si creas una clase para la cesta de la compra en la tienda
web, podrías implementar este interface para contar los productos que figuran en la misma.
Antes aprendiste que en PHP una clase sólo puede heredar de otra, 
que no existe la herencia múltiple. Sin embargo, sí es posible crear clases que implementen 
varios interfaces, simplemente separando la lista de interfaces por comas después de la palabra
"implements".

class TV extends Producto implements iMuestra, Countable {

}

La única restricción es que los nombres de los métodos que se deban implementar en los distintos
interfaces no coincidan. Es decir, en nuestro ejemplo, el interface iMuestra no podría contener un método
count, pues éste ya está declarado en Countable.

Una de las dudas más comunes en POO, es qué solución adoptar en algunas situaciones:
interfaces o clases abstractas. Ambas permiten definir reglas para las clases que los 
implementen o hereden respectivamente y ninguna permite instanciar objetos. 
Las diferencias principales entre ambas opciones son:
    - En las clases abstractas, los métodos pueden contener código. 
    Si van a existir varias subclases con un comportamiento común, se podría programar en 
    los métodos de la clase abstracta. Si se opta por un interface, habría que repetir el 
    código en todas las clases que lo implemente.
    - Las clases abstractas pueden contener atributos y los interfaces no.
    - No se puede crear una clase que herede de dos clases abstractas, 
    pero sí se puede crear una clase que implemente varios interfaces.

Funciones relacionadas: 
- get_declared_interface() : devuelve un array con los nombres de los interfaces declarados. 
- interface_exists() : devuelve true si existe el interface que se indica, o false en caso contrario. 
*/