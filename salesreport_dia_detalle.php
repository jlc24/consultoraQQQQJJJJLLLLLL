        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=detalle-->
        <script type="text/javascript">
            $(document).ready(function (){
                $('#detalleVentaDia').dataTable({
                    //"paging":false,
                    //"searching":false,
                    "info": false,
                    //"oLanguage": {"sEmptyTable": "Ningún medicamento registrado en esta compra"}, //Para DataTables >=1.10
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
        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=detalle-->
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table id="detalleVentaDia" class="table table-sm table-condensed table-dark" width="99%" style="font-size:13px; color:white;">
                                        <thead>
                                            <th>Det.</th>
                                            <th>Nombre Del Producto</th>
                                            <th>Cant.</th>
                                            <th>Precio</th>
                                            <th>Sub Total</th>
                                            <th>Utilidad</th>
                                        </thead>
                                        <tbody>
                                        <?php
                                            //CONEXION A LA BdD
                                            include('assets/inc/conexion.php');
                                            //AQUI PODEMOS CAPTURAR EL NUMERO DE LA FACTURA ACTUAL
                                            $consulta = "SELECT dia FROM configuracion";
                                            $resultado = mysqli_query($conexion,$consulta);
                                            $fila = mysqli_fetch_row($resultado);
                                            $fecha = $fila[0];
                                            //falta  la consulta me quede ahi
                                            $sql="SELECT det_id, det_producto, det_cantidad, det_precio_unitario, det_subtotal, det_utilidad from detalle_factura WHERE det_fecha = '$fecha'";
                                            $resultado=mysqli_query($conexion,$sql);
                                            while($registro = mysqli_fetch_row($resultado)){
                                                $datos=$registro[0]."||".$registro[1]."||".$registro[2]."||".$registro[3]."||".$registro[4]."||".$registro[5];

                                         ?>

                                            <tr>
                                                <td><?php echo $registro[0]; ?></td>
                                                <td><?php echo $registro[1]; ?></td>
                                                <td><?php echo $registro[2]; ?></td>
                                                <td><?php echo "Bs. ".$registro[3]; ?></td>
                                                <td><?php echo $registro[4]; ?></td>
                                                <td><?php echo $registro[5]; ?></td>
                                            </tr>

                                        <?php
                                                                                    }
                                        ?>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4" align="right" style="text-align:right; font-size:14px !Important" rowspan="1">&nbsp; <b>
                                                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Total : </font></font></b>
                                                </td>
                                                <td style="text-align: left;" rowspan="1" colspan="1"><b>
                                                    <font style="vertical-align: inherit;">Bs. 
                                                    <?php 
                                                    //$conexion=@mysqli_connect('localhost', 'root', 'usbw', 'botica'); 
                                                    //OBTENEMOS FECHA DEL DIA, DE LA TABLA CONFIGURACION
                                                    $consulta = "SELECT dia FROM configuracion";
                                                    $resultado = mysqli_query($conexion,$consulta);
                                                    $fila = mysqli_fetch_row($resultado);
                                                    $fecha = $fila[0];
                                                    //OBTENEMOS LA SUMA DE LOS SUB TOTALES DE LA FACTURA DE LA FECHA DEL DIA
                                                    $consulta = "SELECT SUM(det_subtotal) FROM detalle_factura WHERE det_fecha = '$fecha'";
                                                    $resultado = mysqli_query($conexion,$consulta);
                                                    $fila = mysqli_fetch_row($resultado);
                                                    $suma = number_format((float)$fila[0], 2, '.', '');
                                                    echo $suma;
                                                    ?>
                                                    </font></b>
                                                </td>
                                                <td style="text-align: left;" rowspan="1" colspan="1">
                                                    <b><font style="vertical-align: inherit;">Bs.
                                                    <?php
                                                    //$conexion=@mysqli_connect('localhost', 'root', 'usbw', 'botica'); 
                                                    //OBTENEMOS FECHA DEL DIA, DE LA TABLA CONFIGURACION
                                                    $consulta = "SELECT dia FROM configuracion";
                                                    $resultado = mysqli_query($conexion,$consulta);
                                                    $fila = mysqli_fetch_row($resultado);
                                                    $fecha = $fila[0];
                                                    //OBTENEMOS LA SUMA DE LOS TOTALES DE LAS FACTURAS DEL DIA
                                                    $consulta = "SELECT SUM(det_utilidad) FROM detalle_factura WHERE det_fecha = '$fecha'";
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
                            </div>
