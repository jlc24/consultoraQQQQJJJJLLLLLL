<?php
include ('assets/inc/conexion.php');
if (isset($_POST['search']))
{
    $consulta = mysqli_query($conexion, "SELECT lab_nombre, lab_nick FROM laboratorio WHERE lab_nombre LIKE '%" . mysqli_real_escape_string($conexion, ($_POST['search'])) . "%' LIMIT 0, 10");
    $return_arr = array();
    while ($row = mysqli_fetch_array($consulta))
    {
        /* El array value, muestra solo informacion*/
        $row_array['value'] = $row['lab_nombre'] /*.', '.$row['lab_nick']*/;
        $row_array['laboratorio'] = $row['lab_nombre'];
        $row_array['nicklaboratorio'] = $row['lab_nick'];
        array_push($return_arr, $row_array);
    }
    echo json_encode($return_arr);
    mysqli_close($conexion);
}
?>
