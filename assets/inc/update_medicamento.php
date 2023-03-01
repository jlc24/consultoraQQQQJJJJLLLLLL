<?php
/*Datos de conexion a la base de datos*/
include "conexion.php";

$prod_id = $_POST["prod_id_update"];
$nom = $_POST["prod_nombre_comercial_update"];
$pro = $_POST["prod_propaganda_update"];
$for = $_POST["prod_forma_update"];
$ing = $_POST["prod_ingrediente_update"];
$lab = $_POST["prod_laboratorio_update"];
$nic = $_POST["prod_nicklaboratorio_update"];
$rep = $_POST["prod_representante_update"];
$cod = $_POST["prod_codigo_update"];
$bar = $_POST["prod_barcode_update"];
$cad = $_POST["prod_fecha_vencimiento_update"];
$sto = $_POST["prod_stock_update"];
$ubi = $_POST["prod_ubicacion_update"];
$com = $_POST["prod_precio_compra_update"];
$ven = $_POST["prod_precio_venta_update"];

$sql = "UPDATE producto 
SET prod_nombre_comercial = '$nom',
prod_propaganda = '$pro',
prod_forma = '$for',
prod_principio_activo = '$ing',
prod_laboratorio = '$lab',
prod_nicklaboratorio = '$nic',
prod_empresa = '$rep',
prod_codigo = '$cod',
prod_fecha_vencimiento = '$cad',
prod_stock = '$sto',
prod_ubicacion = '$ubi',
prod_precio_compra = '$com',
prod_precio_venta = '$ven',
prod_barcode = '$bar' 
WHERE
	prod_id = '$prod_id'";
echo $result = mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>