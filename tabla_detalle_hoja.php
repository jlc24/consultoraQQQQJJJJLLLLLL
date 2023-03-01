        <!-- Inicializamos el DataTable -->
        <script type="text/javascript">
            $(document).ready(function() {
                var table = $("#datatable_hoja_historial").DataTable({
                    keys: !0,
                    "lengthMenu":[5,10],
                    "order": [[ 0,"desc" ]],//ORDERNAR ASCENDENTEMENTE POR EL NUMERO DE DIAS
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
        <table id="datatable_hoja_historial" class="table mb-0 table-sm table-bordered dt-responsive" width="100%">
            <thead>
                <tr>
                    <th data-priority="1">ID</th>
                    <th data-priority="2">Etapa</th>
                    <th data-priority="3">Acción</th>
                    <th class="none">Inicio: </th>
                    <th class="none">Fin: </th>
                    <th data-priority="4">Estado</th>
                    <th class="none">Fecha Audiencia: </th>
                    <th class="none">Observación: </th>
                    <th data-priority="7">Encargado de la Acción</th>
                    <th class="none">Obs. Encargado: </th>
                    <th class="none">Archivo Adjunto: </th>
                    <th data-priority="1">Op</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //OBTENEMOS EL ID DEL PRODUCTO, DE LA TABLA CONFIGURACION
                    $sql="SELECT * FROM hoja_detalle WHERE hoja_id = (SELECT hoja_id FROM configuracion) ORDER BY det_id DESC;";
                    $resultado=mysqli_query($conexion,$sql);
                    while($registro = mysqli_fetch_assoc($resultado)){
                ?>
                    <tr>
                        <td><?php echo $registro['det_id']; ?></td>
                        <td><?php echo $registro['det_etapa']; ?></td>
                        <td><?php echo $registro['det_accion']; ?></td>
                        <td><?php echo $registro['det_inicio']; ?></td>
                        <td><?php echo $registro['det_fin']; ?></td>
                        <td align="center"><?php
                            $hoy = strtotime(date('Y-m-d H:i:s', time()));
                            $evento = strtotime($registro['det_fin']);
                            if ($hoy > $evento && $registro['det_estado'] == 'EJECUCION') {
                                echo "<span class='badge badge-pill badge-danger'>FUERA DE TIEMPO</span></br>";
                                echo "<span class='badge badge-pill badge-danger'>".$registro['det_estado']."</span>";
                            }elseif ($registro['det_estado'] == 'FINALIZADO') {
                                echo "<span class='badge badge-pill badge-success'>".$registro['det_estado']."</span>";
                            }else {
                                echo "<span class='badge badge-pill badge-info'>".$registro['det_estado']."</span>";
                            }
                            ?>
                        </td>
                        <td><?php 
                            if ($registro['det_audiencia'] == '0000-00-00 00:00:00') {
                                echo 'Sin fecha de Audiencia';
                            }else {
                                echo $registro['det_audiencia']; 
                            }
                        ?></td>
                        <td><?php echo $registro['det_observacion']; ?></td>
                        <td><?php $sql1="SELECT adm_nombre FROM administrador WHERE administrador.adm_id = '".$registro['det_encargado']."';";
                                  $res = mysqli_query($conexion,$sql1);
                                  $res2 = mysqli_fetch_assoc($res);
                                  echo $res2['adm_nombre']; ?></td>
                        <td><?php echo $registro['det_respuesta_encargado']; ?></td>
                        <td><?php
                                if ($registro['det_estado'] == 'EJECUCION') {
                                    if ($registro['det_envio_ruta_file'] == '') {
                                        echo "No hay archivos adjuntos";
                                    }else {?>
                                        <a type="button" class="btn btn-success btn-sm" href="<?php echo $registro['det_envio_ruta_file']; ?>" target="_blank" rel="noreferrer noopener">Archivo Envio</a>
                                <?php   
                                    }
                                }elseif ($registro['det_estado'] == 'FINALIZADO' && $registro['det_envio_ruta_file'] != '') { ?>
                                    <a type="button" class="btn btn-success btn-sm" href="<?php echo $registro['det_envio_ruta_file']; ?>" target="_blank" rel="noreferrer noopener">Archivo Envio</a>
                                    <a type="button" class="btn btn-success btn-sm" href="<?php echo $registro['det_recepcion_ruta_file']; ?>" target="_blank" rel="noreferrer noopener">Archivo Respuesta</a>
                            <?php 
                                }elseif ($registro['det_estado'] == 'FINALIZADO' && $registro['det_envio_ruta_file'] == '' && $registro['det_recepcion_ruta_file'] != '') { ?>
                                    <a type="button" class="btn btn-success btn-sm" href="<?php echo $registro['det_recepcion_ruta_file']; ?>" target="_blank" rel="noreferrer noopener">Archivo Respuesta</a>
                            <?php 
                                }else {
                                    echo "No hay archivos adjuntos";
                                }
                            ?>
                        </td>
                        <td><?php
                            $hoy = strtotime(date('Y-m-d H:i:s', time()));
                            $evento = strtotime($registro['det_fin']);
                            if ($registro['det_estado'] == 'EJECUCION' && $hoy < $evento &&  $registro['enc_reg'] == $admid) {?>
                                <a style="color:black;" href="javascript:void(0);" class='btnEditarAccion' title="Editar Accion">
                                    <i style="color: purple; --darkreader-inline-color:#230443; font-size:20px;" class="far fa-edit"></i>
                                </a>
                                <a style="color:black;" href="javascript:void(0);" title="Eliminar Accion" class='btnBorrarAccion'>
                                    <i style="color: purple; --darkreader-inline-color:#230443; font-size:20px;" class="far fa-trash-alt"></i>
                                </a>
                            <?php
                            }elseif ($registro['det_estado'] == 'EJECUCION' && $hoy < $evento && $registro['det_encargado'] == $admid && $registro['enc_reg'] != $admid) { ?>
                                <a style="color:black;" href="javascript:void(0);" class='btnEditarAccion' title="Editar Accion">
                                    <i style="color: purple; --darkreader-inline-color:#230443; font-size:20px;" class="far fa-edit"></i>
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