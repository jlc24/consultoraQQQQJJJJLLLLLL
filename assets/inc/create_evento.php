<?php
include ('conexion.php');

$tit = $_POST['eventoNombre'];
$ini = $_POST['inicioEvento'];
$fin = $_POST['finEvento'];
$des = $_POST['descripcionEvento'];
$area = $_POST['areaEvento'];
if($area == 'JURIDICA'){
	$tex='#414d5f';
	$fon='#414d5f';
}elseif($area == 'CONTABLE'){
	$tex='#F06292';
	$fon='#F06292';
}elseif($area == 'MARKETING'){
	$tex='#5553ce';
	$fon='#5553ce';
}else{
	$tex='#ffa91c';
	$fon='#ffa91c';
}

$fec = date("Y-m-d H:i:s");

$sql = "INSERT INTO eventos ( id,  titulo, descripcion, inicio, fin, colortexto, colorfondo )
			VALUES ( NULL,'$tit', '$des', '$ini', '$fin', '$tex', '$fon' )";
echo mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>
