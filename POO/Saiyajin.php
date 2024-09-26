<?php

class Saiyayin
{
    /*
    El encapsulamiento o visibilidad de miembros en PHP funciona como en la mayoría de lenguajes de programación: 
        public: Acceso universal
        protected: Misma clase y clases que heredan
        private: Acceso misma clase únicamente.
    */

    private string $nombre; //En las clases podemos tipar los miembros
    private int $nivel_pelea;
    public string $clase = "Saiyajin";

    public function __construct($nombre, $nivel_pelea)
    {
        $this->nombre = $nombre;
        $this->nivel_pelea = $nivel_pelea;
    }
    /*
    Nueva funcionalidad a la hora de crear un constructor (PHP 8+):
    Podemos definir el constructor y sobre la marcha definir los atributos 
    de la clase pasándolos como parámetros:
    
    public function __construct(public string $nombre, public int $nivel_pelea)
    {
        //No hace falta la asignación, se hace automáticamente.
    }
    */
    public function Saludar(string $texto = "Hola soy "): string
    {
        return $texto . $this->nombre;
    }

    public function NivelDePelea(): string
    {
        return $this->nombre . " tiene un nivel de pela de " . $this->nivel_pelea
            . " y pertenece a la clase " . $this->clase;
    }

    //Getters
    public function getNombre()
    {
        return $this->nombre;
    }

    public function getNivel()
    {
        return $this->nivel_pelea;
    }

    //Setters
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setNivel($nivel_pelea)
    {
        $this->nivel_pelea = $nivel_pelea;
    }
}
