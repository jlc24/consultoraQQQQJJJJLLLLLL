<?php
include("assets/inc/conexion.php");
session_start();
if (!isset($_SESSION['adm_id'])) {
    header('Location: login.php');
}

$adm_id = $_SESSION['adm_id'];
$sql = "SELECT adm_id, adm_nombre, adm_area FROM administrador WHERE adm_id = '$adm_id'";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'assets/inc/head.php'; ?>
</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <?php include 'assets/inc/topbar.php'; ?>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <?php include 'assets/inc/left_sidebar.php'; ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <!-- start page title -->
                    <?php 
                        $sql1 = "SELECT adm_id, adm_nombre, adm_area FROM administrador WHERE adm_id = '$adm_id'";
                        $resultado1 = $conexion->query($sql1);
                        $row1 = $resultado1->fetch_assoc(); 
                    ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    
                                </div>
                                <h4 class="page-title">Panel de Control</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!--========================================
                        =            Contenido Principal           =
                        =========================================-->
                    <div class="row">

                        <!--==============================================================================
                        =   MODAL PARA VER EL DETALLE DE TODOS LOS PRODUCTOS DE UNA DETERMINADA FACTURA  =
                        ===============================================================================-->
                        <div id="modal_detalle_factura" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">DETALLE DE PRODUCTOS DE LA NOTA DE VENTA  Nº
                                            <span id="numero_factura">
                                            </span>
                                        </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row" id="tabla_factura_detalle">
                                        </div>
                                    </div>
                                    <!-- <div class="modal-footer"></div> -->
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <!--===========================================================================
                        =   MODAL PARA VER EL DETALLE DE TODOS LOS PRODUCTOS DE LA BOLETA A IMPRIMIR  =
                        ============================================================================-->
                        <div id="modal_detalle_boleta" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">IMPRESIÓN DE LA NOTA DE VENTA  Nº
                                            <span id="numero_boleta">
                                            </span>
                                        </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row" id="tabla_boleta_detalle">
                                        </div>
                                    </div>
                                    <!-- <div class="modal-footer"></div> -->
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <div class="col-xl-3 col-sm-6">
                            <div class="card-box widget-box-two widget-two-custom">
                                <div class="media">
                                    <div class="avatar-lg bg-icon rounded-circle align-self-center">
                                        <img class="avatar-md" src="assets/images/icons/calendar.svg" title="calendar.svg">
                                    </div>

                                    <div class="wigdet-two-content media-body">
                                        <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Reuniones</p>
                                        <h3 class="font-weight-medium my-2">
                                            <span data-plugin="counterup">
                                                <?php //include('assets/inc/conexion.php');
                                                $filas = mysqli_fetch_row(mysqli_query($conexion, "SELECT SUM(fac_total) FROM factura"));
                                                echo (int)$filas[0]; ?>
                                            </span>
                                        </h3>
                                        <p class="m-0">Ene - Dic <?php echo date("Y"); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->

                        <div class="col-xl-3 col-sm-6">
                            <div class="card-box widget-box-two widget-two-custom ">
                                <div class="media">
                                    <div class="avatar-lg bg-icon rounded-circle align-self-center">
                                        <img class="avatar-md" src="assets/images/icons/businessman.svg" title="businessman.svg">
                                    </div>

                                    <div class="wigdet-two-content media-body">
                                        <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Clientes</p>
                                        <h3 class="font-weight-medium my-2">
                                            <span data-plugin="counterup">
                                                <?php $sql = "SELECT COUNT(*) FROM cliente";
                                                $resultado = mysqli_query($conexion, $sql);
                                                $filas = mysqli_fetch_row($resultado);
                                                $total = (int)$filas[0];
                                                echo $total; ?>
                                            </span>
                                        </h3>
                                        <p class="m-0">Ene - Dic <?php echo date("Y"); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->

                        <div class="col-xl-3 col-sm-6">
                            <div class="card-box widget-box-two widget-two-custom ">
                                <div class="media">
                                    <div class="avatar-lg bg-icon rounded-circle align-self-center">
                                        <img class="avatar-md" src="assets/images/icons/contacts.svg" title="contacts.svg">
                                    </div>

                                    <div class="wigdet-two-content media-body">
                                        <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Hojas de Ruta</p>
                                        <h3 class="font-weight-medium my-2">
                                            <span data-plugin="counterup">
                                                <?php $sql = "SELECT COUNT(*) FROM hoja";
                                                $resultado = mysqli_query($conexion, $sql);
                                                $filas = mysqli_fetch_row($resultado);
                                                echo number_format($filas[0]); ?>
                                            </span>
                                        </h3>
                                        <p class="m-0">Ene - Dic <?php echo date("Y"); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->

                        <div class="col-xl-3 col-sm-6">
                            <div class="card-box widget-box-two widget-two-custom ">
                                <div class="media">
                                    <div class="avatar-lg bg-icon rounded-circle align-self-center">
                                        <img class="avatar-md" src="assets/images/icons/customer_support.svg" title="customer_support.svg">
                                    </div>

                                    <div class="wigdet-two-content media-body">
                                        <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Administradores</p>
                                        <h3 class="font-weight-medium my-2">
                                            <span data-plugin="counterup">
                                                <?php $sql = "SELECT COUNT(*) FROM administrador";
                                                $resultado = mysqli_query($conexion, $sql);
                                                $filas = mysqli_fetch_row($resultado);
                                                $total = (int)$filas[0];
                                                echo $total; ?>
                                            </span>
                                        </h3>
                                        <p class="m-0">Ene - Dic <?php echo date("Y"); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <?php
                        if ($_SESSION['adm_id'] == '1' || $_SESSION['adm_id'] == '2' || $_SESSION['adm_id'] == '8' || $_SESSION['adm_id'] == '9') { ?>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12">
                                    <div class="card-box">
                                        <ul class="nav nav-tabs nav-justified">
                                            <li class="nav-item active" role="presentation">
                                                <a href="#tabla_notificaciones" data-toggle="tab" aria-expanded="true" class="nav-link active" >
                                                    
                                                    <span class="d-none d-sm-block">NOTIFICACIONES <span data-plugin="counterup">
                                                        <?php
                                                    $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND det_encargado = '".$_SESSION['adm_id']."';";
                                                    $resultado = mysqli_query($conexion, $sql);
                                                    $filas = mysqli_fetch_row($resultado);
                                                    $total = (int)$filas[0];
                                                    echo $total; ?>
                                                </span> </span>
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a href="#tabla_tasignada" data-toggle="tab" aria-expanded="true" class="nav-link" >
                                                    <span class="d-block d-sm-none">Tareas asignadas</i></span>
                                                    <span class="d-none d-sm-block">TAREAS ASIGNADAS</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a href="#tabla_finalizado" data-toggle="tab" aria-expanded="false" class="nav-link" >
                                                    <span class="d-block d-sm-none">Finalizada</span>
                                                    <span class="d-none d-sm-block">TODAS LAS TAREAS</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a href="#tabla_tincumplida" data-toggle="tab" aria-expanded="false" class="nav-link" >
                                                    <span class="d-block d-sm-none">Tareas incumplidas</span>
                                                    <span class="d-none d-sm-block">TARES INCUMPLIDAS</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="tabla_notificaciones">
                                                
                                            </div>
                                            <div class="tab-pane fade" id="tabla_tasignada">

                                            </div>
                                            <div class="tab-pane fade" id="tabla_finalizado_adm">

                                            </div>
                                            <div class="tab-pane fade" id="tabla_tincumplidas">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                        }elseif ($row1['adm_area'] == 'JURIDICA') { ?>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12">
                                    <div class="card-box">
                                        <ul class="nav nav-tabs nav-justified">
                                            <li class="nav-item active" role="presentation">
                                                <a href="#tabla_notificaciones" data-toggle="tab" aria-expanded="true" class="nav-link active" >
                                                    
                                                    <span class="badge badge-warning" data-plugin="counterup">
                                                            <?php
                                                        $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                        $resultado = mysqli_query($conexion, $sql);
                                                        $filas = mysqli_fetch_row($resultado);
                                                        $total = (int)$filas[0];
                                                        echo $total; ?>
                                                    </span>
                                                    <span> NOTIFICACIONES</span>    
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a href="#tabla_tasignada" data-toggle="tab" aria-expanded="true" class="nav-link" >
                                                    <span class="badge badge-success" data-plugin="counterup">
                                                        <?php
                                                        $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_estado = 'EJECUCION' AND NOW() < det_fin AND det_encargado = '".$_SESSION['adm_id']."';";
                                                        $resultado = mysqli_query($conexion, $sql);
                                                        $filas = mysqli_fetch_row($resultado);
                                                        $total = (int)$filas[0];
                                                        echo $total; ?>
                                                    </span>
                                                    <span>TAREAS ASIGNADAS</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a href="#tabla_all_tareas" data-toggle="tab" aria-expanded="false" class="nav-link" >
                                                    <span class="badge badge-info" data-plugin="counterup">
                                                        <?php
                                                        $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_encargado = '".$_SESSION['adm_id']."';";
                                                        $resultado = mysqli_query($conexion, $sql);
                                                        $filas = mysqli_fetch_row($resultado);
                                                        $total = (int)$filas[0];
                                                        echo $total; ?>
                                                    </span>
                                                    <span>TODAS LAS TAREAS</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a href="#tabla_tincumplida" data-toggle="tab" aria-expanded="false" class="nav-link" >
                                                    <span class="badge badge-danger" data-plugin="counterup">
                                                        <?php
                                                        $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND NOW() > det_fin AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                        $resultado = mysqli_query($conexion, $sql);
                                                        $filas = mysqli_fetch_row($resultado);
                                                        $total = (int)$filas[0];
                                                        echo $total; ?>
                                                    </span>
                                                    <span>TAREAS INCUMPLIDAS</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="tabla_notificaciones">
                                                
                                            </div>
                                            <div class="tab-pane fade" id="tabla_tasignada">

                                            </div>
                                            <div class="tab-pane fade" id="tabla_all_tareas">

                                            </div>
                                            <div class="tab-pane fade" id="tabla_tincumplida">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                    <div id="modal_ver_hoja_detalle" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Ver Accion de Hoja de Ruta</h4>
                                </div>
                                <div class="modal-body" id="ver_hoja_detalle">
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    <div id="modal_finalizar_hoja_detalle" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Finalizar Accion de Hoja de Ruta</h4>
                                </div>
                                <div class="modal-body" id="finalizar_hoja_detalle">
                                    
                                
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                </div> <!-- end container-fluid -->

            </div> <!-- end content -->

            <!-- Footer Start -->
            <?php include 'assets/inc/footer.php'; ?>

            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Libs Start -->
    <?php include 'assets/inc/librerias.php'; ?>
    <!-- end Libs -->
    <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=factura-->
    <script type="text/javascript">
            $(document).ready(function() {
            // 1. CARGAMOS LA TABLA DE CLIENTES
                $('#tabla_notificaciones').load('tabla_notificaciones.php');
                $('#tabla_tasignada').load('tabla_tasignada.php');
                $('#tabla_all_tareas').load('tabla_all_tareas.php');
                $('#tabla_tincumplida').load('tabla_tareas_incumplidas.php');
            });

            $(document).on("click", ".btnEditarEventoHojaPendiente", function() {
                cadena = "hoja_id=" + $(this).closest('tr').find('td:eq(0)').text();
                //alert(cadena); return false;
                //https://jsonformatter.org/jsbeautifier
                $.ajax({
                    type: "POST",
                    url: "assets/inc/update_hoja_id.php",
                    data: cadena,
                    success: function(r) {
                            if(r) {
                                $('#finalizar_hoja_detalle').load('modal_finalizar_evento_hoja.php');
                                $('#modal_finalizar_hoja_detalle').modal('show');
                            }
                        }
                });
            });
            /*$('#finalizar_accion_hoja').click(function(){
                var datos = $('#formulario_actualizar_hoja_detalle').serialize();
                //alert(datos); return false;
                $.ajax({
                    type:"POST",
                    url:"assets/inc/update_hoja_detalle.php",
                    data:datos,
                    success:function(response){
                        if(response==1){
                            $('#tabla_pendiente').load('tabla_pendiente.php');
                            $('#tabla_pendiente_adm').load('tabla_pendiente_adm.php');
                            $('#tabla_finalizado').load('tabla_finalizado.php');
                            $('#tabla_finalizado_adm').load('tabla_finalizado_adm.php');
                            Swal.fire({
                                type: 'success',
                                title: 'Actualizacion Exitosa.',
                                showConfirmButton: false,
                                    timer: 2000//1500
                                })
                        }else{
                            Swal.fire({
                                type: 'error',
                                title: 'Se ha Producido un Error.',
                                showConfirmButton: false,
                                    timer: 2000//1500
                                })
                        }
                    }
                });
            });*/
            $(document).on("click", ".btnVerEventoHojaPendiente", function() {
                cadena = "hoja_id=" + $(this).closest('tr').find('td:eq(0)').text();
                //alert(cadena); return false;
                //https://jsonformatter.org/jsbeautifier
                $.ajax({
                    type: "POST",
                    url: "assets/inc/update_hoja_id.php",
                    data: cadena,
                    success: function(r) {
                            if(r) {
                                $('#ver_hoja_detalle').load('modal_show_hoja_detalle_pendiente.php');
                                $('#modal_ver_hoja_detalle').modal('show');
                            }
                        }
                });
            });
            $(document).on("click", ".btnVerEventoHojaFinalizado", function() {
                cadena = "hoja_id=" + $(this).closest('tr').find('td:eq(0)').text();
                //alert(cadena); return false;
                //https://jsonformatter.org/jsbeautifier
                $.ajax({
                    type: "POST",
                    url: "assets/inc/update_hoja_id.php",
                    data: cadena,
                    success: function(r) {
                            if(r) {
                                $('#ver_hoja_detalle').load('modal_show_hoja_detalle_finalizado.php');
                                $('#modal_ver_hoja_detalle').modal('show');
                            }
                        }
                });
            });
    </script>
</body>
</html>