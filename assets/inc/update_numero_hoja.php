<?php
	include('conexion.php');
	$hoja_id = $_POST['hoja_id'];
	$sql="UPDATE configuracion SET hoja_id = '$hoja_id'";
	echo $result=mysqli_query($conexion,$sql);
	mysqli_close($conexion);
 ?>