        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=detalle-->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#detalle').dataTable({
                    "paging": false,
                    "searching": false,
                    "info": false,
                    "oLanguage": {
                        "sEmptyTable": "Ningún medicamento registrado en esta compra"
                    } //Para DataTables >=1.10
                });
            });
        </script>
        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=detalle-->
        <div class="col-sm-12">
            <div class="table-responsive">
                <table id="detalle" class="table mb-0 table-sm dt-responsive" width="100%">
                    <thead>
                        <th>Cod.</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Sub Total</th>
                    </thead>
                    <tbody>
                        <?php
                        //CONEXION A LA BdD
                        include 'assets/inc/conexion.php';
                        //AQUI PODEMOS CAPTURAR EL NUMERO DE LA FACTURA ACTUAL
                        $consulta = "SELECT numero_detalle FROM configuracion";
                        $result = mysqli_query($conexion, $consulta);
                        $filas = mysqli_fetch_row($result);
                        $numero = (int)$filas[0];

                        $sql = "SELECT det_id, det_producto, det_cantidad, det_precio_unitario, det_subtotal, prod_id, det_codigo from detalle_factura WHERE fac_id = $numero";
                        $resultado = mysqli_query($conexion, $sql);
                        while ($registro = mysqli_fetch_row($resultado)) {
                            $datos = $registro[0] . "||" . $registro[1] . "||" . $registro[2] . "||" . $registro[3] . "||" . $registro[4] . "||" . $registro[6];

                        ?>

                            <tr>
                                <td><?php echo $registro[6]; ?></td>
                                <td><?php echo $registro[1]; ?></td>
                                <td><?php echo $registro[2]; ?></td>
                                <td><?php echo $registro[3]; ?></td>
                                <td><?php echo "Bs. " . $registro[4]; ?></td>
                            </tr>

                        <?php
                        }
                        ?>
                    <tfoot>
                        <tr>
                            <td colspan="4" align="right" style="text-align:right; font-size:14px !Important" rowspan="1">&nbsp; <b>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Total : </font>
                                    </font>
                                </b>
                            </td>
                            <td style="text-align: left;" rowspan="1" colspan="1"><b>
                                    <font style="vertical-align: inherit;">Bs.
                                        <?php
                                        //$conexion = @mysqli_connect('localhost', 'root', 'usbw', 'farmacia');
                                        //OBTENEMOS FECHA DEL DIA, DE LA TABLA CONFIGURACION
                                        $consulta = "SELECT numero_detalle FROM configuracion";
                                        $resultado = mysqli_query($conexion, $consulta);
                                        $fila = mysqli_fetch_row($resultado);
                                        $numero = (int)$filas[0];
                                        //OBTENEMOS LA SUMA DE LOS SUB TOTALES DE LA FACTURA CON ID $numero
                                        $consulta = "SELECT SUM(det_subtotal) FROM detalle_factura WHERE fac_id = '$numero'";
                                        $resultado = mysqli_query($conexion, $consulta);
                                        $fila = mysqli_fetch_row($resultado);
                                        $suma = number_format((float)$fila[0], 2, '.', '');
                                        echo $suma;
                                        ?>
                                    </font>
                                </b>
                            </td>
                        </tr>
                    </tfoot>
                    </tbody>
                </table>
            </div>
        </div>