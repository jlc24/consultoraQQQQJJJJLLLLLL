<?php 
    include('assets/inc/conexion.php');
	//OBTENEMOS EL NUMERO DE FACTURA ACTUAL
    $consulta = "SELECT MAX(fac_id) FROM factura";
    $result = mysqli_query($conexion,$consulta);
    $fila = mysqli_fetch_row($result);
    $numerofactura = (int)$fila[0];

    //LAS FACTURAS SE CREAN AUTOMATICAMENTE, POR TANTO SIEMPRE SE MOSTRARÁ LA FACTURA ACTUAL
    //YA SEA SIN PRODUCTOS O CON MUCHOS PRODUCTOS.
	//TOTAL DE LA FACTURA ACTUAL, DADO EL NUMERO DE FACTURA.
    $sql="SELECT SUM(det_subtotal) FROM detalle_factura WHERE fac_id = $numerofactura";
    $resultado = mysqli_query($conexion,$sql);
    $filas = mysqli_fetch_row($resultado);
    $total = number_format($filas[0], 2);
    echo $total; 
?>