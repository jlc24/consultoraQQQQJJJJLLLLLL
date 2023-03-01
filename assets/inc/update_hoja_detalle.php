<?php
include ('conexion.php');

$det_id = $_POST['det_id_update'];
$estado = ($_POST['det_estado_update']);
$respuesta = ($_POST['det_respuesta_encargado']);
$fec_fin = date("Y-m-d H:i:s");

$sql = "UPDATE hoja_detalle SET det_estado = '$estado', det_respuesta_encargado = '$respuesta', fec_reg_evento = '$fec_fin' WHERE det_id = '$det_id';";
echo mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>