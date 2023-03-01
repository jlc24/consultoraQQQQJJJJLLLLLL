<?php
	/*Datos de conexion a la base de datos*/
	include('conexion.php');

	$prod_id = $_POST['prod_id'];

	$sql="UPDATE configuracion SET prod_id = '$prod_id'";
	echo $result=mysqli_query($conexion,$sql);
	mysqli_close($conexion);
 ?>