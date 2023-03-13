<?php
	include ('conexion.php');

	$area = $_POST['qjl_area'];
	$adm = $_POST['qjl_adm_id'];
	$fec = date("Y-m-d H:i:s");

	$conarea = "SELECT * FROM proceso WHERE area_id = '".$area."';";
	$resultado = mysqli_query($conexion, $conarea);
	
	while ($proceso = mysqli_fetch_assoc($resultado)) {
		$proc = $proceso['proceso_id'];
		
		if (isset($_POST[$proc])) {
			if ($_POST[$proc] == 'on') {
				$est = 1;
				$asignar = "INSERT INTO asignacion (asig_id, adm_id, area_id, proceso_id, asig_estado, asig_fecha)
										VALUES		(NULL, '$adm', '$area', '$proc', '$est', '$fec')";
				echo mysqli_query($conexion,$asignar);
			}
		}else{
			$est = 0;
			$asignar = "INSERT INTO asignacion (asig_id, adm_id, area_id, proceso_id, asig_estado, asig_fecha)
									VALUES		(NULL, '$adm', '$area', '$proc', '$est', '$fec')";
			echo mysqli_query($conexion,$asignar);
		}
	}
	mysqli_close($conexion);

?>
