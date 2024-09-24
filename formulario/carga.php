<?php   

/* 
echo $_FILES['fichero']['name']."<br>"; // El nombre original del fichero en la máquina del cliente.
echo $_FILES['fichero']['tmp_name']."<br>"; // El nombre temporal del fichero en el cual se almacena el fichero subido en el servidor.
echo $_FILES['fichero']['type']."<br>"; // El tipo MIME del fichero, si el navegador proporcionó esta información. 
//Un ejemplo sería "image/gif". Este tipo MIME, sin embargo, no se comprueba en el lado de PHP y por lo tanto no se garantiza su valor.
//https://developer.mozilla.org/es/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Common_types
echo $_FILES['fichero']['error']."<br>"; // El código de error asociado a esta subida. https://www.php.net/manual/es/features.file-upload.errors.php
echo $_FILES['fichero']['size']."<br>"; // El tamaño, en bytes, del fichero subido.
*/

if(mime_content_type($_FILES['fichero']['tmp_name']) != "image/jpeg" 
&& mime_content_type($_FILES['fichero']['tmp_name']) != "image/png") { //https://www.php.net/manual/es/function.mime-content-type.php
    echo "Tipo de fichero no admitido";
    exit();
} 

if(($_FILES['fichero']['size']/1024)>3072) {//Si el archivo tiene un tamaño mayor que 3MB (1024bytes*3)
    echo "El archivo supera el peso permitido (3Mb)";
    exit();
}

if(!file_exists("files")) { //https://www.php.net/manual/es/function.file-exists.php
    if(!mkdir("files", 0777)) { //https://www.php.net/manual/es/function.mkdir.php
        echo "Error al crear el directorio";
        exit();
    }
}

chmod("files", 0777); //https://www.php.net/manual/es/function.chmod.php

if(move_uploaded_file($_FILES['fichero']['tmp_name'], "files/".$_FILES['fichero']['name'])) { //https://www.php.net/manual/es/function.move-uploaded-file.php
    echo "Archivo subido con éxito.";
} else {
    echo "Error al subir el archivo.";
}