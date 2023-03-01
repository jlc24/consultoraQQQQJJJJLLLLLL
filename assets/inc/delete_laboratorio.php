<?php
include('conexion.php');
$lab_id=$_POST['id'];

$sql="DELETE FROM laboratorio WHERE lab_id='$lab_id'";
echo mysqli_query($conexion,$sql);
mysqli_close($conexion);
 ?>