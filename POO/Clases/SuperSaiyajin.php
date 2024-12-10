<?php

namespace POO\Clases;
//require_once "Saiyajin.php";

/*En PHP no existe la herencia múltiple, la sobrecarga de métodos (incluidos los métodos constructores) 
ni la sobrecarga de operadores.*/

class SuperSaiyajin extends Saiyajin
{

    public string $clase = "Super Saiyajin";
    public static $cabello = "Amarillo"; //Al redefinir un atributo estático del padre este tiene que ser también estático.

    public function Transformacion()
    {

        if ($this->getNivel() >= 1500) {
            $texto = $this->getNombre() . " se transformó en " . $this->clase;
        } else {
            $texto = $this->getNombre() . " NO se transformó en " . $this->clase;
        }

        return $texto;
    }

    public static function MostrarColorCabello(): string
    {
        return "Tengo el cabello de color " . self::$cabello;
    }

    public static function NuevoMetodo()
    {
        return parent::VELOCIDAD; //Accede a al atributo constante VELOCIDAD del padre
    }

    /*
    public function NivelDePelea(): string //Sobreescrita
    {
        $nivel = $this->nivel_pelea * 2;
        return $this->nombre . " aumentó su nivel de pelea a " . $nivel;
    }
    */
}


/*
Diferencias entre this, self y parent: $this hace referencia al objeto actual, self, a la clase actual.
    -this, hace referencia a los atributos NO ESTÁTICOS de la clase.
    -self, hace referencia a los atributos ESTÁTICOS de la clase.
    -parent, hace referencia a los atributos NO ESTÁTICOS de la clase padre o superclase.
 
*/

/*
Funciones de utilidad en la herencia: 
- get_parent_class(objeto) : Devuelve el nombre de la clase padre del objeto o la clase que se indica.
- is_subclass_of(objeto, 'Clase') : Devuelve true si el objeto o la clase del primer parámetro tiene como 
clase base a la que se indica en el segundo parámetro o false en caso contrario. 
*/

/*
Existe una forma de evitar que las clases heredadas puedan redefinir el comportamiento de los
métodos existentes en la superclase: utilizar la palabra final.
Incluso se puede declarar una clase utilizando final. 
En este caso no se podrían crear clases heredadas utilizándola como base
*/

/*
Opuestamente al modificador final, existe también abstract. 
Se utiliza de la misma forma,tanto con métodos como con clases completas, 
pero en lugar de prohibir la herencia, obliga a que se herede. 
Es decir, una clase con el modificador abstract no puede tener objetos que la instancien, 
pero sí podrá utilizarse de clase base y sus subclases sí podrán utilizarse para instanciar 
objetos.

Y un método en el que se indique abstract, debe ser redefinido obligatoriamente por las
subclases, y no podrá contener código.

class Producto {

    abstract public function muestra();
}
*/

/*
Obviamente puedes definir un nuevo constructor para las clases heredadas que redefinan 
el comportamiento del que existe en la clase base, tal ycomo harías con cualquier otro método.
Y dependiendo de si programas o no el constructor en la clase heredada, se llamará o no 
automáticamente al constructor de la clase base.
En PHP, si la clase heredada no tiene constructor propio, se llamará automáticamente 
al constructor de la clase base (si existe). Sin embargo, si la clase heredada define su 
propio constructor, deberás ser tú el que realice la llamada al constructor de la clase 
base si lo consideras necesario, utilizando para ello la palabra
parent y el operador de resolución de ámbito.
*/