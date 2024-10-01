<?php 
    #Almacenando datos: 
    $usuario = limpiar_cadena($_POST['login_usuario']);
    $clave = limpiar_cadena($_POST['login_clave']);

    #Verificando campos obligatorios: 
    if (
        $usuario == "" || $clave == "") {
        echo '<div class="notification is-danger">
                    <strong>¡Ocurrió un error inesperado!</strong>
                    No has rellenado todos los campos que son obligatorios. 
                </div>';
        exit();
    }

    #Verificando integridad de los datos:
    if (verificar_datos("[a-zA-Z0-9]{4,20}", $usuario)) {
        echo '<div class="notification is-danger">
                <strong>¡Ocurrió un error inesperado!</strong>
                El usuario no coincide con el formato solicitado. 
            </div>';
        exit();
    }

    if (verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave)) {
        echo '<div class="notification is-danger">
                <strong>¡Ocurrió un error inesperado!</strong>
                La clave no coincide con el formato solicitado. 
            </div>';
        exit();
    }

    $check_user=conexion();
    $check_user=$check_user->query("SELECT * FROM usuario WHERE usuario_usuario = '$usuario'");

    if($check_user->rowCount()==1) {
        $check_user=$check_user->fetch(); //Devuelve un array asociativo con los datos.

        if($check_user['usuario_usuario'] == $usuario 
        && password_verify($clave, $check_user['usuario_clave'])) {

            $_SESSION['id']=$check_user['usuario_id'];
            $_SESSION['nombre']=$check_user['usuario_nombre'];
            $_SESSION['apellido']=$check_user['usuario_apellido'];
            $_SESSION['usuario']=$check_user['usuario_usuario'];

            if(headers_sent()) {
                echo "<script> window.location.href='index.php?vista=home'; </script>";
            }else {
                header("location: index.php?vista=home");
            }

        }else {
            echo '<div class="notification is-danger">
                    <strong>¡Ocurrió un error inesperado!</strong>
                    Usuario o clave incorrectos. 
                </div>';
        }

    } else {
        echo '<div class="notification is-danger">
                <strong>¡Ocurrió un error inesperado!</strong>
                Usuario o clave incorrectos. 
             </div>';
    }

    $check_user=null;