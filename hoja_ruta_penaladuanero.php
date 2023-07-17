<?php
include("assets/inc/conexion.php");

session_start();
if (!isset($_SESSION['adm_id'])) {
	header('Location: login.php');
}

$adm_id = $_SESSION['adm_id'];
$sql = "SELECT adm_id, adm_nombre, adm_rol, area_id FROM administrador WHERE adm_id = '$adm_id'";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include 'assets/inc/head.php'; ?>
        <style type="text/css">
            /*Para inputs en los heads de los datatables*/
            thead input {
                width: 100%;
                padding: 3px;
                /*box-sizing: border-box;*/
            }
            /*Para el icono de buscar en el input de thead en datatables*/
            input {
              font-family: 'Font Awesome\ 5 Free', Montserrat, Helvetica, sans-serif;
              font-weight: 900;
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
                                    
                                    <h4 class="page-title">
                                        <a style="color:purple;" href="#" data-toggle="modal" data-target="#modal_crear_hoja" title="Registrar Hoja de Ruta">
                                            <i class="far fa-plus-square"></i>
                                        </a>Administración de Hojas de Ruta Penal Aduanero
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
                                <!-- inicio tabla hoja de ruta -->
                                <div class="card-box table-responsive" id="tabla_hoja">

                                </div>
                                <!-- fin tabla hoja de ruta -->

                                <!-- Modales para Crear y Actualizar, Hojas de Ruta, Etc -->
                                <?php include "modal_create_hoja_penal_aduana.php"; ?>
                                <?php include "modal_create_cliente.php"; ?>
                                <div id="modal_crear_evento_hoja" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myModalLabel">Registrar Evento de Hojas de Ruta Penal Aduanero</h4>
                                            </div>
                                            <div class="modal-body" id="evento_hoja">
                                                <!-- Dentro de este DIV, se muestra el formulario de registro de un evento de la hoja de ruta -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="close_evento_hoja" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                                <button type="button" id="create_evento_hoja" class="btn btn-purple waves-effect" data-dismiss="modal" disabled>Guardar</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <!-- /.modal editar accion -->
                                
                                <div id="modal_finalizar_hoja_detalle" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myModalLabel">Finalizar Accion de Hoja de Ruta</h4>
                                            </div>
                                            <div class="modal-body" id="finalizar_hoja_detalle">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Cerrar</button>
                                                <button type="button" id="update_file_hoja" class="btn btn-purple waves-effect" data-dismiss="modal" disabled>Enviar Respuesta</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <div id="modal_editar_hoja" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myModalLabel">Actualizar Hoja de Ruta Penal Aduanero</h4>
                                            </div>
                                            <div class="modal-body" id="editar_hoja">
                                                <!-- Dentro de este DIV, se muestra los datos de la hoja de ruta a editar -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="cerrar_hoja" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                                <button type="button" id="update_hoja" class="btn btn-purple waves-effect" data-dismiss="modal">Actualizar</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                
                                <div id="modal_respuesta_hoja_detalle" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myModalLabel">Respuesta Accion de Hoja de Ruta</h4>
                                            </div>
                                            <div class="modal-body" id="respuesta_hoja_detalle">
                                                
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" id="update_respuesta_accion_fin" class="btn btn-success waves-effect">Finalizar Evento</button>
                                                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Cerrar</button>
                                                <button type="button" id="update_respuesta_accion" class="btn btn-purple waves-effect" disabled>Reenviar Accion</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <!--=================================================================================
                                =   MODAL PARA VER EL DETALLE DE TODOS LOS EVENTOS REGISTRADOS DE UNA HOJA DE RUTA  =
                                ==================================================================================-->
                                <div id="modal_detalle_hoja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">DETALLE DE EVENTOS DE LA HOJA DE RUTA:&nbsp;
                                                    <span id="numero_tramite">
                                                    </span>
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body" id="tabla_hoja_detalle">

                                            </div>
                                            <!-- <div class="modal-footer"></div> -->
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
                                <!-- Modales para Crear y Actualizar, Medicamentos -->

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
        <script type="text/javascript">
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
                //PARA APILAR MODALES INDEFINIDAMENTE https://stackoverflow.com/questions/19305821/multiple-modals-overlay
                $('.modal').on('show.bs.modal', function(event) {
                    var idx = $('.modal:visible').length;
                    $(this).css('z-index', 1040 + (10 * idx));
                });
                $('.modal').on('shown.bs.modal', function(event) {
                    var idx = ($('.modal:visible').length) -1; // raise backdrop after animation.
                    $('.modal-backdrop').not('.stacked').css('z-index', 1039 + (10 * idx));
                    $('.modal-backdrop').not('.stacked').addClass('stacked');
                });
                //PARA APILAR MODALES INDEFINIDAMENTE https://stackoverflow.com/questions/19305821/multiple-modals-overlay
                // 2.  REGISTRO DE UN NUEVO CLIENTE
                $('#create_cliente').click(function(){
                        var datos = $('#formulario_crear_cliente').serialize();
                        //alert(datos); return false;
                        $.ajax({
                            type:"POST",
                            url:"assets/inc/create_cliente.php",
                            data:datos,
                            success:function(response){
                                if (response == 1) {
                                    $('#tabla_cliente').load('tabla_cliente.php');
                                    $('#modal_crear_cliente').on('hidden.bs.modal', function (){
                                        $(this).find('#formulario_crear_cliente')[0].reset();
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
                // 2.  REGISTRO DE UN NUEVO CLIENTE

                $(".parsley_create_medicamento").parsley();
                //Editar (Recupera el ID de hoja de ruta y lo guarda en la tabla configuracion, luego se carga el modal update hoja de ruta con todos los datos que corresponden a ese ID.)
                $(document).on("click", ".btnEditarHoja", function() {
                    cadena = "hoja_id=" + $(this).closest('tr').find('td:eq(0)').text();
                    //alert(cadena); return false;
                    //https://jsonformatter.org/jsbeautifier
                    $.ajax({
                        type: "POST",
                        url: "assets/inc/update_hoja_id.php",
                        data: cadena,
                        success: function(r) {
                                if(r) {
                                    $('#editar_hoja').load('modal_update_hoja_penal_aduana.php');
                                    $('#modal_editar_hoja').modal('show');
                                }
                            }
                    });
                });
                $(document).on("click", ".btnEventoHoja", function() {
                    cadena = "hoja_id=" + $(this).closest('tr').find('td:eq(0)').text();
                    //alert(cadena); return false;
                    //https://jsonformatter.org/jsbeautifier
                    $.ajax({
                        type: "POST",
                        url: "assets/inc/update_hoja_id.php",
                        data: cadena,
                        success: function(r) {
                                if(r) {
                                    $('#evento_hoja').load('modal_create_evento_hoja.php');
                                    $('#modal_crear_evento_hoja').modal('show');
                                }
                            }
                    });
                });
                $(document).on("click", ".btnEditarAccion", function() {
                    cadena = "hoja_id=" + $(this).closest('tr').find('td:eq(0)').text();
                    //alert(cadena); return false;
                    //https://jsonformatter.org/jsbeautifier
                    $.ajax({
                        type: "POST",
                        url: "assets/inc/update_hoja_id.php",
                        data: cadena,
                        success: function(r) {
                                if(r) {
                                    $('#update_evento_hoja').load('modal_update_evento_hoja.php');
                                    $('#modal_editar_evento_hoja').modal('show');
                                }
                            }
                    });
                });

                // ACTUALIZACION DE DATOS DEL HOJA DE RUTA
                $('#update_hoja').click(function(){
                    var datos = $('#formulario_actualizar_hoja').serialize();
                    //alert(datos); return false;
                    $.ajax({
                        type:"POST",
                        url:"assets/inc/update_hoja.php",
                        data:datos,
                        success:function(response){
                            if(response){
                                $('#tabla_hoja').load('tabla_hoja_penaladuana_serverside.php');
                                $('#modal_crear_hoja').on('hidden.bs.modal', function() {
                                    $(this).find('#formulario_crear_hoja')[0].reset();
                                });
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

                //COLOCAMOS EL FOCO EN EL INPUT NOMBRE DE DATOS DEL CLIENTE AL LLENAR LA HOJA DE RUTA
                $('#modal_crear_hoja').on('shown.bs.modal', function() {
                    $('#hoja_nombre_solicitante').focus();
                });
                //COLOCAMOS EL FOCO EN EL INPUT PARA COLOCAR EL NOMBRE DE LA ETAPA DE UN EVENTO DE LA HOJA DE RUTA
                $('#modal_crear_evento_hoja').on('shown.bs.modal', function() {
                    $('#detalle_etapa').focus();
                });
                $('#modal_respuesta_hoja_detalle').on('shown.bs.modal', function() {
                    $('#det_respuesta_fin').focus();
                });
                //Imprimir Hoja de Ruta despues de Registrar Hoja
                $(document).on("click", ".btnImprimirHoja", function() {
                    cadena = "hoja_id=" + $(this).closest('tr').find('td:eq(0)').text();
                    //alert(cadena); return false;
                    //https://jsonformatter.org/jsbeautifier
                    $.ajax({
                        type: "POST",
                        url: "assets/inc/update_numero_hoja.php",
                        data: cadena,
                        success: function(r) {
                                if(r != 1) {
                                    //window.open('http://localhost/qjl/tcpdf/pdf/hoja_ruta.php', '_blank');
                                    Swal.fire({
                                        type: 'warning',
                                        title: 'Error al generar el Reporte de la Hoja de Ruta',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                }
                            }
                    });
                });
                //Imprimir Hoja de Ruta despues de Registrar Hoja
                $(document).on("click", ".btnImprimirBitacora", function() {
                    cadena = "hoja_id=" + $(this).closest('tr').find('td:eq(0)').text();
                    //alert(cadena); return false;
                    //https://jsonformatter.org/jsbeautifier
                    $.ajax({
                        type: "POST",
                        url: "assets/inc/update_numero_hoja.php",
                        data: cadena,
                        success: function(r) {
                                if(r != 1) {
                                    //window.open('http://localhost/qjl/tcpdf/pdf/hoja_ruta.php', '_blank');
                                    Swal.fire({
                                        type: 'warning',
                                        title: 'Error al generar el Reporte de la Hoja de Ruta',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                }
                            }
                    });
                });
                //Imprimir Hoja de Ruta despues de Registrar Hoja
                $(document).on("click", ".btnBitacoraBlanco", function() {
                    cadena = "hoja_id=" + $(this).closest('tr').find('td:eq(0)').text();
                    //alert(cadena); return false;
                    //https://jsonformatter.org/jsbeautifier
                    $.ajax({
                        type: "POST",
                        url: "assets/inc/update_numero_hoja.php",
                        data: cadena,
                        success: function(r) {
                                if(r != 1) {
                                    //window.open('http://localhost/qjl/tcpdf/pdf/hoja_ruta.php', '_blank');
                                    Swal.fire({
                                        type: 'warning',
                                        title: 'Error al generar el Reporte de la Hoja de Ruta',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                }
                            }
                    });
                });
                
                //Borrar
                $(document).on("click", ".btnBorrarAccion", function() {
                    //e.preventDefault();//evita el comportambiento normal del submit, es decir, recarga total de la página
                    fila = $(this);
                    //alert(fila); return false;
                    eventi_id = parseInt($(this).closest('tr').find('td:eq(0)').text());
                    nombre_eve = $(this).closest('tr').find('td:eq(2)').text();
                    Swal.fire({
                        title: 'Se Borrará ' + nombre_eve,
                        text: "No podrás revertir esto!",
                        type: 'warning',
                        showCancelButton: true,
                        cancelButtonText: 'Cancelar',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, eliminarlo!'
                    }).then((result) => {
                        if(result.value) {
                            cadena = "id=" + eventi_id;
                            //alert(cadena);
                            $.ajax({
                                url: "assets/inc/delete_accion.php",
                                data: cadena,
                                type: "POST",
                                success: function(response) {
                                    if(response == 1) {
                                        Swal.fire({
                                            type: 'success',
                                            title: 'Tu evento a sido Borrado.',
                                            showConfirmButton: false,
                                            timer: 2000
                                        })
                                        $('#alarma_notificaciones_topbar').load('alarma/alarma_notificaciones_topbar.php');
                                        $('#tabla_hoja_detalle').load('tabla_detalle_hoja.php');
                                        $('#modal_detalle_hoja').modal('show');
                                    }else{
                                        Swal.fire({
                                            type: 'danger',
                                            title: 'Error en alguna parte.',
                                            showConfirmButton: false,
                                            timer: 2000
                                        })
                                    }
                                }
                            });
                        }
                    })
                });

                //Historial de Eventos de una Hoja de Ruta
                $(document).on("click", ".btnDetalleHoja", function() {
                    cadena = "hoja_id=" + $(this).closest('tr').find('td:eq(0)').text();
                    document.getElementById("numero_tramite").innerHTML = $(this).closest('tr').find('td:eq(1)').text();
                    //alert(cadena); return false;
                    $.ajax({
                        type: "POST",
                        url: "assets/inc/update_hoja_id.php",
                        data: cadena,
                        success: function(response) {
                                if(response) {
                                    $('#tabla_hoja_detalle').load('tabla_detalle_hoja.php');
                                    $('#modal_detalle_hoja').modal('show');
                                }
                            }
                    });
                });
                // 1.  REGISTRO DE UNA NUEVA HOJA DE RUTA
                $('#create_hoja').click(function() {
                    var datos = $('#formulario_crear_hoja').serialize();
                    //alert(datos); return false;
                    $.ajax({
                        type: "POST",
                        url: "assets/inc/create_hoja.php",
                        data: datos,
                        success: function(response) {
                            if(response == 1) {
                                Swal.fire({
                                    type: 'success',
                                    title: 'Registro de Hoja de Ruta Exitosamente.',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                $('#tabla_hoja').load('tabla_hoja_penaladuana_serverside.php');
                                $('#modal_crear_hoja').on('hidden.bs.modal', function() {
                                    $(this).find('#formulario_crear_hoja')[0].reset();
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
                
                //CARGAMOS TODAS LAS HOJAS DE RUTA
                $('#tabla_hoja').load('tabla_hoja_penaladuana_serverside.php');
                //COLOCAMOS EL FOCO EN UN INPUT PARA COLOCAR NOMBRE
                $('#modal_crear_hoja').on('shown.bs.modal',function(){
                    $('#prod_nombre_comercial').trigger('focus');
                });

                //AUTOCOMPLETA DATOS DEL CLIENTE O SOLICITANTE
                $("#hoja_nombre_solicitante").autocomplete({
                    appendTo: '#modal_crear_hoja',
                    source: function(request, response) {
                        $.ajax({
                            url: "autocomplete_nombre_solicitante.php",
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
                        $('#cli_id').val(ui.item.id);
                        $('#hoja_nombre_solicitante').val(ui.item.nombre);
                        $('#hoja_ci_solicitante').val(ui.item.ci);
                        $('#hoja_celular_solicitante').val(ui.item.celular);
                        return false;
                    }
                });

                //AUTOCOMPLETA DATOS DEL ENCARGADO DE AREA AL QUE SE ENTREGA LA HOJA DE RUTA
                $("#hoja_area_destino").autocomplete({
                    appendTo: '#modal_crear_hoja',
                    source: function(request, response) {
                        $.ajax({
                            url: "autocomplete_nombre_responsable.php",
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
                        $('#hoja_area_destino').val(ui.item.area);
                        $('#hoja_responsable_area').val(ui.item.nombre);
                        return false;
                    }
                });

                //AUTOCOMPLETA DATOS DEL ENCARGADO DE AREA AL QUE SE ENTREGA LA HOJA DE RUTA
                $("#area_update").autocomplete({
                    appendTo: '#modal_editar_hoja',
                    source: function(request, response) {
                        $.ajax({
                            url: "autocomplete_nombre_responsable.php",
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
                        $('#area_update').val(ui.item.area);
                        $('#responsable_update').val(ui.item.nombre);
                        return false;
                    }
                });

                //CREAR EVENTO PARA UNA HOJA DE RUTA CREADA
                $('#create_evento_hoja').click(function(){
                    var file_data = $("#uploadFile").prop("files")[0];
                    var datos = new FormData();
                    datos.append("uploadFile", file_data);
                    datos.append("hoja_id", $("#hoja_id").val());
                    datos.append("admin", $("#admin").val());
                    datos.append("hoja_numero_tramite", $("#hoja_numero_tramite").val());
                    datos.append("nombre_update_cliente", $("#nombre_update_cliente").val());
                    datos.append("detalle_etapa", $("#detalle_etapa").val());
                    datos.append("detalle_accion", $("#detalle_accion").val());
                    datos.append("detalle_inicio", $("#detalle_inicio").val());
                    datos.append("detalle_fecha_fin", $("#detalle_fecha_fin").val());
                    datos.append("detalle_audiencia", $("#detalle_audiencia").val());
                    datos.append("detalle_juzgado", $("#detalle_juzgado").val());
                    datos.append("lugar_juzgado", $("#lugar_juzgado").val());
                    datos.append("detalle_estado", $("#detalle_estado").val());
                    datos.append("detalle_observacion", $("#detalle_observacion").val());
                    datos.append("responsable_area", $("#responsable_area").val());
                    for (var value of datos.values()) {
                        console.log(value);
                    }

                    //alert(datos); return false;
                    $.ajax({
                        cahe: false,
                        contentType: false,
                        data: datos,
                        dataType: 'JSON',
                        enctype: 'multipart/form-data',
                        processData: false,
                        method:"POST",
                        url:"assets/inc/create_evento_hoja.php",
                        success:function(response){
                            if(response){
                                Swal.fire({
                                    type: 'success',
                                    title: 'Registro de Evento Exitoso',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                $('#alarma_notificaciones_topbar').load('alarma/alarma_notificaciones_topbar.php');
                                $('#formulario_crear_evento_hoja').trigger("reset");
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
            function showInp(){
                var accion = document.getElementById("detalle_accion").value;
                if(accion == "AUDIENCIA"){
                    document.getElementById("audiencia").style.display = "";
                    document.getElementById("juzgado").style.display = "";
                    document.getElementById("respuesta").style.display = "none";
                    document.getElementById("error_accion").style.display = "none";
                    document.getElementById("field_file").style.display = "none";
                    document.getElementById("field_f").style.display = "none";
                    document.getElementById("det_obs").style.display = "";
                    document.getElementById("resp_area").style.display = "";
                }else if(accion=="") {
                    document.getElementById("error_accion").style.display = "";
                    document.getElementById("respuesta").style.display = "";
                    document.getElementById("audiencia").style.display = "none";
                    document.getElementById("create_evento_hoja").disabled = true;
                }else {
                    document.getElementById("audiencia").style.display = "none";
                    document.getElementById("juzgado").style.display = "none";
                    document.getElementById("respuesta").style.display = "";
                    document.getElementById("error_accion").style.display = "none";
                    document.getElementById("field_file").style.display = "";
                    document.getElementById("field_f").style.display = "";
                    document.getElementById("det_obs").style.display = "";
                    document.getElementById("resp_area").style.display = "";
                }
            }
            function verificar() {
                var etapa = document.getElementById("detalle_etapa").value;
                var accion = document.getElementById("detalle_accion").value;
                var detfin = document.getElementById("detalle_fecha_fin").value;
                var audiencia = document.getElementById("detalle_audiencia").value;
                var juzgado = document.getElementById("detalle_juzgado").value;
                var obs = document.getElementById("detalle_observacion").value;
                var encargado = document.getElementById("responsable_area").value;
                if (etapa != "") {
                    if (accion == "AUDIENCIA") {
                        if (detfin != "0000-00-00 00:00:00" && juzgado != "" && obs != "" && encargado != "") {
                            document.getElementById("create_evento_hoja").disabled = false;
                        }else{
                            document.getElementById("create_evento_hoja").disabled = true;
                        }
                    }else if (detfin != "0000-00-00 00:00:00" && obs != "" && encargado != "") {
                        document.getElementById("create_evento_hoja").disabled = false;
                    }else{
                        document.getElementById("create_evento_hoja").disabled = true;
                    }
                }else{
                    document.getElementById("create_evento_hoja").disabled = true;
                }
            }
            function verif(detalle) {
                if (detalle == "registro") {
                    var audiencia = document.getElementById("detalle_audiencia").value;
                    var juzgado = document.getElementById("detalle_juzgado").value;
                    var obs = document.getElementById("det_observacion").value;
                    var encargado = document.getElementById("responsable_area").value;
                    if (juzgado != "" && obs != "" && encargado != "") {
                        document.getElementById("update_audiencia_hoja").disabled = false;
                    }else{
                        document.getElementById("update_audiencia_hoja").disabled = true;
                    }
                }else if (detalle == "fin"){
                    var obs = $("#det_respuesta").val();
                    if (obs != "" ) {
                        document.getElementById("update_file_hoja").disabled = false;
                    }else{
                        document.getElementById("update_file_hoja").disabled = true;
                    }
                }else if (detalle == "reenvio"){
                    var obs = $("#det_respuesta_fin").val();
                    var fecfin = $("#detalle_resp_fin").val();
                    //alert(fecfin); return false;
                    if (obs != "" && fecfin != "") {
                        document.getElementById("update_respuesta_accion").disabled = false;
                    }else{
                        document.getElementById("update_respuesta_accion").disabled = true;
                    }
                }
            }
            function showError(cadena){
                var dato = $('#'+cadena+'').val();
                console.log(dato);
                if (dato != '') {
                    document.getElementById("error_"+cadena+"").style.display = "none";
                }else{
                    document.getElementById("error_"+cadena+"").style.display = "";
                }
            }
            $("#update_file_hoja").click(function(){
                cadena = "hoja_id="+$("#hoja_id").val();
                tramite = $("#hoja_numero_tramite_update").val();
                audi_sw = $("#audi_switch").val();
                //alert(audi_sw); return false;
                
                var file_data = $("#newFile").prop("files")[0];
                var datos = new FormData();
                
                datos.append("newFile", file_data);
                datos.append("detalle_id", $("#detalle_id").val());
                datos.append("admin_eve", $("#admin_eve").val());
                datos.append("identificador", $("#identificador").val());
                datos.append("det_respuesta", $("#det_respuesta").val());
                datos.append("det_leido", $("#det_leido").val());
                datos.append("det_estado_update", $("#det_estado_update").val());
                
                //console.log(datos); 
                //alert(datos); return false;
                $.ajax({
                    cache: false,
                    contentType: false,
                    data: datos,
                    dataType: 'JSON',
                    enctype: 'multipart/form-data',
                    processData: false,
                    method: "POST",
                    url: "assets/inc/upload_file.php",
                    success:function(response){
                        if(response){
                            if (audi_sw != "0000-00-00 00:00:00") {
                                Swal.fire({
                                    type: 'success',
                                    title: 'Audiencia finalizada con éxito',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                $('#tabla_hoja_detalle').load('tabla_detalle_hoja.php');
                                $('#modal_detalle_hoja').modal('show');
                            }else{
                                Swal.fire({
                                    type: 'success',
                                    title: 'Accion finalizada con éxito',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                $('#alarma_notificaciones_topbar').load('alarma/alarma_notificaciones_topbar.php');
                            }
                        }else{
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
            function verificarCliente() {
                var cliente = document.getElementById("cli_id").value;
                if (cliente == '') {
                    Swal.fire({
                        type: 'warning',
                        title: 'Cliente no encontrado, por favor registre al cliente',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    document.getElementById("hoja_nombre_solicitante").value = '';
                    $('#modal_crear_cliente').modal('show');
                }
            }
            $('#modal_close').click(function(){
                $('#modal_crear_cliente').on('hidden.bs.modal', function (){
                    $(this).find('#formulario_crear_cliente')[0].reset();
                });
            });
            $('#modal_close_hoja').click(function(){
                $('#modal_crear_hoja').on('hidden.bs.modal', function() {
                    $(this).find('#formulario_crear_hoja')[0].reset();
                });
            });
            $('#modal_crear_cliente').on('shown.bs.modal',function(){
                $('#cli_ci_nit').trigger('focus');
            });
            function verifCliente() {
                var ci = document.getElementById("cli_ci_nit").value;
                var nombre = document.getElementById("cli_nombre").value;
                var genero = document.getElementById("cli_genero").value;
                var direccion = document.getElementById("cli_direccion").value;
                var celular = document.getElementById("cli_celular").value;
                if (ci != '' && nombre != '' && genero != '' && direccion != '' && celular != '') {
                    document.getElementById("create_cliente").disabled = false;
                }else{
                    document.getElementById("create_cliente").disabled = true;
                }
            }
            $(document).on("click", ".btnVerEventoHojaFinalizado", function() {
                cadena = "hoja_id=" + $(this).closest('tr').find('td:eq(0)').text();
                //alert(cadena); return false;
                //https://jsonformatter.org/jsbeautifier
                $.ajax({
                    type: "POST",
                    url: "assets/inc/update_hoja_id.php",
                    data: cadena,
                    success: function(r) {
                        if(r) {
                            $("#formulario_actualizar_hoja_detalle").trigger("reset");
                            document.getElementById("update_file_hoja").disabled = true;
                            $('#finalizar_hoja_detalle').load('modal_finalizar_evento_hoja.php');
                            $('#modal_finalizar_hoja_detalle').modal('show');
                            $('#modal_finalizar_hoja_detalle').on('shown.bs.modal',function(){
                                $('#det_respuesta').trigger('focus');
                            });
                        }
                    }
                });
            });
            $(document).on("click", ".btnRespLeido", function() {
                cadena = "resp_id=" + $(this).closest('tr').find('td:eq(0)').text();
                //alert(cadena); return false;
                //https://jsonformatter.org/jsbeautifier
                $.ajax({
                    type: "POST",
                    url: "assets/inc/update_detalle_leido.php",
                    data: cadena,
                    success: function(r) {
                        if(r) {
                            $('#notificaciones_table').load('tabla_notificaciones.php');
                        }
                    }
                });
            });
            $(document).on("click", ".btnVerRespuesta", function() {
                cadena = "hoja_id=" + $(this).closest('tr').find('td:eq(0)').text();
                //alert(cadena); return false;
                //https://jsonformatter.org/jsbeautifier
                $.ajax({
                    type: "POST",
                    url: "assets/inc/update_hoja_id.php",
                    data: cadena,
                    success: function(r) {
                        if(r) {
                            $('#respuesta_hoja_detalle').load('modal_respuesta_evento_hoja.php');
                            $('#modal_respuesta_hoja_detalle').modal('show');
                        }
                    }
                });
            });
            $(document).on("click", "#update_respuesta_accion_fin", function() {
                cadena = "resp_fin="+$("#detalle_id_fin").val();
                hoja = "hoja_id="+$("#hoja_id").val();
                tramite = $("#hoja_numero_tramite_fin").val();
                //alert(cadena); return false;
                //https://jsonformatter.org/jsbeautifier
                Swal.fire({
                    type: 'warning',
                    title: '¿Desea finalizar la accion de '+tramite+'?',
                    text: "",
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si'
                }).then((result) => {
                    if(result.value) {
                        $.ajax({
                            type: "POST",
                            url: "assets/inc/update_detalle_leido.php",
                            data: cadena,
                            success: function(r) {
                                if(r) {
                                    Swal.fire({
                                    type: 'success',
                                    title: '¿Desea fijar otro evento para la hoja de ruta ',
                                    text: tramite+"?",
                                    showCancelButton: true,
                                    cancelButtonText: 'No',
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Si'
                                    }).then((result) => {
                                        if(result.value) {
                                            $.ajax({
                                                type: "POST",
                                                url: "assets/inc/update_hoja_id.php",
                                                data: hoja,
                                                success: function(r) {
                                                    if(r) {
                                                        $('#alarma_notificaciones_topbar').load('alarma/alarma_notificaciones_topbar.php');
                                                        $('#modal_respuesta_hoja_detalle').modal('hide');
                                                        $('#evento_hoja').load('modal_create_evento_hoja.php');
                                                        $('#modal_crear_evento_hoja').modal('show');
                                                    }
                                                }
                                            });
                                        }else{
                                            $('#alarma_notificaciones_topbar').load('alarma/alarma_notificaciones_topbar.php');
                                            $('#modal_respuesta_hoja_detalle').modal('hide');
                                            Swal.fire({
                                                type: 'success',
                                                title: 'Evento finalizado.',
                                                showConfirmButton: false,
                                                timer: 2000
                                            })
                                        }
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
                    }
                })
            });
            $("#update_respuesta_accion").click(function(){
                cadena = "hoja_id="+$("#hoja_id").val();
                tramite = $("#hoja_numero_tramite_update").val();
                //alert(audi_sw); return false;
                
                var file_data = $("#endFile").prop("files")[0];
                var datos = new FormData();
                
                datos.append("newFile", file_data);
                datos.append("detalle_id", $("#detalle_id_fin").val());
                datos.append("admin_eve", $("#admin_eve_fin").val());
                datos.append("det_respuesta", $("#det_respuesta_fin").val());
                datos.append("det_fecha_fin", $("#detalle_resp_fin").val());
                datos.append("det_leido", $("#det_leido_fin").val());
                datos.append("det_estado_update", $("#det_estado_fin").val());
                for (var value of datos.values()) {
                    console.log(value);
                }
                //console.log(datos); 
                //alert(datos); return false;
                $.ajax({
                    cache: false,
                    contentType: false,
                    data: datos,
                    dataType: 'JSON',
                    enctype: 'multipart/form-data',
                    processData: false,
                    method: "POST",
                    url: "assets/inc/upload_file.php",
                    success:function(response){
                        if(response){
                            $('#alarma_notificaciones_topbar').load('alarma/alarma_notificaciones_topbar.php');
                            $('#modal_respuesta_hoja_detalle').modal('hide');
                            Swal.fire({
                                type: 'success',
                                title: 'Tarea reenviada.',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }else{
                            Swal.fire({
                                type: 'error',
                                title: 'Se ha Producido un Error.',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }
                    }
                })
            });
            function verFileSize(file_nombre){
            var archivo = $("#"+file_nombre).prop("files")[0].name;
            var ext=["doc","docx","pdf","jpge","jpg","xls","xlsx"];
            var tam= $("#"+file_nombre).prop("files")[0].size;
            archnom = archivo.slice((archivo.lastIndexOf(".") - 1 >>> 0) + 2);
            var buscar = ext.indexOf(archnom);
            if (buscar == -1) {
                Swal.fire({
                    type: 'warning',
                    title: 'Archivo no permitido',
                    text: 'El archivo debe ser: doc, pdf o jpg',
                    showConfirmButton: false,
                    timer: 2000
                })
                $("#"+file_nombre).val('');
                $("#"+file_nombre).html('');
            } else {
                if (tam > 5242880) {
                    Swal.fire({
                        type: 'warning',
                        title: 'El archivo es demasiado grande',
                        text: 'Los archivos deben pesar menos de 5MB',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $("#"+file_nombre).val('');
                    $("#"+file_nombre).html('');
                }
            }
        }
        </script>
    </body>
</html>
