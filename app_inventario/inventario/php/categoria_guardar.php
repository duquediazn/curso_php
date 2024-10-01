<?php
require_once "main.php";

#Almacenando datos: 
$nombre = limpiar_cadena($_POST['categoria_nombre']);
$ubicacion = limpiar_cadena($_POST['categoria_ubicacion']);


#Verificando campos obligatorios: 
if ($nombre == "") {
    echo '<div class="notification is-danger">
            <strong>¡Ocurrió un error inesperado!</strong>
            No has rellenado todos los campos que son obligatorios. 
        </div>';
    exit();
}

#Verificando integridad de los datos:
if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}", $nombre)) {
    echo '<div class="notification is-danger">
            <strong>¡Ocurrió un error inesperado!</strong>
            El nombre no coincide con el formato solicitado. 
        </div>';
    exit();
}

if ($ubicacion != "") {
    if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{5,150}", $ubicacion)) {
        echo '<div class="notification is-danger">
                <strong>¡Ocurrió un error inesperado!</strong>
                La ubicación no coincide con el formato solicitado. 
            </div>';
        exit();
    }
}

#Verificando el nombre: 
$check_nombre = conexion(); //Abrimos conexión con la BD
$check_nombre = $check_nombre->query("SELECT categoria_nombre FROM categoria WHERE categoria_nombre='$nombre'");
if ($check_nombre->rowCount() > 0) {
    echo '<div class="notification is-danger">
            <strong>¡Ocurrió un error inesperado!</strong>
            El nombre ingresado ya se encuentra registrado, por favor, introduzca otro. 
        </div>';
    exit();
}
$check_nombre = null; //Terminamos la conexión.

#Guardar datos
$guardar_categoria = conexion();
$guardar_categoria = $guardar_categoria->prepare("INSERT INTO categoria(categoria_nombre, categoria_ubicacion) 
VALUES(:nombre, :ubicacion)");

$marcadores = [
    ":nombre" => $nombre,
    ":ubicacion" => $ubicacion
];

$guardar_categoria->execute($marcadores);

if ($guardar_categoria->rowCount() == 1) {
    echo '<div class="notification is-info">
            <strong>¡Categoría registrada!</strong>
            La categoría se registró con éxito. 
         </div>';
} else {
    echo '<div class="notification is-danger">
            <strong>¡Ocurrió un error inesperado!</strong>
            No se pudo registrar la categoría, por favor, introduzca otro. 
        </div>';
}

$guardar_categoria = null;
