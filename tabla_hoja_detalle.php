        <!-- Inicializamos el DataTable -->
        <script type="text/javascript">
            $(document).ready(function() {
                var table = $("#hoja_ruta_historial").DataTable({
                    keys: !0,
                    "lengthMenu":[10,20,50,100],
                    "order": [[ 1,"asc" ]],//ORDERNAR ASCENDENTEMENTE POR EL NUMERO DE DIAS
                    dom: 'Bfrtilp',
                    buttons:[
                        {
                            extend:    'excelHtml5',
                            text:      '<i class="fas fa-file-excel"><br>EXCEL</i>',
                            titleAttr: 'Exportar a Excel',
                            className: 'btn btn-success',
                            exportOptions: {
                                columns: [ 1, 2, 3, 4 ]
                            }
                        },
                        {
                            extend:    'pdfHtml5',
                            text:      '<i class="fas fa-file-pdf"><br>PDF</i>',
                            titleAttr: 'Exportar a PDF',
                            className: 'btn btn-danger',
                            exportOptions: {
                                columns: [ 1, 2, 3, 4 ]
                            }
                        },
                        {
                            extend:    'print',
                            text:      '<i class="fa fa-print"><br>PRINT</i>',
                            titleAttr: 'Imprimir',
                            className: 'btn btn-info',
                            exportOptions: {
                                columns: [ 1, 2, 3, 4 ]
                            }
                        },
                        
                    ],
                    responsive: true,
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
        <?php include('assets/inc/conexion.php');
            session_start();
            if (!isset($_SESSION['adm_id'])) {
                header('Location: login.php');
            }
            $admid = $_SESSION['adm_id'];
        ?>

        <!-- <table id="datatable_producto" class="table table-sm table-bordered dt-responsive nowrap"> -->
        <table id="hoja_ruta_historial" class="table mb-0 table-sm table-bordered dt-responsive" width="100%">
            <thead>
                <tr>
                    <th hidden>ID</th>
                    <th data-priority="1" width="200px">Proceso</th>
                    <th data-priority="1">Trámite</th>
                    <th data-priority="2">Cliente</th>
                    <th data-priority="3">Detalle</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql="SELECT hoja_id, hoja_demandante, hoja_demandado, hoja_patrocinio, hoja_tipo_proceso, proceso_nombre FROM hoja, proceso WHERE hoja.hoja_area_proceso = proceso.proceso_nombre AND proceso.proceso_id = (SELECT hoja_id FROM configuracion) ORDER BY hoja_numero_tramite DESC;";
                    $resultado=mysqli_query($conexion,$sql);
                    while($registro = mysqli_fetch_assoc($resultado)){ ?>
                        <tr>
                            <td hidden><?php echo $registro['hoja_id'] ?></td>
                            <td><?php echo $registro['proceso_nombre'] ?></td>
                            <td><?php echo $registro['hoja_numero_tramite']; ?></td>
                            <td><?php 
                                if ($registro['hoja_patrocinio'] == 'VICTIMA' || $registro['hoja_patrocinio'] == 'DEMANDANTE' || $registro['hoja_patrocinio'] == 'DENUNCIANTE') {
                                    echo $registro['hoja_demandante'];
                                }elseif ($registro['hoja_patrocinio'] == 'IMPUTADO' || $registro['hoja_patrocinio'] == 'DEMANDADO' || $registro['hoja_patrocinio'] == 'DENUNCIADO') {
                                    echo $registro['hoja_demandado'];
                                }elseif ($registro['hoja_patrocinio'] == 'RECURRENTE') {
                                    echo $registro['hoja_demandante'];
                                }elseif ($registro['hoja_patrocinio'] == 'ADMINISTRADO') {
                                    echo $registro['hoja_demandante'];
                                } ?>
                            </td>
                            <td><?php echo $registro['hoja_tipo_proceso']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
            </tbody>
        </table>