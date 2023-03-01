<?php
include ('conexion.php');

$prod_id = $_POST['prod_id_update'];
$cad = $_POST['prod_caducidad_update'];
$bar = $_POST['prod_barcode_update'];
$sto = $_POST['prod_stock_update'];
$inv = $_POST['prod_inversion_update'];

$fec = date("Y-m-d H:i:s");
$sql = "UPDATE producto SET prod_fecha_vencimiento='$cad', prod_stock='$sto', prod_fecha_actualizacion='$fec', prod_inversion='$inv', prod_barcode='$bar'
	WHERE prod_id='$prod_id'";
echo mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>
