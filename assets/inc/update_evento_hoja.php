<?php
include ('conexion.php');

$detalle_id = $_POST['det_id'];
$hoja_id = $_POST['hoja_id'];
$admid = $_POST['admin'];
$hoja_num = $_POST['hoja_numero_tramite'];
$hoja_nom = $_POST['nombre_update_cliente'];
$eta = $_POST['detalle_etapa'];
$accion = $_POST['detalle_accion'];
$ini = $_POST['detalle_inicio'];
if ($_POST['detalle_audiencia'] == '') {
	$aud = '0000-00-00 00:00';
}else {
	$aud = $_POST['detalle_audiencia'];
}
if ($_POST['detalle_fin'] == '') {
	$fin = $aud;
}else {
	$fin = $_POST['detalle_fin'];
}
//$aud = $_POST['detalle_audiencia'];
$est = $_POST['detalle_estado'];
$obs = $_POST['detalle_observacion'];
$enc = $_POST['responsable_area'];

$fec = date("Y-m-d H:i:s");

$sql = "UPDATE hoja_detalle SET    det_etapa = '$eta',
								   det_accion = '$accion', 
								   det_inicio = '$ini', 
								   det_fin = '$fin', 
								   det_estado = '$est', 
								   det_audiencia = '$aud',
								   det_observacion = '$obs',
								   det_encargado = '$enc',
								   fec_reg_evento = '$fec',
								   enc_reg = '$admid'
			WHERE det_id = '$detalle_id';";
if (mysqli_query($conexion, $sql) == 1) {
	$tex='#414d5f';
	$fon='#414d5f';
	$des = $hoja_nom.", ".$obs;
	$sql1 = "INSERT INTO eventos ( id,  titulo, descripcion, inicio, fin, colortexto, colorfondo )
				VALUES ( NULL,'$accion', '$des', '$aud', '$aud', '$tex', '$fon' )";
	echo mysqli_query($conexion, $sql1);
}

//echo mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>
