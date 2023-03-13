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
				$asignar = "UPDATE asignacion SET asig_estado = '$est', asig_fecha = '$fec'
										WHERE	adm_id = '$adm' AND proceso_id = '$proc';";
				echo mysqli_query($conexion,$asignar);
			}
		}else{
			$est = 0;
			$asignar = "UPDATE asignacion SET asig_estado = '$est', asig_fecha = '$fec'
									WHERE	adm_id = '$adm' AND proceso_id = '$proc';";
			echo mysqli_query($conexion,$asignar);
		}
	}
	mysqli_close($conexion);

?>
