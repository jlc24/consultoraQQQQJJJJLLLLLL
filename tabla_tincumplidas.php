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

    <table class="table table-sm table-striped table-responsive-sm" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #F96A74;">
    <tbody>
        <?php

            $sql = "SELECT `det_id`,`hoja_numero_tramite`, `hoja_tipo_proceso`,`det_encargado`, det_leido, enc_reg
                    FROM hoja_detalle JOIN hoja 
                    WHERE hoja_detalle.hoja_id = hoja.hoja_id AND NOW() > det_fin AND det_estado = 'EJECUCION' AND det_encargado = '".$admid."';";
            $resultado = mysqli_query($conexion, $sql);
            while ($registro = mysqli_fetch_assoc($resultado))
            {
        ?>
            <tr>
                <td hidden><?php echo $registro["det_id"]; ?></td>
                <td><?php echo $registro["hoja_numero_tramite"]; ?></td>
                <td><?php echo $registro["hoja_tipo_proceso"]; ?></td>
                <td><?php 
                    $sql1 = "SELECT adm_nombre FROM administrador WHERE adm_id = '".$registro['det_encargado']."';";
                    $result1 = mysqli_query($conexion,$sql1);
                    $res1 = mysqli_fetch_assoc($result1);
                    echo $res1['adm_nombre']; ?>
                </td>
                <td style="text-align: center;">
                <?php 
                    $sql2 = "SELECT * FROM nota WHERE det_id = '".$registro['det_id']."';";
                    $result2 = mysqli_query($conexion,$sql2);
                    $res2 = mysqli_fetch_assoc($result2);
                    $hoy = date("Y-m-d H:i:s");
                    
                    if ($registro['enc_reg'] == $admid && $registro['det_leido'] == '0' && empty($res2['det_id'])) { ?>
                        <a style="color:black;" href="javascript:void(0);" class="btnMensaje" title="Enviar Mensaje">
                            <i style="color: #F96A74; --darkreader-inline-color:#230443; font-size:20px;" class="fas fa-envelope"></i>
                        </a>
                    <?php
                    }elseif ($registro['enc_reg'] == $admid && $registro['det_leido'] == '1' && empty($res2['det_id'])) { ?>
                        <a style="color:black;" href="javascript:void(0);" class="btnMensaje" title="Enviar Mensaje">
                            <i style="color: #F96A74; --darkreader-inline-color:#230443; font-size:20px;" class="fas fa-envelope-open-text"></i>
                        </a>
                    <?php
                    }elseif ($registro['enc_reg'] == $admid && !empty($res2['det_id']) && $res2['not_estado'] == 0) { ?>
                        <a style="color:black;" href="javascript:void(0);" class="btnVerMensaje" title="Mensaje no Visto">
                            <i style="color: #F96A74; --darkreader-inline-color:#230443; font-size:20px;" class="fas fa-check"></i>
                        </a>
                    <?php
                    }elseif ($registro['enc_reg'] == $admid && !empty($res2['det_id']) && $res2['not_estado'] == 1) { ?>
                        <a style="color:black;" href="javascript:void(0);" class="btnVerMensaje" title="Mensaje Visto">
                            <i style="color: #F96A74; --darkreader-inline-color:#230443; font-size:20px;" class="fas fa-check-double"></i>
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

