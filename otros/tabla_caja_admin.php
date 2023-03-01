<?php
include("assets/inc/conexion.php");

session_start();
if (!isset($_SESSION['adm_id'])) {
	header('Location: login.php');
}

$adm_id = $_SESSION['adm_id'];
?>
        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=detalle-->
        <script type="text/javascript">
            var table = $(document).ready(function() {
                $('#detalle_tabla').dataTable({
                    "paging": false,
                    "searching": false,
                    "order": [[0, "desc"]],
                    "info": false,
                    "oLanguage": {
                        "sEmptyTable": "Ningúna caja abierta para el administrador"
                    } //Para DataTables >=1.10
                });
            });
        </script>
        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=detalle-->
        <div class="col-sm-12">
            <div class="table-responsive">
                <table id="detalle_tabla" class="table-condensed dt-responsive" width="100%">
                    <thead>
                        <th data-priority="1">Id</th>
                        <th data-priority="2">Administrador</th>
                        <th data-priority="3">Fecha Apertura</th>
                        <th data-priority="5">Fecha Cierre</th>
                        <th data-priority="4">Monto Inicial</th>
                        <th data-priority="6">Monto Final</th>
                        <th data-priority="8">Cambio</th>
                        <th data-priority="7">Op.</th>
                    </thead>
                    <tbody>
                    <?php

                        //$sql="SELECT * FROM caja";
                        //SELECT * FROM caja WHERE DATE_FORMAT(caja_fecha_apertura,'%Y/%m/%d')=CURDATE(); reporte del dia de hoy
                        //$sql="SELECT * FROM caja WHERE DATE_FORMAT(caja_fecha_cierre,'%Y/%m/%d') BETWEEN (CURDATE() - INTERVAL 1 DAY) and (CURDATE() + INTERVAL 1 DAY )";
                        $sql="SELECT * FROM caja ORDER BY caja_id DESC LIMIT  15";
                        $resultado=mysqli_query($conexion,$sql);
                        while($registro = mysqli_fetch_assoc($resultado)){
                            $datos=$registro['caja_id']."||".$registro['adm_id']."||".$registro['caja_administrador']."||".$registro['caja_fecha_apertura']."||".
                            $registro['caja_monto_inicial']."||".$registro['caja_fecha_cierre']."||".$registro['caja_monto_final']."||".$registro['caja_estado']."||".$registro['caja_cambio'];

                     ?>

                        <tr>
                            <td><?php echo $registro['caja_id']; ?></td>
                            <td><?php echo $registro['caja_administrador']; ?></td>
                            <td><?php echo $registro['caja_fecha_apertura']; ?></td>
                            <td><?php echo $registro['caja_fecha_cierre']; ?></td>
                            <td><?php echo 'Bs '.$registro['caja_monto_inicial']; ?></td>
                            <td><?php echo 'Bs '.$registro['caja_monto_final']; ?></td>
                            <td><?php echo $registro['caja_cambio']; ?></td>
                            <td>
                                <?php if( $registro['caja_estado']=='0'){ ?>
                                    <!-- HTML here CAJA CERRADA-->
                                    <a style="color:#ff0000; font-size:20px" href="#" title='Caja Cerrada'>
                                        <i class="icon-lock"></i>
                                    </a>&nbsp;
                                    <!--<a style="color:#230443; font-size:20px" href="#" title='Reporte Caja' onclick="EliminarDetalle('<?php echo $registro['det_id']."||".$registro['det_cantidad']."||".$registro['prod_id']; ?>')">
                                         id_detalle, cant. a sumar al stock actual, id_producto 
                                        <i class="icon-printer"></i>-->
                                    </a>
                                <?php } ?>
                                <?php if( $registro['caja_estado']=='1'){ ?>
                                    <!-- HTML here CAJA ABIERTA-->
                                    <a style="color:#008f39; font-size:20px" href="#" data-toggle="modal" data-target="#modal_cerrar_caja" title='Cerrar Caja' onclick="CerrarCaja('<?php echo $registro['caja_id']; ?>')">
                                        <i class="icon-lock-open"></i>
                                    </a>&nbsp;
                                    <!--<a style="color:#230443; font-size:20px" href="#" title='Reporte Caja' onclick="EliminarDetalle('<?php echo $registro['det_id']."||".$registro['det_cantidad']."||".$registro['prod_id']; ?>')">
                                         id_detalle, cant. a sumar al stock actual, id_producto 
                                        <i class="icon-printer"></i>
                                    </a>-->
                                <?php } ?>
                            </td>
                        </tr>

                    <?php
                                                                }
                    ?>
                    </tbody>

                </table>
            </div>
        </div>
