<?php
	/*Datos de conexion a la base de datos*/
	include('conexion.php');
	$cli_id = $_POST['cli_id'];
	$sol = $_POST['hoja_nombre_solicitante'];
	$ci = $_POST['hoja_ci_solicitante'];
	$cel = $_POST['hoja_celular_solicitante'];

	$num = $_POST['hoja_numero_tramite'];
	$fin = $_POST['hoja_fecha_ingreso'];
	$fout = $_POST['hoja_fecha_salida'];

	$area = $_POST['hoja_area_destino'];
	$resp_area = $_POST['hoja_responsable_area'];
	$obs = $_POST['hoja_observacion'];

	$fec = date("Y-m-d H:i:s");
	//REGISTRAMOS UN PRODUCTO -> medicamento, y LUEGO LA PRIMERA COMPRA PARA EL HISTORIAL DE COMPRAS DEL PRODUCTO
	$sql="INSERT INTO hoja ( hoja_id, cli_id, hoja_nombre_solicitante, hoja_ci_solicitante, hoja_celular_solicitante,hoja_numero_tramite, hoja_fecha_ingreso, hoja_fecha_salida, hoja_area_destino, hoja_responsable_area, hoja_observacion)
			VALUES
				( NULL,'$cli_id','$sol', '$ci', '$cel', '$num', '$fin', '$fout', '$area','$resp_area', '$obs')";

	//SI EL PRODUCTO SE REGISTRA CON EXITO, AHORA REGISTRAMOS LA PRIMERA COMPRA
	/*if(mysqli_query($conexion,$sql))
	{
        //OBTENEMOS EL ID DEL ULTIMO PRODUCTO REGISTRADO, QUE LLEGARIA A SER LA CONSULTA QUE EJECUTAMOS ARRIBA
        $consulta = "SELECT MAX( prod_id ) AS prod_id FROM producto";
		$result = mysqli_query($conexion,$consulta);
		$fila = mysqli_fetch_row($result);
		$prod_id = (int)$fila[0];

		$consulta="INSERT INTO compra ( comp_id, prod_id, comp_caducidad, comp_detalle, comp_cantidad, comp_subtotal, comp_precio_unitario, comp_fecha_registro, comp_vendedor, comp_tipo)
			VALUES
				( NULL, '$prod_id', '$cad', '$det', '$sto', '$com', '$uni', '$fec', '$rep', '$tip' )";
		echo mysqli_query($conexion,$consulta);
	}*/
	echo mysqli_query($conexion,$sql);
	mysqli_close($conexion);
 ?>