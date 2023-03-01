<?php
	include('conexion.php');
	$barcode = $_POST['prod_barcode'];
	//VERIFICAMOS SI EL CODIGO DE BARRAS EXISTE EN NUESTRA BdD
	//$sql="SELECT EXISTS ( SELECT * FROM producto WHERE prod_barcode LIKE '%$barcode%')";
	//if(mysqli_query($conexion,$sql)){
		$sql = "UPDATE configuracion SET prod_barcode = '$barcode'";
		echo mysqli_query($conexion,$sql);
	//}
	mysqli_close($conexion);
 ?>