<?php
include ('conexion.php');

$nom = $_POST['area_nombre'];
$fec = date("Y-m-d H:i:s");

$sql = "INSERT INTO area ( area_id, area_nombre, area_fecha )
			VALUES		 ( NULL, '$nom', '$fec' )";
echo mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>
