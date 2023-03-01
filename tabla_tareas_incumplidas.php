        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=medicamento-->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#tincumplidas').dataTable({
                    responsive: true,
                    columnDefs: [],
                    "lengthMenu": [15, 25, 50, 100],
                    "order": [[ 0,"desc" ]],//ORDERNAR ASCENDENTEMENTE POR EL NUMERO DE DIAS
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
                var table = $('#tincumplidas').DataTable();
                $('#tincumplidas_filter input').focus();
            });
        </script>

        <!--=================================================
        =            CONEXION A LA BASE DE DATOS            =
        ==================================================-->
        <?php include('assets/inc/conexion.php');
            session_start();
            if (!isset($_SESSION['adm_id'])) {
                header('Location: login.php');
            }
            $admid = $_SESSION['adm_id'];
        ?>

        <table id="tincumplidas" class="table mb-0 table-sm table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead style="background-color: #DBEDC8;">
                <th data-priority="1">ID</th>
                <th data-priority="1">Nº Trámite</th>
                <th data-priority="1">Cliente</th>
                <th data-priority="1">Patrocinio</th>
                <th data-priority="1">Tipo Proceso</th>
                <th class="none">Etapa Proceso: </th>
                <th data-priority="1">Acción</th>
                <th class="none">Inicio Acción: </th>
                <th class="none">Fin Acción: </th>
                <th data-priority="1">Estado</th>
                <th class="none">Encargado a: </th>
                <th class="none">Registrado por:</th>
                <th class="none">Observacion:</th>
                <th class="none">Archivo adjunto:</th>
                <th data-priority="2">Op.</th>
            </thead>
            <tbody>
                <?php
                
                $sql = "SELECT `det_id`,`hoja_numero_tramite`,`hoja_demandante`,`hoja_demandado`,`hoja_patrocinio`,
                                `hoja_tipo_proceso`,`det_etapa`,`det_accion`,`det_inicio`,`det_fin`,`det_estado`, `det_encargado`, `enc_reg`, `det_audiencia`, det_observacion, det_envio_ruta_file 
                        FROM hoja_detalle JOIN hoja 
                        WHERE hoja_detalle.hoja_id = hoja.hoja_id AND NOW() > det_fin AND det_estado = 'EJECUCION' AND det_encargado = '".$admid."';";
                $resultado = mysqli_query($conexion, $sql);
                while ($registro = mysqli_fetch_assoc($resultado))
                {
                    if ($registro['hoja_patrocinio'] == 'DEMANDANTE' || $registro['hoja_patrocinio'] == 'VICTIMA' || $registro['hoja_patrocinio'] == 'RECURRENTE' || $registro['hoja_patrocinio'] == 'ADMINISTRADO' || $registro['hoja_patrocinio'] == 'DENUNCIANTE'){
                        $cliente = $registro["hoja_demandante"];
                    }else {
                        $cliente = $registro["hoja_demandado"];
                    }
                    
                ?>
                    <tr>
                        <td><?php echo $registro["det_id"]; ?></td>
                        <td><?php echo $registro["hoja_numero_tramite"]; ?></td>
                        <td><?php 
                        if ($registro['hoja_patrocinio'] == 'DEMANDANTE' || $registro['hoja_patrocinio'] == 'VICTIMA' || $registro['hoja_patrocinio'] == 'RECURRENTE' || $registro['hoja_patrocinio'] == 'ADMINISTRADO' || $registro['hoja_patrocinio'] == 'DENUNCIANTE'){
                            echo $registro["hoja_demandante"];
                        }else {
                            echo $registro["hoja_demandado"];
                        }
                        ?></td>
                        <td><?php echo $registro["hoja_patrocinio"]; ?></td>
                        <td><?php echo $registro["hoja_tipo_proceso"]; ?></td>
                        <td><?php echo $registro["det_etapa"]; ?></td>
                        <td><?php echo $registro["det_accion"]; ?></td>
                        <td><?php echo $registro["det_inicio"]; ?></td>
                        <td><?php echo $registro["det_fin"]; ?></td>
                        <td align="center"><?php
                            $hoy = strtotime(date('Y-m-d H:i:s', time()));
                            $evento = strtotime($registro['det_fin']);
                            if ($hoy > $evento) {
                                echo "<span class='badge badge-pill badge-danger'>FUERA DE TIEMPO</span></br>";
                                echo "<span class='badge badge-pill badge-danger'>".$registro['det_estado']."</span>";
                            }else {
                                echo "<span class='badge badge-pill badge-info'>".$registro['det_estado']."</span>";
                            }
                            ?>
                        </td>
                        <td><?php 
                            $sql1 = "SELECT adm_nombre FROM administrador WHERE adm_id = '".$registro['det_encargado']."';";
                            $result1 = mysqli_query($conexion,$sql1);
                            $res1 = mysqli_fetch_assoc($result1);
                            echo $res1['adm_nombre']; ?></td>
                        <td><?php 
                            $sql2 = "SELECT adm_nombre FROM administrador WHERE adm_id = '".$registro['enc_reg']."';";
                            $result2 = mysqli_query($conexion,$sql2);
                            $res2 = mysqli_fetch_assoc($result2);
                            echo $res2['adm_nombre']; ?></td>
                        <td><?php echo $registro['det_observacion']; ?></td>
                        <td><?php
                                if ($registro['det_envio_ruta_file'] == '') {
                                    echo "No hay archivos adjuntos";
                                }else {?>
                                    <a type="button" class="btn btn-success btn-sm" href="<?php echo $registro['det_envio_ruta_file']; ?>" target="_blank" rel="noreferrer noopener">Descargar Archivo</a>
                            <?php   
                                }
                            ?>
                        </td>
                        <td><?php 
                        if ($registro['det_encargado'] == $admid) { ?>
                            <a style="color:black;" href="javascript:void(0);" class='btnEditarEventoHojaPendiente' title="Finalizar Accion">
                                <i style="color: purple; --darkreader-inline-color:#230443; font-size:20px;" class="fas fa-envelope"></i>
                            </a>
                        <?php 
                        }else { ?>
                            <a style="color:black;" href="javascript:void(0);" class='btnVerEventoHojaPendiente' title="Ver Accion Pendiente">
                                <i style="color: purple; --darkreader-inline-color:#230443; font-size:20px;" class="fas fa-envelope"></i>
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

