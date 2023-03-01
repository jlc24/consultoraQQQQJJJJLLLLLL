<?php
include ('conexion.php');

$not_id = $_POST['not_id'];
$tit = strtoupper($_POST['nota_titulo_update']);
$com = strtoupper($_POST['nota_comentario_update']);
$est = strtoupper($_POST['nota_estado_update']);

$sql = "UPDATE nota SET not_titulo='$tit', not_comentario='$com', not_estado=$est	WHERE not_id='$not_id'";
echo mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>