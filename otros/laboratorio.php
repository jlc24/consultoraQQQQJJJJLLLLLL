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
                                            <li class="breadcrumb-item active">Laboratorios</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">
                                        <a style="color:purple;" href="#" data-toggle="modal" data-target="#modal_crear_laboratorio" title="Registrar Proveedor">
                                            <i class="far fa-plus-square"></i>
                                        </a>Administración de Proveedores
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
                                <div class="card-box table-responsive" id="tabla_laboratorio">

                                </div>
                                <!-- fin tabla medicamento -->

                                <?php include "modal_create_laboratorio.php"; ?>
                                <?php include "modal_update_laboratorio.php"; ?>

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

        <!--=============================  LABORATORIOS  =============================-->
        <script>
            function EditarLaboratorio(datos){
                //alert(datos);
                vector=datos.split('||');
                $('#lab_id').val(vector[0]);
                $('#lab_nombre_update').val(vector[1]);
                $('#lab_nick_update').val(vector[2]);
                $('#lab_direccion_update').val(vector[3]);
                $('#lab_email_update').val(vector[4]);
                $('#lab_web_update').val(vector[5]);
                $('#lab_preventista_update').val(vector[6]);
            }

            function EliminarLaboratorio(datos) {
                vector = datos.split('||');
                Swal.fire({
                    title: 'Se Borrará a ' + vector[1],
                    text: "No podrás revertir esto!",
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminarlo!'
                }).then((result) => {
                    if(result.value) {
                        cadena = "id=" + vector[0];
                        //alert(cadena);
                        $.ajax({
                            url: "assets/inc/delete_laboratorio.php",
                            data: cadena,
                            type: "POST",
                            success: function(response) {
                                if(response == 1) {
                                    $('#tabla_laboratorio').load('tabla_laboratorio.php');
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Tu registro a sido Borrado.',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                }
                            }
                        });
                    }
                })
            }
            //------------------------------------------------------------------------------------//
            //------------------------------------------------------------------------------------//
            $(document).ready(function() {
            // 1. CARGAMOS LA TABLA DE LABORATORIO
                $('#tabla_laboratorio').load('tabla_laboratorio.php');
            // COLOCAMOS EN FOCO EN EL INPUT NOMBRE
                $('#modal_crear_laboratorio').on('shown.bs.modal',function(){
                    $('#lab_nombre').trigger('focus');
                });

            // 5.1 SI DAMOS CLIC EN EL BOTON CANCELAR DEL FORMULARIO DE REGISTRO DE DETALLE
                $('#modal_crear_laboratorio').on('hidden.bs.modal',function(){ 
                    $('#formulario_crear_laboratorio')[0].reset();
                });


            // 2.  REGISTRO DE UN NUEVO LABORATORIO
                $('#create_laboratorio').click(function(){
                    var datos = $('#formulario_crear_laboratorio').serialize();
                    //alert(datos); return false;
                    $.ajax({
                        type:"POST",
                        url:"assets/inc/create_laboratorio.php",
                        data:datos,
                        success:function(response){
                            if (response == 1) {
                                $('#tabla_laboratorio').load('tabla_laboratorio.php');
                                $('#modal_crear_laboratorio').on('hidden.bs.modal', function (){
                                    $(this).find('#formulario_crear_laboratorio')[0].reset();
                                });
                                /*$('#c_paciente')[0].reset();*/ //Limpia los inputs del formulario con id=c_paciente*/
                                Swal.fire({
                                    type: 'success',
                                    title: 'Laboratorio Agregado Exitosamente.',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Se ha Producido un Error.',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            }

                        }
                    });
                });
            // 3. ACTUALIZACION DE DATOS DEL LABORATORIO
                $('#update_laboratorio').click(function(){
                    var datos = $('#formulario_actualizar_laboratorio').serialize();
                    //alert(datos); return false;
                    $.ajax({
                        type:"POST",
                        url:"assets/inc/update_laboratorio.php",
                        data:datos,
                        success:function(response){
                            if(response==1){
                                $('#tabla_laboratorio').load('tabla_laboratorio.php');
                                Swal.fire({
                                  type: 'success',
                                  title: 'Actualizacion Exitosamente.',
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
                });
            //------------------------------------------------------------------------------------//
            //------------------------------------------------------------------------------------//
            });
        </script>
    </body>
</html>