<?php
	/* Conexion a la BdD */
	include('assets/inc/conexion.php');
	if (isset($_POST['search'])){
		$consulta = mysqli_query($conexion,"SELECT * FROM cliente WHERE cli_nombre like '%".mysqli_real_escape_string($conexion,($_POST['search']))."%' LIMIT 0 ,10"); 
		/*if(array() != null)
		{
			$return_arr['data'] = array();
		}else{
			$return_arr['data'][] = null;
		}*/
		$return_arr = array();
		/*$data['data'][ ] = null;*/
		while ($row = mysqli_fetch_array($consulta)) {
				/* El array value, muestra solo informacion*/
				/*$row_array['value'] = $row['cli_nombre'].', CI/NIT: '.$row['cli_ci_nit'];*/
				$row_array['value'] = $row['cli_nombre'];
				$row_array['id'] = $row['cli_id'];
				$row_array['nombre'] = $row['cli_nombre'];
				$row_array['ci'] = $row['cli_ci_nit'];
				$row_array['celular'] = $row['cli_celular'];
				array_push($return_arr,$row_array);
			}
		/* Codifica el resultado del array en JSON. */
		echo json_encode($return_arr);
		/* Cierra la conexión. */
		mysqli_close($conexion);
	}
?>