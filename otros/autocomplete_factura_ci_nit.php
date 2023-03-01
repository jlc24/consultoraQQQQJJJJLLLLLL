<?php
if (isset($_GET['term']))
{
    # conectare la base de datos
    include ('assets/inc/conexion.php');

    $return_arr = array();
    /* Si la conexión a la base de datos , ejecuta instrucción SQL. */
    if ($conexion)
    {
        $fetch = mysqli_query($conexion, "SELECT * FROM cliente where cli_ci_nit like '%" . mysqli_real_escape_string($conexion, ($_GET['term'])) . "%' LIMIT 0 ,10");

        /* Recuperar y almacenar en conjunto los resultados de la consulta.*/
        while ($row = mysqli_fetch_array($fetch))
        {
            /* El array value, muestra solo informacion*/
            $row_array['value'] = $row['cli_ci_nit'] . ", " . $row['cli_nombre'];
            $row_array['id'] = $row['cli_id'];
            $row_array['ci_nit'] = $row['cli_ci_nit'];
            $row_array['nombre'] = $row['cli_nombre'];
            $row_array['billetera'] = $row['cli_saldo_billetera'];
            array_push($return_arr, $row_array);
        }
    }

    /* Codifica el resultado del array en JSON. */
    echo json_encode($return_arr);

}

/* Cierra la conexión. */
mysqli_close($conexion);
?>
