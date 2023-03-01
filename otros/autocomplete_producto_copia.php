<?php
if (isset($_GET['term'])){
	# conectare la base de datos
    $con=@mysqli_connect("localhost", "root", "usbw", "papeleria");
	
$return_arr = array();
/* Si la conexión a la base de datos , ejecuta instrucción SQL. */
if ($con)
{
	$fetch = mysqli_query($con,"SELECT * FROM producto where prod_nombre like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,10"); 
	
	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	while ($row = mysqli_fetch_array($fetch)) {
		/* El array value, muestra solo informacion*/
		$row_array['value'] = $row['prod_nombre']." , Bs. ".$row['prod_precio_venta']." , Stock: ".$row['prod_stock'];
		$row_array['id']=$row['prod_id'];
		$row_array['nombre']=$row['prod_nombre'];
		$row_array['stock']=$row['prod_stock'];
		$row_array['precio_compra']=$row['prod_precio_compra'];
		$row_array['precio_venta']=$row['prod_precio_venta'];
		array_push($return_arr,$row_array);
    }
}

/* Cierra la conexión. */
mysqli_close($con);

/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);

}
?>