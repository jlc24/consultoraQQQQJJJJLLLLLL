<?php
	/*Datos de conexion a la base de datos*/
	include('conexion.php');

	$evento_id=$_POST['id'];

	/*$sql1="SELECT
                    det_envio_ruta_fiel,
					det_recepcion_ruta_file
                FROM
                    hoja_detalle
                WHERE
                    det_id ='$detid';";
	$resultado = $conexion->query($sql1);
	$row = $resultado->fetch_assoc();

	if ($row['det_envio_ruta_file'] != '' || $row['det_recepcion_ruta_file'] != '') {
		$ruta = $row['det_envio_ruta_file'];
		rmdir($ruta);
		$ruta2 = $row['det_recepcion_ruta_file'];
		rmdir($ruta2);
	}*/

	$sql="DELETE FROM hoja_detalle WHERE det_id='$evento_id'";
	echo $result=mysqli_query($conexion,$sql);
	mysqli_close($conexion);
 ?>