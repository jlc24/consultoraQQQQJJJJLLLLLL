<?php
	/*Datos de conexion a la base de datos*/
	include('conexion.php');

	$prod_id = $_POST['prod_id_abastecer'];
	$nom = $_POST['prod_nombre_comercial_abastecer'];
	$pro = $_POST['prod_stock_abastecer'];
	$for = $_POST['prod_fecha_vencimiento_abastecer'];

	$ing = $_POST['cantidad_comprada_abastecer'];
	$lab = $_POST['precio_compra_abastecer'];
	$nic = $_POST['precio_unitario_abastecer'];
	$fec = date("Y-m-d H:i:s");
	
	$sql="INSERT INTO nota ( not_id, not_usuario, not_titulo, not_adelanto, not_saldo, not_comentario, not_fecha_hora )
			VALUES
				( NULL, '$usu', '$tit', '$ade', '$sal', '$com', '$fec' )";
	echo $result=mysqli_query($conexion,$sql);
	mysqli_close($conexion);
 ?>