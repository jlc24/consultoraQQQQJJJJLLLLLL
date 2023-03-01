<?php
include ('conexion.php');
	
	$hoja_id = $_POST['hoja_id'];
	$admid = $_POST['admin'];
	$hoja_num = $_POST['hoja_numero_tramite'];
	$hoja_nom = $_POST['nombre_update_cliente'];
	$eta = $_POST['detalle_etapa'];
	$accion = $_POST['detalle_accion'];
	$ini = $_POST['detalle_inicio'];
	$fec = date("Y-m-d H:i:s");
	$est = $_POST['detalle_estado'];
	$obs = $_POST['detalle_observacion'];
	$enc = $_POST['responsable_area'];
 
	$aud = isset($_POST['detalle_audiencia']) ? $_POST['detalle_audiencia'] : 0;
	$juzgado = isset($_POST['detalle_juzgado']) ? $_POST['detalle_juzgado'] : 0;
	$lugarjuz = isset($_POST['lugar_juzgado']) ? $_POST['lugar_juzgado'] : 0;
	$fin = isset($_POST['detalle_fecha_fin']) ? $_POST['detalle_fecha_fin'] : 0;
	
	if (isset($_FILES["uploadFile"]["name"])) {
		$sql1 = "INSERT INTO hoja_detalle ( det_id, hoja_id, det_etapa, det_accion, det_inicio, det_fin, det_estado, det_audiencia,
											det_juzgado, det_lugar_juzgado, det_observacion, det_encargado, det_leido, det_respuesta_encargado,
											det_mensaje, fec_reg_evento, enc_reg, det_envio_ruta_file, det_recepcion_ruta_file)
						VALUES	( NULL, '$hoja_id', '$eta', '$accion', '$ini', '$fin', '$est', '0000-00-00T00:00:00', NULL, NULL,
								'$obs', '$enc', 0, NULL, NULL, '$fec', '$admid', NULL, NULL);";
		if (mysqli_query($conexion, $sql1) == 1) {
			$sql="SELECT
						det_id,
						hoja.`hoja_id`,
						`cli_id`,
						`hoja_numero_tramite`,
						`hoja_demandante`,
						`hoja_demandado`,
						`hoja_area_proceso`,
						`hoja_patrocinio`,
						`fec_reg_evento`,
						`enc_reg`,
						`hoja_area_destino`
					FROM
						hoja,
						hoja_detalle
					WHERE
						hoja.hoja_id = hoja_detalle.hoja_id AND hoja_detalle.det_id = (SELECT MAX(det_id)FROM `hoja_detalle` WHERE `enc_reg` = '$admid')";
			$resultado = $conexion->query($sql);
			$row = $resultado->fetch_assoc();
	
			$file = $_FILES['uploadFile']['name']; 
			
			$directorio = "../document/QJL/".$row['hoja_area_destino']."/".$row['hoja_area_proceso']."/".$row['hoja_numero_tramite']."/".$row['det_id'];
			
			$ruta_temp = $_FILES['uploadFile']['tmp_name']; 
			
			$rutafile = $directorio."/envio_".$file;
			$ruta = "assets".substr($directorio,2) ."/envio_".$file;
			
			if (!file_exists($directorio)) {
				mkdir($directorio, 0777, true);
				if (move_uploaded_file($ruta_temp, $rutafile)) {
					$sql1 = "UPDATE hoja_detalle SET 	det_envio_ruta_file = '$ruta'
												WHERE det_id = '".$row['det_id']."';";
					echo mysqli_query($conexion,$sql1);
					if (mysqli_query($conexion,$sql1) == 1) {
						$tex='#414d5f';
						$fon='#414d5f';
						$des = $hoja_nom.", ".$obs;
						$sql2 = "INSERT INTO eventos ( id,  titulo, descripcion, inicio, fin, colortexto, colorfondo )
									VALUES ( NULL,'$accion', '$des', '$ini', '$fin', '$tex', '$fon' )";
						echo mysqli_query($conexion, $sql2);
					}
				} else {
					echo "Ha habido un error al cargar tu archivo.";
				}
			}else {
				echo " no se pudo crear directorio </br>";
			}
		}
	}elseif($_POST['detalle_accion'] != 'AUDIENCIA')  {
		$sql1 = "INSERT INTO hoja_detalle ( det_id, hoja_id, det_etapa, det_accion, det_inicio, det_fin, det_estado, det_audiencia,
											det_juzgado, det_lugar_juzgado, det_observacion, det_encargado, det_leido, det_respuesta_encargado,
											det_mensaje, fec_reg_evento, enc_reg, det_envio_ruta_file, det_recepcion_ruta_file)
						VALUES	( NULL, '$hoja_id', '$eta', '$accion', '$ini', '$fin', '$est', '0000-00-00T00:00:00', NULL, NULL,
								'$obs', '$enc', 0, NULL, NULL, '$fec', '$admid', NULL, NULL);";
		if (mysqli_query($conexion, $sql1) == 1) {
			$tex='#414d5f';
			$fon='#414d5f';
			$des = $hoja_nom.", ".$obs;
			$sql2 = "INSERT INTO eventos ( id,  titulo, descripcion, inicio, fin, colortexto, colorfondo )
						VALUES ( NULL,'$accion', '$des', '$ini', '$fin', '$tex', '$fon' )";
			echo mysqli_query($conexion, $sql2);
		}
	}elseif($_POST['detalle_accion'] == "AUDIENCIA"){
		$finaud = date('Y-m-d H:i:s', strtotime($_POST['detalle_audiencia']."+ 1 days"));
		$sql1 = "INSERT INTO hoja_detalle ( det_id, hoja_id, det_etapa, det_accion, det_inicio, det_fin, det_estado, det_audiencia,
											det_juzgado, det_lugar_juzgado, det_observacion, det_encargado, det_leido, det_respuesta_encargado,
											det_mensaje, fec_reg_evento, enc_reg, det_envio_ruta_file, det_recepcion_ruta_file)
						VALUES	( NULL, '$hoja_id', '$eta', '$accion', '$ini', '$finaud', '$est', '$finaud', '$juzgado', '$lugarjuz',
								'$obs', '$enc', 0, NULL, NULL, '$fec', '$admid', NULL, NULL);";
		if (mysqli_query($conexion, $sql1) == 1) {
			$tex='#414d5f';
			$fon='#414d5f';
			$des = $hoja_nom.", ".$obs;
			$sql2 = "INSERT INTO eventos ( id,  titulo, descripcion, inicio, fin, colortexto, colorfondo )
						VALUES ( NULL,'$accion', '$des', '$aud', '$aud', '$tex', '$fon' )";
			echo mysqli_query($conexion, $sql2);
		}
	}else {
		echo "no se guardo nada";
	}
	
	mysqli_close($conexion);
?>
