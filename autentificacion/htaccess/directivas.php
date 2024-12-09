<?php

echo "<h1>Directivas PHP_AUTH</h1>";

echo "<p>Usuario:".$_SERVER['PHP_AUTH_USER']."</p>";
echo "<p>Contraseña:".$_SERVER['PHP_AUTH_PW']."</p>";
echo "<p>MétodoAutentificación:".$_SERVER['AUTH_TYPE']."</p>";
