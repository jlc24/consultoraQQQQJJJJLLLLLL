        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=factura-->
        <script type="text/javascript">
            $(document).ready(function (){
                var table = $('#ventaSemana').dataTable({
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
            <table id="ventaSemana" class="table table-background table-background-dark table-hover table-condensed responsive" width="100%">
                <thead style="background-color:;">
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
                    //IMPRIMIMOS LAS FACTURAS CON ESTADO 1, QUE ESTAN FINALIZADA Y CANCELADAS DE LA SEMANA ACTUAL
                    //OBTENEMOS EL PRIMER Y ULTIMO DIA DE LA SEMANA
                    $year=date("Y"); //echo $year;
                    $month=date("m"); //echo $month;
                    $day=date("d"); //echo $day;

                    # Obtenemos el numero de la semana
                    $semana=date("W",mktime(0,0,0,$month,$day,$year));

                    # Obtenemos el día de la semana de la fecha dada
                    $diaSemana=date("w",mktime(0,0,0,$month,$day,$year));

                    # el 0 equivale al domingo...
                    if($diaSemana==0)
                        $diaSemana=7;

                    # A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes
                    $primer=date("Y-m-d",mktime(0,0,0,$month,$day-$diaSemana+1,$year));

                    # A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo
                    $ultimo=date("Y-m-d",mktime(0,0,0,$month,$day+(7-$diaSemana),$year));

                    $sql="SELECT fac_id, fac_fecha_hora, fac_nombre_cliente, fac_nombre_usuario, fac_total, fac_utilidad, fac_importe, fac_cambio FROM factura WHERE fac_estado = 1 AND DATE(fac_fecha_hora) BETWEEN '$primer' AND '$ultimo'";
                    $resultado=mysqli_query($conexion,$sql);
                    while($registro = mysqli_fetch_row($resultado)){
                        $datos=$registro[0]."||".$registro[1]."||".$registro[2]."||".$registro[3]."||".$registro[4]."||".$registro[5];

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
                                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Total, Ventas De La Semana :</font></font></b>
                            </td>
                            <td style="text-align: left; background-color:;" rowspan="1" colspan="1"><b>
                                <font style="vertical-align: inherit;">Bs. 
                                <?php 
                                    //OBTENEMOS EL PRIMER Y ULTIMO DIA DE LA SEMANA
                                    $year=date("Y"); //echo $year;
                                    $month=date("m"); //echo $month;
                                    $day=date("d"); //echo $day;

                                    # Obtenemos el numero de la semana
                                    $semana=date("W",mktime(0,0,0,$month,$day,$year));

                                    # Obtenemos el día de la semana de la fecha dada
                                    $diaSemana=date("w",mktime(0,0,0,$month,$day,$year));

                                    # el 0 equivale al domingo...
                                    if($diaSemana==0)
                                        $diaSemana=7;

                                    # A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes
                                    $primer=date("Y-m-d",mktime(0,0,0,$month,$day-$diaSemana+1,$year));

                                    # A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo
                                    $ultimo=date("Y-m-d",mktime(0,0,0,$month,$day+(7-$diaSemana),$year));

                                    //OBTENEMOS LA SUMA DE LOS TOTALES DE LAS FACTURAS DE LA SEMANA
                                    $consulta = "SELECT SUM(fac_total) FROM factura WHERE DATE(fac_fecha_hora) BETWEEN '$primer' AND '$ultimo'";
                                    $resultado = mysqli_query($conexion,$consulta);
                                    $fila = mysqli_fetch_row($resultado);
                                    $suma = number_format((float)$fila[0], 2, '.', '');
                                    echo $suma;
                                ?>
                                </font></b>
                            </td>
                            <td colspan="3" align="right" style="text-align:right;" rowspan="1"><b>
                                <font style="vertical-align: inherit;">Bs. 
                                <?php 
                                    //OBTENEMOS EL PRIMER Y ULTIMO DIA DE LA SEMANA
                                    $year=date("Y"); //echo $year;
                                    $month=date("m"); //echo $month;
                                    $day=date("d"); //echo $day;

                                    # Obtenemos el numero de la semana
                                    $semana=date("W",mktime(0,0,0,$month,$day,$year));

                                    # Obtenemos el día de la semana de la fecha dada
                                    $diaSemana=date("w",mktime(0,0,0,$month,$day,$year));

                                    # el 0 equivale al domingo...
                                    if($diaSemana==0)
                                        $diaSemana=7;

                                    # A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes
                                    $primer=date("Y-m-d",mktime(0,0,0,$month,$day-$diaSemana+1,$year));

                                    # A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo
                                    $ultimo=date("Y-m-d",mktime(0,0,0,$month,$day+(7-$diaSemana),$year));

                                    //OBTENEMOS LA SUMA DE LOS TOTALES DE LAS FACTURAS DE LA SEMANA
                                    $consulta = "SELECT SUM(fac_utilidad) FROM factura WHERE DATE(fac_fecha_hora) BETWEEN '$primer' AND '$ultimo'";
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
