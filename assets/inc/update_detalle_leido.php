<?php
	/*Datos de conexion a la base de datos*/
	include('conexion.php');

	if (isset($_POST['det_id'])) {

		$det_id = $_POST['det_id'];
		$sql="UPDATE hoja_detalle SET det_leido = 1 WHERE det_id = '$det_id'";
		echo $result=mysqli_query($conexion,$sql);
		mysqli_close($conexion);

	}elseif (isset($_POST['not_id'])) {

		$not_id = $_POST['not_id'];
		$date = date('Y-m-d H:i:s');
		$sql="UPDATE nota SET not_estado = 1, not_fecha_visto = '$date' WHERE not_id = '$not_id'";
		echo $result=mysqli_query($conexion,$sql);
		mysqli_close($conexion);

	}elseif (isset($_POST['resp_id'])) {

		$det_id = $_POST['resp_id'];
		$sql="UPDATE hoja_detalle SET det_leido = 3 WHERE det_id = '$det_id'";
		echo $result=mysqli_query($conexion,$sql);
		mysqli_close($conexion);

	}elseif (isset($_POST['resp_fin'])) {
		
		$det_id = $_POST['resp_fin'];
		$sql="UPDATE hoja_detalle SET det_leido = 4 WHERE det_id = '$det_id'";
		echo $result=mysqli_query($conexion,$sql);
		mysqli_close($conexion);
	}
 ?>