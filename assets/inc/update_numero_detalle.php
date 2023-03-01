<?php
	/*Datos de conexion a la base de datos*/
	include('conexion.php');

	$fac_id = $_POST['fac_id'];

	$sql="UPDATE configuracion SET numero_detalle = '$fac_id'";
	echo $result=mysqli_query($conexion,$sql);
	mysqli_close($conexion);
 ?>