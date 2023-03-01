<?php
include 'serverside.php';
$table_data->get('vista_hoja', 'hoja_id', array(
    'hoja_id',
    'hoja_nombre_solicitante',
    'hoja_ci_solicitante',
    'hoja_celular_solicitante',
    'hoja_fecha_ingreso',
    'hoja_patrocinio',
    'hoja_delito',
    'hoja_num_juzgado',
    'hoja_nurej',
    'hoja_etapa'
));
?>
