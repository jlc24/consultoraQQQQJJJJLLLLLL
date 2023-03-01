<?php
	/*Datos de conexion a la base de datos*/
	include('conexion.php');
	$cli_id = $_POST['cli_id'];
	$fac_nit = $_POST['fac_ci_nit'];
	$fac_nom = $_POST['fac_nombre'];
	$fac_id = $_POST['fac_id'];
	$adm_id = $_POST['adm_id'];
	$fac_pago = $_POST['fac_forma_pago'];
	$fac_user = $_POST['fac_usuario'];
	$fac_tot = (float)$_POST['fac_total'];
	$fac_imp = (float)$_POST['fac_importe'];
	$fac_cam = (float)$_POST['fac_cambio'];
	$fecha =date("Y-m-d H:i:s");

	//CALCULAMOS LA UTILIDAD SUMANDO LAS UTILIDADES DE LA FACTURA N
    $sql="SELECT SUM(det_utilidad) FROM detalle_factura WHERE fac_id = '$fac_id'";
    $resultado = mysqli_query($conexion,$sql);
    $filas = mysqli_fetch_row($resultado);
    $fac_utilidad = (float)$filas[0];

	//ACTUALIZAMOS LOS DATOS DE LA FACTURA PARA FINALIZAR LA COMPRA
	//YA QUE AL CREARSE SOLO TIENE NUMERO DE FACTURA Y ESTADO DE LA
	//FACTUA EN CERO Y TOTAL DE LA FACTURA EN CERO
	if ($fac_pago == 'CONTADO') {
		$consulta = "UPDATE factura 
		SET cli_id = '$cli_id',
		fac_nombre_cliente = '$fac_nom',
		adm_id = '$adm_id',
		fac_nombre_usuario = '$fac_user',
		fac_total = $fac_tot,
		fac_utilidad = $fac_utilidad,
		fac_estado = 1,
		fac_fecha_hora = '$fecha',
		fac_forma_pago = '$fac_pago',
		fac_importe = $fac_imp,
		fac_cambio = $fac_cam
		WHERE
			fac_id = '$fac_id'";
		echo mysqli_query($conexion,$consulta);
	} else {
	    $consulta = "UPDATE factura 
				SET cli_id = '$cli_id',
				fac_nombre_cliente = '$fac_nom',
				adm_id = '$adm_id',
				fac_nombre_usuario = '$fac_user',
				fac_total = $fac_tot,
				fac_utilidad = $fac_utilidad,
				fac_estado = 2,
				fac_fecha_hora = '$fecha',
				fac_forma_pago = '$fac_pago',
				fac_importe = $fac_imp,
				fac_cambio = $fac_cam
				WHERE
					fac_id = '$fac_id'";
		echo mysqli_query($conexion,$consulta);
	}	
	mysqli_close($conexion);
 ?>