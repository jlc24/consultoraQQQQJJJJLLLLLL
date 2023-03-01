<?php
include ('conexion.php');

$nit = $_POST['adm_ci_nit'];
$nom = $_POST['adm_nombre'];
$dir = $_POST['adm_direccion'];
$cel = $_POST['adm_celular'];
$are = $_POST['adm_area'];
$fec = date("Y-m-d H:i:s");

$sql = "INSERT INTO cliente ( adm_id, adm_ci_nit, adm_nombre, adm_genero, adm_direccion, adm_celular, adm_fecha_registro )
			VALUES
				( NULL,'$nit', '$nom', '$gen', '$dir', '$cel', '$fec' )";
echo mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>
