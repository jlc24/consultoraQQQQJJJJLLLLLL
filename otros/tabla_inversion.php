        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=medicamento-->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#cliente').dataTable({
                    responsive: true,
                    columnDefs: [],
                    "lengthMenu": [10, 25, 50, 100],
                    /* Disable initial sort */
                    "aaSorting": [],
                    "language": {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningún dato disponible en esta tabla",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                });
                //var versionNo = $.fn.dataTable.version;
                //alert(versionNo);
                var table = $('#cliente').DataTable();
                $('#cliente_filter input').focus();
            });
        </script>

        <!--=================================================
        =            CONEXION A LA BASE DE DATOS            =
        ==================================================-->
        <?php include('assets/inc/conexion.php'); ?>

        <table id="cliente" class="table mb-0 table-sm table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead style="background-color: #DBEDC8;">
                <th data-priority="1">Laboratorio Fabricante</th>
                <th data-priority="2">Nº de Productos Registrados</th>
                <th data-priority="3">Inversión por Laboratorio</th>
                <th data-priority="4">Op.</th>
            </thead>
            <tbody>
                <?php
                //1.- OBTENEMOS LOS NICK's DE TODOS LOS LABORATORIOS REGISTRADOS
                //2.- PARA CADA NICK obtenemos, prod_codigo,prod_nombre,proc_precio_compra,prod_stock
                //3.-
                $sql="SELECT DISTINCT prod_nicklaboratorio FROM producto";
                $resultado=mysqli_query($conexion,$sql);
                while($nombre_lab = mysqli_fetch_row($resultado)){//mientras haya filas (nombres de laboratorios) a recorrer

                    $query="SELECT prod_stock, prod_precio_compra FROM producto WHERE prod_nicklaboratorio LIKE '$nombre_lab[0]'";
                    $result=mysqli_query($conexion,$query);
                    $total = 0;
                    $subtotal = 0;
                    $cantidad = 0;//Cantidad de productos registrados para un determinado laboratorio
                    while ($producto = mysqli_fetch_row($result)) {//mientras haya filas (productos de un laboratorio) a recorrer
                        $subtotal = (float)$producto[0]*(float)$producto[1];
                        $total = $total + $subtotal;
                        $cantidad = $cantidad + 1;
                    }
                ?>

                <tr>
                    <td><?php echo $nombre_lab[0]; ?></td>
                    <td><?php echo $cantidad ?></td>
                    <td><?php echo "Bs."."&nbsp;&nbsp;".$total ?></td>
                    <td><a style="color:#230443; font-size:18px;" href="#" data-toggle="modal" data-target="#modal_lista_producto" onclick="VerProductos('<?php echo $nombre_lab[0];?>')" title="Ver Productos"><i class="icon-note"></i></a></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" rowspan="1">
                        <b>Inversión Total : Bs.&nbsp;
                            <?php
                                $consulta = "SELECT SUM(prod_precio_compra*prod_stock) FROM producto";
                                $resultado = mysqli_query($conexion,$consulta);
                                $fila = mysqli_fetch_row($resultado);
                                $suma = number_format((float)$fila[0], 2, '.', '');
                                echo $suma;
                            ?>
                        </b>
                    </td>
                </tr>
            </tfoot>
        </table>

