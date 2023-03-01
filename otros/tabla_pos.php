        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=detalle-->
        <script type="text/javascript">
            var table = $(document).ready(function() {
                $('#detalle_tabla').dataTable({
                    columnDefs: [{ "visible": false, "targets": 0 },{"targets": 1, "className": "text-left"},{"targets": 4, "className": "text-left"}],
                    "paging": false,
                    "searching": false,
                    "order": [[0, "desc"]],
                    "info": false,
                    "oLanguage": {
                        "sEmptyTable": "Ningún producto disponible en esta factura"
                    } //Para DataTables >=1.10
                });
            });
        </script>
        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=detalle-->
        <div class="col-sm-12">
            <div class="table-responsive">
                <table id="detalle_tabla" class="table-condensed dt-responsive" width="100%">
                    <thead>
                        <th>Nº</th>
                        <th data-priority="1">Nombre Del Producto</th>
                        <th data-priority="3">Cantidad</th>
                        <th data-priority="2">Precio</th>
                        <th data-priority="4">SubTotal</th>
                        <th data-priority="5">Op.</th>
                    </thead>
                    <tbody>
                    <?php
                        //ESTA TABLA MUESTRA EL DETALLE DE LA FACTURA ACTUAL, DEPENDIENDO DEL ESTADO DE LA FACTURA (CREADA ó FINALIZADA)
                        //SI NO HAY FACTURAS LA TABLA DETALLE NO NUESTRA NADA, SI HAY AL MENOS UNA FACTURA VERIFICAMOS EL ESTADO DE LA FACTURA
                        //SI LA FACTURA NO ESTA FINALIZADA, MUESTRAS EL DETALLE DE LOS PRODUCTOS SI ES QUE LOS TUVIERA.

                        //CONEXION A LA BdD
                        include('assets/inc/conexion.php');

                        //BUSCAMOS EL No DE FACTURA ACTUAL, PUEDE SER QUE NO HAYA NINGUNA FACTURA ó QUE SEA LA FACTURA NUMERO N.
                        $consulta="SELECT MAX(fac_id) FROM factura";
                        $result = mysqli_query($conexion,$consulta);
                        $filas = mysqli_fetch_row($result);
                        $valor = (int)$filas[0];
                        if($valor == 0){//SI NO HAY NINGUA FACTURA
                            $numero_factura = $valor;
                        }else{//SI HAY FACTURAS, ENTONCES VERIFICAMOS EL ESTADO ACTUAL DE LA FACTURA (0=FACTURA CREADA ó 1=FACTURA FINALIZADA)
                            $consulta1="SELECT fac_estado FROM factura WHERE fac_id = $valor";
                            $resultado1 = mysqli_query($conexion,$consulta1);
                            $filas1 = mysqli_fetch_row($resultado1);
                            $estado = (int)$filas1[0];
                            if($estado==0){//estado 0 indica que factura solo ha sido creada, y por lo tanto se mostrara en la tabla detalle los productos que contengan la factura actual
                                $numero_factura = $valor;
                            }else if($estado==1){//estado 1 indica que se realizo la compra, y por lo tanto se mostrara la tabla detalle vacia sin productos, y esperando a que se cree una nueva factura
                                $numero_factura = $valor + 1;
                            }
                        }

                        $sql="SELECT
                                det_id,
                                det_producto,
                                det_cantidad,
                                det_precio_unitario,
                                det_subtotal,
                                prod_id
                            FROM
                                detalle_factura
                            WHERE
                                fac_id = $numero_factura";
                        $resultado=mysqli_query($conexion,$sql);
                        while($registro = mysqli_fetch_assoc($resultado)){
                            $datos=$registro['det_id']."||".$registro['det_producto']."||".$registro['det_cantidad']."||".$registro['det_precio_unitario']."||".$registro['det_subtotal'];

                     ?>

                        <tr>
                            <td><?php echo $registro['det_id']; ?></td>
                            <td><?php echo $registro['det_producto']; ?></td>
                            <td><?php echo $registro['det_cantidad']; ?></td>
                            <td><?php echo $registro['det_precio_unitario']; ?></td>
                            <td><?php echo "Bs. ".$registro['det_subtotal']; ?></td>
                            <td>
                                <a style="color:red;" href="#" onclick="EliminarDetalle('<?php echo $registro['det_id']."||".$registro['det_cantidad']."||".$registro['prod_id']; ?>')">
                                    <!-- id_detalle, cant. a sumar al stock actual, id_producto -->
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>

                    <?php
                    }
                    ?>
                    </tbody>

                </table>
            </div>
        </div>
