        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=medicamento-->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#usuario').dataTable({
                    responsive: true,
                    columnDefs: [],
                    "lengthMenu": [15, 25, 50, 100],
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
                var table = $('#usuario').DataTable();
                $('#usuario_filter input').focus();
            });
        </script>

        <!--=================================================
        =            CONEXION A LA BASE DE DATOS            =
        ==================================================-->
        <?php include('assets/inc/conexion.php'); ?>

        <table id="usuario" class="table mb-0 table-sm table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead style="background-color: #DBEDC8;">
                <th data-priority="1">ID</th>
                <th data-priority="2">Nombre Completo</th>
                <th data-priority="3">Usuario</th>
                <th data-priority="5">Contraseña</th>
                <th data-priority="4">Rol</th>
                <th data-priority="6">Op.</th>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM administrador ORDER BY adm_id";
                $resultado = mysqli_query($conexion, $sql);
                while ($registro = mysqli_fetch_assoc($resultado))
                {
                    $datos = $registro["adm_id"] . "||" . $registro["adm_nombre"] . "||" . $registro["adm_usuario"] . "||" . $registro["adm_pass"] . "||" . $registro["adm_rol"];
                ?>
                    <tr>
                        <td><?php echo $registro["adm_id"]; ?></td>
                        <td><?php echo $registro["adm_nombre"]; ?></td>
                        <td><?php echo $registro["adm_usuario"]; ?></td>
                        <td><?php echo $registro["adm_pass"]; ?></td>
                        <td><?php echo $registro["adm_rol"]; ?></td>
                        <td>
                            <a href='javascript:void(0);' data-toggle='modal' data-target='#modal_actualizar_usuario' onclick="EditarUsuario('<?php echo $datos; ?>')" title='Editar Cuenta'><i style='color: purple; --darkreader-inline-color:#230443; font-size:20px;' class='icon-note' data-darkreader-inline-color=''></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

