<?php
	/*CONEXION A LA BASE DE DATOS*/
	include('conexion.php');

	$prod_id = $_POST['prod_id_abastecer'];
	$nom = $_POST['prod_nombre_comercial_abastecer'];
	$lab = $_POST['prod_laboratorio_abastecer'];
	$can = $_POST['prod_stock_abastecer'];
	$cad = $_POST['prod_fecha_vencimiento_abastecer'];
	$tip = $_POST['prod_tipo_compra_abastecer'];
	$com = $_POST['cantidad_comprada_abastecer'];
	$pre = $_POST['precio_compra_abastecer'];
	$uni = $_POST['precio_unitario_abastecer'];//NUEVO PRECIO DE COMPRA, POR QUE PERTENECE AL ULTIMO PRECIO DE COMPRA DEL PRODUCTO
	$ven = $_POST['precio_venta_abastecer'];
	$det = $_POST['prod_detalle_abastecer'];
	$fec = date("Y-m-d H:i:s");

	/*ACTUALIZAMOS EL STOCK EN LA TABLA PRODUCTO*/
	/*SUMANOS EL STOCK ACTUAL MAS LA CANTIDAD COMPRADA*/
	$stock_actual = (int)$can + (int)$com;
	$consulta = "UPDATE producto SET prod_stock = '$stock_actual', prod_precio_compra = '$uni', prod_precio_venta = '$ven' WHERE prod_id = '$prod_id'";
	if(mysqli_query($conexion,$consulta)){//SI NUESTRO STOCK SE ACTUALIZA, ENTONCES INSERTAMOS LA COMPRA....
		$sql="INSERT INTO compra (comp_id,prod_id,comp_caducidad,comp_detalle,comp_cantidad,comp_subtotal,comp_precio_unitario,comp_fecha_registro,comp_vendedor,comp_tipo)
		 VALUES (NULL,'$prod_id','$cad','$det','$com','$pre','$uni','$fec','$lab','$tip')";
		echo $result=mysqli_query($conexion,$sql);
	}
	mysqli_close($conexion);
 ?>