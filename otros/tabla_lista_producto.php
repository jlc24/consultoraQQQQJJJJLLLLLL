        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=detalle-->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#detalle').dataTable({
                    "paging": false,
                    "searching": false,
                    "info": false,
                    "oLanguage": {
                        "sEmptyTable": "Ningún producto registrado para este Laboratorio"
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
                        <th>Nombre Comercial</th>
                        <th>Stock</th>
                        <th>Precio Compra</th>
                        <th>Sub Total</th>
                    </thead>
                    <tbody>
                        <?php
                        //CONEXION A LA BdD
                        include('assets/inc/conexion.php');
                        //OBTENEMOS NOMBRE DE LABORATORIO, DE LA TABLA CONFIGURACION
                        $consulta = "SELECT laboratorio FROM configuracion";
                        $resultado = mysqli_query($conexion, $consulta);
                        $fila = mysqli_fetch_row($resultado);
                        $nombre_lab = $fila[0];
                        $sql = "SELECT prod_codigo, prod_nombre_comercial, prod_stock, prod_precio_compra FROM producto WHERE prod_nicklaboratorio LIKE '$nombre_lab'";
                        $resultado = mysqli_query($conexion, $sql);
                        while ($registro = mysqli_fetch_assoc($resultado)) {

                        ?>

                            <tr>
                                <td><?php echo $registro['prod_codigo']; ?></td>
                                <td><?php echo $registro['prod_nombre_comercial']; ?></td>
                                <td><?php echo $registro['prod_stock']; ?></td>
                                <td><?php echo $registro['prod_precio_compra']; ?></td>
                                <td><?php echo "Bs."."&nbsp;".$registro['prod_stock']*$registro['prod_precio_compra']; ?></td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" align="right" style="text-align:right; font-size:14px !Important" rowspan="1">&nbsp; <b>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Total : </font>
                                    </font>
                                </b>
                            </td>
                            <td colspan="1" style="text-align: left;" rowspan="1"><b>
                                    <font style="vertical-align: inherit;">Bs.
                                        <?php
                                        //OBTENEMOS NOMBRE DE LABORATORIO, DE LA TABLA CONFIGURACION
                                        $consulta = "SELECT laboratorio FROM configuracion";
                                        $resultado = mysqli_query($conexion, $consulta);
                                        $fila = mysqli_fetch_row($resultado);
                                        $nombre_lab = $fila[0];
                                        //OBTENEMOS LA SUMA DE LOS SUB TOTALES DE LA FACTURA CON ID $numero
                                        $consulta = "SELECT sum( prod_stock * prod_precio_compra ) FROM producto WHERE prod_nicklaboratorio LIKE '$nombre_lab'";
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
                </table>
            </div>
        </div>