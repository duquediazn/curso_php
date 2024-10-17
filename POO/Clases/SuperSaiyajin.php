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
    public static function MostrarColorCabello(): string {
        return "Tengo el cabello de color ".self::$cabello; 
    }

    public static function NuevoMetodo(){
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
Diferencias entre this, self y parent: $this hace referencia al objeto actual, $self, a la clase actual.
    -this, hace referencia a los atributos NO ESTÁTICOS de la clase.
    -self, hace referencia a los atributos ESTÁTICOS de la clase.
    -parent, hace referencia a los atributos NO ESTÁTICOS de la clase padre o superclase.
 
*/


