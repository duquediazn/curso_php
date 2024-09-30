<?php 
namespace POO\Traits;
/*
TRAITS
Los traits son un mecanismo de reutilización de código en lenguajes de herencia simple como PHP.
El objetivo de un trait es el de reducir las limitaciones propias de la herencia simple permitiendo que 
los desarrolladores reutilicen a voluntad conjuntos de métodos sobre varias clases independientes y pertenecientes
a clases jerárquicas distintas. 

Un trait es similar a una clase, pero su objetivo es agrupar funcionalidades específicas. Un trait no se puede
instantcias, simplemente facilita comportamientos (métodos) a las clases sin necesidad de usar herencia.
*/
trait TecnicasSimples{
    public function AumentarVelocidad(): string {
        return $this->getNombre()." aumentó su velocidad";
    }

    public function AumentarKi(): string {
        return $this->getNombre()." aumentó su Ki ".$this->getNivel();
    }
}