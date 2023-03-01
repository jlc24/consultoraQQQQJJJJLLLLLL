        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=factura-->
        <script type="text/javascript">
            $(document).ready(function (){
                var table = $('#compraSemana').dataTable({
                    responsive: true,
                    columnDefs: [],
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
            <table id="compraSemana" class="table table-background table-background-dark table-hover table-condensed responsive" width="100%">
                <thead>
                    <th data-priority="1">Nº</th>
                    <th data-priority="2">Producto</th>
                    <th data-priority="7">Detalle Compra</th>
                    <th data-priority="4">Cantidad</th>
                    <th data-priority="3">Sub Total</th>
                    <th data-priority="5">Precio Unitario</th>
                    <th data-priority="6">Editar</th>
                </thead>
                <tbody>
                <?php
                    //CONEXION A LA BdD
                    include('assets/inc/conexion.php');
                    //IMPRIMIMOS LAS FACTURAS CON ESTADO 1, QUE ESTAN FINALIZADA Y CANCELADAS DE LA SEMANA ACTUAL
                    //OBTENEMOS EL PRIMER Y ULTIMO DIA DE LA SEMANA
                    $year=date("Y");
                    $week=date("W");   
                    # obtenemos el timestamp del primer dia del año
                    $timestamp=mktime(0, 0, 0, 1, 1, $year);
                    # sumamos el timestamp de la suma de las semanas actuales
                    $timestamp+=$week*7*24*60*60;
                    # restamos la posición inicial del primer dia del año
                    $ultimoDia=$timestamp-date("w", mktime(0, 0, 0, 1, 1, $year))*24*60*60; 
                    # le restamos los dias que hay hasta llegar al lunes
                    $primerDia=$ultimoDia-86400*(date('N',$ultimoDia)-1);
                    $ultimo = date("Y-m-d",$ultimoDia);
                    $primer = date("Y-m-d",$primerDia);

                    $sql="SELECT
                            comp_id,
                            prod_nombre_comercial,
                            comp_detalle,
                            comp_cantidad,
                            comp_subtotal,
                            comp_precio_unitario 
                        FROM
                            producto
                            INNER JOIN compra ON producto.prod_id = compra.prod_id 
                        WHERE DATE(comp_fecha_registro) BETWEEN '$primer' AND '$ultimo'";
                    $resultado=mysqli_query($conexion,$sql);
                    while($registro = mysqli_fetch_row($resultado)){
                        $datos=$registro[0]."||".$registro[1]."||".$registro[2]."||".$registro[3]."||".$registro[4]."||".$registro[5];

                 ?>

                    <tr>
                        <td><?php echo $registro[0]; ?></td>
                        <td><?php echo $registro[1]; ?></td>
                        <td><?php echo $registro[2]; ?></td>
                        <td style="text-align: right;"><?php echo $registro[3]; ?></td>
                        <td style="text-align: right;"><?php echo $registro[4]; ?></td>
                        <td><?php echo "Bs. "."</span>".$registro[5]; ?></td>
                        <td>
                            <a style="color:white;" href="#" data-toggle="modal" data-target="#modal_actualizar_compra" title="Editar" onclick="EditarCompra('<?php echo $datos; ?>')">
                                <i class="icon-pencil"></i>
                            </a>
                        </td>
                        
                    </tr>

                <?php
                                                            }

                ?>
                    <tfoot>
                        <td colspan="7" rowspan="1" style="text-align:left;font-size:14px">&nbsp; 
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Total :</font>
                            </font>
                            <font style="vertical-align: inherit;">Bs. 
                            <?php 
                                //OBTENEMOS EL PRIMER Y ULTIMO DIA DE LA SEMANA
                                $year=date("Y");
                                $week=date("W");   
                                # obtenemos el timestamp del primer dia del año
                                $timestamp=mktime(0, 0, 0, 1, 1, $year);
                                # sumamos el timestamp de la suma de las semanas actuales
                                $timestamp+=$week*7*24*60*60;
                                # restamos la posición inicial del primer dia del año
                                $ultimoDia=$timestamp-date("w", mktime(0, 0, 0, 1, 1, $year))*24*60*60; 
                                # le restamos los dias que hay hasta llegar al lunes
                                $primerDia=$ultimoDia-86400*(date('N',$ultimoDia)-1);

                                $ultimo = date("Y-m-d",$ultimoDia);
                                $primer = date("Y-m-d",$primerDia);

                                //OBTENEMOS LA SUMA DE LOS TOTALES DE LAS FACTURAS DE LA SEMANA
                                $consulta = "SELECT SUM(comp_subtotal) FROM compra WHERE DATE(comp_fecha_registro) BETWEEN '$primer' AND '$ultimo'";
                                $resultado = mysqli_query($conexion,$consulta);
                                $fila = mysqli_fetch_row($resultado);
                                $suma = number_format((float)$fila[0], 2, '.', '');
                                echo $suma;
                            ?>
                            </font>
                        </td>
                    </tfoot>
                </tbody>
            </table>
        </div>
