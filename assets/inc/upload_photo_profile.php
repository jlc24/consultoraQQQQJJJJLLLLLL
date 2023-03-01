<?php
    include ('conexion.php');
    
    $admid = $_POST['adminid'];
    $fec = date('Y-m-d H:m:s');
     
    if (isset($_FILES["uploadFile"]["name"])) {
        $sql="SELECT * FROM administrador WHERE adm_id =$admid";
        $resultado = $conexion->query($sql);
        $row = $resultado->fetch_assoc();

        $file = $_FILES['uploadFile']['name'];
        
        $directorio = "../images/users/".$row['adm_id']."_".$row['adm_usuario']."_".$row['adm_area'];
        
        $ruta_temp = $_FILES['uploadFile']['tmp_name'];
        
        $rutafile = $directorio."/".$file;
        $ruta = "assets".substr($directorio,2) ."/".$file;
        
        if (file_exists($directorio)) {
            //mkdir($directorio, 0755, true);
            if (move_uploaded_file($ruta_temp, $rutafile)) {
                $sql1 = "UPDATE administrador SET adm_imagen = '$ruta' WHERE adm_id = '$admid';";
                echo mysqli_query($conexion,$sql1);
                
            } else {
                echo "Ha habido un error al cargar tu archivo.";
            }
        }else {
            mkdir($directorio, 0777, true);
            if (move_uploaded_file($ruta_temp, $rutafile)) {
                $sql1 = "UPDATE administrador SET adm_imagen = '$ruta' WHERE adm_id = '$admid';";
                echo mysqli_query($conexion,$sql1);
                
            } else {
                echo "Ha habido un error al cargar tu archivo.";
            }
            //echo " no se pudo crear directorio </br>";
        }
    }
    mysqli_close($conexion);
?>
