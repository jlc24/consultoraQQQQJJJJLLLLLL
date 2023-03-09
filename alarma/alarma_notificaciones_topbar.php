<?php
    include("../assets/inc/conexion.php");

    session_start();
    if (!isset($_SESSION['adm_id'])) {
        header('Location: login.php');
    }
    $sql = "SELECT COUNT(*) FROM hoja_detalle JOIN hoja WHERE hoja_detalle.hoja_id = hoja.hoja_id AND ((det_estado = 'EJECUCION' AND det_fin >= NOW() AND det_audiencia = '0000-00-00 00:00:00' AND det_encargado = '".$_SESSION['adm_id']."') OR (det_estado = 'FINALIZADO' AND det_audiencia = '0000-00-00 00:00:00' AND det_leido = '2' AND enc_reg = '".$_SESSION['adm_id']."') OR (det_estado = 'FINALIZADO' AND det_audiencia = '0000-00-00 00:00:00' AND det_leido = '3' AND enc_reg = '".$_SESSION['adm_id']."')) ORDER BY det_fin ASC;";
    $resultado = mysqli_query($conexion, $sql);
    $filas = mysqli_fetch_row($resultado);
    $total = (int)$filas[0];
    if ($total == '0') { ?>
        <div style="display: inline-block;"></div>
        <button class="btn btn-light btn-circle" type="button" data-toggle="dropdown" title="Notificaciones" style="width: 50px; height: 50px; padding: 7px 10px; margin-top: 10px; border-radius: 50%;">
            <i class="fas fa-bell" style="font-size: 30px; color: #DC5C05;"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right dropdown-lg">
            <div class="dropdown-header noti-title">
                <h5 class="text-overflow m-0"><span class="float-right">
                </span>Noficaciones</h5>
            </div>
            <div class="slimscroll noti-scroll text-center">
                <p>No tiene tareas pendientes</p>
            </div>
        </div>
    <?php
    }else{?>
        <div style="display: inline-block;"></div>
        <button class="btn btn-light btn-circle" type="button" data-toggle="dropdown" title="Notificaciones" style="width: 50px; height: 50px; padding: 7px 10px; margin-top: 10px; border-radius: 50%;">
            <i class="fas fa-bell" style="font-size: 30px; color: #DC5C05;"></i>
            <span class="badge badge-warning rounded-circle noti-icon-badge" ><?php echo $total; ?></span>
        </button>
        <div class="dropdown-menu dropdown-menu-right dropdown-lg">
            <div class="dropdown-header noti-title">
                <h5 class="text-wrap m-0" ><span class="float-right">
                </span>Notificaciones</h5>
            </div>
            <div class="slimscroll noti-scroll" style="overflow-y: scroll;">
                <?php
                    $sql1 = "SELECT `det_id`, `hoja_numero_tramite`, `hoja_tipo_proceso`, hoja_area_proceso, `det_etapa`, `det_accion`, det_audiencia, `det_observacion`, det_fin, det_leido, enc_reg, fec_reg_evento
                             FROM hoja_detalle JOIN hoja 
                             WHERE hoja_detalle.hoja_id = hoja.hoja_id AND ((det_estado = 'EJECUCION' AND det_fin >= NOW() AND det_audiencia = '0000-00-00 00:00:00' AND det_encargado = '".$_SESSION['adm_id']."') OR (det_estado = 'FINALIZADO' AND det_audiencia = '0000-00-00 00:00:00' AND det_leido = '2' AND enc_reg = '".$_SESSION['adm_id']."') OR (det_estado = 'FINALIZADO' AND det_audiencia = '0000-00-00 00:00:00' AND det_leido = '3' AND enc_reg = '".$_SESSION['adm_id']."'))
                             ORDER BY det_fin ASC;";
                    $res = mysqli_query($conexion, $sql1);
                    while ($registro = mysqli_fetch_assoc($res)) { ?>
                        <table>
                            <tbody>
                                <tr>
                                    <td hidden><?php echo $registro['det_id'] ?></td>
                                    <td>
                                        <?php
                                        if ($registro['det_leido'] == '0' || $registro['det_leido'] == '1') { ?>
                                            <a class="dropdown-item notify-item btnVerEventoHojaFinalizado btnUpdateLeido" href="javascript:void(0);">
                                                <div class="notify-icon bg-warning"><i class="mdi mdi-comment-account-outline"></i></div>
                                                <p class="notify-details"><?php 
                                                    $sql2 = "SELECT adm_nombre FROM administrador WHERE adm_id = '".$registro['enc_reg']."';";
                                                    $result2 = mysqli_query($conexion,$sql2);
                                                    $res2 = mysqli_fetch_assoc($result2);
                                                    echo $res2['adm_nombre'];
                                                ?>
                                                <small class="text-muted">Accion de Hoja de Ruta: <strong><?php 
                                                                echo $registro['hoja_numero_tramite'];
                                                                ?></strong> </small>
                                                <small class="text-muted">Responder antes de: <br> <?php 
                                                    $datoau = $registro['det_fin'];
                                                    $day = date('d',strtotime($datoau));
                                                    $month = date('m',strtotime($datoau));
                                                    $year = date('Y',strtotime($datoau));
                                                    $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                                                    $hora = date('H:i',strtotime($datoau)); 
                                                    echo $day.' de '.$meses[$month - 1].' de '.$year.' hasta '.$hora;
                                                ?></small></p>
                                            </a>
                                        <?php
                                        }elseif ($registro['det_leido'] == '2' || $registro['det_leido'] == '3') { ?>
                                            <a class="dropdown-item notify-item btnVerRespuesta btnRespLeido" href="javascript:void(0);">
                                                <div class="notify-icon bg-warning"><i class="mdi mdi-comment-account-outline"></i></div>
                                                <p class="notify-details"><?php 
                                                    $sql2 = "SELECT adm_nombre FROM administrador WHERE adm_id = '".$registro['enc_reg']."';";
                                                    $result2 = mysqli_query($conexion,$sql2);
                                                    $res2 = mysqli_fetch_assoc($result2);
                                                    echo $res2['adm_nombre'];
                                                ?>
                                                <small class="text-muted">Respuesta de Accion <br> de Hoja de Ruta: 
                                                    <strong><?php echo $registro['hoja_numero_tramite']; ?></strong> 
                                                </small></p>
                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <?php
                    }
                    ?>
            </div>
        </div>
        
    <?php
    }
    ?>
