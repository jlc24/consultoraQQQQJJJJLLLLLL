<?php
include ('conexion.php');

$nom = $_POST['lab_nombre'];
$nic = $_POST['lab_nick'];
$dir = $_POST['lab_direccion'];
$ema = $_POST['lab_email'];
$web = $_POST['lab_web'];
$pre = $_POST['lab_preventista'];
$fec = date("Y-m-d H:i:s");

$sql = "INSERT INTO laboratorio ( lab_id, lab_logo, lab_nombre, lab_nick, lab_direccion, lab_email, lab_web, lab_preventista, lab_fecha_registro )
			VALUES
				( NULL,NULL,'$nom', '$nic', '$dir', '$ema', '$web', '$pre', '$fec' )";
echo mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>