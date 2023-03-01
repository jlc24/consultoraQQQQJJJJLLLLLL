<?php
	if (isset($_GET['term'])){
	# conectare la base de datos
    include('assets/inc/conexion.php');	
	$return_arr = array();
	/* Si la conexión a la base de datos , ejecuta instrucción SQL. */
	if ($conexion){
		$fetch = mysqli_query($conexion,"SELECT prod_id,prod_codigo, prod_nicklaboratorio FROM producto WHERE prod_codigo like '%" . mysqli_real_escape_string($conexion,($_GET['term'])) . "%' ORDER BY prod_id DESC LIMIT 10"); 
		
		/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
		while ($row = mysqli_fetch_array($fetch)){
			/* El array value, muestra solo informacion*/
			$row_array['value'] = $row['prod_codigo'].", ".$row['prod_nicklaboratorio'];
			$row_array['codigo']=$row['prod_codigo'];
			array_push($return_arr,$row_array);
	    }
	}

	/* Codifica el resultado del array en JSON. */
	echo json_encode($return_arr);
	}

	/* Cierra la conexión. */
	mysqli_close($conexion);
?>