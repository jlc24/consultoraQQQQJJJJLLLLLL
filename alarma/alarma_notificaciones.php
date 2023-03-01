<?php
    include("../assets/inc/conexion.php");

    session_start();
    if (!isset($_SESSION['adm_id'])) {
        header('Location: login.php');
    }
    $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND det_fin >= NOW() AND det_audiencia = '0000-00-00 00:00:00' AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
    $resultado = mysqli_query($conexion, $sql);
    $filas = mysqli_fetch_row($resultado);
    $total = (int)$filas[0];
    if ($total == '0') { ?>
        <span class="m-0 font-weight-medium text-truncate" style="font-size: 15px;">Notificaciones </span>
    <?php
    }else{?>
        <span class="m-0 font-weight-medium text-truncate" style="font-size: 15px;">Notificaciones </span>
        <span class="badge badge-warning" data-plugin="counterup" style="font-size: 15px;" id="alarma_notificaciones">
            <?php echo $total;  ?>
        </span>
    <?php
    }
    ?>
