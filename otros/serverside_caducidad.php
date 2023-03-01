<?php
include 'serverside.php';
$table_data->get('vista_caducidad', 'prod_id', array(
    'prod_nombre_comercial',
    'prod_forma',
    'prod_nicklaboratorio',
    'prod_fecha_vencimiento',
    'days',
    'stock'
));
?>