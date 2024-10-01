<?php
require_once "../inc/session_start.php";
require_once "main.php";

#Almacenando datos: 
$codigo = limpiar_cadena($_POST['producto_codigo']);
$nombre = limpiar_cadena($_POST['producto_nombre']);
$precio = limpiar_cadena($_POST['producto_precio']);
$stock = limpiar_cadena($_POST['producto_stock']);
$categoria = limpiar_cadena($_POST['producto_categoria']);

#Verificando campos obligatorios: 
if (
    $codigo == "" || $nombre == "" || $precio == ""
    || $categoria == "" || $stock == ""
) {
    echo '<div class="notification is-danger">
                    <strong>¡Ocurrió un error inesperado!</strong>
                    No has rellenado todos los campos que son obligatorios. 
                </div>';
    exit();
}

#Verificando integridad de los datos:
if (verificar_datos("[a-zA-Z0-9- ]{1,70}", $codigo)) {
    echo '<div class="notification is-danger">
                <strong>¡Ocurrió un error inesperado!</strong>
                El código no coincide con el formato solicitado. 
            </div>';
    exit();
}

if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}", $nombre)) {
    echo '<div class="notification is-danger">
                <strong>¡Ocurrió un error inesperado!</strong>
                El nombre no coincide con el formato solicitado. 
            </div>';
    exit();
}

if (verificar_datos("[0-9.]{1,25}", $precio)) {
    echo '<div class="notification is-danger">
                <strong>¡Ocurrió un error inesperado!</strong>
                El precio no coincide con el formato solicitado. 
            </div>';
    exit();
}

if (verificar_datos("[0-9]{1,25}", $stock)) {
    echo '<div class="notification is-danger">
                <strong>¡Ocurrió un error inesperado!</strong>
                El stock no coincide con el formato solicitado. 
            </div>';
    exit();
}

#Verificando el codigo: 
$check_codigo = conexion(); //Abrimos conexión la BD
$check_codigo = $check_codigo->query("SELECT producto_codigo FROM producto WHERE producto_codigo='$codigo'");
if ($check_codigo->rowCount() > 0) {
    echo '<div class="notification is-danger">
                    <strong>¡Ocurrió un error inesperado!</strong>
                    El código de barras ingresado ya se encuentra registrado, por favor, introduzca otro. 
            </div>';
    exit();
}
$check_codigo = null; //Terminamos la conexión.

#Verificando el nombre: 
$check_nombre = conexion(); //Abrimos conexión la BD
$check_nombre = $check_nombre->query("SELECT producto_nombre FROM producto WHERE producto_nombre='$nombre'");
if ($check_nombre->rowCount() > 0) {
    echo '<div class="notification is-danger">
                    <strong>¡Ocurrió un error inesperado!</strong>
                    El nombre ingresado ya se encuentra registrado, por favor, introduzca otro. 
            </div>';
    exit();
}
$check_nombre = null; //Terminamos la conexión.

#Verificando la categoría: 
$check_categoria = conexion(); //Abrimos conexión la BD
$check_categoria = $check_categoria->query("SELECT categoria_id FROM categoria WHERE categoria_id='$categoria'");
if ($check_categoria->rowCount() <= 0) {
    echo '<div class="notification is-danger">
                    <strong>¡Ocurrió un error inesperado!</strong>
                    La cateforía seleccionada no existe. 
            </div>';
    exit();
}
$check_categoria = null; //Terminamos la conexión.

#Directorio de imágenes
$img_dir = "../img/producto/";

#Comprobar si se seleccionó una imagen
if ($_FILES['producto_foto']['name'] != "" && $_FILES['producto_foto']['size'] > 0) {
    #Creando directorio
    if (!file_exists($img_dir)) {
        if (!mkdir($img_dir, 0777)) {
            echo '<div class="notification is-danger">
                        <strong>¡Ocurrió un error inesperado!</strong>
                        Error al crear el directorio. 
                    </div>';
            exit();
        }
    }

    #Verficando el formato de las imágenes
    if (
        mime_content_type($_FILES['producto_foto']['tmp_name']) != "image/jpeg" &&
        mime_content_type($_FILES['producto_foto']['tmp_name']) != "image/png"
    ) {
        echo '<div class="notification is-danger">
                    <strong>¡Ocurrió un error inesperado!</strong>
                    La imagen que ha seleccionado es de un formato no permitido. 
                </div>';
        exit();
    }

    #verificarndo el peso de la imagen
    if (($_FILES['producto_foto']['size'] / 1024) > 3072) { //3MB
        echo '<div class="notification is-danger">
                    <strong>¡Ocurrió un error inesperado!</strong>
                    La imagen que ha seleccionado supera el peso permitido. 
                </div>';
        exit();
    }

    #verificando la extensión de la imagen
    switch (mime_content_type($_FILES['producto_foto']['tmp_name'])) {
        case 'image/jpeg':
            $img_ext = ".jpg";
            break;
        case 'image/png':
            $img_ext = ".png";
            break;
    }

    chmod($img_dir, 0777);

    $img_nombre = renombrar_fotos($nombre);
    $foto = $img_nombre . $img_ext;

    #Moviendo imagen al directorio
    if (!move_uploaded_file($_FILES['producto_foto']['tmp_name'], $img_dir . $foto)) {
        echo '<div class="notification is-danger">
                    <strong>¡Ocurrió un error inesperado!</strong>
                    No podemos subir la imagen al sistema en este momento. 
                </div>';
        exit();
    }
} else {
    $foto = "";
}

#Guardando datos:
$guardar_producto = conexion();
$guardar_producto = $guardar_producto->prepare("INSERT INTO producto(producto_codigo, producto_nombre, producto_precio, producto_stock, producto_foto,
    categoria_id, usuario_id) VALUES(:codigo, :nombre, :precio, :stock, :foto, :categoria, :usuario)");

//contruimos un array asociativo donde asociamos cada marcador ":marcador" con su valor.
$marcadores = [
    ":codigo" => $codigo,
    ":nombre" => $nombre,
    ":precio" => $precio,
    ":stock" => $stock,
    ":foto" => $foto,
    ":categoria" => $categoria,
    ":usuario" => $_SESSION['id']
];

$guardar_producto->execute($marcadores); //Ejecutamos la consulta con execute y le pasamos el array anterior.

//Comprobamos que hemos registrado el usuario correctamnte: 
if ($guardar_producto->rowCount() == 1) {
    echo '<div class="notification is-info">
                <strong>¡Producto registrado!</strong>
                El producto se registró con éxito. 
            </div>';
} else {
    if (is_file($img_dir . $foto)) {
        chmod($img_dir, 0777);
        unlink($img_dir . $foto); //Borra un fichero: https://www.php.net/manual/es/function.unlink.php
    }
    echo '<div class="notification is-danger">
                <strong>¡Ocurrió un error inesperado!</strong>
                No se pudo registrar el producto, por favor, inténtelo de nuevo. 
            </div>';
}

$guardar_producto = null; //Cerramos conexión.
