<?php
	//CONEXION A LA BdD
	include('conexion.php');
    $y = (int)$_POST['anio'];
	$sql="UPDATE configuracion SET year = $y";
	echo mysqli_query($conexion,$sql);
	mysqli_close($conexion);
 ?>