        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=factura-->
        <script type="text/javascript">
            $(document).ready(function (){
                var table = $('#ventaDia').dataTable({
                    "lengthMenu":[5,10,15,20],
                    "order": [[ 0,"desc" ]],//ORDERNAR DESCENDENTEMENTE POR EL NUMERO DE FACTURA
                    "language": {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                });
            });
        </script>
        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=factura-->
        <div class="table-responsive">
            <table id="ventaDia" class="table table-background table-background-dark table-hover table-condensed responsive" width="100%">
                <thead>
                <th data-priority="1">Fact.</th>
                    <th data-priority="5">Fecha</th>
                    <th data-priority="2">Cliente</th>
                    <th data-priority="4">Vendedor</th>
                    <th data-priority="3">Total</th>
                    <th data-priority="7">Importe</th>
                    <th data-priority="8">Cambio</th>
                    <th data-priority="6">Utilidad</th>
                </thead>
                <tbody>
                <?php
                    //CONEXION A LA BdD
                    include('assets/inc/conexion.php');
                    //OBTENEMOS FECHA DEL DIA, DE LA TABLA CONFIGURACION
                    $consulta = "SELECT dia FROM configuracion";
                    $resultado = mysqli_query($conexion,$consulta);
                    $fila = mysqli_fetch_row($resultado);
                    $fecha = $fila[0];
                    //echo $fecha;
                    //$fecha=date("Y-m-d");

                    $sql="SELECT fac_id, fac_fecha_hora, fac_nombre_cliente, fac_nombre_usuario, fac_total, fac_utilidad, fac_importe, fac_cambio FROM factura WHERE fac_estado = 1 AND DATE(fac_fecha_hora) = '$fecha'";
                    $resultado=mysqli_query($conexion,$sql);
                    while($registro = mysqli_fetch_row($resultado)){
                        $datos=$registro[0]."||".$registro[1]."||".$registro[2]."||".$registro[3]."||".$registro[4]."||".$registro[5]."||".$registro[6]."||".$registro[7];

                 ?>

                    <tr>
                        <td><?php echo $registro[0]; ?></td>
                        <td><?php $fecha = date_create($registro[1]); echo date_format($fecha, 'd/m/Y H:i:s'); ?></td>
                        <td><?php echo $registro[2]; ?></td>
                        <td><?php echo $registro[3]; ?></td>
                        <td><?php echo $registro[4]; ?></td>
                        <td><?php echo $registro[6]; ?></td>
                        <td><?php echo $registro[7]; ?></td>
                        <td><?php echo "Bs. "."</span>".$registro[5]; ?></td>
                    </tr>

                <?php
                                                            }

                ?>
                    <tfoot>
                        <tr>
                            <td colspan="4" align="right" style="text-align:right;font-size:14px !Important" rowspan="1">&nbsp; <b>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Total, Ventas Del Día :</font>
                                </font></b>
                            </td>
                            <td style="text-align: left; background-color:;" rowspan="1" colspan="1">
                                <b>

                                    <font style="vertical-align: inherit;">Bs. 
                                    <?php 
                                    //include('assets/inc/conexion.php'); 
                                    //OBTENEMOS FECHA DEL DIA, DE LA TABLA CONFIGURACION
                                    $consulta = "SELECT dia FROM configuracion";
                                    $resultado = mysqli_query($conexion,$consulta);
                                    $fila = mysqli_fetch_row($resultado);
                                    $fecha = $fila[0];
                                    //OBTENEMOS LA SUMA DE LOS TOTALES DE LAS FACTURAS DEL DIA
                                    $consulta = "SELECT SUM(fac_total) FROM factura WHERE DATE(fac_fecha_hora) = '$fecha'";
                                    $resultado = mysqli_query($conexion,$consulta);
                                    $fila = mysqli_fetch_row($resultado);
                                    $suma = number_format((float)$fila[0], 2, '.', '');
                                    echo $suma;
                                    ?>&nbsp;
                                    <a style="color:; font-size: 22px;" title="Detalle de Ventas" href="#" data-toggle="modal" data-target="#modal_detalle_dia" onclick="VerDetalleVentaDia('<?php 
                                    //OBTENEMOS FECHA DEL DIA, DE LA TABLA CONFIGURACION
                                    $consulta = "SELECT dia FROM configuracion";
                                    $resultado = mysqli_query($conexion,$consulta);
                                    $fila = mysqli_fetch_row($resultado);
                                    $fecha = $fila[0]; echo $fecha;
                                    ?>')">
                                        <i class="mdi mdi-eye-outline"></i>
                                    </a>
                                    </font>
                                </b>
                            </td>
                            <td colspan="3" align="right" style="text-align:right;" rowspan="1"><b>
                                <font style="vertical-align: inherit;">Bs. 
                                <?php 
                                //include 'assets/inc/conexion.php';
                                //OBTENEMOS FECHA DEL DIA, DE LA TABLA CONFIGURACION
                                $consulta = "SELECT dia FROM configuracion";
                                $resultado = mysqli_query($conexion,$consulta);
                                $fila = mysqli_fetch_row($resultado);
                                $fecha = $fila[0];
                                //OBTENEMOS LA SUMA DE LOS TOTALES DE LAS FACTURAS DEL DIA
                                $consulta = "SELECT SUM(fac_utilidad) FROM factura WHERE DATE(fac_fecha_hora) = '$fecha'";
                                $resultado = mysqli_query($conexion,$consulta);
                                $fila = mysqli_fetch_row($resultado);
                                $suma = number_format((float)$fila[0], 2, '.', '');
                                echo $suma;
                                ?>
                                </font></b>
                            </td>
                        </tr>
                    </tfoot>
                </tbody>

            </table>
        </div>
