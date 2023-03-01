<?php 
$fecha_actual= date("Y-m-d");
echo "Fecha Actual: ".$fecha_actual;
$fecha_vencimiento = date_create("2020-12-13");
$fecha_final = date_format($fecha_vencimiento,'Y-m-d');
echo "<br>Fecha Caducidad: ".$fecha_final;
$diferencia = (strtotime($fecha_final) - strtotime($fecha_actual)) / 60 / 60 / 24;
echo "<br>Diferencia en Dias: ".$diferencia."<br><br>";
$numero = (int)$diferencia;
//echo "<br>".$numero."<br>";


if($diferencia>181){//si al producto tiene mas de 180 dias de vigencias no se colorea
    $fecha = date_create("2020-12-13"); echo date_format($fecha, 'd/m/Y');
}
elseif($diferencia>90){//si al producto tiene mas de 90 dias de vigencias no se colorea verde
    $fecha = date_format($fecha_vencimiento,'d-m-Y');
    echo "<span class='badge badge-success'>$fecha</span>";
}
elseif($diferencia>-1){//si al producto tiene mas de 0 dias de vigencias no se colorea amarillo
    $fecha = date_format($fecha_vencimiento,'d-m-Y');
    echo "<font color=\"red\">$fecha</font>";
}
else{//si al producto ya vencio se colorea rojo
    $fecha = date_format($fecha_vencimiento,'d-m-Y');
    echo "<span class='badge badge-danger'>$fecha</span>"; 
}


 ?>