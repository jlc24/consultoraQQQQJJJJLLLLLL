<?php
	/*Datos de conexion a la base de datos*/
	include('conexion.php');

	$fec = date("Y-m-d H:i:s");
	//por defecto el estado de la nota es activo, vigente, o visible que lo representamos con el número 1
	if (!empty($_POST['det_id'])) {
		$admin = $_POST['adm_id'];
		$destino = $_POST['enc_id'];
		$asunto = $_POST['asunto'];
		$mensaje = $_POST['desc_mensaje'];
		$detid = $_POST['det_id'];
		$sql="INSERT INTO nota ( not_id, adm_id, not_destino, not_asunto, det_id, not_mensaje, not_fecha_reg, not_estado, not_fecha_visto )
						VALUES ( NULL, '$admin', '$destino', '$asunto', '$detid', '$mensaje', '$fec', 0, NULL )";
		echo $result=mysqli_query($conexion,$sql);
		mysqli_close($conexion);
	}else{
		$admin = $_POST['adm_id_blanco'];
		$destino = $_POST['enc_id_blanco'];
		$asunto = $_POST['asunto_blanco'];
		$mensaje = $_POST['desc_mensaje_blanco'];
		$sql="INSERT INTO nota ( not_id, adm_id, not_destino, not_asunto, det_id, not_mensaje, not_fecha_reg, not_estado, not_fecha_visto )
						VALUES ( NULL, '$admin', '$destino', '$asunto', NULL, '$mensaje', '$fec', 0, NULL )";
		echo $result=mysqli_query($conexion,$sql);
		mysqli_close($conexion);
	}
 ?>