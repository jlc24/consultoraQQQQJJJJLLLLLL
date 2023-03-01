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
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">QJL</a></li>
                                            <li class="breadcrumb-item active">Medicamentos</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">
                                        <a style="color:purple;" href="#" data-toggle="modal" data-target="#modal_crear_hoja" title="Registrar Hoja de Ruta">
                                            <i class="far fa-plus-square"></i>
                                        </a>Administración de Hojas de Ruta
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
                                <div class="card-box table-responsive" id="tabla_hoja">

                                </div>
                                <!-- fin tabla medicamento -->

                                <!-- Modales para Crear y Actualizar, Medicamentos, Etc -->
                                <?php include "modal_create_cliente.php";?>
                                <?php include "modal_create_hoja.php"; ?>
                                <div id="modal_editar_hoja" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myModalLabel">Actualizar Datos del Medicamento</h4>
                                            </div>
                                            <div class="modal-body" id="editar_medicamento">
                                                <!-- Dentro de este DIV, se muestra los datos del medicamento a editar -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="cerrar_medicamento" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                                <button type="button" id="update_medicamento" class="btn btn-purple waves-effect" data-dismiss="modal">Actualizar</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <div id="modal_abastecer_hoja" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Abastecer Producto</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body" id="proveer_medicamento">
                                                <!-- Dentro de este DIV, se muestra los datos del medicamento a abastecer -->
                                            </div>
                                            <div class="modal-footer">
                                                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-purple waves-effect" data-dismiss="modal" id="abastecer_medicamento">Guardar Registro</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <?php include "modal_historial_compra.php"; ?>

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
                //Editar
                $(document).on("click", ".btnEditar", function() {
                    cadena = "prod_id=" + $(this).closest('tr').find('td:eq(0)').text();
                    //alert(cadena); return false;
                    //https://jsonformatter.org/jsbeautifier
                    $.ajax({
                        type: "POST",
                        url: "assets/inc/update_producto_id.php",
                        data: cadena,
                        success: function(r) {
                                if(r == 1) {
                                    $('#editar_medicamento').load('modal_update_medicamento.php');
                                    //$('#modal_editar_hoja').modal('show');
                                }
                            }
                    });
                });
                //COLOCAMOS EL FOCO EN EL INPUT
                $('#modal_abastecer_hoja').on('shown.bs.modal', function() {
                    $('#cantidad_comprada_abastecer').focus();
                });
                //Abastecer
                $(document).on("click", ".btnAbastecer", function() {
                    cadena = "prod_id=" + $(this).closest('tr').find('td:eq(0)').text();
                    alert(cadena); //return false;
                    //https://jsonformatter.org/jsbeautifier
                    $.ajax({
                        type: "POST",
                        url: "assets/inc/update_producto_id.php",
                        data: cadena,
                        success: function(r) {
                                if(r == 1) {
                                    $('#proveer_medicamento').load('modal_abastecer_hoja.php');
                                    $('#modal_abastecer_hoja').modal('show');
                                }
                            }
                    });
                });
                //Borrar
                $(document).on("click", ".btnBorrar", function() {
                    //e.preventDefault();//evita el comportambiento normal del submit, es decir, recarga total de la página
                    fila = $(this);
                    prod_id = parseInt($(this).closest('tr').find('td:eq(0)').text());
                    prod_nombre = $(this).closest('tr').find('td:eq(2)').text();
                    Swal.fire({
                        title: 'Se Borrará ' + prod_nombre,
                        text: "No podrás revertir esto!",
                        type: 'warning',
                        showCancelButton: true,
                        cancelButtonText: 'Cancelar',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, eliminarlo!'
                    }).then((result) => {
                        if(result.value) {
                            cadena = "id=" + prod_id;
                            //alert(cadena);
                            $.ajax({
                                url: "assets/inc/delete_medicamento.php",
                                data: cadena,
                                type: "POST",
                                success: function(response) {
                                    if(response == 1) {
                                        //medicamento.row(fila.parents('tr')).remove().draw();
                                        Swal.fire({
                                            type: 'success',
                                            title: 'Tu registro a sido Borrado.',
                                            showConfirmButton: false,
                                            timer: 2000
                                        })
                                        $('#tabla_hoja').load('tabla_hoja_serverside.php');
                                    }
                                }
                            });
                        }
                    })
                });

                //Historial
                $(document).on("click", ".btnHistorial", function() {
                    /*RECIBE COMO DATOS EL ID y NOMBRE DEL PRODUCTO, EL ID SE ACTUALIZA EN LA
                    TABLA CONFIGURACION, LUEGO SE MUESTRA EL RESULTADO DE LA CONSULTA
                    PARA ESE ID, EN EL DIV ---> #tabla_producto_historial */
                    cadena = "prod_id=" + $(this).closest('tr').find('td:eq(0)').text();
                    document.getElementById("prod_nombre").innerHTML = "Historial De Compras : " + $(this).closest('tr').find('td:eq(2)').text();
                    //alert(vector);
                    $.ajax({
                        type: "POST",
                        url: "assets/inc/update_producto_id.php",
                        data: cadena,
                        success: function(r) {
                                if(r == 1) {
                                    $('#tabla_compra_historial').load('tabla_compra_historial.php');
                                    $('#modal_historial_compra').modal('show');
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
                                $('#tabla_hoja').load('tabla_hoja_serverside.php');
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
                // 2.  ACTUALIZACION UN NUEVO MEDICAMENTO
                //
                //VERIFICAMOS SI LA FACTURA TIENE NOMBRE DEL CLIENTE
                $('#abastecer_medicamento').click(function() {
                    //EL PRECIO DE COMPRA, CANTIDAD Y FECHA DE VENCIMIENTO NO PUEDEN SER VALORES VACIOS
                    if($('#cantidad_comprada_abastecer').val() === "") {
                        Swal.fire({
                                title: 'Oops...',
                                text: 'INGRESE LA CANTIDAD COMPRADA',
                                type: 'info',
                                showConfirmButton: false,
                                timer: 2500,
                                onAfterClose: () => {
                                    setTimeout(() => $("#cantidad_comprada_abastecer").focus(), 110);
                                }
                            })
                        return false;
                    } else if($('#precio_compra_abastecer').val() === "") {
                        Swal.fire({
                                title: 'Oops...',
                                text: 'INGRESE EL PRECIO DE COMPRA',
                                type: 'info',
                                showConfirmButton: false,
                                timer: 2500,
                                onAfterClose: () => {
                                    setTimeout(() => $("#precio_compra_abastecer").focus(), 110);
                                }
                            })
                        return false;
                    } else if($('#prod_fecha_vencimiento_abastecer').val() === "") {
                        Swal.fire({
                                title: 'Oops...',
                                text: 'INGRESE LA FECHA DE VENCIMIENTO',
                                type: 'info',
                                showConfirmButton: false,
                                timer: 2500,
                                onAfterClose: () => {
                                    setTimeout(() => $("#prod_fecha_vencimiento_abastecer").focus(), 110);
                                }
                            })
                        return false;
                    } else {
                        var datos = $('#formulario_abastecer_hoja').serialize();
                        //alert(datos); return false;
                        $.ajax({
                            type: "POST",
                            url: "assets/inc/create_compra.php",
                            data: datos,
                            success: function(response) {
                                if(response == 1) {
                                    $('#tabla_hoja').load('tabla_hoja_serverside.php');
                                    $('#modal_abastecer_hoja').on('hidden.bs.modal', function() {
                                        $(this).find('#formulario_abastecer_hoja')[0].reset();
                                    });
                                    /*$('#c_paciente')[0].reset();*/ //Limpia los inputs del formulario con id=c_paciente*/
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Suministro exitoso.',
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
                //CARGAMOS TODOS LOS MEDICAMENTOS
                $('#tabla_hoja').load('tabla_hoja_serverside.php');
                //COLOCAMOS EL FOCO EN UN INPUT
                $('#modal_crear_hoja').on('shown.bs.modal',function(){
                    $('#prod_nombre_comercial').trigger('focus');
                });
                //AUTOCOMPLETA DATOS DEL MEDICAMENTO A REGISTRAR DESDE EL VADEMÉCUM
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
                //AUTOCOMPLETA EL NOMBRE DEL LABORATORIO FABRICANTE EN EL MODAL DE REGISTRO
                $("#prod_laboratorio").autocomplete({
                    appendTo: '#modal_crear_hoja',
                    source: function(request, response){
                        $.ajax({
                            url: "autocomplete_laboratorio.php",
                            type: "post",
                            dataType: "json",
                            data: {search: request.term},
                            success: function(data){
                                response(data);
                            }
                        });
                    },
                    minLength: 1,
                    select: function(event, ui){
                        event.preventDefault();
                        $('#prod_laboratorio').val(ui.item.laboratorio);
                        $('#prod_nicklaboratorio').val(ui.item.nicklaboratorio);

                        return false;
                    }
                });
                //AUTOCOMPLETA EL NOMBRE DEL LABORATORIO FABRICANTE EN EL MODAL DE ACTUALIZACION
                $("#prod_laboratorio_update").autocomplete({
                    appendTo: '#modal_editar_hoja',
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
                        $('#prod_laboratorio_update').val(ui.item.laboratorio);
                        $('#prod_nicklaboratorio_update').val(ui.item.nicklaboratorio);
                        return false;
                    }
                });

                //---------------------CALCULO DE PRECIOS EN REGISTRO DE UN NUEVO PRODUCTO--------------------------------
                $("#prod_precio_compra").on('keyup change',function() {
                    var cantidad = document.getElementById("prod_stock_inicial").value;
                    var precio = $(this).val();
                    var descuento = document.getElementById("prod_precio_descuento").value;
                    var resultado = ((parseFloat(precio)-parseFloat(descuento)) / parseFloat(cantidad)).toFixed(2);
                    document.getElementById("prod_precio_unitario").value = resultado;
                });
                $("#prod_precio_descuento").on('keyup change',function() {
                    var cantidad = document.getElementById("prod_stock_inicial").value;
                    var precio = document.getElementById("prod_precio_compra").value;
                    var descuento = $(this).val();
                    var resultado = ((parseFloat(precio)-parseFloat(precio)*parseFloat(descuento)/100) / parseFloat(cantidad)).toFixed(2);
                    document.getElementById("prod_precio_unitario").value = resultado;
                });
                //---------------------CALCULO DE PRECIOS EN REGISTRO DE UN NUEVO PRODUCTO--------------------------------

                //AUTOCOMPLETA EL ULTIMO CODIGO USADO PARA EL REGISTRO DE MEDICAMENTOS DE UN DETERMINADO LABORATORIO
                $("#prod_codigo").autocomplete({
                    appendTo: '#modal_crear_hoja',
                    source: "autocomplete_codigo.php",
                    minLength: 1,
                    select: function(event, ui) {
                        event.preventDefault();
                        $('#prod_codigo').val(ui.item.codigo);
                    }
                });

                $('#update_medicamento').click(function(){
                    var datos = $('#formulario_editar_medicamento').serialize();
                    //alert(datos); return false;
                    //https://jsonformatter.org/jsbeautifier
                    $.ajax({
                        type: "POST",
                        url: "assets/inc/update_medicamento.php",
                        data: datos,
                        success: function(response) {
                            if(response == 1) {
                                Swal.fire({
                                    type: 'success',
                                    title: 'Actualizacion Exitosamente.',
                                    showConfirmButton: false,
                                    timer: 2000 //1500
                                })
                                $('#tabla_hoja').load('tabla_hoja_serverside.php');
                                $('#modal_editar_hoja').on('hidden.bs.modal', function() {
                                    $(this).find('#formulario_editar_medicamento')[0].reset();
                                });
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Se ha Producido un Error.',
                                    showConfirmButton: false,
                                    timer: 2000 //1500
                                })
                            }
                        }
                    });
                });
                //ABASTECER PRODUCTO
                $('#abastecer_producto').click(function(){
                    var datos = $('#formulario_abastecer_hoja').serialize();
                    alert(datos);
                    //return false;
                    $.ajax({
                        type:"POST",
                        url:"assets/inc/create_compra.php",
                        data:datos,
                        success:function(response){
                            if(response==1){
                                Swal.fire({
                                    type: 'success',
                                    title: 'Registro de Compra Exitoso.',
                                    showConfirmButton: false,
                                    timer: 2000//1500
                                })
                                $('#modal_abastecer_hoja').on('hidden.bs.modal',function(){
                                    $(this).find('#formulario_abastecer_hoja')[0].reset();
                                });
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
        </script>
    </body>
</html>