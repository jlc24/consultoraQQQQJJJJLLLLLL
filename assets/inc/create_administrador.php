<?php
	include ('conexion.php');

	$nit = $_POST['adm_ci_nit'];
	$nom = $_POST['adm_nombre'];
	$dir = $_POST['adm_direccion'];
	$cel = $_POST['adm_celular'];
	$area = $_POST['adm_area'];
	$user = $_POST['usuario_user'];
	$pass = $_POST['usuario_pass'];
	$pass_sha1 = sha1($pass);
	$rol = 'admin';
	$fec = date("Y-m-d H:i:s");

	if (isset($_FILES['upload_foto']['name'])) {
		$sql = "INSERT INTO administrador ( adm_id, adm_ci_nit, adm_nombre, adm_direccion, adm_celular, adm_area, adm_fecha_registro, adm_usuario, adm_pass, adm_rol, adm_imagen )
						VALUES 		( NULL,'$nit', '$nom', '$dir', '$cel', '$area', '$fec', '$user', '$pass_sha1', '$rol', NULL );";
		if (mysqli_query($conexion, $sql)) {
			$sql1 = "SELECT * FROM administrador ORDER BY adm_fecha_registro DESC LIMIT 1;";
			$resultado = $conexion->query($sql1);
			$row = $resultado->fetch_assoc();

			$file = $_FILES['upload_foto']['name'];
        
			$directorio = "../images/users/".$row['adm_id']."_".$row['adm_usuario']."_".$row['adm_area'];
			
			$ruta_temp = $_FILES['upload_foto']['tmp_name'];
			
			$rutafile = $directorio."/".$file;
			$ruta = "assets".substr($directorio,2) ."/".$file;

			if (file_exists($directorio)) {
				//mkdir($directorio, 0755, true);
				if (move_uploaded_file($ruta_temp, $rutafile)) {
					$sql1 = "UPDATE administrador SET adm_imagen = '$ruta' WHERE adm_id = '".$row['adm_id']."';";
					echo mysqli_query($conexion,$sql1);
					
				} else {
					echo "Ha habido un error al cargar tu archivo.";
				}
			}else {
				mkdir($directorio, 0777, true);
				if (move_uploaded_file($ruta_temp, $rutafile)) {
					$sql1 = "UPDATE administrador SET adm_imagen = '$ruta' WHERE adm_id = '".$row['adm_id']."';";
					echo mysqli_query($conexion,$sql1);
					
				} else {
					echo "Ha habido un error al cargar tu archivo.";
				}
				//echo " no se pudo crear directorio </br>";
			}
		}
	}else{
		$sql = "INSERT INTO administrador ( adm_id, adm_ci_nit, adm_nombre, adm_direccion, adm_celular, adm_area, adm_fecha_registro, adm_usuario, adm_pass, adm_rol, adm_imagen )
						VALUES 		( NULL,'$nit', '$nom', '$dir', '$cel', '$area', '$fec', '$user', '$pass_sha1', '$rol', NULL )";
		echo mysqli_query($conexion,$sql);
	}

	mysqli_close($conexion);
?>
