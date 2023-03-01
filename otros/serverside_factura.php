<?php
include 'serverside.php';
$table_data->get('vista_factura', 'fac_id', array(
    'fac_id',
    'fac_fecha_hora',
    'fac_nombre_cliente',
    'fac_nombre_usuario',
    'fac_total'
));
?>