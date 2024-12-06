<?php

namespace POO\Clases;
/*
Los espacios de nombres en PHP son un mecanismo diseñado para evitar las colisiones de nombres. 

En el mundo de PHP, los espacios de nombres están diseñados para solucionar dos problemas con clases o funciones: 
1. El conflicto de nombres entre el código que se crea y el que existe internamente en PHP o en bibliotecas de terceros.
2. La capacidad de abreviar Nombres_Extra_Largos, mejorando la legibilidad del código fuente.

Únicamente cubren los siguientes elementos de PHP: 
- Clases
- Interfaces
- Traits
- Funciones
- Constantes declaradas con const pero no con define.
*/

/*
Creación de clases: 
Es preferible que cada clase figure en su propio fichero y que su nombre comience por mayúscula.
 */

class Saiyajin
{
    //use TecnicasSimples, TecnicasEspeciales; //Para agregar un trait
    use \POO\Traits\TecnicasCombinadas;

    /* use TecnicasSimples, TecnicasEspeciales { //Para cambiar la visibilidad de un trait
        UsarKameKameHa as private;
    } */

    private string $nombre; //En las clases podemos tipar los miembros
    private int $nivel_pelea;
    public string $clase = "Saiyajin";
    public static $cabello = "Negro";
    const VELOCIDAD = "Normal";
    /*
    Las constantes no usan el carácter $ y, además, su valor va siempre entre comillas y está asociado a la clase, 
    es decir, no existe una copia del mismo en cada objeto. Por tanto, para acceder a las constantes de una clase, 
    se debe utilizar el nombre de la clase y el operador ::, llamado operador de resolución de ámbito
    */

    /*El encapsulamiento o visibilidad de miembros en PHP funciona como en la mayoría de lenguajes de programación: 
        public: Acceso universal
        protected: Misma clase y clases que heredan
        private: Acceso misma clase únicamente.
    */

    /*Propiedades y médotos estáticos
    Como en otros POO, declarar propiedades o métodos estáticos los hacen accesibles sin la necesidad de instanciar la clase. 
    - Una propiedad o método estático siempre tendrá que ser public
    - Una propiedad declarada como static no puede ser accedida con un objeto de clase instanciado (aunque un método estático sí 
    lo puede hacer) 
    - Un método estático no puede acceder a los atributos (normales) de la clase.
    */

    public function __construct($nombre, $nivel_pelea)
    {
        $this->nombre = $nombre;
        $this->nivel_pelea = $nivel_pelea;
    }
    /*
    No se permite la sobrecarga de constructores. 

    Nueva funcionalidad a la hora de crear un constructor (PHP 8+):
    Podemos definir el constructor y sobre la marcha definir los atributos 
    de la clase pasándolos como parámetros:
    
    public function __construct(public string $nombre, public int $nivel_pelea)
    {
        //No hace falta la asignación, se hace automáticamente.
    }

    Con el uso de las funciones "func_get_args()", "fun_get_arg()" y "func_num_arg()", podemos pasar distinto número de parámetros 
    a un constructor "simulando" la sobrecarga del mismo. 
    
    class Persona {
        private $nombre;
        private $perfil;
        public function __construct() {
            $num = func_num_args(); //guardamos el número de argumentos
            switch ($num) {
                case 0:
                    break;
                case 1:
                    //recuperamos el argumento pasado
                    $this->nombre = func_get_arg(0); // los argumentos empiezan a contar por 0
                    break;
                case 2:
                    $this->nombre = func_get_arg(0);
                    $this->perfil = func_get_arg(1);
            }
        }
    }
    //Ahora será válido el siguiente código.
    $persona1 = new Persona();
    $persona2 = new Persona("Alicia");
    $persona3 = new Persona("Alicia", "Público");
    var_dump($persona1);
    echo "<break>";
    var_dump($persona2);
    echo "<break>";
    var_dump($persona3);
    
    S
    Otra posibilidad es usar el método mágico "__call" para capturar llamadas 
    a métodos que no estén implementados.

    También es posible definir un método destructor, que debe llamarse "__destruct" y permite
    definir acciones que se ejecutarán cuando se elimine el objeto. Ejemplo: 

    class Producto {
        private static $num_productos = 0;
        private $codigo;
       
        public function __construct($codigo) {
            $this->$codigo = $codigo;
            self::$num_productos++;
        }
        public function __destruct() {
            self::$num_productos--;
        }
    }
    */
    public static function MostrarColorCabello(): string
    {
        return "Tengo el cabello de color " . self::$cabello; //Un médoto estático puede acceder a un atributo estático, 
        //pero necesitamos referenciarlo con "self", en vez de "this", o, como se accede normalmente a un atributo estático: 
        //Saiyajin::$cabello.
    }

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

/*
Métodos mágicos: 
https://www.php.net/manual/es/language.oop5.magic.php

En PHP5 se introdujeron los llamados métodos mágicos, entre ellos __set y __get. 
Si se declaran estos dos métodos en una clase, PHP los invoca automáticamente cuando 
desde un objeto se intenta usar un atributo noexistente o no accesible. 

Por ejemplo, el código siguiente simula que la claseProducto tiene cualquier atributo 
que queramos usar.

class Producto {
    private $atributos = array();

    public function __get($atributo) {
        return $this->atributos[$atributo];
    }

    public function __set($atributo, $valor) {
        return->atributos[$atributo] = $valor;
    }
}
*/
/* __toString():
A veces puede ser útil mostrar el contenido de un objeto sin tener que usar
var_dump() para ello podemos usar el método mágico __toString(). 
Este método siempre debe devolver un String.

class Persona {
    public $nombre;
    public $apellidos;
    public $perfil;
    public function __toString(): String {
        return "{$this->apellidos}, ${this->nombre}. Tu perfil es: {$this->perfil}";
    }

}
$persona = new Persona();
$persona->nombre = "Manuel"; 
$persona->apellidos = "Gil Gil";
$persona->perfil="Público";
echo $persona; //muestra: Gil Gil, Manuel. Tu perfil es: Público
*/