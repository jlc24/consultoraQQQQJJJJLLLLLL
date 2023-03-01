        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=medicamento-->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#administrador').dataTable({
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
                var table = $('#administrador').DataTable();
                $('#administrador_filter input').focus();
            });
        </script>

        <!--=================================================
        =            CONEXION A LA BASE DE DATOS            =
        ==================================================-->
        <?php include('assets/inc/conexion.php'); ?>

        <table id="administrador" class="table mb-0 table-sm table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead style="background-color: #DBEDC8;">
                <th data-priority="3">C.I.</th>
                <th data-priority="1">Nombre</th>
                <!--<th class="none">Dirección</th>-->
                <th data-priority="5">Celular</th>
                <th data-priority="4">Área</th>
                <th data-priority="6">Fecha de Registro</th>
                <th data-priority="2">Op.</th>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM administrador";
                $resultado = mysqli_query($conexion, $sql);
                while ($registro = mysqli_fetch_assoc($resultado))
                {
                    $datos = $registro["adm_id"] . "||" . $registro["adm_ci_nit"] . "||" . $registro["adm_nombre"] . "||". $registro["adm_direccion"] . "||" . $registro["adm_celular"] . "||" . $registro["adm_area"] . "||" . $registro["adm_fecha_registro"];
                ?>
                    <tr>
                        <td><?php echo $registro["adm_ci_nit"]; ?></td>
                        <td><?php echo $registro["adm_nombre"]; ?></td>
                        
                        <td><?php echo $registro["adm_celular"]; ?></td>
                        <td><?php echo $registro["adm_area"]; ?></td>
                        <td><?php echo $registro["adm_fecha_registro"]; ?></td>
                        <td>
                            <a href='javascript:void(0);' data-toggle='modal' data-target='#modal_actualizar_nota' title='Actualizar Datos Administrador'><i style='color: purple; --darkreader-inline-color:#230443; font-size:20px;' class='icon-note btnUpdateNota' data-darkreader-inline-color=''></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

