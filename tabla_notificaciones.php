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

    <table class="table table-sm table-striped table-responsive-sm" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #E67E22;">
        <tbody>
            <?php
                $sql = "SELECT `det_id`,`hoja_numero_tramite`, `hoja_tipo_proceso`, hoja_area_proceso,`det_etapa`,`det_accion`,`det_observacion`, det_leido 
                        FROM hoja_detalle JOIN hoja 
                        WHERE hoja_detalle.hoja_id = hoja.hoja_id AND det_estado = 'EJECUCION' AND det_fin >= NOW() AND det_audiencia = '0000-00-00 00:00:00' AND det_encargado = '".$_SESSION['adm_id']."' ORDER BY det_fin ASC;";
                $resultado = mysqli_query($conexion, $sql);
                while ($registro = mysqli_fetch_assoc($resultado))
                {
                ?>
                    <tr>
                        <td hidden><?php echo $registro["det_id"]; ?></td>
                        <td><?php echo $registro["hoja_numero_tramite"]; ?></td>
                        <td><?php echo $registro["hoja_tipo_proceso"]; ?></td>
                        <td><?php echo $registro["hoja_area_proceso"]; ?></td>
                        <td>
                            <?php echo $registro['det_observacion']; ?>
                        </td>
                        <td style="text-align: center;">
                        <?php 
                            if ($registro['det_leido'] == '0') { ?>
                                <a style="color:black;" href="javascript:void(0);" class='btnVerEventoHojaFinalizado btnUpdateLeido' title="Ver Accion">
                                    <i style="color: #E67E22; --darkreader-inline-color:#230443; font-size:20px;" class="fas fa-envelope"></i>
                                </a>
                            <?php
                            }else { ?>
                                <a style="color:black;" href="javascript:void(0);" class='btnVerEventoHojaFinalizado' title="Visto">
                                    <i style="color: #E67E22; --darkreader-inline-color:#230443; font-size:20px;" class="fas fa-envelope-open-text"></i>
                                </a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
        </tbody>
    </table>

