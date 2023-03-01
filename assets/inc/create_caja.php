<?php
include ('conexion.php');

$adm_id = $_POST['adm_id'];
$adm = $_POST['caja_administrador'];
$fec_ini = $_POST['caja_fecha_hora'];
$caj_ini = $_POST['caja_monto_inicial'];
$fec = date("Y-m-d H:i:s");

//OBTENEMOS EL ESTADO DE LA ULTIMA CAJA ABIERTA
$consulta = "SELECT caja_estado FROM caja WHERE caja_id = (SELECT MAX(caja_id) FROM caja)";
$result = mysqli_query($conexion,$consulta);
$fila = mysqli_fetch_row($result);
$estado = (int)$fila[0];

//SI EL ESTADO ES IGUAL A 0 PODEMOS ABRIR CAJA
if ($estado == 0) {
$sql = "INSERT INTO caja ( caja_id, adm_id, caja_administrador, caja_fecha_apertura, caja_monto_inicial, caja_fecha_cierre, caja_monto_final, caja_estado )
			VALUES
				( NULL, '$adm_id', '$adm', '$fec', '$caj_ini', NULL, NULL, 1)";
echo mysqli_query($conexion, $sql);
} else {
	echo (int)(0);
}
mysqli_close($conexion);
?>
