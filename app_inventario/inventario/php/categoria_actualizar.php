<?php
require_once "main.php ";

$id = limpiar_cadena($_POST['categoria_id']);

//Verificar la categoria
$check_categoria = conexion();
$check_categoria = $check_categoria->query("SELECT * FROM categoria WHERE
    categoria_id='$id'");

if ($check_categoria->rowCount() <= 0) {
    echo '<div class="notification is-danger">
                <strong>¡Ocurrió un error inesperado!</strong>
                La categoría no existe en el sistema. 
            </div>';
    exit();
} else {
    $datos = $check_categoria->fetch();
}

$check_categoria = null;

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
if ($nombre != $datos['categoria_nombre']) {
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
}


#Actualizar datos
$actualizar_categoria = conexion();
$actualizar_categoria = $actualizar_categoria->prepare("UPDATE categoria SET categoria_nombre=:nombre,
    categoria_ubicacion=:ubicacion WHERE categoria_id=:id");

//construimos un array asociativo donde asociamos cada marcador ":marcador" con su valor.
$marcadores = [
    ":nombre" => $nombre,
    ":ubicacion" => $ubicacion,
    ":id" => $id
];

if ($actualizar_categoria->execute($marcadores)) {
    echo '<div class="notification is-info">
            <strong>¡Categoría actualizada!</strong>
            La categoría se actualizó con éxito.  
        </div>';
} else {
    echo '<div class="notification is-danger">
            <strong>¡Ocurrió un error inesperado!</strong>
            No se puso actualizar la categoría, por favor, inéntelo nuevamente.  
        </div>';
}
$actualizar_categoria = null;
