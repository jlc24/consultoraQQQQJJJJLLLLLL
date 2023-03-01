<?php
include 'serverside.php';
$table_data->get('vista_producto', 'prod_id', array(
    'prod_id',
    'prod_codigo',
    'prod_nombre_comercial',
    'prod_forma',
    //'prod_principio_activo',
    'prod_nicklaboratorio',
    'prod_fecha_vencimiento',
    'prod_stock',
    //'prod_ubicacion',
    'prod_fecha_actualizacion',
    'prod_precio_compra',
    'prod_inversion'
));
?>
