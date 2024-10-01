<?php
    $modulo_buscador=limpiar_cadena($_POST['modulo_buscador']);

    $modulos=["usuario", "categoria", "producto"];

    if(in_array($modulo_buscador, $modulos)){
        $modulos_url=[
            "usuario"=>"user_search",
            "categoria"=>"category_search",
            "producto"=>"product_search"
        ];

        $modulos_url=$modulos_url[$modulo_buscador];

        $modulo_buscador="busqueda_".$modulo_buscador;

        //Iniciar búsqueda
        if(isset($_POST['txt_buscador'])){
            $txt=limpiar_cadena($_POST['txt_buscador']);

            if ($txt=="") {
                echo '<div class="notification is-danger">
                        <strong>¡Ocurrió un error inesperado!</strong>
                        Introduce un término de búsqueda. 
                     </div>';
            } else {
                if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}", $txt)) {
                    echo '<div class="notification is-danger">
                            <strong>¡Ocurrió un error inesperado!</strong>
                            El término de búsqueda no coincide con los datos solicitados. 
                        </div>';
                } else {
                    $_SESSION[$modulo_buscador]=$txt;
                    header("Location: index.php?vista=$modulos_url", true, 303);
                    exit();
                }
                
            }
            
        }

        //Eliminar búsqueda
        if(isset($_POST['eliminar_buscador'])){
            unset($_SESSION[$modulo_buscador]);
            header("Location: index.php?vista=$modulos_url", true, 303);
            exit();
        }
    }else{
        echo '<div class="notification is-danger">
                <strong>¡Ocurrió un error inesperado!</strong>
                No podemos procesar la petición. 
            </div>';
    }