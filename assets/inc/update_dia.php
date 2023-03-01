<?php
	//CONEXION A LA BdD
	include('conexion.php');
    $fecha = $_POST['date'];
    //$fecha= date("Y-m-d");
	$sql="UPDATE configuracion SET dia = '$fecha'";
	echo mysqli_query($conexion,$sql);
	mysqli_close($conexion);
 ?>