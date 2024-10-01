<?php
require_once "main.php";

#Almacenando datos: 
$nombre = limpiar_cadena($_POST['usuario_nombre']);
$apellido = limpiar_cadena($_POST['usuario_apellido']);

$usuario = limpiar_cadena($_POST['usuario_usuario']);
$email = limpiar_cadena($_POST['usuario_email']);

$clave_1 = limpiar_cadena($_POST['usuario_clave_1']);
$clave_2 = limpiar_cadena($_POST['usuario_clave_2']);

#Verificando campos obligatorios: 
if (
    $nombre == "" || $apellido == "" || $usuario == ""
    || $clave_1 == "" || $clave_2 == ""
) {
    echo '<div class="notification is-danger">
                <strong>¡Ocurrió un error inesperado!</strong>
                No has rellenado todos los campos que son obligatorios. 
            </div>';
    exit();
}

#Verificando integridad de los datos:
if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $nombre)) {
    echo '<div class="notification is-danger">
            <strong>¡Ocurrió un error inesperado!</strong>
            El nombre no coincide con el formato solicitado. 
         </div>';
    exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $apellido)) {
    echo '<div class="notification is-danger">
            <strong>¡Ocurrió un error inesperado!</strong>
            El apellido no coincide con el formato solicitado. 
         </div>';
    exit();
}

if (verificar_datos("[a-zA-Z0-9]{4,20}", $usuario)) {
    echo '<div class="notification is-danger">
            <strong>¡Ocurrió un error inesperado!</strong>
            El usuario no coincide con el formato solicitado. 
         </div>';
    exit();
}


if (verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave_1) || verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave_2)) {
    echo '<div class="notification is-danger">
            <strong>¡Ocurrió un error inesperado!</strong>
            Las claves no coinciden con el formato solicitado. 
         </div>';
    exit();
}

#Verificando el email: 
if ($email != "") {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { //https://www.php.net/manual/es/function.filter-var.php
        $check_email = conexion(); //Abrimos conexión la BD
        $check_email = $check_email->query("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");
        if ($check_email->rowCount() > 0) {
            echo '<div class="notification is-danger">
                    <strong>¡Ocurrió un error inesperado!</strong>
                    El email ingresado ya se encuentra registrado, por favor, introduzca otro email. 
                 </div>';
            exit();
        }
        $check_email = null; //Terminamos la conexión.
    } else {
        echo '<div class="notification is-danger">
                <strong>¡Ocurrió un error inesperado!</strong>
                El email ingresado no es válido. 
             </div>';
        exit();
    }
}

#Verificando el usuario: 
$check_usuario = conexion(); //Abrimos conexión la BD
$check_usuario = $check_usuario->query("SELECT usuario_usuario FROM usuario WHERE usuario_usuario='$usuario'");
if ($check_usuario->rowCount() > 0) {
    echo '<div class="notification is-danger">
                <strong>¡Ocurrió un error inesperado!</strong>
                El usuario ingresado ya se encuentra registrado, por favor, introduzca otro. 
          </div>';
    exit();
}
$check_usuario = null; //Terminamos la conexión.

#Verificando las claves:
if ($clave_1 != $clave_2) {
    echo '<div class="notification is-danger">
                <strong>¡Ocurrió un error inesperado!</strong>
                Las claves ingresadas no coinciden. 
          </div>';
    exit();
} else {
    $clave = password_hash($clave_1, PASSWORD_BCRYPT, ["cost" => 10]);
    /*cost - denota el coste del algoritmo que debería usarse. 
    Si se omite, se usará el valor predeterminado 10. 
    Este es un buen coste de referencia, pero se podría considerar aumentarlo dependiendo del hardware.*/
}

#Guardando datos:
$guardar_usuario = conexion();

/*
Podemos ejecutar la consulta directamente: 
$guardar_usuario = $$guardar_usuario->query("INSERT INTO usuario(usuario_nombre, usuario_apellido, 
usuario_usuario, usuario_clave, usuario_email) VALUES($nombre, $apellido, $usuario, $clave, $email)");*/

//O podemos prepararla con prepare en lugar de ejecutarla directamente con query (más seguro).
$guardar_usuario = $guardar_usuario->prepare("INSERT INTO usuario(usuario_nombre, usuario_apellido, 
usuario_usuario, usuario_clave, usuario_email) VALUES(:nombre, :apellido, :usuario, :clave, :email)");

//contruimos un array asociativo donde asociamos cada marcador ":marcador" con su valor.
$marcadores = [
    ":nombre" => $nombre,
    ":apellido" => $apellido,
    ":usuario" => $usuario,
    ":clave" => $clave,
    ":email" => $email,
];


$guardar_usuario->execute($marcadores); //Ejecutamos la consulta con execute y le pasamos el array anterior.

//Comprobamos que hemos registrado el usuario correctamnte: 
if ($guardar_usuario->rowCount() == 1) {
    echo '<div class="notification is-info">
        <strong>¡Usuario registrado!</strong>
        El usuario se registró con éxito. 
    </div>';
} else {
    echo '<div class="notification is-danger">
        <strong>¡Ocurrió un error inesperado!</strong>
        No se pudo registrar el usuario, por favor, inténtelo de nuevo. 
    </div>';
}

$guardar_usuario = null; //Cerramos conexión.
