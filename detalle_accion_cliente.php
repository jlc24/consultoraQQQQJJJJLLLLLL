        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=medicamento-->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#cliente').dataTable({
                    responsive: true,
                    columnDefs: [],
                    "lengthMenu": [10, 15, 20, 25],
                    "order": [[ 0,"desc" ]],
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
                var table = $('#cliente').DataTable();
                $('#cliente_filter input').focus();
            });
        </script>

        <!--=================================================
        =            CONEXION A LA BASE DE DATOS            =
        ==================================================-->
        <?php include('assets/inc/conexion.php'); ?>

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-actuado-tab" data-toggle="tab" data-target="#nav-actuado" type="button" role="tab" aria-controls="nav-actuado" aria-selected="true" style="border-style: solid; border-width: 1px; border-color: #F7B168; border-radius: 5px;">Acciones</button>
                <button class="nav-link" id="nav-audiencia-tab" data-toggle="tab" data-target="#nav-audiencia" type="button" role="tab" aria-controls="nav-audiencia" aria-selected="false" style="border-style: solid; border-width: 1px; border-color: #F7B168; border-radius: 5px;">Audiencias</button>
                
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent"  style="border-style: solid; border-width: 1px; border-color: #F7B168; border-radius: 5px;">
            <div class="tab-pane fade show active col-12" id="nav-actuado" role="tabpanel" aria-labelledby="nav-actuado-tab">
                <table class="table table-sm table-responsive-lg" style="border-style: solid; border-width: 1px; border-color: #F7B168; font-size: 12px; text-align: left;">
                    <thead class="text-center">
                        <tr style="background-color: #F7B168; color: #ffffff;">
                            <th width="200px">Fecha</th>
                            <th>Tareas realizadas</th>
                        </tr>
                    </thead>
                    <tbody style="border-style: solid; border-width: 1px; border-color: #F7B168;">
                    <?php
                    //OBTENEMOS EL ID DEL PRODUCTO, DE LA TABLA CONFIGURACION
                        function fechaletra($fecha){
                            $day = date('d',strtotime($fecha));
                            $month = date('m',strtotime($fecha));
                            $year = date('Y',strtotime($fecha));
                            $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                            $letra = $day.' de '.$meses[$month - 1].' de '.$year;
                            return $letra;
                        }
                        $sql3="SELECT * FROM hoja_detalle WHERE det_audiencia = '0000-00-00 00:00:00' AND hoja_id = (SELECT hoja_id FROM configuracion) ORDER BY det_inicio DESC;";
                        $resultado=mysqli_query($conexion,$sql3);
                        while($registro = mysqli_fetch_assoc($resultado)){
                            if (empty($registro)) {
                                echo "<tr><td>No tiene aun acciones iniciadas</td></tr>";
                            }else{
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php
                                
                                if ($registro['det_estado'] == 'EJECUCION') {
                                    
                                    echo fechaletra($registro['det_inicio']);
                                }elseif ($registro['det_estado'] == 'FINALIZADO') {
                                    echo fechaletra($registro['det_fin']);
                                }
                                ?>
                            </td>
                            <td style="text-align: center;"><?php 
                                if ($registro['det_estado'] == 'EJECUCION') {
                                    echo $registro['det_observacion'];
                                }elseif($registro['det_estado'] == 'FINALIZADO') {
                                    echo $registro['det_respuesta_encargado'];
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-audiencia" role="tabpanel" aria-labelledby="nav-audiencia-tab">
                <div class="tab-pane fade show active col-12" id="nav-actuado" role="tabpanel" aria-labelledby="nav-actuado-tab">
                    <table class="table table-sm table-responsive-lg" style="border-style: solid; border-width: 1px; border-color: #F7B168; font-size: 12px; text-align: left;">
                        <thead class="text-center">
                            <tr style="background-color: #F7B168; color: #ffffff;">
                                <th width="50px">Tipo</th>
                                <th width="100px">Fecha</th>
                                <th width="100px">Juzgado</th>
                                <th width="50px">Hora</th>
                                
                                <th width="50px">Estado</th>
                                
                                <th>Observaciones</th>
                            </tr>
                        </thead>
                        <tbody style="border-style: solid; border-width: 1px; border-color: #F7B168;">
                        <?php
                        //OBTENEMOS EL ID DEL PRODUCTO, DE LA TABLA CONFIGURACION
                            $sql4="SELECT det_observacion, det_audiencia, hoja_area_proceso, hoja_patrocinio, cli_id, det_juzgado, det_lugar_juzgado, det_estado, det_respuesta_encargado 
                                    FROM hoja_detalle, hoja 
                                    WHERE hoja_detalle.hoja_id = hoja.hoja_id AND det_audiencia != '0000-00-00 00:00:00' AND hoja_detalle.hoja_id =( SELECT hoja_id FROM configuracion ) ORDER BY det_inicio DESC;";
                            $result=mysqli_query($conexion,$sql4);
                            while($reg = mysqli_fetch_assoc($result)){
                                if (empty($reg)) {
                                    echo "<tr><td>No tiene audiencias programadas ni finalizadas</td></tr>";
                                }else{
                        ?>
                                <tr style="text-align: center;">
                                    <td><?php echo $reg['det_observacion']; ?></td>
                                    <td><?php 
                                        $datoau = $reg['det_audiencia'];
                                        $day = date('d',strtotime($datoau));
                                        $month = date('m',strtotime($datoau));
                                        $year = date('Y',strtotime($datoau));
                                        $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                                        echo $day.' de '.$meses[$month - 1].' de '.$year;?>
                                    </td>
                                    <td><?php 
                                        echo $reg['det_lugar_juzgado']."<br>".$reg['det_juzgado'];
                                        ?>
                                    </td>
                                    <td><?php 
                                        $datoau = $reg['det_audiencia'];
                                        $hora = date('H:i:s',strtotime($datoau)); 
                                        echo $hora; ?>
                                    </td>
                                    
                                    <td><?php 
                                        if ($reg['det_estado'] == 'EJECUCION') {
                                            echo "Audiencia<br>Programada";
                                        }else {
                                            echo "Audiencia ".$reg['det_estado'];
                                        }
                                     ?>
                                    </td>
                                    <td><?php echo $reg['det_respuesta_encargado']; ?></td>
                                </tr>
                        <?php
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>

