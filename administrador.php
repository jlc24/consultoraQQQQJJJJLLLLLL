<?php
include("assets/inc/conexion.php");

session_start();
if (!isset($_SESSION['adm_id'])) {
	header('Location: login.php');
}

$adm_id = $_SESSION['adm_id'];
$sql = "SELECT adm_id, adm_nombre, adm_rol, area_id  FROM administrador WHERE adm_id = '$adm_id'";
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
                                    </div>
                                    <h4 class="page-title">Administración</h4>
                                </div>
                            </div>
                            
                        </div>
                        <!-- end page title -->

                        <!--========================================
                        =            Contenido Principal           =
                        =========================================-->
                        <div class="row">
                            <div class="col-4">
                                <div class="card-box py-2 text-center" id="card_area" name="card_area" style="border-style: solid; border-width: 1px; border-color: #fff;">
                                    <input type="hidden" id="switch_area" value="0">
                                    <div class="col-12">
                                        <span><img src="assets/images/icon_png/distribucion.png" alt="" width="80px"></span>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Administración de Áreas</h5>
                                        <span>
                                            <button type="button" id="btnArea" name="btnarea" class="btn btn-outline-info btn-sm" data-toggle="collapse" data-target="#adm_area" title="Ver Areas"><img src="assets/images/icons/collapse.svg" alt="" width="20px" id="img_area" style="transform: rotate(90deg);"></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 ">
                                <div class="card-box py-2 text-center" id="card_proceso" name="card_proceso" style="border-style: solid; border-width: 1px; border-color: #fff;">
                                    <input type="hidden" id="switch_proceso" value="0">
                                    <div class="col-12">
                                        <span><img src="assets/images/icon_png/procesamiento.png" alt="" width="80px"></span>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Administración de Procesos</h5>
                                        <span>
                                            <button type="button" id="btnProceso" class="btn btn-outline-info btn-sm" data-toggle="collapse" data-target="#adm_proceso" title="Ver Areas"><img src="assets/images/icons/collapse.svg" alt="" width="20px" id="img_proceso" style="transform: rotate(90deg);"></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 ">
                                <div class="card-box py-2 text-center" id="card_personal" name="card_personal" style="border-style: solid; border-width: 1px; border-color: #fff;">
                                    <input type="hidden" id="switch_personal" value="0">
                                    <div class="col-12">
                                        <span><img src="assets/images/icon_png/administracion.png" alt="" width="80px"></span>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Administración de Personal</h5>
                                        <span>
                                            <button type="button" id="btnPersonal" class="btn btn-outline-info btn-sm" data-toggle="collapse" data-target="#adm_personal" title="Ver Areas"><img src="assets/images/icons/collapse.svg" alt="" width="20px" id="img_personal" style="transform: rotate(90deg);"></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="row justify-content-center">
                            <div class="col-10">
                                <div id="adm_area" class="row collapse">
                                    <div class="col-xl-12">
                                        <div class="card-box" style="border-style: solid; border-width: 1px; border-color: #32C861;">
                                            <div class="card-header" style="background-color: #E8F8ED; height: 50px; padding-top: 5px;">
                                                <h4 class="page-title">
                                                    <a style="color: #32C861;" href="#" data-toggle="modal" data-target="#modal_crear_area" title="Registrar Area">
                                                        <i class="far fa-plus-square"></i>
                                                    </a> Áreas
                                                </h4>
                                            </div>
                                            <div class="card-body" id="tabla_area">

                                            </div>
                                        </div>
                                        
                                    </div>
                                </div> <!--div Collapse -->
                            </div>
                            <div class="col-10">
                                <div id="adm_proceso" class="row collapse in">
                                    <div class="col-xl-12">
                                        <div class="card-box" style="border-style: solid; border-width: 1px; border-color: #32C861;">
                                            <div class="card-header" style="background-color: #E8F8ED; height: 50px; padding-top: 5px;">
                                                <h4 class="page-title">
                                                    <a style="color: #32C861;" href="#" data-toggle="modal" data-target="#modal_crear_proceso" title="Registrar Proceso">
                                                        <i class="far fa-plus-square"></i>
                                                    </a> Procesos
                                                </h4>
                                            </div>
                                            <div class="card-body" id="tabla_proceso">

                                            </div>
                                        </div>
                                        
                                    </div>
                                </div> <!--div Collapse -->
                            </div>
                            <div class="col-10">
                                <div id="adm_personal" class="row collapse in">
                                    <div class="col-xl-12">
                                        <div class="card-box" style="border-style: solid; border-width: 1px; border-color: #32C861;">
                                            <div class="card-header" style="background-color: #E8F8ED; height: 50px; padding-top: 5px;">
                                                <h4 class="page-title">
                                                    <a style="color: #32C861;" href="#" data-toggle="modal" data-target="#modal_crear_administrador" title="Registrar Administrador">
                                                        <i class="far fa-plus-square"></i>
                                                    </a> Personal
                                                </h4>
                                            </div>
                                            <div class="card-body table-responsive" id="tabla_administrador">

                                            </div>
                                        </div>
                                        
                                    </div>
                                </div> <!--div Collapse -->
                            </div>

                            <?php include "modal_create_administrador.php"; ?>
                            <?php include "modal_create_area.php"; ?>
                            <?php include "modal_create_proceso.php"; ?>
                            <?php /*include "modal_update_administrador.php";*/ ?>
                            <div id="modal_crear_asignacion" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Asignar Procesos a Administradores</h4>
                                        </div>
                                        <div class="modal-body" id="asignar_proceso">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="create_asignacion" class="btn btn-purple waves-effect" data-dismiss="modal">Guardar</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            <div id="modal_modificar_asignacion" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Asignar Procesos a Administradores</h4>
                                        </div>
                                        <div class="modal-body" id="actualizar_proceso">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="update_asignacion" class="btn btn-purple waves-effect" data-dismiss="modal">Guardar</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                            <!--=================================================================================
                            =   MODAL PARA VER LOS MENSAJES RECIBIDOS Y ENVIADOS ENTRE LOS ADMINISTRADORES  =
                            ==================================================================================-->
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
            $(document).on("click", ".btnEliminarAdministrador", function() {
                cadena = "adm_id=" + $(this).closest('tr').find('td:eq(0)').text();
                nombre = $(this).closest('tr').find('td:eq(2)').text();
                //alert(nombre); return false;
                Swal.fire({
                    title: 'Se Eliminará a ' + nombre,
                    text: "No podrás revertir esto!",
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminarlo!'
                }).then((result) => {
                    if(result.value) {
                        
                        //alert(cadena);
                        $.ajax({
                            url: "assets/inc/delete_administrador.php",
                            data: cadena,
                            type: "POST",
                            success: function(response) {
                                if(response == 1) {
                                    $('#tabla_administrador').load('tabla_administrador.php');
                                    Swal.fire({
                                        type: 'success',
                                        title: 'El administrador ' +nombre+ ' a sido eliminado.',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                }
                            }
                        });
                    }
                })
            })
            //------------------------------------------------------------------------------------//
            //------------------------------------------------------------------------------------//
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
                // 1. CARGAMOS LA TABLA DE CLIENTES
                $('#tabla_administrador').load('tabla_administrador.php');
                $('#tabla_area').load('tabla_area.php');
                $('#tabla_proceso').load('tabla_proceso.php');
                // COLOCAMOS EN FOCO EN EL INPUT CI/NIT
                $('#modal_crear_administrador').on('shown.bs.modal',function(){
                    $('#adm_ci_nit').trigger('focus');
                });
                $('#modal_crear_area').on('shown.bs.modal',function(){
                    $('#area_nombre').trigger('focus');
                });
                $('#modal_crear_proceso').on('shown.bs.modal',function(){
                    $('#proceso_nombre').trigger('focus');
                });
                // 2.  REGISTRO DE UN NUEVO CLIENTE
                $('#create_administrador').click(function(){                    
                    var file_data = $("#upload_foto").prop("files")[0];
                    var datos = new FormData();
                    
                    datos.append("upload_foto", file_data);
                    datos.append("adm_ci_nit", $("#adm_ci_nit").val());
                    datos.append("adm_nombre", $("#adm_nombre").val());
                    datos.append("adm_direccion", $("#adm_direccion").val());
                    datos.append("adm_celular", $("#adm_celular").val());
                    datos.append("adm_area", $("#adm_area").val());
                    datos.append("usuario_user", $("#usuario_user").val());
                    datos.append("usuario_pass", $("#usuario_pass").val());
                    datos.append("usuario_rol", $("#usuario_rol").val());
                    for (var value of datos.values()) {
                        console.log(value);
                    }
                    alert(datos); return false;
                    $.ajax({
                        cahe: false,
                        contentType: false,
                        data: datos,
                        dataType: 'JSON',
                        enctype: 'multipart/form-data',
                        processData: false,
                        method:"POST",
                        url:"assets/inc/create_administrador.php",
                        success:function(response){
                            if (response == 1) {
                                Swal.fire({
                                    type: 'success',
                                    title: 'Administrador agregado exitosamente.',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                $('#tabla_administrador').load('tabla_administrador.php');
                                $('#modal_crear_administrador').on('hidden.bs.modal', function (){
                                    $(this).find('#formulario_crear_administrador')[0].reset();
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
                // 3. ACTUALIZACION DE DATOS DEL CLIENTE
                $('#update_administrador').click(function(){
                    var datos = $('#formulario_actualizar_administrador').serialize();
                    //alert(datos); return false;
                    $.ajax({
                        type:"POST",
                        url:"assets/inc/update_administrador.php",
                        data:datos,
                        success:function(response){
                            if(response==1){
                                $('#tabla_administrador').load('tabla_administrador.php');
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
            });
            
            $("#create_proceso").click(function(){
                var datos = $('#formulario_crear_proceso').serialize();
                //alert(datos); return false;
                $.ajax({
                    type:"POST",
                    url:"assets/inc/create_proceso.php",
                    data:datos,
                    success:function(response){
                        if (response == 1) {
                            $('#tabla_proceso').load('tabla_proceso.php');
                            $('#modal_crear_proceso').on('hidden.bs.modal', function (){
                                $(this).find('#formulario_crear_proceso')[0].reset();
                            });
                            /*$('#c_paciente')[0].reset();*/ //Limpia los inputs del formulario con id=c_paciente*/
                            Swal.fire({
                                type: 'success',
                                title: 'Proceso Agregado Exitosamente.',
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
            $("#create_asignacion").click(function(){
                var datos = $('#formulario_crear_asignacion').serialize();
                //alert(datos); return false;
                $.ajax({
                    type:"POST",
                    url:"assets/inc/create_asignacion.php",
                    data:datos,
                    success:function(response){
                        if (response) {
                            $('#tabla_administrador').load('tabla_administrador.php');
                            Swal.fire({
                                type: 'success',
                                title: 'Asignación exitosa.',
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
            $(document).on("click", ".btnAsignar", function() {
                var cadena = "adm_id=" + $(this).closest('tr').find('td:eq(0)').text();
                //alert(cadena); return false;
                $.ajax({
                    type: "POST",
                    url: "assets/inc/update_id_config.php",
                    data: cadena,
                    success: function(r) {
                        if(r) {
                            $('#asignar_proceso').load('modal_create_asignacion.php');
                            $('#modal_crear_asignacion').modal('show');
                        }
                    }
                });
            });
            
            $(document).on("click", ".btnModificar", function() {
                var cadena = "adm_id=" + $(this).closest('tr').find('td:eq(0)').text();
                //alert(cadena); return false;
                $.ajax({
                    type: "POST",
                    url: "assets/inc/update_id_config.php",
                    data: cadena,
                    success: function(r) {
                        if(r) {
                            $('#actualizar_proceso').load('modal_update_asignacion.php');
                            $('#modal_modificar_asignacion').modal('show');
                        }
                    }
                });
            });
            $("#update_asignacion").click(function(){
                var datos = $('#formulario_crear_asignacion').serialize();
                //alert(datos); return false;
                $.ajax({
                    type:"POST",
                    url:"assets/inc/update_asignacion.php",
                    data:datos,
                    success:function(response){
                        if (response) {
                            $('#tabla_administrador').load('tabla_administrador.php');
                            Swal.fire({
                                type: 'success',
                                title: 'Asignación exitosa.',
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
            function showError(cadena){
                var dato = $('#'+cadena).val();
                if (dato != '') {
                    document.getElementById("error_"+cadena).style.display = "none";
                }else{
                    document.getElementById("error_"+cadena).style.display = "";
                }
            }
            function showErrorPass(cadena){
                var dato = $('#'+cadena).val();
                if (dato != '') {
                    document.getElementById("error_"+cadena).style.display = "none";
                    document.getElementById("error_usuario_pass_ok").style.display = 'none';
                    document.getElementById("error_usuario_pass_ok2").style.display = 'none';
                    document.getElementById("error_usuario_pass_noverif").style.display = 'none';
                    document.getElementById("error_usuario_pass_noverif2").style.display = 'none';
                }else{
                    document.getElementById("error_"+cadena).style.display = "";
                    document.getElementById("error_usuario_pass_ok").style.display = 'none';
                    document.getElementById("error_usuario_pass_ok2").style.display = 'none';
                    document.getElementById("error_usuario_pass_noverif").style.display = 'none';
                    document.getElementById("error_usuario_pass_noverif2").style.display = 'none';
                }
            }
            function verifPass(){
                var pass1 = document.getElementById("usuario_pass").value;
                var pass2 = document.getElementById("usuario_pass_verif").value;
                if (pass2 == "" || pass1 == "") {
                    document.getElementById("error_usuario_pass_ok").style.display = 'none';
                    document.getElementById("error_usuario_pass_ok2").style.display = 'none';
                    document.getElementById("error_usuario_pass_noverif").style.display = 'none';
                    document.getElementById("error_usuario_pass_noverif2").style.display = 'none';
                }else if(pass2 == pass1){
                    document.getElementById("error_usuario_pass_ok").style.display = '';
                    document.getElementById("error_usuario_pass_ok2").style.display = '';
                    document.getElementById("error_usuario_pass_noverif").style.display = 'none';
                    document.getElementById("error_usuario_pass_noverif2").style.display = 'none';
                }else{
                    document.getElementById("error_usuario_pass_noverif").style.display = '';
                    document.getElementById("error_usuario_pass_noverif2").style.display = '';
                    document.getElementById("error_usuario_pass_ok").style.display = 'none';
                    document.getElementById("error_usuario_pass_ok2").style.display = 'none';
                    document.getElementById("usuario_pass").value = '';
                    document.getElementById("usuario_pass_verif").value = '';
                    document.getElementById("usuario_pass").focus();
                }
            }
            function verificar() {
                var ci = document.getElementById("adm_ci_nit").value;
                var nombre = document.getElementById("adm_nombre").value;
                var area = document.getElementById("adm_area").value;
                var user = document.getElementById("usuario_user").value;
                var pass = document.getElementById("usuario_pass").value;
                var passverif = document.getElementById("usuario_pass_verif").value;
                if (ci != "" && nombre != "" && area != "" && user != "" && pass != "" && passverif != "") {
                    document.getElementById("create_administrador").disabled = false;
                }else{
                    document.getElementById("create_administrador").disabled = true;
                }
            }

            /*$("#btnArea").click(function(){
                swa = $("#switch_area").val();
                swpr = $("#switch_proceso").val();
                swp = $("#switch_personal").val();
                if (swa == 0) {
                    $("#card_area").css('border-color', '#32C861');
                    $("#img_area").css('transform', 'rotate(180deg)');
                    $("#switch_area").val('1');
                    //$("#card_proceso").css('border-color', '#fff');
                    if (swpr != '0') {
                        $("#adm_proceso").addClass('collapse');
                        $("#adm_proceso").removeClass('expanded');
                        $("#card_proceso").css('border-color', '#fff');
                        $("#img_proceso").css('transform', 'rotate(90deg)');
                        $("#switch_proceso").val('0');
                    }
                    if (swp != '0') {
                        $("#adm_personal").addClass('');
                        $("#card_personal").css('border-color', '#fff');
                        $("#img_personal").css('transform', 'rotate(90deg)');
                        $("#switch_personal").val('0');
                    }
                }else{
                    $("#card_area").css('border-color', '#fff');
                    $("#img_area").css('transform', 'rotate(90deg)');
                    $("#switch_area").val('0');
                    
                }
            })
            $("#btnProceso").click(function(){
                swa = $("#switch_area").val();
                swpr = $("#switch_proceso").val();
                swp = $("#switch_personal").val();
                if (swpr == 0) {
                    $("#card_proceso").css('border-color', '#32C861');
                    $("#img_proceso").css('transform', 'rotate(180deg)');
                    $("#switch_proceso").val('1');
                    //$("#card_proceso").css('border-color', '#fff');
                    

                }else{
                    $("#card_proceso").css('border-color', '#fff');
                    $("#img_proceso").css('transform', 'rotate(90deg)');
                    $("#switch_proceso").val('0');
                    
                }
            })
            $("#btnPersonal").click(function(){
                swa = $("#switch_area").val();
                swpr = $("#switch_proceso").val();
                swp = $("#switch_personal").val();
                if (swp == 0) {
                    $("#card_personal").css('border-color', '#32C861');
                    $("#img_personal").css('transform', 'rotate(180deg)');
                    $("#switch_personal").val('1');
                    //$("#card_personal").css('border-color', '#fff');

                }else{
                    $("#card_personal").css('border-color', '#fff');
                    $("#img_personal").css('transform', 'rotate(90deg)');
                    $("#switch_personal").val('0');
                    
                }
            })
            $(".A").hide();
            $(".Q").click(function() {
                var that = this;
                $(".A:visible").slideUp("slow");
                $(".Q span.expanded")
                    .removeClass('expanded')
                    .addClass('collapsed');
                $(this)
                    .next(".A:hidden")
                    .slideDown("slow", function(){
                        $('span.collapsed', that)
                            .removeClass('collapsed')
                            .addClass('expanded');
                    });
            });
            */
        </script>
    </body>
</html>