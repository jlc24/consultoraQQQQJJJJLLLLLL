<?php
    include ('conexion.php');

    $detid = $_POST['detalle_id'];
    $admid = $_POST['admin_eve'];
    $leido = $_POST['det_leido'];
    $fec = date('Y-m-d H:m:s');
    
    $fecfin = isset($_POST['det_fecha_fin']) ? $_POST['det_fecha_fin'] : 0;
    $obsest = isset($_POST['det_respuesta']) ? $_POST['det_respuesta'] : 0;
    
    $estado = $_POST['det_estado_update'];
    
    if (isset($_FILES["newFile"]["name"])) {
        if ($fecfin == 0) {
            $sql="SELECT det_id, `hoja_numero_tramite`, `hoja_area_proceso`, `hoja_area_destino`
                    FROM hoja, hoja_detalle
                    WHERE hoja.hoja_id = hoja_detalle.hoja_id AND hoja_detalle.det_id = $detid";
            $resultado = $conexion->query($sql);
            $row = $resultado->fetch_assoc();
    
            $file = $_FILES['newFile']['name']; 
            
            $directorio = "../document/QJL/".$row['hoja_area_destino']."/".$row['hoja_area_proceso']."/".$row['hoja_numero_tramite']."/".$row['det_id'];
    
            $numran1 = rand(0,1000);
            $numran2 = rand(0,1000);
            
            $ruta_temp = $_FILES['newFile']['tmp_name']; 
            
            $rutafile = $directorio."/res_".$numran1."_".$numran2."_".$file;
            $ruta = "assets".substr($directorio,2) ."/res_".$numran1."_".$numran2."_".$file;
            
            if (file_exists($directorio)) {
                //mkdir($directorio, 0755, true);
                if (move_uploaded_file($ruta_temp, $rutafile)) {
                    $sql1 = "UPDATE hoja_detalle SET det_recepcion_ruta_file = '$ruta',
                                                        det_respuesta_encargado = '$obsest',
                                                        det_estado = '$estado',
                                                        fec_reg_evento = '$fec',
                                                        det_leido = '$leido' 
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
                                                        fec_reg_evento = '$fec',
                                                        det_leido = '$leido' 
                                                WHERE det_id = '$detid';";
                    echo mysqli_query($conexion,$sql1);
                    mysqli_close($conexion);
                } else {
                    echo "Ha habido un error al cargar tu archivo.";
                }
                //echo " no se pudo crear directorio </br>";
            }
        }elseif ($fecfin != 0) {
            $sql="SELECT det_id, `hoja_numero_tramite`, `hoja_area_proceso`,`hoja_area_destino`
                    FROM hoja, hoja_detalle
                    WHERE hoja.hoja_id = hoja_detalle.hoja_id AND hoja_detalle.det_id = $detid";
            $resultado = $conexion->query($sql);
            $row = $resultado->fetch_assoc();
    
            $file = $_FILES['newFile']['name']; 
            
            $directorio = "../document/QJL/".$row['hoja_area_destino']."/".$row['hoja_area_proceso']."/".$row['hoja_numero_tramite']."/".$row['det_id'];
    
            $numran1 = rand(0,1000);
            $numran2 = rand(0,1000);
            
            $ruta_temp = $_FILES['newFile']['tmp_name']; 
            
            $rutafile = $directorio."/envio_".$numran1."_".$numran2."_".$file;
            $ruta = "assets".substr($directorio,2) ."/envio_".$numran1."_".$numran2."_".$file;
            
            if (file_exists($directorio)) {
                //mkdir($directorio, 0755, true);
                if (move_uploaded_file($ruta_temp, $rutafile)) {
                    $sql1 = "UPDATE hoja_detalle SET    det_envio_ruta_file = '$ruta',
                                                        det_mensaje = '$obsest',
                                                        det_fin = '$fecfin',
                                                        det_estado = '$estado',
                                                        fec_reg_evento = '$fec',
                                                        det_leido = '$leido' 
                                                WHERE det_id = '$detid';";
                    echo mysqli_query($conexion,$sql1);
                    mysqli_close($conexion);
                } else {
                    echo "Ha habido un error al cargar tu archivo.";
                }
            }else {
                mkdir($directorio, 0777, true);
                if (move_uploaded_file($ruta_temp, $rutafile)) {
                    $sql1 = "UPDATE hoja_detalle SET det_envio_ruta_file = '$ruta',
                                                     det_mensaje = '$obsest',
                                                     det_fin = '$fecfin',
                                                     det_estado = '$estado',
                                                     fec_reg_evento = '$fec',
                                                     det_leido = '$leido' 
                                                WHERE det_id = '$detid';";
                    echo mysqli_query($conexion,$sql1);
                    mysqli_close($conexion);
                } else {
                    echo "Ha habido un error al cargar tu archivo.";
                }
                //echo " no se pudo crear directorio </br>";
            }
        }
    }elseif ($fecfin == 0) {
        $sql1 = "UPDATE hoja_detalle SET det_respuesta_encargado = '$obsest',
                                         det_estado = '$estado',
                                         fec_reg_evento = '$fec', 
                                         det_leido = '$leido'
                                    WHERE det_id = '$detid';";
        echo mysqli_query($conexion,$sql1);
        mysqli_close($conexion);
    }elseif ($fecfin != 0) {
        $sql1 = "UPDATE hoja_detalle SET det_mensaje = '$obsest',
                                         det_fin = '$fecfin',
                                         det_estado = '$estado',
                                         fec_reg_evento = '$fec', 
                                         det_leido = '$leido'
                                    WHERE det_id = '$detid';";
        echo mysqli_query($conexion,$sql1);
        mysqli_close($conexion);
    }
?>
