<?php
include ('conexion.php');

$id = $_POST['lab_id'];
$nom = $_POST['lab_nombre_update'];
$nic = $_POST['lab_nick_update'];
$dir = $_POST['lab_direccion_update'];
$ema = $_POST['lab_email_update'];
$web = $_POST['lab_web_update'];
$pre = $_POST['lab_preventista_update'];

$sql = "UPDATE laboratorio 
			SET lab_nombre = '$nom',
			lab_nick = '$nic',
			lab_direccion = '$dir',
			lab_email = '$ema',
			lab_web = '$web',
			lab_preventista = '$pre' 
			WHERE
				lab_id = '$id'";
echo mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>