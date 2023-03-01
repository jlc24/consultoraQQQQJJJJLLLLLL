        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=medicamento-->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#cliente').dataTable({
                    responsive: true,
                    columnDefs: [],
                    "lengthMenu": [15, 25, 50, 100],
                    /* Disable initial sort */
                    "aaSorting": [],
                    "order": [[0, "desc"]],
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
                <th data-priority="1">ID</th>
                <th data-priority="6">Administrador</th>
                <th data-priority="2">Título de la nota</th>
                <th data-priority="5">Contenido de la Nota</th>
                <th data-priority="4">Fecha de Registro</th>
                <th data-priority="3">Op.</th>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT *FROM nota WHERE not_estado = 1";
                $resultado = mysqli_query($conexion, $sql);
                while ($registro = mysqli_fetch_assoc($resultado))
                {
                    $datos = $registro["not_id"] . "||" . $registro["not_usuario"] . "||" . $registro["not_titulo"] . "||" . $registro["not_comentario"] . "||" . $registro["not_fecha_hora"];
                ?>
                    <tr>
                        <td><?php echo $registro["not_id"]; ?></td>
                        <td><?php echo $registro["not_usuario"]; ?></td>
                        <td><?php echo $registro["not_titulo"]; ?></td>
                        <td><?php echo $registro["not_comentario"]; ?></td>
                        <td><?php echo date_format(date_create($registro["not_fecha_hora"]), 'd/m/Y'); ?></td>
                        <td>
                            <a href='javascript:void(0);' data-toggle='modal' data-target='#modal_actualizar_nota' title='Actualizar Nota'><i style='color: purple; --darkreader-inline-color:#230443; font-size:20px;' class='icon-note btnUpdateNota' data-darkreader-inline-color=''></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

