<?php
	/*Datos de conexion a la base de datos*/
	include('conexion.php');

	if (isset($_POST['adm_id'])) {

		$adm_id = $_POST['adm_id'];
		$sql="UPDATE configuracion SET adm_id = '$adm_id'";
		echo mysqli_query($conexion,$sql);
		//mysqli_close($conexion);

	}
	if (isset($_POST['area_id'])) {

		$area_id = $_POST['area_id'];
		$sql="UPDATE configuracion SET area_id = '$area_id'";
		echo mysqli_query($conexion,$sql);
		//mysqli_close($conexion);

	}
	if (isset($_POST['proceso_id'])) {

		$proceso_id = $_POST['proceso_id'];
		$sql="UPDATE configuracion SET proceso_id = '$proceso_id'";
		echo mysqli_query($conexion,$sql);
		//mysqli_close($conexion);

	}
	if (isset($_POST['cli_id'])) {

		$cli_id = $_POST['cli_id'];
		$sql="UPDATE configuracion SET cli_id = '$cli_id'";
		echo mysqli_query($conexion,$sql);
		//mysqli_close($conexion);

	}
	if (isset($_POST['hoja_id'])) {

		$hoja_id = $_POST['hoja_id'];
		$sql="UPDATE configuracion SET hoja_id = '$hoja_id'";
		echo mysqli_query($conexion,$sql);
		//mysqli_close($conexion);

	}
	if (isset($_POST['nota_id'])) {

		$nota_id = $_POST['nota_id'];
		$sql="UPDATE configuracion SET nota_id = '$nota_id'";
		echo mysqli_query($conexion,$sql);
		//mysqli_close($conexion);

	}
	if (isset($_POST['det_id'])) {

		$det_id = $_POST['det_id'];
		$sql="UPDATE configuracion SET det_id = '$det_id'";
		echo mysqli_query($conexion,$sql);
	}
	mysqli_close($conexion);
 ?>