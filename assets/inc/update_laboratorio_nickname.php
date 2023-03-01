<?php
	//CONEXION A LA BdD
	include("conexion.php");
  $lab = $_POST['prod_laboratorio_cambiar'];
	$nic = $_POST['prod_nicklaboratorio_cambiar'];
	//OBTENEMOS DE CONFIGURACION, EL LABORATORIO QUE VAMOS ACTUALIZAR
	$sql="SELECT laboratorio FROM configuracion";
	$fila = mysqli_fetch_row(mysqli_query($conexion,$sql));
	$nickname = $fila[0];
	//echo $nickname;
	$sql="UPDATE producto SET prod_laboratorio = '$lab', prod_nicklaboratorio = '$nic' WHERE prod_nicklaboratorio = '$nickname'";
	echo mysqli_query($conexion,$sql);
	mysqli_close($conexion);
 ?>