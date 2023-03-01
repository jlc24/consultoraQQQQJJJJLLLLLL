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
                                            <li class="breadcrumb-item active">Notas</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">
                                        <a style="color:purple;" href="#" data-toggle="modal" data-target="#modal_crear_nota" title="Registrar Nota">
                                            <i class="far fa-plus-square"></i>
                                        </a>Administración de Notas
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
                                <div class="card-box table-responsive" id="tabla_nota">

                                </div>
                                <!-- fin tabla medicamento -->

                                <?php include "modal_create_nota.php"; ?>
                                <?php include "modal_update_nota.php"; ?>

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

        <!--=============================  CLIENTES  =============================-->
        <script>
            function EditarCliente(datos){
                //alert(datos);
                vector=datos.split('||');
                $('#cli_id').val(vector[0]);
                $('#cli_ci_nit_update').val(vector[1]);
                $('#cli_nombre_update').val(vector[2]);
                $('#cli_genero_update').val(vector[3]);
                $('#cli_direccion_update').val(vector[4]);
                $('#cli_celular_update').val(vector[5]);
            }

            function EliminarCliente(datos) {
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
                            url: "assets/inc/delete_cliente.php",
                            data: cadena,
                            type: "POST",
                            success: function(response) {
                                if(response == 1) {
                                    $('#tabla_nota').load('tabla_nota_ventas.php');
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
            // 1. CARGAMOS LA TABLA DE CLIENTES
                $('#tabla_nota').load('tabla_nota_ventas.php');
            // COLOCAMOS EN FOCO EN EL INPUT CI/NIT
                $('#modal_crear_nota').on('shown.bs.modal',function(){
                    $('#nota_titulo').trigger('focus');
                });
            // 2.  REGISTRO DE UNA NUEVA NOTA
                $('#create_nota').click(function(){
                    if ($('#nota_titulo').val() == "")
                    {
                        Swal.fire({
                            type: 'info',
                            title: 'Ingrese un título para la nota',
                            showConfirmButton: false,
                            timer: 2000,
                            onAfterClose: () => {
                                setTimeout(() => $("#nota_titulo").focus(), 110);
                            }
                        })
                        return false;
                        //$('#modal_abastecer_medicamento').modal({backdrop: 'static', keyboard: false});
                        //alert("Ingrese, la cantidad comprada");
                    } else if ($('#nota_comentario').val() == "")
                    {
                        Swal.fire({
                            type: 'info',
                            title: 'Ingrese un comentario a la nota',
                            showConfirmButton: false,
                            timer: 2000,
                            onAfterClose: () => {
                                setTimeout(() => $("#nota_comentario").focus(), 110);
                            }
                        })
                        return false;
                    } else{
                        var datos = $('#formulario_crear_nota').serialize();
                        //alert(datos); return false;
                        $.ajax({
                            type:"POST",
                            url:"assets/inc/create_nota.php",
                            data:datos,
                            success:function(response){
                                if (response == 1) {
                                    $('#tabla_nota').load('tabla_nota_ventas.php');
                                    $('#modal_crear_nota').on('hidden.bs.modal', function (){
                                        $(this).find('#formulario_crear_nota')[0].reset();
                                    });
                                    /*$('#c_paciente')[0].reset();*/ //Limpia los inputs del formulario con id=c_paciente*/
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Nota Registrada Exitosamente',
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
                    }
                });
            // 3. ACTUALIZACION DE DATOS DE LA NOTA
                $('#update_cliente').click(function(){
                    var datos = $('#formulario_actualizar_cliente').serialize();
                    //alert(datos); return false;
                    $.ajax({
                        type:"POST",
                        url:"assets/inc/update_cliente.php",
                        data:datos,
                        success:function(response){
                            if(response==1){
                                $('#tabla_nota').load('tabla_nota_ventas.php');
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
            //Editar
            $(document).on("click", ".btnUpdateNota", function() {
                var fila = $(this).closest("tr");

                $('#not_id').val(parseInt(fila.find('td:eq(0)').text()));
                $('#nota_titulo_update').val(fila.find('td:eq(2)').text());
                $('#nota_comentario_update').val(fila.find('td:eq(3)').text());
                $('#nota_estado_update').val(1);
                //COLOCAMOS EL FOCO EN EL INPUT
                $('#modal_actualizar_recuento').on('shown.bs.modal', function (){$('#prod_stock_update').focus();});
            });
            //ACTUALIZAR DATOS DE LA NOTA
            $('#update_nota').click(function(){
                var datos = $('#formulario_actualizar_nota').serialize();
                //alert(datos); return false;
                $.ajax({
                    type:"POST",
                    url:"assets/inc/update_nota.php",
                    data:datos,
                    success:function(response){
                            if (response == 1) {
                                $('#tabla_nota').load('tabla_nota_ventas.php');
                                $('#modal_actualizar_nota').on('hidden.bs.modal', function (){
                                    $(this).find('#formulario_actualizar_nota')[0].reset();
                                });
                                /*$('#c_paciente')[0].reset();*/ //Limpia los inputs del formulario con id=c_paciente*/
                                Swal.fire({
                                    type: 'success',
                                    title: 'Nota Actualizada Exitosamente',
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
            //------------------------------------------------------------------------------------//
            //------------------------------------------------------------------------------------//
            });
        </script>
    </body>
</html>