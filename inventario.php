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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Inventario</a></li>
                                            <li class="breadcrumb-item active" id="nombre_vendedor"><?php include 'nombre_laboratorio.php'; ?></li>
                                        </ol>

                                    </div>
                                    <h4 class="page-title">
                                        <a style="color:purple;" href="#" data-toggle="modal" data-target="#modal_cambiar_laboratorio" title="Seleccionar Laboratorio Fabricante">
                                            <i class="far fa-hospital"></i>
                                        </a>Administración de Inventario&nbsp;&nbsp;
                                        <a style="color:purple;" href="#" data-toggle="modal" data-target="#modal_cambiar_laboratorio_nick" title="Actualizar Fabricante y Representante">
                                            <i class="fas fa-check-circle"></i>
                                        </a>Laboratorio & Nick
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
                                <?php include "modal_cambiar_laboratorio.php"; ?>
                                <?php include "modal_cambiar_laboratorio_nick.php"; ?>
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

            $(document).ready(function() {
                //CARGAMOS TODOS LOS MEDICAMENTOS
                $('#tabla_recuento').load('tabla_inventario.php');
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
                    $('#prod_laboratorio_update').val(fila.find('td:eq(4)').text());
                    $('#prod_barcode_update').val(fila.find('td:eq(10)').text());
                    $('#prod_inversion_update').val(fila.find('td:eq(8)').text());
                    $('#prod_caducidad_update').val(fila.find('td:eq(5)').text());
                    $('#prod_stock_update').val(fila.find('td:eq(6)').text());
                    $('#prod_precio_compra_update').val(fila.find('td:eq(7)').text());

                    //COLOCAMOS EL FOCO EN EL INPUT
                    $('#modal_actualizar_recuento').on('shown.bs.modal', function (){$('#prod_stock_update').focus();});
                });

                //ACTUALIZAR STOCK DEL PRODUCTO SELECCIONADO
                $('#update_recuento').click(function(){
                    var datos = $('#formulario_actualizar_recuento').serialize();
                    //alert(datos); return false;
                    $.ajax({
                        type:"POST",
                        url:"assets/inc/update_recuento.php",
                        data:datos,
                        success:function(response){
                            if (response == 1) {
                                $('#tabla_recuento').load('tabla_inventario.php');
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
                //CAMBIAR EL LABORATORIO FABRICANTE
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
                                    $('#tabla_recuento').load('tabla_inventario.php');
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
                //CAMBIAR EL LABORATORIO FABRICANTE Y NICKNAME LABORATORIO
                $('#cambiar_laboratorio_nick').click(function(){
                    var datos = $('#formulario_cambiar_laboratorio_nick').serialize();
                    //alert(datos); return false;
                    $.ajax({
                    type:"POST",
                    url:"assets/inc/update_laboratorio_nickname.php",
                    data:datos,
                        success:function(response){
                            if(response==1){
                                Swal.fire({
                                    type: 'success',
                                    title: 'Actualización Exitosa',
                                    showConfirmButton: false,
                                        timer: 2000//1500
                                    })
                                    $('#tabla_recuento').load('tabla_inventario.php');
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
                //AUTOCOMPLETA SOLO PARA LA ACTUALIZAR LABORATORIOS FABRICANTES Y SUS NICKS
                $('#modal_cambiar_laboratorio_nick').on('shown.bs.modal',function(){
                    $('#prod_laboratorio_cambiar').trigger('focus');
                });
                $('#modal_cambiar_laboratorio_nick').on('hidden.bs.modal',function(){
                    //$("#prod_laboratorio_cambiar").val("");
                    //$("#prod_nicklaboratorio_cambiar").val("");
                    $('#formulario_cambiar_laboratorio_nick').trigger('reset');
                });
                $("#prod_laboratorio_cambiar").autocomplete({
                    appendTo: '#modal_cambiar_laboratorio_nick',
                    source: function(request, response) {
                        $.ajax({
                            url: "autocomplete_laboratorio.php",
                            type: "post",
                            dataType: "json",
                            data: {
                                search: request.term
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                    },
                    minLength: 1,
                    select: function(event, ui) {
                        event.preventDefault();
                        $('#prod_laboratorio_cambiar').val(ui.item.laboratorio);
                        $('#prod_nicklaboratorio_cambiar').val(ui.item.nicklaboratorio);
                        return false;
                    }
                });
            });
        </script>
    </body>
</html>