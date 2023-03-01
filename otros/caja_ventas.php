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
            <?php include 'assets/inc/topbar_ventas.php'; ?>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <?php include 'assets/inc/left_sidebar_ventas.php'; ?>
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
                                            <li class="breadcrumb-item active">Apertura y Cierre de Caja</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">
                                        <a style="color:purple;" href="#" data-toggle="modal" data-target="#modal_crear_caja" title="Registrar Apertura de Caja">
                                            <i class="far fa-plus-square"></i>
                                        </a>Administración de Caja
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
                                <!-- inicio tabla caja -->
                                <div class="card-box table-responsive" id="tabla_caja">

                                </div>
                                <!-- fin tabla caja -->

                                <!-- Modales para Crear y Actualizar, Caja, Etc -->
                                <?php include "modal_create_caja.php"; include "modal_cerrar_caja.php"; ?>
                                <!-- Modales para Crear y Actualizar, Cajas -->

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

        <!--================================  CLIENTES  ================================-->
        <script>
            //CARGAMOS LOS REGISTROS DE LA CAJA RELACIONADO AL ADMINISTRADOR
            $('#tabla_caja').load('tabla_caja.php');
            // COLOCAMOS EN FOCO EN EL INPUT NECESARIO AL ABRIR Y CERRAR CAJA
            $('#modal_crear_caja').on('shown.bs.modal',function(){
                $('#caja_monto_inicial').trigger('focus');
            });
            $('#modal_cerrar_caja').on('shown.bs.modal',function(){
                $('#caja_monto_final').trigger('focus');
            });
            //FUNCION PARA CERRAR CAJA
            function CerrarCaja(datos){
                //alert(datos);
                vector=datos.split('||');
                $('#caja_id').val(vector[0]);
            }

            $(document).ready(function() {
                // REGISTRO DE UNA NUEVA CAJA
                $('#create_caja').click(function(){
                    //SI EL VALOR DEL MONTO INICIAL ES MAYOR O IGUAL A CERO Y DIFERENTE DE VACIO SE HABRE LA CAJA
                    if ($('#caja_monto_inicial').val() >= 0 && $('#caja_monto_inicial').val() != "") { 
                        var datos = $('#formulario_crear_caja').serialize();
                        //alert(datos); return false;
                        $.ajax({
                            type:"POST",
                            url:"assets/inc/create_caja.php",
                            data:datos,
                            success:function(response){
                                if (response == 1) {
                                    $('#tabla_caja').load('tabla_caja.php');
                                    $('#modal_crear_caja').on('hidden.bs.modal', function (){
                                        $(this).find('#formulario_crear_caja')[0].reset();
                                    });
                                    /*$('#c_paciente')[0].reset();*/ //Limpia los inputs del formulario con id=c_paciente*/
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Apertura de Caja Exitosa',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                } else {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Primero, cierre la caja abierta...',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                }

                            }
                        });
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'Ingrese, Monto de Apertura Válido...',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                });
                // CIERRE DE LA CAJA ABIERTA
                $('#cerrar_caja').click(function(){
                    //PARA CERRAR CAJA VERIFICAMOS QUE EL MONTO FINAL Y CAMBIO NO SEAN VACIOS
                    caja_final = parseInt($('#caja_monto_final').val());
                    caja_cambio = parseInt($('#caja_cambio').val());
                    var datos = $('#formulario_cerrar_caja').serialize();
                    //alert(datos); return false;
                    if (caja_final >= 0 && caja_cambio >= 0) {
                        $.ajax({
                            type:"POST",
                            url:"assets/inc/update_caja.php",
                            data:datos,
                            success:function(response){
                                if (response == 1) {
                                    $('#tabla_caja').load('tabla_caja.php');
                                    $('#modal_cerrar_caja').on('hidden.bs.modal', function (){
                                        $(this).find('#formulario_cerrar_caja')[0].reset();
                                    });
                                    /*$('#c_paciente')[0].reset();*/ //Limpia los inputs del formulario con id=c_paciente*/
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Cierre de Caja Exitosa',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                } else {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'La Caja ya esta Cerrada',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                }

                            }
                        });                    
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'Debe Ingresar Monto de Cierre y Cambio',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }

                }); 
            });
        </script>
    </body>
</html>