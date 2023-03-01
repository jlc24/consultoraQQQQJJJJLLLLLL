<?php
	/*Datos de conexion a la base de datos*/
	include('conexion.php');
	
	$cli_id = $_POST['cli_id'];
	$area_proc = $_POST['area_proceso'];
	$admid = $_POST['admin'];
	$tramite = $_POST['hoja_numero_tramite'];
	$cli = $_POST['hoja_nombre_solicitante'];
	$contra = $_POST['hoja_nom_contra'];
	if ($_POST['hoja_actor_cliente'] == 'DEMANDANTE' && ($area_proc == 'PENAL' || $area_proc == 'PENAL ADUANERO')) {
		$demandante = $cli;
		$demandado = $contra;
		$patr = 'VICTIMA';
	}elseif ($_POST['hoja_actor_cliente'] == 'DEMANDADO' && ($area_proc == 'PENAL' || $area_proc == 'PENAL ADUANERO')) {
		$demandante = $contra;
		$demandado = $cli;
		$patr = 'IMPUTADO';
	}elseif ($_POST['hoja_actor_cliente'] == 'DEMANDANTE' && ($area_proc == 'FAMILIA' || $area_proc == 'CIVIL')) {
		$demandante = $cli;
		$demandado = $contra;
		$patr = 'DEMANDANTE';
	}elseif ($_POST['hoja_actor_cliente'] == 'DEMANDADO' && ($area_proc == 'FAMILIA' || $area_proc == 'CIVIL')) {
		$demandante = $cli;
		$demandado = $contra;
		$patr = 'DEMANDADO';
	}elseif ($_POST['hoja_actor_cliente'] == 'RECURRENTE' && $area_proc == 'AIT') {
		$demandante = $cli;
		$demandado = $contra;
		$patr = 'RECURRENTE';
	}elseif ($_POST['hoja_actor_cliente'] == 'ADMINISTRADO' && $area_proc == 'ADUANA') {
		$demandante = $cli;
		$demandado = $contra;
		$patr = 'ADMINISTRADO';
	}elseif ($_POST['hoja_actor_cliente'] == 'DEMANDANTE' && $area_proc == 'ADMINISTRATIVO') {
		$demandante = $cli;
		$demandado = $contra;
		$patr = 'DENUNCIANTE';
	}elseif ($_POST['hoja_actor_cliente'] == 'DEMANDADO' && $area_proc == 'ADMINISTRATIVO') {
		$demandante = $cli;
		$demandado = $contra;
		$patr = 'DENUNCIADO';
	}
	//$patr = $_POST['hoja_actor_cliente'];
	$tipo_proc = $_POST['hoja_tipo_delito'];
	$juzgado = $_POST['hoja_num_juzgado'];
	$id_proc = $_POST['hoja_id_proc'];
	$fis_int = $_POST['hoja_fiscalia_interno'];
	$etapa = $_POST['hoja_etapa_proceso'];
	$resp_area = $_POST['hoja_responsable_area'];
	$ref = $_POST['hoja_referencia'];
	$area = $_POST['hoja_area_destino'];
	$obs = $_POST['hoja_observacion'];
	$fin = str_replace("T", " ", $_POST['hoja_fecha_ingreso']);
	
	//$fout = str_replace("T", " ", $_POST['hoja_fecha_salida']);

	$fec = date("Y-m-d H:i:s");
	//REGISTRAMOS UN PRODUCTO -> medicamento, y LUEGO LA PRIMERA COMPRA PARA EL HISTORIAL DE COMPRAS DEL PRODUCTO
	$sql="INSERT INTO hoja ( hoja_id, 
	                         cli_id, 
							 hoja_numero_tramite, 
							 hoja_demandante, 
							 hoja_demandado,
							 hoja_patrocinio, 
							 hoja_tipo_proceso, 
							 hoja_num_juzgado, 
							 hoja_num_sentencia, 
							 hoja_id_proceso, 
							 hoja_fiscalia_interno, 
							 hoja_etapa, 
							 hoja_responsable_area, 
							 hoja_referencia, 
							 hoja_area_destino, 
							 hoja_observacion, 
							 hoja_fecha_ingreso,
							 hoja_fecha_salida,
							 hoja_fecha_finalizacion,
							 hoja_area_proceso,
							 hoja_fecha_mod,
							 administrador_reg,
							 administrador_mod)
			VALUES
				           ( NULL,
						     '$cli_id',
							 '$tramite', 
							 '$demandante', 
							 '$demandado', 
							 '$patr', 
							 '$tipo_proc', 
							 '$juzgado', 
							 NULL, 
							 '$id_proc', 
							 '$fis_int', 
							 '$etapa', 
							 '$resp_area', 
							 '$ref', 
							 '$area',
							 '$obs',
							 '$fin', 
							 NULL, 
							 NULL,
							 '$area_proc',
							 '$fec',
							 '$admid',
							 '$admid')";
	echo mysqli_query($conexion,$sql);
	mysqli_close($conexion);
 ?>