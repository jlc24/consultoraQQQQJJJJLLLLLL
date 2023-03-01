        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=factura-->
        <script type="text/javascript">
            $(document).ready(function (){
                var table = $('#compraAnual').dataTable({
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
            <table id="compraAnual" class="table table-background table-background-dark table-hover table-condensed responsive" width="100%">
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
                    //OBTENEMOS EL MES y AÑO PARA REALIZAR EL REPORTE
                    $consulta = "SELECT year FROM configuracion";
                    $result = mysqli_query($conexion,$consulta);
                    $fila = mysqli_fetch_row($result);
                    $year = (int)$fila[0];

                    $sql="SELECT
                        comp_id,
                        prod_nombre_comercial,
                        comp_detalle,
                        comp_cantidad,
                        comp_subtotal,
                        comp_precio_unitario 
                    FROM
                        producto INNER JOIN compra ON producto.prod_id = compra.prod_id 
                    WHERE year(comp_fecha_registro) = '$year'";
                    $resultado=mysqli_query($conexion,$sql);

                    while($registro = mysqli_fetch_assoc($resultado)){
                        $datos=$registro['comp_id']."||".$registro['prod_nombre_comercial']."||".$registro['comp_detalle']."||".$registro['comp_cantidad']."||".$registro['comp_subtotal']."||".$registro['comp_precio_unitario'];

                 ?>

                    <tr>
                        <td><?php echo $registro['comp_id']; ?></td>
                        <td><?php echo $registro['prod_nombre_comercial']; ?></td>
                        <td><?php echo $registro['comp_detalle']; ?></td>
                        <td style="text-align: right;"><?php echo $registro['comp_cantidad']; ?></td>
                        <td style="text-align: right;"><?php echo $registro['comp_subtotal']; ?></td>
                        <td><?php echo "Bs. ".$registro['comp_precio_unitario']; ?></td>
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
                                //OBTENEMOS EL AÑO ESCOGIDO
                                $consulta = "SELECT year FROM configuracion";
                                $result = mysqli_query($conexion,$consulta);
                                $fila = mysqli_fetch_row($result);
                                $year = (int)$fila[0];
                                //OBTENEMOS LA SUMA DE LOS TOTALES DE LAS FACTURAS DE LA SEMANA
                                $consulta = "SELECT SUM(comp_subtotal) FROM compra WHERE year(comp_fecha_registro) = '$year'";
                                $resultado = mysqli_query($conexion,$consulta);
                                $fila = mysqli_fetch_row($resultado);
                                $suma = number_format((float)$fila[0], 2, '.', '');
                                echo $suma;
                                ?>&nbsp;
                            </font>
                        </td>
                    </tfoot>
                </tbody>
            </table>
        </div>
