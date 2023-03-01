<?php
include 'serverside.php';
$table_data->get('vista_hoja', 'hoja_id', array(
    'hoja_id',
    'id_cliente',
    'ci_cliente',
    'celular_cliente',
    'hoja_demandante',
    'hoja_demandado',
    'hoja_patrocinio',
    'hoja_tipo_proceso',
    'hoja_num_sentencia',
    'hoja_num_juzgado',
    'hoja_id_proceso',
    'hoja_fiscalia_interno',
    'hoja_etapa',
    'hoja_observacion',
    'hoja_fecha_ingreso'
));
?>
