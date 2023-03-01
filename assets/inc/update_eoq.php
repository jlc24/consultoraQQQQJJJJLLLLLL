<?php
	//CONEXION A LA BdD
	include('conexion.php');
    $cantidad = $_POST['cantidad'];
    //$fecha= date("Y-m-d");
	$sql="UPDATE configuracion SET eoq = '$cantidad'";
	echo mysqli_query($conexion,$sql);
	mysqli_close($conexion);
 ?>