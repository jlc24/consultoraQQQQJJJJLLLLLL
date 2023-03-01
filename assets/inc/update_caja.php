<?php
include ('conexion.php');

$caja_id = $_POST['caja_id'];
$fin = $_POST['caja_monto_final'];
$cam = $_POST['caja_cambio'];
$fec = date("Y-m-d H:i:s");

//OBTENEMOS EL ESTADO DE LA ULTIMA CAJA ABIERTA
$consulta = "SELECT caja_estado FROM caja WHERE caja_id = (SELECT MAX(caja_id) FROM caja)";
$result = mysqli_query($conexion,$consulta);
$fila = mysqli_fetch_row($result);
$estado = (int)$fila[0];

//SI EL ESTADO ES IGUAL A 1 PODEMOS CERRAR LA CAJA
if ($estado == 1) {
$sql = "UPDATE caja SET caja_fecha_cierre='$fec', caja_monto_final='$fin', caja_estado = 0, caja_cambio='$cam' WHERE caja_id='$caja_id'";
echo mysqli_query($conexion, $sql);
} else {
	echo (int)(0);
}
mysqli_close($conexion);
?>
