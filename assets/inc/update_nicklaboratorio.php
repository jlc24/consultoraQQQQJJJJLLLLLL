<?php
	//CONEXION A LA BdD
	include("conexion.php");
  $lab = $_POST['prod_nicklaboratorio'];
	$sql="UPDATE configuracion SET laboratorio = '$lab'";
	echo mysqli_query($conexion,$sql);
	mysqli_close($conexion);
 ?>