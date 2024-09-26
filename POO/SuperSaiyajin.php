<?php

//require_once "Saiyajin.php";

//En PHP no existe la herencia múltiple.
class SuperSaiyajin extends Saiyayin
{

    public string $clase = "Super Saiyajin";

    public function Transformacion()
    {

        if ($this->getNivel() >= 1500) {
            $texto = $this->getNombre() . " se transformó en " . $this->clase;
        } else {
            $texto = $this->getNombre() . " NO se transformó en " . $this->clase;
        }

        return $texto;
    }
    /*
    public function NivelDePelea(): string //Sobreescrita
    {
        $nivel = $this->nivel_pelea * 2;
        return $this->nombre . " aumentó su nivel de pelea a " . $nivel;
    }
    */
}
