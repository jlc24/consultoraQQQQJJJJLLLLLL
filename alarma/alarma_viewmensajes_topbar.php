<?php
    include("../assets/inc/conexion.php");

    session_start();
    if (!isset($_SESSION['adm_id'])) {
        header('Location: login.php');
    }
    $sql = "SELECT COUNT(*) FROM nota WHERE not_estado = 1 AND  not_destino = '".$_SESSION['adm_id']."';";
    $resultado = mysqli_query($conexion, $sql);
    $filas = mysqli_fetch_row($resultado);
    $total = (int)$filas[0];
    if ($total == '0') { ?>
        <div style="display: inline-block;"></div>
        <button class="btn btn-light btn-circle" type="button" data-toggle="dropdown" title="Mensajes Leidos" style="width: 50px; height: 50px; padding: 7px 10px; margin-top: 10px; border-radius: 50%;">
            <i class="noti-icon fas fa-envelope-open-text" style="font-size: 30px; color: #DC5C05;"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right dropdown-lg">
            <div class="dropdown-header noti-title">
                <h5 class="text-overflow m-0"><span class="float-right"></span>Mensajes leidos</h5>
            </div>
            <div class="slimscroll noti-scroll text-center">
                <p>No tiene mensajes leidos</p>
            </div>
        </div>
    <?php
    }else{?>
        <div style="display: inline-block;"></div>
        <button class="btn btn-light btn-circle" type="button" data-toggle="dropdown" title="Mensajes Leidos" style="width: 50px; height: 50px; padding: 7px 10px; margin-top: 10px; border-radius: 50%;">
            <i class="noti-icon fas fa-envelope-open-text" style="font-size: 30px; color: #DC5C05;"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right dropdown-lg">
            <div class="dropdown-header noti-title">
                <h5 class="text-overflow m-0"><span class="float-right"></span>Mensajes leidos</h5>
            </div>
            <div class="slimscroll noti-scroll" style="overflow-y: scroll;">
                <?php
                $sql1 = "SELECT * FROM nota WHERE not_estado = 1 AND  not_destino = '".$_SESSION['adm_id']."' ORDER BY not_fecha_visto DESC;";
                $res = mysqli_query($conexion, $sql1);
                while ($registro = mysqli_fetch_assoc($res)) { ?>
                    <table>
                        <tbody>
                            <tr>
                                <td hidden><?php echo $registro['not_id'] ?></td>
                                <td>
                                    <a class="dropdown-item notify-item btnVerMensaje" href="javascript:void(0);" >
                                        <div class="notify-icon bg-success"><i class="mdi mdi-comment-account-outline"></i></div>
                                        <p class="notify-details"><?php 
                                            $sql2 = "SELECT adm_nombre FROM administrador WHERE adm_id = '".$registro['adm_id']."';";
                                            $result2 = mysqli_query($conexion,$sql2);
                                            $res2 = mysqli_fetch_assoc($result2);
                                            echo $res2['adm_nombre'];
                                        ?>
                                        <small class="text-muted">Asunto: <strong><?php 
                                            echo $registro['not_asunto'];
                                            ?></strong></small>
                                        <small class="text-muted">Mensaje leido: <br> <?php 
                                            $datoau = $registro['not_fecha_visto'];
                                            $day = date('d',strtotime($datoau));
                                            $month = date('m',strtotime($datoau));
                                            $year = date('Y',strtotime($datoau));
                                            $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                                            $hora = date('H:i',strtotime($datoau)); 
                                            echo $day.' de '.$meses[$month - 1].' de '.$year.' a las '.$hora;
                                            ?></small></p>
                                    </a>
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
