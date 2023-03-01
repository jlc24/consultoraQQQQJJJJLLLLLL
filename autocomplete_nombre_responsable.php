<?php
	include('assets/inc/conexion.php');
	if (isset($_POST['search'])){
		$consulta = mysqli_query($conexion,"SELECT * FROM administrador WHERE
		adm_area LIKE '%".mysqli_real_escape_string($conexion,($_POST['search']))."%' 
		LIMIT 0,10");
		$return_arr = array();
		while ($row = mysqli_fetch_array($consulta)) {
				$row_array['value'] = $row['adm_area']." ─> ".$row['adm_nombre'];
				//$row_array['id'] = $row['adm_id'];
				$row_array['area'] = $row['adm_area'];
				$row_array['nombre'] = $row['adm_nombre'];
				array_push($return_arr,$row_array);
			}
		echo json_encode($return_arr);
		mysqli_close($conexion);
	}
?>