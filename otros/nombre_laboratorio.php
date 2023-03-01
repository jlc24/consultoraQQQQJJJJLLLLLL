<?php
$conexion = @mysqli_connect('localhost', 'root', 'usbw', 'botica');
//OBTENEMOS NOMBRE DE LABORATORIO, DE LA TABLA CONFIGURACION
$consulta = "SELECT laboratorio FROM configuracion";
$resultado = mysqli_query($conexion, $consulta);
$fila = mysqli_fetch_row($resultado);
echo $fila[0];
//ysqli_close($conexion);
?>