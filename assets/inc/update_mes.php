<?php
	//CONEXION A LA BdD
	include('conexion.php');
    
    $m = (int)$_POST['mes'];
    $a = (int)$_POST['anio'];

	$sql="UPDATE configuracion SET mes = '$m', year = '$a'";
	echo mysqli_query($conexion,$sql);
	mysqli_close($conexion);

 ?>