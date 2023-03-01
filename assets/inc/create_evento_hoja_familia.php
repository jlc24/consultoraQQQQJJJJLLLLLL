<?php
include ('conexion.php');

$hoja_id = $_POST['hoja_id'];
$hoja_num = $_POST['hoja_numero_tramite'];
$hoja_nom = $_POST['hoja_nombre_solicitante'];
$eta = $_POST['detalle_etapa'];
$acc = $_POST['detalle_accion'];
$ini = $_POST['detalle_inicio'];
$fin = $_POST['detalle_fin'];
$aud = $_POST['detalle_audiencia'];
$est = 'EJECUCION';
$obs = $_POST['detalle_observacion'];
$enc = $_POST['detalle_encargado'];
$fec = date("Y-m-d H:i:s");

$sql = "INSERT INTO hoja_detalle ( det_id, hoja_id, det_etapa, det_accion, det_inicio, det_fin, det_estado, det_audiencia, det_observacion, det_encargado)
			VALUES
				( NULL, '$hoja_id','$eta','$acc','$ini','$fin','$est','$aud','$obs','$enc')";
echo mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>
