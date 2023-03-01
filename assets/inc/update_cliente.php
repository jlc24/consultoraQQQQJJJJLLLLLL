<?php
include ('conexion.php');

$id = $_POST['cli_id'];
$nit = $_POST['cli_ci_nit_update'];
$nom = $_POST['cli_nombre_update'];
$gen = $_POST['cli_genero_update'];
$dir = $_POST['cli_direccion_update'];
$cel = $_POST['cli_celular_update'];

$sql = "UPDATE cliente SET cli_ci_nit='$nit', cli_nombre='$nom', cli_genero='$gen', cli_direccion='$dir', cli_celular='$cel'
	WHERE cli_id='$id'";
echo mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>
