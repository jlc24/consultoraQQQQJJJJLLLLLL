<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'admin');
define('DB_PASS', 'usbw');
define('DB_NAME', 'consultora');

$conexion = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
date_default_timezone_set('America/La_Paz');
setlocale(LC_TIME, "spanish");
mysqli_set_charset($conexion, 'utf8');

if (!$conexion)
{
    die("La conexión falló: " . mysqli_connect_error());
}
//echo "Conectado exitosamente";
//mysqli_close($conn);

?>