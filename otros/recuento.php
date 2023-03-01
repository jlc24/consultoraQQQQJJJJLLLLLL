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
                                            <li class="breadcrumb-item active">Inventario</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">
                                        <a style="color:purple;" href="#">
                                            <i class="far fa-plus-square"></i>
                                        </a>Administración de Inventario
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
                                <div class="card-box table-responsive" id="tabla_recuento">

                                </div>
                                <!-- fin tabla medicamento -->

                                <!-- Modales para Actualizar, Datos del Inventario -->
                                <?php include "modal_update_recuento.php"; ?>
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
                function CambiarVendedor(lab_nombre){
                    cadena="prod_nicklaboratorio=" + lab_nombre;
                    alert(cadena);
                    $.ajax({
                    type:"POST",
                    url:"assets/inc/update_nicklaboratorio.php",
                    data:cadena,
                    success:function(){
                        $('#tabla_recuento').load('tabla_recuento_serverside.php');
                    }
                    });
                }
            $(document).ready(function() {
                //CARGAMOS TODOS LOS MEDICAMENTOS
                $('#tabla_recuento').load('tabla_recuento_serverside.php');
                //COLOCAMOS EL FOCO EN UN INPUT
                $('#modal_crear_recuento').on('shown.bs.modal',function(){
                    $('#prod_nombre_comercial').trigger('focus');
                });
                //var fila; //captura la fila, para editar o eliminar
                //Editar
                $(document).on("click", ".btnRecuento", function() {
                    var fila = $(this).closest("tr");

                    $('#prod_id_update').val(parseInt(fila.find('td:eq(0)').text()));
                    $('#prod_codigo_update').val(fila.find('td:eq(1)').text());
                    $('#prod_nombre_comercial_update').val(fila.find('td:eq(2)').text());
                    $('#prod_forma_update').val(fila.find('td:eq(3)').text());
                    //$('#prod_ingrediente_update').val(fila.find('td:eq(4)').text());
                    $('#prod_laboratorio_update').val(fila.find('td:eq(4)').text());
                    $('#prod_caducidad_update').val(fila.find('td:eq(5)').text());
                    $('#prod_stock_update').val(fila.find('td:eq(6)').text());
                    $('#prod_precio_compra_update').val(fila.find('td:eq(8)').text());

                    //COLOCAMOS EL FOCO EN EL INPUT
                    $('#modal_actualizar_recuento').on('shown.bs.modal', function (){$('#prod_stock_update').focus();});
                });

                //ACTUALIZAR STOCK DEL PRODUCTO SELECCIONADO
                $('#update_recuento').click(function(){
                    var datos = $('#formulario_actualizar_recuento').serialize();
                    //alert(datos);
                    //return false;
                    $.ajax({
                        type:"POST",
                        url:"assets/inc/update_recuento.php",
                        data:datos,
                        success:function(response){
                            if (response == 1) {
                                $('#tabla_recuento').load('tabla_recuento_serverside.php');
                                $('#modal_actualizar_recuento').on('hidden.bs.modal', function (){
                                    $(this).find('#formulario_actualizar_recuento')[0].reset();
                                });
                                Swal.fire({
                                    type: 'success',
                                    title: 'Actualización Exitosa',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Se ha Producido un Error',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            }

                        }
                    });
                });

                //CALCULA LA INVERSION, CUANDO CAMBIA EL STOCK, DADO EL PRECIO DE COMPRA UNITARIO
                $("#prod_stock_update").on('keyup change',function() {
                    var precio = document.getElementById("prod_precio_compra_update").value;
                    var cantidad = $(this).val();
                    var resultado = (parseFloat(precio)*parseFloat(cantidad)).toFixed(2);
                    document.getElementById("prod_inversion_update").value = resultado;
                });
                //ACTUALIZA NOMBRE DE LABORATORIO EN LA TABLA DE CONFIGURACION
                $('#button_lab').click(function(){
                lab_nombre=$('#lab_nombre').val();
                CambiarVendedor(lab_nombre);
                });
            });
        </script>
    </body>
</html>