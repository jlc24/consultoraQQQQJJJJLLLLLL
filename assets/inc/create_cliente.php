<?php
include ('conexion.php');

$nit = $_POST['cli_ci_nit'];
$nom = $_POST['cli_nombre'];
$gen = $_POST['cli_genero'];
$dir = $_POST['cli_direccion'];
$cel = $_POST['cli_celular'];
$fec = date("Y-m-d H:i:s");

$sql = "INSERT INTO cliente ( cli_id, cli_ci_nit, cli_nombre, cli_genero, cli_direccion, cli_celular, cli_fecha_registro )
			VALUES
				( NULL,'$nit', '$nom', '$gen', '$dir', '$cel', '$fec' )";
echo mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>
