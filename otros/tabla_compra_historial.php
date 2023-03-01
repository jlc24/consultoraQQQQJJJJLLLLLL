        <!-- Inicializamos el DataTable -->
        <script type="text/javascript">
            $(document).ready(function() {
                var table = $("#datatable_producto_historial").DataTable({
                    keys: !0,
                    language: {
                        processing: "Procesando...",
                        lengthMenu: "Mostrar _MENU_ registros",
                        zeroRecords: "No se encontraron resultados",
                        emptyTable: "Ningún dato disponible en esta tabla",
                        info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                        infoFiltered: "(filtrado de un total de _MAX_ registros)",
                        infoPostFix: "",
                        search: "Buscar:",
                        url: "",
                        infoThousands: ",",
                        loadingRecords: "Cargando...",
                        paginate: {
                            first: "Primero",
                            last: "Último",
                            next: "Siguiente",
                            previous: "Anterior"
                        },
                        aria: {
                            sortAscending: ": Activar para ordenar la columna de manera ascendente",
                            sortDescending: ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                });
                //Coloca el foco en el input search del DataTable
                $('div.dataTables_filter input',table.table().container()).focus();
            });
        </script>
        <!--=================================================
        =       CONEXIÓN A LA BASE DE DATOS PAPELERIA       =
        ==================================================-->
        <?php include('assets/inc/conexion.php'); ?>

        <!-- <table id="datatable_producto" class="table table-sm table-bordered dt-responsive nowrap"> -->
        <table id="datatable_producto_historial" class="table mb-0 table-sm table-bordered dt-responsive" width="100%">
            <thead>
                <tr>
                    <th class="all">Fecha De Compra</th>
                    <th class="none">Detalle</th>
                    <th class="all">Cantidad</th>
                    <th class="all">Precio De Compra</th>
                    <th class="all">Precio Unitario</th>
                    <th class="all">Caducidad</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //OBTENEMOS EL ID DEL PRODUCTO, DE LA TABLA CONFIGURACION
                    $consulta = "SELECT prod_id FROM configuracion";
                    $resultado = mysqli_query($conexion,$consulta);
                    $fila = mysqli_fetch_row($resultado);
                    $numero = (int)$fila[0];

                    $sql="SELECT * FROM compra WHERE prod_id = $numero ORDER BY comp_id DESC";
                    $resultado=mysqli_query($conexion,$sql);
                    while($registro = mysqli_fetch_row($resultado)){
                        /* En la variable $datos se recoge los registros de una fila
                        de la consulta, para poder enviarlo a los inputs de un modal
                        y de esta manera poder actualizar los datos */
                        $datos = $registro[0]."||".
                                 $registro[1]."||".
                                 $registro[2]."||".
                                 $registro[3]."||".
                                 $registro[4]."||".
                                 $registro[5]."||".
                                 $registro[6]."||".
                                 $registro[7];
                ?>
                    <tr>
                        <td><?php $fecha = new DateTime($registro[7]); echo strftime("%d %b %Y", $fecha->getTimestamp());?></td>
                        <td><?php echo $registro[3]; ?></td>
                        <td><?php echo $registro[4]; ?></td>
                        <td><?php echo $registro[5]; ?></td>
                        <td><?php echo "Bs. ".$registro[6]; ?></td>
                        <td></td>
                    </tr>

                <?php
                    }
                ?>
            </tbody>
        </table>