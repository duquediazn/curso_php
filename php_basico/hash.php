<?php
/*
Una función criptográfica hash- usualmente conocida como "hash"- es un algoritmo
matemático que transforma cualquier bloque arbitrario de datos en una nueva serie 
de caracteres con una longitud fija. 

Independientemente de la longitud de los datos de entrada, el valor hash de salida 
tendrá siempre la misma longitud. 

*/

$clave = "HolaMundo123";

echo md5($clave) . "<br>"; //md5(), se usaba mucho antes pero ahora no es la más recomendable. https://www.php.net/manual/es/function.md5.php
//devuelve: 5b6b89a334ac2d95be7e053566d81466
echo sha1($clave) . "<br>";  //Al igual que al anterior, está en desuso. https://www.php.net/manual/es/function.sha1.php
//devuelve: 47dd16b35e08b74d688de0724f76f66ce62fe072
echo hash("md5", $clave) . "<br>";
/*
Parámetros: 
1: string con algoritmo hash. 
2: string con la clave a encriptar. 
3: opcional, booleano.
Cuando se establece en true la salida serán datos binarios sin formato, 
false la salida serán dígitos hexadecimales en minúsculas.

//https://www.php.net/manual/es/function.hash.php

Podemos ver así todos los algoritmos soportados por la función hash: 
*/
foreach (hash_algos() as $algoritmos) { //hash_algos(), devuelve un array con todos los algoritmos que sorpota "hash()"
    echo $algoritmos . "<br>";
}

foreach (hash_algos() as $algoritmos) {
    echo $algoritmos . " : " . hash($algoritmos, $clave) . "<br>"; //Vemos el hash generado por cada algoritmo. 
}

/*
Manera recomendada de encriptar claves: 

password_hash() : https://www.php.net/manual/es/function.password-hash.php
Paŕametros: 
1:string a procesar,
2:algoritmo: PASSWORD_DEFAULT o PASSWORD_BCRYPT 
3:opcional: Un array asociativo de opciones.

El hash devuelto varía, no es fijo como en los anteriores. 
*/

echo password_hash($clave, PASSWORD_DEFAULT) . "<br>";
$clave_procesada = password_hash($clave, PASSWORD_BCRYPT);

/*
Para verificar un hash: 

password_verify():
parámetros:
1: password: La contraseña del usuario.
2: hash: Un hash creado por password_hash().

https://www.php.net/manual/es/function.password-verify.php
*/

echo password_verify($clave, $clave_procesada) ? "Las claves coinciden" : "Las claves no coinciden";