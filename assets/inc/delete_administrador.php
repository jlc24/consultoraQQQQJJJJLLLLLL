<?php
include ('conexion.php');
$adm = $_POST['adm_id'];
$sql = "DELETE FROM administrador WHERE adm_id = '$adm'";
echo mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>