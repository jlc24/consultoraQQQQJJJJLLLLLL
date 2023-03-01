<?php
include ('conexion.php');

$id = $_POST['usuario_id_update'];
$nom = $_POST['usuario_nombre_update'];
$user = $_POST['usuario_user_update'];
$pass = $_POST['usuario_pass_update'];
$pass_sha1 =  sha1($pass);
$rol = $_POST['usuario_rol_update'];

$fila = mysqli_fetch_row(mysqli_query($conexion, "SELECT adm_pass FROM administrador WHERE adm_id = $id"));
if($pass == $fila[0]){
	$sql = "UPDATE administrador SET adm_nombre='$nom', adm_usuario='$user', adm_rol='$rol' WHERE adm_id='$id'";
	echo mysqli_query($conexion, $sql);
}else{
	$sql = "UPDATE administrador SET adm_nombre='$nom', adm_usuario='$user', adm_pass='$pass_sha1', adm_rol='$rol' WHERE adm_id='$id'";
	echo mysqli_query($conexion, $sql);
}
mysqli_close($conexion);
?>
