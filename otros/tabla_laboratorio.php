        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=medicamento-->
        <script type="text/javascript">
            $(document).ready(function (){
                var table = $('#laboratorio').dataTable({
                    responsive: true,
                    columnDefs: [],
                    "lengthMenu":[15,25,50,100],
                        "language": {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                });
                //var versionNo = $.fn.dataTable.version;
                //alert(versionNo);
                //var table = $('#laboratorio').DataTable();
                $('#laboratorio_filter input').focus();
            });
        </script>

        <!--=================================================
        =            CONEXION A LA BASE DE DATOS            =
        ==================================================-->
        <?php include('assets/inc/conexion.php'); ?>

        <table id="laboratorio" class="table mb-0 table-sm table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead style="background-color: #DBEDC8;">
                <th data-priority="1">Nombre</th>
                <th data-priority="7">Alias</th>
                <th data-priority="5">Dirección</th>
                <th data-priority="6">Email</th>
                <th data-priority="3">Web</th>
                <th data-priority="4">Preventista</th>
                <th data-priority="2">Op.</th>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT *FROM laboratorio";
                $resultado = mysqli_query($conexion, $sql);
                while ($registro = mysqli_fetch_assoc($resultado))
                {
                    $datos = $registro["lab_id"] . "||" . $registro["lab_nombre"] . "||" . $registro["lab_nick"] . "||" . $registro["lab_direccion"] . "||" . $registro["lab_email"] . "||" . $registro["lab_web"] . "||" . $registro["lab_preventista"];
                ?>
                                
                    <tr>
                        <td><?php echo $registro["lab_nombre"]; ?></td>
                        <td><?php echo $registro["lab_nick"]; ?></td>
                        <td><?php echo $registro["lab_direccion"]; ?></td>
                        <td><?php echo $registro["lab_email"]; ?></td>
                        <td align="center">
                            <?php if ($registro["lab_web"] != '')
                            { ?>
                                <a style="color:black;" href="<?php echo 'http://' . $registro["lab_web"]; ?>" target="_blank" title="Ir a la Web">
                                    <i class="fab fa-chrome fa-lg"></i>
                                </a>
                            <?php
                            } ?>
                        </td>
                        <td><?php echo $registro["lab_preventista"]; ?></td>
                        <td>
                            <div class="dropdown"> 
                                
                                <button type="button" class="btn btn-icon btn-xs btn-outline-purple dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-caret-down"></i>
                                </button> 
                                    
                                <div class="dropdown-menu"> 
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal_actualizar_laboratorio" onclick="EditarLaboratorio('<?php echo $datos; ?>')">
                                        <i class="far fa-edit"></i>
                                        <span>Editar</span>
                                    </a> 
                                    <a class="dropdown-item" href="#" onclick="EliminarLaboratorio('<?php echo $registro["lab_id"] . "||" . $registro["lab_nick"]; ?>')">
                                        <i class="far fa-trash-alt"></i>
                                        <span>Borrar</span>
                                    </a> 
                                </div> 
                            </div> 
                        </td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>

