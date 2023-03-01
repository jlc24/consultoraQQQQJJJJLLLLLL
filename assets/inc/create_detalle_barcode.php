<?php
	include('conexion.php');
	$barcode = $_POST['prod_barcode'];
	//VERIFICAMOS SI EL CóDIGO DE BARRAS EXISTE EN NUESTRA BdD
	$sql="SELECT EXISTS ( SELECT * FROM producto WHERE prod_barcode LIKE '%$barcode%')";
	if (mysqli_query($conexion,$sql)) {
		$sql="SELECT * FROM producto WHERE prod_barcode LIKE '%$barcode%'";
		$resultado = mysqli_query($conexion,$sql);
		$fila = mysqli_fetch_assoc($resultado);
	
		$pro = $fila['prod_id'];
		$nom = $fila['prod_nombre_comercial'];
		$com = $fila['prod_precio_compra'];
		$ven = $fila['prod_precio_venta'];
		$sto = $fila['prod_stock'];
		$can = 1;
		$cod = $fila['prod_codigo'];
		$tot = $fila['prod_precio_venta'];
		$uti = (float)$ven - (float)$com;
		//CANTIDAD ACTUAL = STOCK_ACTUAL - CANTIDAD_VENDIDAD
		//EN ESTE CASO LA CANTIDAD VENDIDA SIEMPRE SERA 1
		$act = (int)$sto - (int)$can;
		$fec= date("Y-m-d");
	
		//OBTENEMOS EL ULTIMO NUMERO DE LAS FACTURAS EXISTENTES
		$sql="SELECT MAX(fac_id) FROM factura";
		$resultado = mysqli_query($conexion,$sql);
		$fila = mysqli_fetch_row($resultado);
		$fac = $fila[0];
	
		//OBTENEMOS LA CANTIDAD VENDIDA DE ESTE PRODUCTO DADO SU ID, PARA SUMARLE 1
		//YA QUE AL ESCANEAR CON EL BARCODE ASUMINOS QUE SOLO COMPRANOS UNA UNIDAD
		$sql1="SELECT prod_mas_vendido FROM producto WHERE prod_id = $pro";
		$resultado1 = mysqli_query($conexion,$sql1);
		$fila1 = mysqli_fetch_row($resultado1);
		$num = (int)$fila1[0];
		$act1 = (int)$num + (int)$can;
	
		/*CONSULTA PARA REGISTRAR EL DETALLE DE LA FACTURA*/
		$sql="INSERT INTO detalle_factura ( det_id, fac_id, prod_id, det_producto, det_cantidad, det_precio_unitario, det_subtotal, det_utilidad, det_fecha, det_codigo )
				VALUES
					( NULL, '$fac', '$pro', '$nom', $can, '$ven', '$tot', '$uti', '$fec', '$cod')";
		/*SI PODEMOS REGISTRAR EL DETALLE ENTONCES ACTUALIZAMOS EL STOCK*/
		if(mysqli_query($conexion,$sql)){
			/*ACTUALIZAMOS EL STOCK, QUE EN ESTE CASO SIEMPRE SERA 1 */
			$consulta="UPDATE producto SET prod_stock = $act WHERE prod_id = $pro";
			/*ACTUALIZAMOS LA CANTIDAD VENDIDA, DADO EL ID DEL PRODUCTO*/
			$consulta1="UPDATE producto SET prod_mas_vendido = $act1 WHERE prod_id = $pro";
			//if(mysqli_query($conexion,$consulta) && mysqli_query($conexion,$consulta1)){
			//	echo 1;
			//}
			mysqli_query($conexion,$consulta);
			mysqli_query($conexion,$consulta1);
			echo 1;
		}
	} else {
		echo 0;
	}
	mysqli_close($conexion);
 ?>