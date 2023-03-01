<?php
	/*Datos de conexion a la base de datos*/
	include('conexion.php');

    $det_id=$_POST['det_id'];
    $sumar_stock=$_POST['sumar_stock'];
    $prod_id=$_POST['prod_id'];
	/*ACTUALIZAMOS EL STOCK, SUMAMOS AL STOCK ACTUAL LA CANTIDAD QUE SE ESTA ELIMINADO DE LA TABLA DETALLE DE FACTURA*/
	//PARA ELLO OBTENEMOS EL STOCK ACTUAL DE PRODUCTO MEDIANTE prod_id
	$sql1 = "SELECT prod_stock FROM producto WHERE prod_id = $prod_id";
	$resultado = mysqli_query($conexion,$sql1);
    $fila = mysqli_fetch_row($resultado);// $filas[0] ES EL STOCK ACTUAL PARA EL PRODUCTO CON ID $prod_id
    $stock = (int)$fila[0] + (int)$sumar_stock;//stock_actual + sumar_stock

	//OBTENEMOS LA CANTIDAD VENDIDA DE ESTE PRODUCTO DADO SU ID
	$sql2="SELECT prod_mas_vendido FROM producto WHERE prod_id = $prod_id";
	$resultado2 = mysqli_query($conexion,$sql2);
	$fila2 = mysqli_fetch_row($resultado2);
	$cantidad_vendida = (int)$fila2[0]-(int)$sumar_stock;

    //CONSULTA PARA ACTUALIZAR EL STOCK DEL PRODUCTO
	$consulta="UPDATE producto SET prod_stock = $stock WHERE prod_id = $prod_id";

	//ACTUALIZAMOS LA CANTIDAD VENDIDA, DADO EL ID DEL PRODUCTO
	$consulta1="UPDATE producto SET prod_mas_vendido = $cantidad_vendida WHERE prod_id = $prod_id";
;
	if (mysqli_query($conexion,$consulta) && mysqli_query($conexion,$consulta1)) {//SI SE EJECUTÓ LA ACTUALIZACION DEL STOCK, ELIMINO EL DETALLE DE LA TABLA DETALLE
		$sql="DELETE FROM detalle_factura WHERE det_id=$det_id";
		echo mysqli_query($conexion,$sql);
	}
 ?>