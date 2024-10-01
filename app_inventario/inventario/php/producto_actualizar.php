<?php
    require_once "main.php ";

    $id = limpiar_cadena($_POST['producto_id']);

    
    //Verificar producto
    $check_producto = conexion();
    $check_producto = $check_producto->query("SELECT * FROM producto WHERE
        producto_id='$id'");

    if ($check_producto->rowCount() <= 0) {
        echo '<div class="notification is-danger">
                    <strong>¡Ocurrió un error inesperado!</strong>
                    El producto no existe en el sistema. 
                </div>';
        exit();
    } else {
        $datos = $check_producto->fetch();
    }

    $check_producto = null;

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
    if($codigo!=$datos['producto_codigo']){
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
    } 
    
    #Verificando el nombre: 
    if($nombre!=$datos['producto_nombre']){
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
    }

    #Verificando la categoría: 
    if($categoria!=$datos['categoria_id']){
        $check_categoria = conexion(); //Abrimos conexión la BD
        $check_categoria = $check_categoria->query("SELECT categoria_id FROM categoria WHERE categoria_id='$categoria'");
        if ($check_categoria->rowCount() <= 0) {
            echo '<div class="notification is-danger">
                            <strong>¡Ocurrió un error inesperado!</strong>
                            La categoría seleccionada no existe. 
                    </div>';
            exit();
        }
        $check_categoria = null; //Terminamos la conexión.
    }
   
    #Actualizar datos
    $actualizar_producto = conexion();
    $actualizar_producto = $actualizar_producto->prepare("UPDATE producto SET producto_codigo=:codigo,
        producto_nombre=:nombre, producto_precio=:precio, producto_stock=:stock, categoria_id=:categoria 
        WHERE producto_id=:id");

    $marcadores = [
        ":codigo" => $codigo,
        ":nombre" => $nombre,
        ":precio" => $precio,
        ":stock" => $stock,
        ":categoria" => $categoria,
        ":id" => $id
    ];

    if ($actualizar_producto->execute($marcadores)) {
        echo '<div class="notification is-info">
                <strong>¡Producto actualizado!</strong>
                El producto se actualizó con éxito.  
            </div>';
    } else {
        echo '<div class="notification is-danger">
                <strong>¡Ocurrió un error inesperado!</strong>
                No se puso actualizar el producto, por favor, inéntelo nuevamente.  
            </div>';
    }
    $actualizar_producto = null;
