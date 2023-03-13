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
        <?php include('assets/inc/conexion.php'); 
            session_start(); 
            $adm_id = $_SESSION['adm_id'];
        ?>

        <table id="administrador" class="table mb-0 table-sm table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead style="background-color: #DBEDC8;">
                <th data-priority="1" hidden>ID</th>
                <th data-priority="2">C.I.</th>
                <th data-priority="3">Nombre</th>
                <th data-priority="4">Dirección</th>
                <th data-priority="5">Celular</th>
                <th data-priority="6">Área</th>
                <th data-priority="1">Op.</th>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM administrador";
                $resultado = mysqli_query($conexion, $sql);
                while ($registro = mysqli_fetch_assoc($resultado))
                {
                ?>
                    <tr>
                        <td hidden><?php echo $registro['adm_id']; ?></td>
                        <td><?php echo $registro["adm_ci_nit"]; ?></td>
                        <td><?php echo $registro["adm_nombre"]; ?></td>
                        <td><?php echo $registro["adm_direccion"]; ?></td>
                        <td><?php echo $registro["adm_celular"]; ?></td>
                        <td><?php 
                            $sql1 = "SELECT area_nombre FROM area WHERE area_id = '".$registro['area_id']."';";
                            $resul = $conexion->query($sql1);
                            $area = $resul->fetch_assoc();
                            echo $area["area_nombre"]; ?>
                        </td>
                        <td>
                            <?php
                                $sql2 = "SELECT DISTINCT adm_id FROM asignacion WHERE adm_id = '".$registro['adm_id']."';";
                                $result = $conexion->query($sql2);
                                $buscar = $result->fetch_assoc();
                                if (!isset($buscar['adm_id'])) { ?>
                                    <a href="javascript:void(0);" class="btnAsignar" title="Asignar Procesos">
                                        <i style="color: #40CC6C; --darkreader-inline-color:#DC5C05; font-size:20px;" class="far fa-file"></i>
                                    </a>
                                    <a style="color:black;" href="javascript:void(0);" title="Eliminar Administrador" class="btnEliminarAdministrador">
                                        <i style="color: #F96A74; --darkreader-inline-color:#DC5C05; font-size:20px;" class="far fa-trash-alt"></i>
                                    </a>
                            <?php
                                }else { ?>
                                    <a href="javascript:void(0);" class="btnModificar" title="Modificar Procesos">
                                        <i style="color: #DC5C05; --darkreader-inline-color:#DC5C05; font-size:20px;" class="far fa-edit"></i>
                                    </a>
                                    <a style="color:black;" href="javascript:void(0);" title="Eliminar Administrador" class="btnEliminarAdministrador">
                                        <i style="color: #F96A74; --darkreader-inline-color:#DC5C05; font-size:20px;" class="far fa-trash-alt"></i>
                                    </a>
                            <?php
                                }
                            ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

