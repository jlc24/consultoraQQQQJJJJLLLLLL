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
                                    <div class="page-title-right">
                                    </div>
                                    <h4 class="page-title">
                                        <a style="color:purple;" href="#" onclick="registrarAgenda()" data-toggle="modal" data-target="#modal_crear_evento" title="Registrar Evento en la Agenda">
                                            <i class="far fa-plus-square"></i>
                                        </a>Administración de la Agenda General
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <!--========================================
                        =            Contenido Principal           =
                        =========================================-->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <!--
                                            <a href="#" data-toggle="modal" data-target="#add-category" class="btn btn-lg btn-dark btn-block waves-effect mt-2 waves-light">
                                                <i class="fa fa-plus"></i> Crear Nuevo
                                            </a>-->
                                            <div id="external-events" class="mt-3">
                                                <br>
                                                <p class="text-muted">Colores de Texto y Fondo para los eventos en el Calendario</p>
                                                <div class="external-event bg-soft-secondary text-secondary" data-class="bg-secondary">
                                                    <i class="mdi mdi-checkbox-blank-circle mr-1 vertical-middle"></i>Jurídica
                                                </div>
                                                <div class="external-event bg-soft-pink text-pink" data-class="bg-pink">
                                                    <i class="mdi mdi-checkbox-blank-circle mr-1 vertical-middle"></i>Contable
                                                </div>
                                                <div class="external-event bg-soft-purple text-purple" data-class="bg-purple">
                                                    <i class="mdi mdi-checkbox-blank-circle mr-1 vertical-middle"></i>Marketing
                                                </div>
                                                <div class="external-event bg-soft-warning text-warning" data-class="bg-warning">
                                                    <i class="mdi mdi-checkbox-blank-circle mr-1 vertical-middle"></i>Otro evento
                                                </div>
                                            </div>

                                            <!-- checkbox 
                                            <div class="checkbox checkbox-primary mt-4">
                                                <input type="checkbox" id="drop-remove">
                                                <label for="drop-remove">
                                                    Remover después de soltar
                                                </label>
                                            </div>-->
                                        </div> <!-- end col-->
                                        <div class="col-lg-10">
                                            <div id="agenda"></div>
                                        </div> <!-- end col -->

                                        <?php include 'modal_create_evento.php'; ?>
                                    </div>  <!-- end row -->
                                </div>

                                <!-- BEGIN MODAL -->
                                <div class="modal fade none-border" id="event-modal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Agregar nuevo evento</h4>
                                            </div>
                                            <div class="modal-body pb-0"></div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                                <button type="button" class="btn btn-success save-event waves-effect waves-light">Crear Evento</button>
                                                <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Borrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

        <!--=============================  EVENTOS CALENDARIO WEB  =============================-->
        <script>
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
            });
            function registrarAgenda(){
                $('#close_evento').show();
                $('#create_evento').show();
                $('#update_evento').hide();
                $('#delete_evento').hide();
                document.getElementById("myModalLabelEventoCalendar").innerHTML = "Registrar Evento en la Agenda";
                $('#eventoNombre').focus();
            }
            function limpiarFormulario(){
                $('#eventoNombre').val('');
                $('#inicioEvento').val('');
                $('#finEvento').val('');
                $('#descripcionEvento').val('');
                $('#descripcionEvento').val('');
            }

            let agenda = new FullCalendar.Calendar(document.getElementById('agenda'),{
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    //right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    right: 'dayGridMonth,listWeek'
                },
                locale: 'es',
                slotDuration: "00:30:00",
                minTime: "08:00:00",
                maxTime: "19:00:00",
                events:'datoseventos.php?accion=listar',
                dateClick: function(info){
                    //alert(info.dateStr);
                    $('#close_evento').show();
                    $('#create_evento').show();
                    $('#update_evento').hide();
                    $('#delete_evento').hide();
                    document.getElementById("myModalLabelEventoCalendar").innerHTML = "Registrar Evento en la Agenda";
                    limpiarFormulario();
                    $("#modal_crear_evento").modal('show');
                    if (info.allDay) {
                        //$('#inicioEvento1').val(moment().format("YYYY-MM-DD[T]HH:mm:ss"));
                        //$('#finEvento1').val(moment().format("YYYY-MM-DD[T]HH:mm:ss"));
                        $('#inicioEvento').val(moment(info.dateStr).format("YYYY-MM-DD[T]HH:mm"));
                        $('#finEvento').val(moment(info.dateStr).format("YYYY-MM-DD[T]HH:mm"));
                    } else {
                        let fechaHora = info.dateStr;
                        $('#inicioEvento').val(fechaHora);
                        $('#finEvento').val(fechaHora);
                    }


                },
                eventClick: function(info) {
                    $('#close_evento').show();
                    $('#create_evento').hide();
                    $('#update_evento').show();
                    $('#delete_evento').hide();
                    document.getElementById("myModalLabelEventoCalendar").innerHTML = "Actualizar Evento en la Agenda";
                    $("#modal_crear_evento").modal('show');
                    $('#eventoId').val(info.event.id);
                    $('#eventoNombre').val(info.event.title);
                    $('#inicioEvento').val(moment(info.event.start).format("YYYY-MM-DD[T]HH:mm"));
                    $('#finEvento').val(moment(info.event.end).format("YYYY-MM-DD[T]HH:mm"));
                    $('#descripcionEvento').val(info.event.extendedProps.descripcion);
                    $("#modal_crear_evento").modal('show');

                }
            });
            agenda.render();

            //  REGISTRO DE UN EVENTO EN LA AGENDA
            $('#create_evento').click(function(){
                var datos = $('#formulario_crear_evento').serialize();
                //alert(datos); return false;
                $.ajax({
                    type:"POST",
                    url:"assets/inc/create_evento.php",
                    data:datos,
                    success:function(response){
                        if (response) {
                            Swal.fire({
                                type: 'success',
                                title: 'evento Agregado Exitosamente.',
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
                        agenda.refetchEvents();
                    }
                });
                $('#modal_crear_evento').on('hidden.bs.modal', function (){
                    $(this).find('#formulario_crear_evento')[0].reset();
                });
            });
            //  ACTUALIZAR UN EVENTO EN LA AGENDA
            $('#update_evento').click(function(){
                var datos = $('#formulario_crear_evento').serialize();
                //alert(datos); return false;
                $.ajax({
                    type:"POST",
                    url:"assets/inc/update_evento.php",
                    data:datos,
                    success:function(response){
                        if (response) {
                            Swal.fire({
                                type: 'success',
                                title: 'Avento Actualizado Exitosamente.',
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
                        agenda.refetchEvents();
                    }
                });
                $('#modal_crear_evento').on('hidden.bs.modal', function (){
                    $(this).find('#formulario_crear_evento')[0].reset();
                });
            });
        </script>
    </body>
</html>