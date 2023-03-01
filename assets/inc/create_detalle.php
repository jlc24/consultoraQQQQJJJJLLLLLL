<?php
	/*Datos de conexion a la base de datos*/
	include('conexion.php');
	//OBTENEMOS EL ULTIMO NUMERO DE LAS FACTURAS EXISTENTES
	$sql="SELECT MAX(fac_id) FROM factura";
	$resultado = mysqli_query($conexion,$sql);
	$fila = mysqli_fetch_row($resultado);
	$fac = (int)$fila[0];
	$pro = $_POST['prod_id'];
	$nom = $_POST['prod_nombre'];
	$com = $_POST['prod_precio_compra'];
	$ven = $_POST['prod_precio_venta'];
	$sto = $_POST['prod_stock'];

	$can = $_POST['prod_cantidad'];
	$cod = $_POST['prod_codigo'];
	$tot = $_POST['prod_subtotal'];

	$uti = $_POST['prod_utilidad'];
	$act = (int)$sto - (int)$can;
	$fec= date("Y-m-d");

	//OBTENEMOS LA CANTIDAD VENDIDA DE ESTE PRODUCTO DADO SU ID
	$sql1="SELECT prod_mas_vendido FROM producto WHERE prod_id = $pro";
	$resultado1 = mysqli_query($conexion,$sql1);
	$fila1 = mysqli_fetch_row($resultado1);
	$num = (int)$fila1[0];
	$act1 = (int)$num + (int)$can;

	/*CONSULTA PARA REGISTRAR EL DETALLE DE LA FACTURA*/
	$sql="INSERT INTO detalle_factura ( det_id, fac_id, prod_id, det_producto, det_cantidad, det_precio_unitario, det_subtotal, det_utilidad, det_fecha, det_codigo )
			VALUES
				( NULL ,'$fac','$pro','$nom','$can','$ven', '$tot', '$uti', '$fec', '$cod')";
	/*SI PODEMOS REGISTRAR EL DETALLE ENTONCES ACTUALIZAMOS EL STOCK*/
	if(mysqli_query($conexion,$sql)){
		/*ACTUALIZAMOS EL STOCK, QUE RECOGEMOS DE LA VENTANA MODAL*/
		$consulta="UPDATE producto SET prod_stock = $act WHERE prod_id = $pro";
		/*ACTUALIZAMOS LA CANTIDAD VENDIDA, DADO EL ID DEL PRODUCTO*/
		$consulta1="UPDATE producto SET prod_mas_vendido = $act1 WHERE prod_id = $pro";
		if(mysqli_query($conexion,$consulta) && mysqli_query($conexion,$consulta1)){
			echo 1;
		}
	}
	mysqli_close($conexion);
 ?>