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
                                    <h4 class="page-title">Reporte de Hojas de Ruta</h4>
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
                                    <!-- <h4 class="header-title mb-4">Default Tabs</h4> -->
                                    <ul class="nav nav-tabs navtab-bg nav-justified">
                                        <li class="nav-item">
                                            <a href="#general" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                                Reporte General
                                            </a>
                                        </li>
                                        <li class="nav-item navtab-bg nav-justified">
                                            <a href="#hruta" data-toggle="tab" aria-expanded="true" class="nav-link">
                                                Hojas de Ruta
                                            </a>
                                        </li>
                                        <li class="nav-item navtab-bg nav-justified">
                                            <a href="#tareas" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                Tareas
                                            </a>
                                        </li>
                                        <li class="nav-item navtab-bg nav-justified">
                                            <a href="#tincumplidas" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                Tareas Cumplidas
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="general">
                                            <div id="general_area">
                                                
                                            </div>
                                        </div>
                                        <div class="tab-pane show" id="hruta">
                                            <div class="container">
                                                <div class="row justify-content-center">
                                                    <div class="col-5 justify-content-center">
                                                        <div class="form-group">
                                                            <label class="mb-2 mr-sm-2">Seleccionar proceso asignado: </label>
                                                            <select class="custom-select" id="area_qjl_juridico" name="area_qjl_juridico">
                                                                <option selected="" disabled>&nbsp;-&nbsp;-&nbsp;-&nbsp;-&nbsp;- SELECCIONAR -&nbsp;-&nbsp;-&nbsp;-&nbsp;-&nbsp;</option>
                                                                <option value="all">ASIGNADO</option>
                                                                <?php
                                                                    $sql = "SELECT asignacion.proceso_id, proceso_nombre FROM asignacion, proceso WHERE asignacion.proceso_id = proceso.proceso_id AND adm_id = '".$adm_id."' AND asig_estado = '1';";
                                                                    $resultado = mysqli_query($conexion, $sql);
                                                                    while ($registro = mysqli_fetch_assoc($resultado))
                                                                    { ?>
                                                                        <option value="<?php echo $registro['proceso_id']; ?>"><?php echo $registro['proceso_nombre']; ?></option>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="row justify-content-center" id="tabla_hoja_ruta" style="border-style: solid; border-width: 1px; border-color: #EEA96B;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tareas">
                                            <div class="container">
                                                <div class="row justify-content-center">
                                                    <div class="col-5 justify-content-center">
                                                        <div class="form-group">
                                                            <label class="mb-2 mr-sm-2">Seleccionar hoja de ruta: </label>
                                                            <select class="custom-select" id="area_hoja_ruta" name="area_hoja_ruta">
                                                                <option selected="" disabled>&nbsp;-&nbsp;-&nbsp;-&nbsp;-&nbsp;- SELECCIONAR -&nbsp;-&nbsp;-&nbsp;-&nbsp;-&nbsp;</option>
                                                                <?php
                                                                    $conproc = "SELECT proceso_id FROM asignacion WHERE asig_estado != '0' AND adm_id = '".$adm_id."';";
                                                                    $r = mysqli_query($conexion,$conproc);
                                                                    while ($a = mysqli_fetch_assoc($r)) {
                                                                        echo $a['proceso_id'];
                                                                        $sql = "SELECT hoja_id, hoja_numero_tramite FROM hoja, proceso WHERE hoja.hoja_area_proceso = proceso.proceso_nombre AND proceso_id = '".$a['proceso_id']."' ;";
                                                                        $resultado = mysqli_query($conexion, $sql);
                                                                        while ($registro = mysqli_fetch_assoc($resultado)) { 
                                                                            echo $registro['hoja_numero_tramite'];
                                                                            ?>
                                                                            <option value="<?php echo $registro['hoja_id']; ?>"><?php echo $registro['hoja_numero_tramite'] ; ?></option>
                                                                <?php
                                                                        }
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="row justify-content-center" id="tabla_hoja_detalle" style="border-style: solid; border-width: 1px; border-color: #EEA96B;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tincumplidas">
                                            
                                        </div>
                                    </div>
                                </div><!-- end card-box-->
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
                        </div><!-- end row -->
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

        <!--=============================  REPORTE DE VENTAS  =============================-->
        <!-- FOCO, BUSQUEDA, SELECCION PRODUCTO, MODAL DEL PRODUCTO, GUARDAR DETALLE, GUARDAR FACTURA  -->
        <script type="text/javascript">
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
            $("#general_area").load("general_area.php");

            $(document).on("change", "#area_qjl_juridico", function() {
                cadena = "proceso_id="+$("#area_qjl_juridico").val();
                //alert(cadena); return false;
                //https://jsonformatter.org/jsbeautifier
                $.ajax({
                    type: "POST",
                    url: "assets/inc/update_id_config.php",
                    data: cadena,
                    success: function(r) {
                        if(r) {
                            $('#tabla_hoja_ruta').load('tabla_hoja_ruta.php');
                        }
                    }
                });
            });
            $("#area_qjl_area").change(function(){
                area = $("#area_qjl_area").val();
                //alert(area); return false;
                if (area == 'JURIDICA') {
                    $("#area_jur").css('display', '');
                    $("#area_cont").css('display', 'none');
                    $("#area_mark").css('display', 'none');
                    $('#tabla_hoja_ruta').css('display', '');
                }else if (area == 'CONTABILIDAD') {
                    $("#area_jur").css('display', 'none');
                    $("#area_cont").css('display', '');
                    $("#area_mark").css('display', 'none');
                    $('#tabla_hoja_ruta').css('display', 'none');
                }else if (area == 'MARKETING'){
                    $("#area_jur").css('display', 'none');
                    $("#area_cont").css('display', 'none');
                    $("#area_mark").css('display', '');
                    $('#tabla_hoja_ruta').css('display', 'none');
                }else{
                    $("#area_jur").css('display', 'none');
                    $("#area_cont").css('display', 'none');
                    $("#area_mark").css('display', 'none');
                    $('#tabla_hoja_ruta').css('display', 'none');
                }
            })
            $("#area_hoja_ruta").change(function(){
                cadena = "hoja_id="+$("#area_hoja_ruta").val();
                alert(hoja_ruta); return false;
                $.ajax({
                    type: "POST",
                    url: "assets/inc/update_id_config.php",
                    data: cadena,
                    success: function(r) {
                        if(r) {
                            $('#tabla_hoja_ruta').load('tabla_hoja_ruta.php');
                        }
                    }
                })
            })
        </script>
    </body>
</html>