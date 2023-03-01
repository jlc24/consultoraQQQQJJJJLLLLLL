<?php
include ('conexion.php');
$cli_id = $_POST['id'];
$sql = "DELETE FROM cliente WHERE cli_id = '$cli_id'";
echo mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>