<?php
    include("../assets/inc/conexion.php");

    session_start();
    if (!isset($_SESSION['adm_id'])) {
        header('Location: login.php');
    }
    $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE NOW() > det_fin AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
    $resultado = mysqli_query($conexion, $sql);
    $filas = mysqli_fetch_row($resultado);
    $total = (int)$filas[0];
    echo $total; 
?>
