        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=medicamento-->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#proceso').dataTable({
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
                var table = $('#proceso').DataTable();
                $('#proceso_filter input').focus();
            });
        </script>

        <!--=================================================
        =            CONEXION A LA BASE DE DATOS            =
        ==================================================-->
        <?php include('assets/inc/conexion.php'); ?>

        <table id="proceso" class="table mb-0 table-sm table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead style="background-color: #DBEDC8;">
                <th data-priority="1">ID</th>
                <th data-priority="2">Codigo</th>
                <th data-priority="3">Nombre</th>
                <th data-priority="3">Área</th>
                <th data-priority="3">Fecha</th>
                <th data-priority="1">Op</th>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT proceso_id, proceso_nombre, proceso_cod, proceso.area_id, proceso_fecha 
                        FROM proceso, area
                        WHERE proceso.area_id = area.area_id;";
                $resultado = mysqli_query($conexion, $sql);
                while ($registro = mysqli_fetch_assoc($resultado))
                {
                ?>
                    <tr>
                        <td><?php echo $registro["proceso_id"]; ?></td>
                        <td><?php echo $registro["proceso_cod"]; ?></td>
                        <td><?php echo $registro["proceso_nombre"]; ?></td>
                        <td><?php 
                            $cons = "SELECT area_nombre FROM area WHERE area_id = '".$registro['area_id']."';";
                            $resul = $conexion->query($cons);
                            $area_nom = $resul->fetch_assoc();
                            echo $area_nom["area_nombre"]; ?></td>
                        <td><?php echo $registro["proceso_fecha"]; ?></td>
                        <td>
                            <a style="color:black;" href="javascript:void(0);" title="Eliminar Proceso" class='btnEliminarProceso'>
                                <i style="color: #F96A74; --darkreader-inline-color:#DC5C05; font-size:20px;" class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

