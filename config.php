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
<html lang="en">

<head>
    <?php include 'assets/inc/head.php'; ?>
    <style>
        input[readonly], input[readonly="readonly"] {
            background-color: white !important;
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
                                    
                                </div>
                                <h4 class="page-title">Configuración de Parámetros</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!--========================================
                        =            Contenido Principal           =
                    =========================================-->
                    
                    <?php include "modal_create_administrador.php"; ?>
                    <!--<div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <h4 class="header-title">Tipo de Cambio</h4>

                                <form id="update_form_tipo_cambio">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                        <label class="col-md-8 col-form-label"><i class="flag-icon flag-icon-us" style="height:24px;width:32px;"></i> USD - Dólar Americano</label>
                                            <div class="input-group input-group-lg">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">&nbsp;$&nbsp;</span>
                                                </div>
                                                <input type="text" class="form-control" aria-label="Username" value="1" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label class="col-md-8 col-form-label"><i class="flag-icon flag-icon-bo" style="height:24px;width:32px;"></i> BOB - Boliviano de Bolivia</label>
                                            <div class="input-group input-group-lg">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Bs.</span>
                                                </div>
                                                <input
                                                  type="number"
                                                  step="0.01"
                                                  class="form-control" id="tipo_cambio" name="tipo_cambio"
                                                  aria-label="Username"
                                                  value="<?php //$consulta = "SELECT tipo_cambio FROM configuracion";
                                                  //$fila = mysqli_fetch_row(mysqli_query($conexion,$consulta));
                                                  //echo number_format((float)$fila[0], 2, '.', ''); ?>">
                                                  
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-purple" id="update_tipo_cambio">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                     end row -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <h4 class="header-title">Administración de Usuarios del Sistema</h4>
                                <!-- inicio tabla usuarios -->
                                <div class="card-box table-responsive" id="tabla_usuario">

                                </div>
                                <!-- fin tabla usuarios -->
                            </div>
                        </div>
                    </div>
                    <div id="modal_actualizar_usuario" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Actualizar Datos de la cuenta</h4>
                                </div>
                                <div class="modal-body" id="actualizar_usuario">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="close_usuario" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                    <button type="button" id="update_usuario" class="btn btn-purple waves-effect" data-dismiss="modal">Actualizar Cuenta</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    <!-- end row -->
                    <!-- /.MENSAJES -->
                    <div id="modal_mensaje" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Mensaje Nuevo</h4>
                                </div>
                                <div class="modal-body" id="contenido_mensaje">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Cerrar</button>
                                    <button type="button" id="enviar_mensaje" class="btn btn-purple waves-effect" data-dismiss="modal">Enviar mensaje</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    
                    <?php include 'modal_message_blanck.php'; ?>

                    <div id="modal_ver_mensaje" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Mensaje</h4>
                                </div>
                                <div class="modal-body" id="ver_mensaje">

                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
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
    <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=factura-->
    <script type="text/javascript">
        //CARGAMOS TODOS LOS USUARIOS DEL SISTEMA, ADMINISTRADORES Y VENDEDORES
        $('#tabla_usuario').load('tabla_usuario.php');
        
        $(document).on("click", "#update_users", function() {
            cadena = "hoja_id=" + $(this).closest('tr').find('td:eq(0)').text();
            //alert(cadena); return false;
            //https://jsonformatter.org/jsbeautifier
            $.ajax({
                type: "POST",
                url: "assets/inc/update_hoja_id.php",
                data: cadena,
                success: function(r) {
                    if(r) {
                        $('#modal_actualizar_usuario').on('hidden.bs.modal', function() {
                            $(this).find('#formulario_actualizar_usuario')[0].reset();
                        });
                        $('#actualizar_usuario').load('modal_update_usuario.php');
                        $('#modal_actualizar_usuario').modal('show');
                    }
                }
            });
        });
        // ACTUALIZACION DATOS DE USUARIOS
        $('#update_usuario').click(function(){
            var datos = $('#formulario_actualizar_usuario').serialize();
            //alert(datos); return false;
            $.ajax({
                type:"POST",
                url:"assets/inc/update_usuario.php",
                data:datos,
                success:function(response){
                    if(response==1){
                        $('#tabla_usuario').load('tabla_usuario.php');
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


        $(document).ready(function() {
            $('#alarma_notificaciones').load('alarma/alarma_notificaciones.php');
            $('#alarma_notificaciones_topbar').load('alarma/alarma_notificaciones_topbar.php');
            $('#alarma_newmensajes_topbar').load('alarma/alarma_newmensajes_topbar.php');
            $('#alarma_viewmensajes_topbar').load('alarma/alarma_viewmensajes_topbar.php');
            $('#alarma_sendmensajes_topbar').load('alarma/alarma_sendmensajes_topbar.php');
            
            $("#destino_mensaje_blanco").autocomplete({
                appendTo: '#modal_mensaje_blanco',
                source: function(request, response) {
                    $.ajax({
                        url: "autocomplete_nombre_administrador.php",
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
                    $('#enc_id_blanco').val(ui.item.id);
                    $('#destino_mensaje_blanco').val(ui.item.nombre);
                    return false;
                }
            });
            $(document).on("click", ".btnMensaje", function() {
                cadena = "hoja_id=" + $(this).closest('tr').find('td:eq(0)').text();
                //alert(cadena); return false;
                //https://jsonformatter.org/jsbeautifier
                $.ajax({
                    type: "POST",
                    url: "assets/inc/update_hoja_id.php",
                    data: cadena,
                    success: function(r) {
                        if(r) {
                            $('#contenido_mensaje').load('modal_message.php');
                            $('#modal_mensaje').modal('show');
                            $('#modal_mensaje').on('shown.bs.modal',function(){
                                $('#desc_mensaje').trigger('focus');
                            });
                        }
                    }
                });
            });
            $(document).on("click", "#enviar_mensaje_blanco", function() {
                cadena = $("#formulario_mensaje_blanco").serialize();
                //alert(cadena); return false;
                $.ajax({
                    type: "POST",
                    url: "assets/inc/create_message.php",
                    data: cadena,
                    success: function(response) {
                        if(response == 1) {
                            Swal.fire({
                                type: 'success',
                                title: 'Envio de mensaje exitoso.',
                                showConfirmButton: false,
                                timer: 2000
                            })
                            $('#alarma_newmensajes_topbar').load('alarma/alarma_newmensajes_topbar.php');
                            $('#alarma_sendmensajes_topbar').load('alarma/alarma_sendmensajes_topbar.php');
                            $('#modal_mensaje_blanco').on('hidden.bs.modal', function() {
                                $(this).find('#formulario_mensaje_blanco')[0].reset();
                            });
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
            $(document).on("click", ".btnMensajeLeido", function() {
                cadena = "not_id=" + $(this).closest('tr').find('td:eq(0)').text();
                //alert(cadena); return false;
                //https://jsonformatter.org/jsbeautifier
                $.ajax({
                    type: "POST",
                    url: "assets/inc/update_detalle_leido.php",
                    data: cadena,
                    success: function(r) {
                        if(r) {
                            $('#alarma_newmensajes_topbar').load('alarma/alarma_newmensajes_topbar.php');
                            $('#alarma_sendmensajes_topbar').load('alarma/alarma_sendmensajes_topbar.php');
                            $('#alarma_viewmensajes_topbar').load('alarma/alarma_viewmensajes_topbar.php');
                        }
                    }
                });
            });
            $(document).on("click", ".btnVerMensaje", function() {
                cadena = "hoja_id=" + $(this).closest('tr').find('td:eq(0)').text();
                //alert(cadena); return false;
                //https://jsonformatter.org/jsbeautifier
                $.ajax({
                    type: "POST",
                    url: "assets/inc/update_hoja_id.php",
                    data: cadena,
                    success: function(r) {
                        if(r) {
                            $('#ver_mensaje').load('modal_message_show.php');
                            $('#modal_ver_mensaje').modal('show');
                        }
                    }
                });
            });
            // ACTUALIZACION DEL % DE UTILIDAD QUE SE ASIGNA A LA BILLETERA VIRTUAL DEL CLIENTE
            $('#update_utilidad_billetera').click(function(){
                var datos = $('#update_form_billetera').serialize();
                //alert(datos); return false;
                $.ajax({
                    type:"POST",
                    url:"assets/inc/update_billetera.php",
                    data:datos,
                    success:function(response){
                        if (response == 1) {
                            Swal.fire({
                                type: 'success',
                                title: 'Actualización Exitosamente',
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
            // ACTUALIZACION DEL TIPO DE CAMBIO PARA VENTAS CON MONEDA EXTRANJERA (DOLAR)
            $('#update_tipo_cambio').click(function(){
                var datos = $('#update_form_tipo_cambio').serialize();
                //alert(datos); return false;
                $.ajax({
                    type:"POST",
                    url:"assets/inc/update_tipo_cambio.php",
                    data:datos,
                    success:function(response){
                        if (response == 1) {
                            Swal.fire({
                                type: 'success',
                                title: 'Actualización Exitosamente',
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
            //Editar Datos de la cuenta del usuario
            $('#modal_actualizar_usuario').on('shown.bs.modal',function(){
                    //$('#nota_titulo').trigger('focus'); $('#prod_stock_update').focus();
            });
            $('#create_administrador').click(function(){
                var datos = $('#formulario_crear_administrador').serialize();
                alert(datos); return false;
                $.ajax({
                    type:"POST",
                    url:"assets/inc/create_administrador.php",
                    data:datos,
                    success:function(response){
                        if (response == 1) {
                            $('#tabla_administrador').load('tabla_administrador.php');
                            $('#modal_crear_administrador').on('hidden.bs.modal', function (){
                                $(this).find('#formulario_crear_administrador')[0].reset();
                            });
                            /*$('#c_paciente')[0].reset();*/ //Limpia los inputs del formulario con id=c_paciente*/
                            Swal.fire({
                                type: 'success',
                                title: 'Cliente Agregado Exitosamente.',
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
    });
    </script>
</body>
</html>