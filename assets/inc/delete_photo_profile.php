<?php
    include ('conexion.php');
    
    $admid = $_POST['adminid'];
    
    $sql1 = "UPDATE administrador SET adm_imagen = NULL WHERE adm_id = '$admid';";
    echo mysqli_query($conexion,$sql1);
    mysqli_close($conexion);
?>
