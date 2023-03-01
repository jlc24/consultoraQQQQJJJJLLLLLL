<?php
	include ('conexion.php');

	$id = $_POST['hoja_id_update'];
	$adm_mod = $_POST['admin'];
	$area_proc = $_POST['area_proceso'];
	$tramite = $_POST['tramite_update'];
	$cli = $_POST['nombre_update_cliente'];
	$contra = $_POST['nombre_update_contra'];
	if ($_POST['patrocinio_update_cliente'] == 'VICTIMA' && ($area_proc == 'PENAL' || $area_proc == 'PENAL ADUANERO')) {
		$demandante = $cli;
		$demandado = $contra;
		//$patr = 'VICTIMA';
	}elseif ($_POST['patrocinio_update_cliente'] == 'IMPUTADO' && ($area_proc == 'PENAL' || $area_proc == 'PENAL ADUANERO')) {
		$demandante = $contra;
		$demandado = $cli;
		//$patr = 'IMPUTADO';
	}elseif ($_POST['patrocinio_update_cliente'] == 'DEMANDANTE' && ($area_proc == 'FAMILIA' || $area_proc == 'CIVIL')) {
		$demandante = $cli;
		$demandado = $contra;
		//$patr = 'DEMANDANTE';
	}elseif ($_POST['patrocinio_update_cliente'] == 'DEMANDADO' && ($area_proc == 'FAMILIA' || $area_proc == 'CIVIL')) {
		$demandante = $contra;
		$demandado = $cli;
		//$patr = 'DEMANDADO';
	}elseif ($_POST['patrocinio_update_cliente'] == 'RECURRENTE' && $area_proc == 'AIT') {
		$demandante = $cli;
		$demandado = $contra;
	}elseif ($_POST['patrocinio_update_cliente'] == 'ADMINISTRADO' && $area_proc == 'ADUANA') {
		$demandante = $cli;
		$demandado = $contra;
	}elseif ($_POST['hoja_actor_cliente'] == 'DEMANDANTE' && $area_proc == 'ADMINISTRATIVO') {
		$demandante = $cli;
		$demandado = $contra;
		$patr = 'DENUNCIANTE';
	}elseif ($_POST['hoja_actor_cliente'] == 'DEMANDADO' && $area_proc == 'ADMINISTRATIVO') {
		$demandante = $cli;
		$demandado = $contra;
		$patr = 'DENUNCIADO';
	}
	
	$patr = $_POST['patrocinio_update_cliente'];
	$tipo_proc = $_POST['tipo_proceso_update'];
	$juzgado = $_POST['num_juzgado_update'];
	$sentencia = $_POST['num_sentencia_update'];
	$id_proc = $_POST['id_proceso_update'];
	$fis_int = $_POST['fis_int_update'];
	$etapa = $_POST['etapa_proceso_update'];
	//$resp_area = $_POST['hoja_responsable_area'];
	$ref = $_POST['referencia_update'];
	//$area = $_POST['hoja_area_destino'];
	$obs = $_POST['obs_update'];
	$fec_mod = date("Y-m-d H:i:s");

$sql = "UPDATE hoja 
        SET hoja_demandante = '$demandante', 
			hoja_demandado = '$demandado',
			hoja_tipo_proceso = '$tipo_proc', 
			hoja_num_juzgado = '$juzgado', 
			hoja_num_sentencia = '$sentencia', 
			hoja_id_proceso = '$id_proc', 
			hoja_fiscalia_interno = '$fis_int', 
			hoja_etapa = '$etapa', 
			hoja_referencia = '$ref', 
			hoja_observacion = '$obs', 
			hoja_fecha_mod = '$fec_mod',
			administrador_mod = '$adm_mod'
		WHERE hoja_id = '$id';";
echo mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>
