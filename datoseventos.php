<?php
header("Content-Type: application/json");
require('assets/inc/conexion.php');
switch($_GET['accion']){
    case 'listar':
        $sql = "SELECT id, titulo as title, descripcion, inicio as start, fin as end, colortexto as textColor, colorfondo as backgroundColor 
      FROM 
        eventos";
    $datos = mysqli_query($conexion, $sql);
    $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
    echo json_encode($resultado);
        break;
    case 'agregar':
        echo 'agregar';
        break;
    case 'modificar':
        echo 'modificar';
        break;
    case 'modificar':
        break;
    case 'borrar':
        echo 'borrar';
        break;
}
?>