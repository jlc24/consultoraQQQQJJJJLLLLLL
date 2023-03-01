<?php
include ('assets/inc/conexion.php');
if (isset($_POST['search']))
{
    $consulta = mysqli_query($conexion, "SELECT * FROM producto WHERE prod_nombre_comercial 
        LIKE '%" . mysqli_real_escape_string($conexion, ($_POST['search'])) . "%' 
        OR prod_propaganda like '%" . mysqli_real_escape_string($conexion, ($_POST['search'])) . "%' 
        OR prod_principio_activo like '%" . mysqli_real_escape_string($conexion, ($_POST['search'])) . "%' 
        OR prod_codigo like '%" . mysqli_real_escape_string($conexion, ($_POST['search'])) . "%' 
        ORDER BY prod_fecha_vencimiento ASC LIMIT 0 ,11");
    $return_arr = array();
    while ($row = mysqli_fetch_array($consulta))
    {
        /* El array value, muestra solo informacion*/
        $row_array['value'] = $row['prod_codigo'] ." | ".$row['prod_nombre_comercial'] . " Bs. " . $row['prod_precio_venta'];
        $row_array['id'] = $row['prod_id'];
        $row_array['nombre'] = $row['prod_nombre_comercial'];
        $row_array['laboratorio'] = $row['prod_nicklaboratorio'];
        $row_array['precio_compra'] = $row['prod_precio_compra'];
        $row_array['precio_venta'] = $row['prod_precio_venta'];
        $row_array['stock'] = $row['prod_stock'];
        $row_array['codigo'] = $row['prod_codigo'];
        $row_array['forma'] = $row['prod_forma'];
        $row_array['vencimiento'] = strftime("%d %b %Y", (new DateTime($row['prod_fecha_vencimiento']))->getTimestamp());
        $row_array['propaganda'] = $row['prod_propaganda'];
        $row_array['ingrediente'] = $row['prod_principio_activo'];
        array_push($return_arr, $row_array);
    }
    mysqli_close($conexion);
    echo json_encode($return_arr);
}
?>
