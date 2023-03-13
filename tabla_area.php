        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=medicamento-->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#area').dataTable({
                    responsive: true,
                    columnDefs: [],
                    "lengthMenu": [5, 10],
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
                var table = $('#area').DataTable();
                $('#area_filter input').focus();
            });
        </script>

        <!--=================================================
        =            CONEXION A LA BASE DE DATOS            =
        ==================================================-->
        <?php include('assets/inc/conexion.php'); ?>

        <table id="area" class="table mb-0 table-sm table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead style="background-color: #DBEDC8;">
                <th data-priority="1">ID</th>
                <th data-priority="2">Nombre</th>
                <th data-priority="3">Fecha</th>
                <th data-priority="1">Op</th>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM area";
                $resultado = mysqli_query($conexion, $sql);
                while ($registro = mysqli_fetch_assoc($resultado))
                {
                ?>
                    <tr>
                        <td><?php echo $registro["area_id"]; ?></td>
                        <td><?php echo $registro["area_nombre"]; ?></td>
                        <td><?php echo $registro["area_fecha"]; ?></td>
                        <td>
                            <a style="color:black;" href="javascript:void(0);" class='btnAsignarArea' title="Asignar Área" hidden>
                                <i style="color: #DC5C05; --darkreader-inline-color:#230443; font-size:20px;" class="far fa-edit"></i>
                            </a>
                            <a style="color:black;" href="javascript:void(0);" title="Eliminar Área" class='btnEliminarArea'>
                                <i style="color: #F96A74; --darkreader-inline-color:#DC5C05; font-size:20px;" class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

