<?php
    include ('conexion.php');

    $detid = $_POST['detalle_id'];
    $admid = $_POST['admin_eve'];
    $idfile = $_POST['identificador'];
    $fec = date('Y-m-d H:m:s');
    
    $obsest = isset($_POST['det_respuesta']) ? $_POST['det_respuesta'] : 0;
    
    
    $estado = $_POST['det_estado_update'];

    

    $archivo = isset($_FILES["newFile"]["name"]) ? $_FILES["newFile"]["name"] : 0;
    
     
    if (isset($_FILES["newFile"]["name"])) {
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
                    hoja.hoja_id = hoja_detalle.hoja_id AND hoja_detalle.det_id =$detid";
        $resultado = $conexion->query($sql);
        $row = $resultado->fetch_assoc();

        $file = $_FILES['newFile']['name']; 
        
        $directorio = "../document/QJL/".$row['hoja_area_destino']."/".$row['hoja_area_proceso']."/".$row['hoja_numero_tramite']."/".$row['det_id'];
        
        $ruta_temp = $_FILES['newFile']['tmp_name']; 
        
        $rutafile = $directorio."/res_".$file;
        $ruta = "assets".substr($directorio,2) ."/res_".$file;
        
        if (file_exists($directorio)) {
            //mkdir($directorio, 0755, true);
            if (move_uploaded_file($ruta_temp, $rutafile)) {
                $sql1 = "UPDATE hoja_detalle SET det_recepcion_ruta_file = '$ruta',
                                                    det_respuesta_encargado = '$obsest',
                                                    det_estado = '$estado',
                                                    fec_reg_evento = '$fec' 
                                            WHERE det_id = '$detid';";
                echo mysqli_query($conexion,$sql1);
                mysqli_close($conexion);
            } else {
                echo "Ha habido un error al cargar tu archivo.";
            }
        }else {
            mkdir($directorio, 0777, true);
            if (move_uploaded_file($ruta_temp, $rutafile)) {
                $sql1 = "UPDATE hoja_detalle SET det_recepcion_ruta_file = '$ruta',
                                                    det_respuesta_encargado = '$obsest',
                                                    det_estado = '$estado',
                                                    fec_reg_evento = '$fec' 
                                            WHERE det_id = '$detid';";
                echo mysqli_query($conexion,$sql1);
                mysqli_close($conexion);
            } else {
                echo "Ha habido un error al cargar tu archivo.";
            }
            //echo " no se pudo crear directorio </br>";
        }
    
        
    }else {
        $sql1 = "UPDATE hoja_detalle SET det_respuesta_encargado = '$obsest',
                                        det_estado = '$estado',
                                        fec_reg_evento = '$fec' WHERE det_id = '$detid';";
        echo mysqli_query($conexion,$sql1);
        mysqli_close($conexion);
    }
?>
