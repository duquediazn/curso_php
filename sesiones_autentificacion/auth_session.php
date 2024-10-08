<?php
// Si el usuario no se ha autentificado, pedimos las credenciales
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header("WWW-Authenticate: Basic realm='Contenido restringido'");
    header("HTTP/1.0 401 Unauthorized");
    die();
}

// Guardaremos el usuario en una variable de sesión
session_start();
if (!isset($_SESSION['usuario'])) {
    // Conexión a la base de datos proyecto.
    $host = "localhost";
    $db = "proyecto";
    $user = "gestor";
    $pass = "secreto";
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    try {
        $conProyecto = new PDO($dsn, $user, $pass);
        $conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $ex) {
        die("Error en la conexión: mensaje: " . $ex->getMessage());
    }

    // Hacemos la consulta con las credenciales pasadas
    $consulta = "SELECT * FROM usuarios WHERE usuario=:u AND pass=:p";
    $stmt = $conProyecto->prepare($consulta);
    $password = hash('sha256', $_SERVER['PHP_AUTH_PW']);
    try {
        $stmt->execute([
            ':u' => $_SERVER['PHP_AUTH_USER'],
            ':p' => $password
        ]);
    } catch (PDOException $ex) {
        $conProyecto = null;
        die("Error al recuperar los datos de MySQL: " . $ex->getMessage());
    }

    // Si la consulta no devuelve ninguna fila, las credenciales son erróneas.
    if ($stmt->rowCount() == 0) {
        header("WWW-Authenticate: Basic realm='Contenido restringido'");
        header("HTTP/1.0 401 Unauthorized");
        $stmt = null;
        $conProyecto = null;
        die();
    }
    $stmt = null;
    $conProyecto = null;

    // Si las credenciales fueron correctas, creo la sesión del usuario con su nombre
    $_SESSION['usuario'] = $_SERVER['PHP_AUTH_USER'];
} else { // si ya está autentificado
    // Para poner el formato fecha en castellano y recuperar fecha y hora de acceso
    setlocale(LC_ALL, 'es_ES.UTF-8');
    date_default_timezone_set('Europe/Madrid');
    $ahora = new DateTime();
    $fecha = strftime("Tu última visita fue el %A, %d de %B de %Y a las %H:%M:%S", date_timestamp_get($ahora));

    // Comprobamos si se ha enviado el formulario que limpia el registro
    if (isset($_POST['limpiar'])) {
        unset($_SESSION['visita']);
    } else {
        $_SESSION['visita'][] = $fecha;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Ejemplo Sesiones</title>
</head>

<body style="background:gainsboro">
    <h4 class="mt-3 text-center font-weight-bold">Ejercicio Apartado 3.2 </h4>
    <div class='container mt-3'>
        <div class='row'>
            <div class='col-md-4 font-weight-bold'> Nombre Usuario:</div>
            <div class='col-md-4'>
                <?php echo htmlspecialchars($_SERVER['PHP_AUTH_USER']); ?>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-4 font-weight-bold'>Password Usuario (sha256):</div>
            <div class='col-md-4'>
                <?php echo htmlspecialchars(hash('sha256', $_SERVER['PHP_AUTH_PW'])); ?>
            </div>
        </div>
    </div>
    <?php

    if (!isset($_SESSION['visita'])) {
        echo "<p class='text-success font-weight-bold mt-3'>Bienvenido, es tu primera visita.</p>";
    } else {
        echo "<p class='text-success font-weight-bold mt-3'>Tus anteriores visitas han sido: </p><ul>";
        foreach ($_SESSION['visita'] as $v) {
            echo "<li>$v</li>";
        }
        echo "</ul>";
    }
    ?>

    <form name='vaciar' action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
        <input type='submit' name='limpiar' value='Limpiar registro' class="btn btn-warning">
    </form>

</body>

</html>