<?php
include ('conexion.php');

$nom = $_POST['proceso_nombre'];
$cod = $_POST['proceso_cod'];
$area = $_POST['proceso_area'];
$fec = date("Y-m-d H:i:s");

$sql = "INSERT INTO proceso ( proceso_id, area_id, proceso_cod, proceso_nombre, proceso_fecha )
			VALUES			( NULL,'$area', '$cod', '$nom', '$fec' )";
echo mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>
