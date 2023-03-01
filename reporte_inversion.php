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
                                            <li class="breadcrumb-item active">Inversión en Medicamentos</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">
                                        <a style="color:purple;" href="#">
                                            <i class="far fa-plus-square"></i>
                                        </a>Capital Invertido en Medicamentos
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
                                <div class="card-box table-responsive" id="tabla_inversion">

                                </div>
                                <?php include "modal_lista_producto.php"; ?>


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
            //CAMBIA EL NOMBRE DEL LABORATORIO EN LA TABLA CONFIGURACION
            function VerProductos(nombre_lab){
                //alert (nombre_lab); return null;
                cadena="prod_nicklaboratorio="+nombre_lab;
                $.ajax({
                  type:"POST",
                  url:"assets/inc/update_nicklaboratorio.php",
                  data:cadena,
                  success:function(){//r puede ser 1 o 0, es uno si la eliminacion fue exitosa, y 0 si fallo.
                    document.getElementById("nombre_laboratorio").innerHTML = nombre_lab;
                    $('#tabla_lista_producto').load('tabla_lista_producto.php');
                  }//Fin success
                });//fin ajax
            }
            $(document).ready(function() {
                //CARGAMOS TODOS LOS MEDICAMENTOS
                $('#tabla_inversion').load('tabla_inversion.php');
                //CARGAMOS TODOS LOS MEDICAMENTOS DE UN LABORATORIO
                //$('#tabla_lista_producto').load('tabla_lista_producto.php');
                //captura la fila, para editar o eliminar
                //var fila;
                //Historial
                /*$(document).on("click", ".btnHistorial", function() {

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
                });*/
            });
        </script>
    </body>
</html>