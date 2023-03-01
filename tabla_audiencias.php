        <!--=================================================
        =            CONEXION A LA BASE DE DATOS            =
        ==================================================-->
        <?php include('assets/inc/conexion.php');
            session_start();
            if (!isset($_SESSION['adm_id'])) {
                header('Location: login.php');
            }
            $admid = $_SESSION['adm_id'];
        ?>

    <table class="table table-sm table-striped table-responsive-sm" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #32C861;">
        <tbody>
        <?php
            if ($admid != '1' && $admid != '9') {
                $sql = "SELECT `det_id`,`hoja_numero_tramite`, det_lugar_juzgado, det_juzgado, det_observacion, det_audiencia, hoja_area_proceso
                        FROM hoja_detalle JOIN hoja 
                        WHERE hoja_detalle.hoja_id = hoja.hoja_id AND det_audiencia >= NOW() AND det_estado = 'EJECUCION' AND det_audiencia != '0000-00-00 00:00:00';";
                $resultado = mysqli_query($conexion, $sql);
            }else{
                $sql = "SELECT `det_id`,`hoja_numero_tramite`, det_lugar_juzgado, det_juzgado, det_observacion, det_audiencia
                        FROM hoja_detalle JOIN hoja 
                        WHERE hoja_detalle.hoja_id = hoja.hoja_id AND det_audiencia >= NOW() AND det_estado = 'EJECUCION' AND det_audiencia != '0000-00-00 00:00:00';";
                $resultado = mysqli_query($conexion, $sql);
            }
            while ($registro = mysqli_fetch_assoc($resultado))
            {
        ?>
            <tr>
                <td hidden><?php echo $registro["det_id"]; ?></td>
                <td width="90px"><?php echo $registro["hoja_numero_tramite"]; ?></td>
                <td width="100px"><?php echo $registro["det_observacion"]; ?></td>
                <td width="100px" style="text-align: center;"><?php 
                    $datoau = $registro['det_audiencia'];
                    $day = date('d',strtotime($datoau."- 1 days"));
                    $month = date('m',strtotime($datoau));
                    $year = date('Y',strtotime($datoau));
                    $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                    echo $day.' de '.$meses[$month - 1].' de '.$year;
                ?>
                </td>
                <td width="50px"><?php
                    $datoau = $registro['det_audiencia'];
                    $hora = date('H:i:s',strtotime($datoau)); 
                    $hi = strtotime($hora);
                    echo $hora;
                    ?> 
                </td>
                <td width="50px" style="text-align: center;"><?php
                    echo $registro['det_lugar_juzgado']."<br>".$registro['det_juzgado'];
                    ?>
                </td>
                <td width="80px" style="text-align: center;">
                        <a style="color:black;" href="javascript:void(0);" class='btnVerEventoHojaFinalizado' title="Ver Accion">
                            <i style="color: #32C861; --darkreader-inline-color:#230443; font-size:20px;" class="fas fa-eye"></i>
                        </a>
                </td>
            </tr>
        <?php
            }
        ?>
        </tbody>
    </table>

