<?php
include 'serverside.php';
$table_data->get('vista_hoja_ait', 'hoja_id', array(
    'hoja_id',
    'hoja_numero_tramite',
    'ci_cliente',
    'celular_cliente',
    'hoja_demandante',
    'hoja_demandado',
    'hoja_patrocinio',
    'hoja_tipo_proceso',
    'hoja_id_proceso',
    'hoja_etapa',
    'hoja_observacion',
    'hoja_fecha_ingreso'
));
?>
