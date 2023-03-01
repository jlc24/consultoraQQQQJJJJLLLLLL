<?php
include("assets/inc/conexion.php");
session_start();
if (!isset($_SESSION['adm_id'])) {
    header('Location: login.php');
}

$adm_id = $_SESSION['adm_id'];
$sql = "SELECT * FROM administrador WHERE adm_id = '$adm_id';";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

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
                                <h4 class="page-title">Perfil de usuario</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <?php include 'modal_change_image.php' ?>
                    <!--========================================
                        =            Contenido Principal           =
                        =========================================-->
                    <?php
                        $sql1 = "SELECT * FROM administrador WHERE adm_id = '$adm_id';";
                        $result=mysqli_query($conexion,$sql1);
                        $rows = mysqli_fetch_assoc($result);
                    ?>
                    <section>
                        <div class="container py-1">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card mb-4">
                                        <div class="card-body text-center">
                                            <img src="<?php 
                                                    if ($rows['adm_imagen'] == "") {
                                                        echo "assets/images/users/avatar-1.png";
                                                    }else {
                                                        echo $rows['adm_imagen'];
                                                    }
                                                ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 200px; height: 200px;">
                                            <h5 class="my-3"><?php echo $rows['adm_nombre'] ?></h5>
                                            <p class="text-muted mb-1"><?php echo $rows['adm_area']; ?></p>
                                            <p class="text-muted mb-4"><?php echo $rows['adm_celular']; ?></p>
                                            <div class="d-flex justify-content-center mb-2">
                                                <button type="file" class="btn btn-outline-warning ms-1" data-toggle="modal" data-target="#modal_cambiar_imagen">Cambiar foto</button>
                                                <?php
                                                if ($rows['adm_imagen'] != "") { ?>
                                                    <button type="file" class="btn btn-outline-danger ms-1 btnEliminarFoto">Eliminar foto</button>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Nombre Completo</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0"><?php echo $rows['adm_nombre']; ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Celular</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0"><?php echo $rows['adm_celular'] ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Dirección</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0"><?php echo $rows['adm_direccion']; ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-center mb-2">
                                                
                                                <button type="button" class="btn btn-outline-warning ms-1">Editar datos</button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Usuario</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0"><?php echo $rows['adm_usuario']; ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Contraseña</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0"><?php echo $rows['adm_pass']; ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-center mb-2">
                                                <button type="button" class="btn btn-outline-warning ms-1">Editar datos</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                   
                    
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
            $(document).ready(function() {
            // 1. CARGAMOS LA TABLA DE CLIENTES
                $('#alarma_notificaciones_topbar').load('alarma/alarma_notificaciones_topbar.php');
                $('#alarma_newmensajes_topbar').load('alarma/alarma_newmensajes_topbar.php');
                $('#alarma_viewmensajes_topbar').load('alarma/alarma_viewmensajes_topbar.php');
                $('#alarma_sendmensajes_topbar').load('alarma/alarma_sendmensajes_topbar.php');
            });

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
            $(document).on("click", "#enviar_mensaje", function() {
                cadena = $("#formulario_mensaje").serialize();
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
                            $('#tincumplidas_table').load('tabla_tincumplidas.php');
                            $('#modal_mensaje').on('hidden.bs.modal', function() {
                                $(this).find('#formulario_mensaje')[0].reset();
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
                            $('#tincumplidas_table').load('tabla_tincumplidas.php');
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
            $('#upload_image').click(function(){
                var file_data = $("#uploadFile").prop("files")[0];
                var datos = new FormData();
                datos.append("uploadFile", file_data);
                datos.append("adminid", $("#adminid").val());
                
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
                    url:"assets/inc/upload_photo_profile.php",
                    success:function(response){
                        if(response){
                            Swal.fire({
                                type: 'success',
                                title: 'Foto de perfil cambiado exitosamente',
                                showConfirmButton: false,
                                timer: 2000
                            })
                            window.location.href = "profile.php";
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
            $('.btnEliminarFoto').click(function(){
                var id = <?php echo $adm_id; ?>;
                cadena = 'adminid='+id;
                //alert(cadena); return false;
                Swal.fire({
                    type: 'warning',
                    title: 'ELIMINAR',
                    text: "¿Desea borrar su foto de perfil?",
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si'
                }).then((result) => {
                    if(result.value) {
                        $.ajax({
                            type: "POST",
                            url: "assets/inc/delete_photo_profile.php",
                            data: cadena,
                            success: function(r) {
                                if(r) {
                                    Swal.fire({
                                    type: 'success',
                                    title: 'Se eliminó con éxito',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                window.location.href = "profile.php";
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

    </script>
</body>
</html>