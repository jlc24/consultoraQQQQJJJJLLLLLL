<?php
include("assets/inc/conexion.php");

session_start();
if (!isset($_SESSION['adm_id'])) {
	header('Location: login.php');
}

$adm_id = $_SESSION['adm_id'];
$sql = "SELECT adm_id, adm_nombre FROM administrador WHERE adm_id = '$adm_id'";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include 'assets/inc/head.php'; ?>
        <style type="text/css">
            /*para alinear los botones y cuadro de busqueda*/
            .btn-group, .btn-group-vertical {
                position: absolute !important;
            }
            div.dom_wrapper {
            position: sticky;  /* Fix to the top */
            top: 0;
            }
        </style>
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
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">QJL</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pedidos</a></li>
                                            <li class="breadcrumb-item active" id="nombre_vendedor"><?php include 'nombre_laboratorio.php'; ?></li>
                                        </ol>

                                    </div>
                                    <h4 class="page-title">
                                        <a style="color:purple;" href="#" data-toggle="modal" data-target="#modal_cambiar_laboratorio" title="Cambiar Laboratorio o Representante">
                                            <i class="icon-refresh"></i>
                                        </a>Administración de Pedidos
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <!--========================================
                        =            Contenido Principal           =
                        =========================================-->
                        <div class="row">
                            <div class="col-12">
                                <!-- inicio tabla medicamento -->
                                <div class="card-box table-responsive" id="tabla_pedido">
                                </div>
                                <?php include "modal_cambiar_laboratorio.php"; ?>
                                <?php //include "modal_update_recuento.php"; ?>
                            </div>
                            <!-- end col-12 -->
                        </div>
                        <!-- end row -->
                        <!--====  End of Contenido Principal  ====-->
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

        <!--=============================  RECUENTO  =============================-->
        <script type="text/javascript">

            $(document).ready(function() {
                //CARGAMOS TODOS LOS MEDICAMENTOS DEL LABORATORIO SELECCIONADO
                $('#tabla_pedido').load('tabla_pedido.php');
                //ACTUALIZA NOMBRE DE LABORATORIO EN LA TABLA DE CONFIGURACION
                $('#button_lab').click(function(){
                lab_nombre=$('#lab_nombre').val();
                CambiarVendedor(lab_nombre);
                });
                //CAMBIAR EL LABORATORIO O REPRESENTANTE
                $('#cambiar_laboratorio').click(function(){
                    var datos = $('#formulario_cambiar_laboratorio').serialize();
                    //alert(datos); return false;
                    $.ajax({
                    type:"POST",
                    url:"assets/inc/update_nicklaboratorio.php",
                    data:datos,
                        success:function(response){
                            if(response==1){
                                Swal.fire({
                                    type: 'success',
                                    title: 'Selección Exitosa',
                                    showConfirmButton: false,
                                        timer: 2000//1500
                                    })
                                    $('#tabla_pedido').load('tabla_pedido.php');
                                    $('#nombre_vendedor').load('nombre_laboratorio.php');
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
                });
            });
        </script>
    </body>
</html>