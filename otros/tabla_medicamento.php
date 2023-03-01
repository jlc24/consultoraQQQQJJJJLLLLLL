        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=medicamento-->
        <script type="text/javascript">
            $(document).ready(function (){
                var table = $('#medicamento').dataTable({
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
                //MUESTRA LA Version DE NUESTRO DataTable
                //var versionNo = $.fn.dataTable.version;
                //alert(versionNo);
                //var table = $('#medicamento').DataTable();
                $('#medicamento_filter input').focus();
            });
        </script>

        <!--=================================================
        =            CONEXION A LA BASE DE DATOS            =
        ==================================================-->
        <?php include('assets/inc/conexion.php'); ?>
        <!--====  End of CONEXION A LA BASE DE DATOS  ====-->

        <!--<h4 class="header-title">Buttons example</h4>
        <p class="sub-header">
            The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
        </p>-->

        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=medicamento-->
        <table id="medicamento" class="table mb-0 table-sm table-striped display responsive no-wrap" style="width: 100%;">
            <thead style="background-color: #DBEDC8;">
                <th data-priority="1">Código</th>
                <th data-priority="2">Nombre Comercial</th>
                <th data-priority="7">Categoria Terapéutica</th>
                <th data-priority="5">Forma</th>
                <th data-priority="6">Laboratorio</th>
                <th data-priority="8">Caducidad</th>
                <th data-priority="9">Stock</th>
                <!--<th class="none">P.Compra</th>-->
                <th data-priority="3">P.Venta</th>
                <th data-priority="4">Op.</th>
            </thead>
            <tbody>
            <?php
                $sql="SELECT *FROM producto";
                $resultado=mysqli_query($conexion,$sql);
                while($registro = mysqli_fetch_assoc($resultado)){
                    $datos=$registro['prod_id']."||".$registro['prod_nombre_comercial']."||".$registro['prod_propaganda']."||".$registro['prod_forma']."||".$registro['prod_principio_activo']."||".$registro['prod_nicklaboratorio']."||".$registro['prod_codigo']."||".$registro['prod_stock_minimo']."||".$registro['prod_ubicacion']."||".$registro['prod_fecha_vencimiento']."||".$registro['prod_stock']."||".$registro['prod_precio_compra']."||".$registro['prod_precio_venta'];
             ?>

                <tr>
                    <td><?php echo $registro['prod_codigo']; ?></td>
                    <td><?php echo $registro['prod_nombre_comercial']; ?></td>
                    <td><?php echo $registro['prod_propaganda']; ?></td>
                    <td><?php echo $registro['prod_forma']; ?></td>
                    <td><?php echo $registro['prod_nicklaboratorio']; ?></td>
                    <!-- Fecha de vencimiento -->
                    <td>
                        <?php
                            //echo date_format(date_create($registro['prod_fecha_vencimiento']), 'd/m/Y');
                            $fecha_actual= date("Y-m-d");
                            //echo $fecha_actual;
                            $fecha_vencimiento = date_create($registro['prod_fecha_vencimiento']);
                            $fecha_final = date_format($fecha_vencimiento,'Y-m-d');
                            //echo "<br>".$fecha_final;
                            $diferencia = (strtotime($fecha_final) - strtotime($fecha_actual)) / 60 / 60 / 24;
                            $numero = (int)$diferencia;
                            //echo "<br>".$numero."<br>";
                            if($diferencia>181){//si al producto tiene mas de 180 dias de vigencias no se colorea
                                $fecha = date_create("2020-12-13"); echo date_format($fecha, 'd-m-Y');
                            }
                            elseif($diferencia>90){//si al producto tiene mas de 90 dias de vigencias no se colorea verde
                                $fecha = date_format($fecha_vencimiento,'d-m-Y');
                                echo "<font color=\"green\"><b>$fecha</b></font>";
                            }
                            elseif($diferencia>-1){//si al producto tiene mas de 0 dias de vigencias no se colorea amarillo
                                $fecha = date_format($fecha_vencimiento,'d-m-Y');
                                echo "<font color=\"orange\"><b>$fecha</b></font>";
                            }
                            else{//Aqui la diferencia ya es negativa, y el producto ya vencio entonces se colorea rojo
                                $fecha = date_format($fecha_vencimiento,'d-m-Y');
                                echo "<font color=\"red\"><b>$fecha</b></font>";
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            $stock = (int)$registro['prod_stock'];
                            $stock_minimo = (int)$registro['prod_stock_minimo'];
                            if($stock<=$stock_minimo ){//medicamentos menores o iguales a su stock minino se muestran en color rojo...
                                /*echo "<font color='red'><strong>$registro['prod_stock_minimo']</strong></font>";*/
                                echo $registro['prod_stock'];
                            }
                            else{
                                echo $registro['prod_stock'];
                            }
                        ?>
                    </td>
                    <!--<td><?php //echo "Bs. ".$registro['prod_ubicacion']; ?></td>-->
                    <td><?php echo "Bs. ".$registro['prod_precio_venta']; ?></td>
                    <td>
                        <div class="dropup dropleft">
                            <button type="button" class="btn btn-icon btn-xs btn-outline-purple dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-caret-down"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a href="javascript:void(0);" class="dropdown-item" title="Editar"  data-toggle="modal" data-target="#modal_editar_medicamento" onclick="EditarMedicamento('<?php echo $datos; ?>')">
                                    <i class="far fa-edit"></i>
                                    <span>Editar</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item" title="Eliminar" onclick="EliminarMedicamento('<?php echo $registro['prod_id']."||".$registro['prod_nombre_comercial']; ?>')">
                                    <i class="far fa-trash-alt"></i>
                                    <span>Borrar</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item" title="Abastecer" data-toggle="modal" data-target="#modal_abastecer_medicamento" onclick="AbastecerMedicamento('<?php echo $registro['prod_id'].'||'.$registro['prod_nombre_comercial'].'||'.$registro['prod_fecha_vencimiento'].'||'.$registro['prod_stock']; ?>')">
                                    <i class="fas fa-shopping-bag"></i>
                                    <span>Abastecer</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item" title="Historial" data-toggle="modal" data-target="#modal_historial_compra" onclick="HistorialMedicamento('<?php echo $registro['prod_id'].'||'.$registro['prod_nombre_comercial']; ?>')">
                                    <i class="fas fa-list-ol"></i>
                                    <span>Historial</span>
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

