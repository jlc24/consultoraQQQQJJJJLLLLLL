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
                                            <li class="breadcrumb-item active">Medicamentos más vendidos</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">
                                        <a style="color:purple;" href="#">
                                            <i class="far fa-plus-square"></i>
                                        </a>Administración de Medicamentos
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
                                <div class="card-box table-responsive" id="tabla_medicamento">

                                </div>
                                <?php //include "modal_historial_venta.php"; ?>


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

        <!--=============================  MEDICAMENTOS  =============================-->
        <script>
            $(document).ready(function() {
                //CARGAMOS TODOS LOS MEDICAMENTOS
                $('#tabla_medicamento').load('tabla_medicamento_serverside_top.php');
                //captura la fila, para editar o eliminar
                var fila;
                //Historial
                $(document).on("click", ".btnHistorial", function() {
                    /*RECIBE COMO DATOS EL ID y NOMBRE DEL PRODUCTO, EL ID SE ACTUALIZA EN LA
                    TABLA CONFIGURACION, LUEGO SE MUESTRA EL RESULTADO DE LA CONSULTA
                    PARA ESE ID, EN EL DIV ---> #tabla_producto_historial */
                    cadena="prod_id=" + $(this).closest('tr').find('td:eq(0)').text();
                    document.getElementById("prod_nombre").innerHTML = "Historial De Compras : " + $(this).closest('tr').find('td:eq(2)').text();
                    //alert(vector);
                    $.ajax({
                        type:"POST",
                        url:"assets/inc/update_producto_id.php",
                        data:cadena,
                        success:function(r){
                            if(r==1){
                            $('#tabla_compra_historial').load('tabla_compra_historial.php');
                            }//Fin if
                        }//Fin success
                    });//fin ajax
                });
            });
        </script>
    </body>
</html>