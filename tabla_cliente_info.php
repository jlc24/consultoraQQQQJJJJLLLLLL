        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=medicamento-->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#cliente').dataTable({
                    responsive: true,
                    columnDefs: [],
                    "lengthMenu": [10, 15, 20, 25],
                    "order": [[ 0,"desc" ]],
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
            <thead>
                <tr>
                    <th class="all" hidden>ID</th>
                    <th class="all">Etapa</th>
                    <th class="all">Acción</th>
                    <th class="all">Observación</th>
                    <th class="all">Encargado</th>
                    <th class="all">Fecha</th>
                    <th class="all">Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //OBTENEMOS EL ID DEL PRODUCTO, DE LA TABLA CONFIGURACION
                    $sql="SELECT * FROM hoja_detalle WHERE hoja_id = (SELECT hoja_id FROM configuracion)";
                    $resultado=mysqli_query($conexion,$sql);
                    while($registro = mysqli_fetch_assoc($resultado)){
                       
                ?>
                    <tr>
                        <td><?php echo $registro['det_id']; ?></td>
                        <td><?php echo $registro['det_etapa']; ?></td>
                        <td><?php echo $registro['det_inicio']; ?></td>
                        <td><?php echo $registro['det_fin']; ?></td>
                        <td>
                            <?php if($registro['det_estado']=='EJECUCION'){?> 
                                <span class="badge badge-success">En Ejecución</span>
                            <?php } else{ ?><span class="badge badge-danger">Finalizado</span> <?php } ?>
                                       
                        </td>
                        <td><?php echo $registro['det_observacion']; ?></td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>

