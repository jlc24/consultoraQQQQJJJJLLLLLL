<?php
include ('conexion.php');

$id = $_POST['fac_id_update'];
$fac_pago = $_POST['fac_forma_pago'];
$fac_imp = (float)$_POST['fac_importe'];
$fac_cam = (float)$_POST['fac_cambio'];
//ACTUALIZAMOS EL ESTADO, FORMA DE PAGI, IMPORTE Y CAMBIO DE LA FACTURA SELECIONADA
$sql = "UPDATE factura SET fac_estado=1, fac_forma_pago='$fac_pago', fac_importe='$fac_imp', fac_cambio='$fac_cam' 
wHERE fac_id='$id'";
echo mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>
