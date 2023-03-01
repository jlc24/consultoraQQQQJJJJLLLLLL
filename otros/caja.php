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
                                            <li class="breadcrumb-item active">Apertura y Cierre de Caja</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">
                                        <a style="color:purple;" href="#" data-toggle="modal" data-target="#modal_crear_caja" title="Registrar Apertura de Caja">
                                            <i class="far fa-plus-square"></i>
                                        </a>Administración de Caja
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
                                <!-- inicio tabla caja -->
                                <div class="card-box table-responsive" id="tabla_caja">

                                </div>
                                <!-- fin tabla caja -->

                                <!-- Modales para Crear y Actualizar, Caja, Etc -->
                                <?php include "modal_create_caja.php"; include "modal_cerrar_caja.php"; ?>
                                <!-- Modales para Crear y Actualizar, Cajas -->

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

        <!--================================  CLIENTES  ================================-->
        <script>
            //CARGAMOS LOS REGISTROS DE LA CAJA RELACIONADO AL ADMINISTRADOR
            $('#tabla_caja').load('tabla_caja_admin.php');
            // COLOCAMOS EN FOCO EN EL INPUT NECESARIO AL ABRIR Y CERRAR CAJA
            $('#modal_crear_caja').on('shown.bs.modal',function(){
                $('#caja_monto_inicial').trigger('focus');
            });
            $('#modal_cerrar_caja').on('shown.bs.modal',function(){
                $('#caja_monto_final').trigger('focus');
            });
            //FUNCION PARA CERRAR CAJA
            function CerrarCaja(datos){
                //alert(datos);
                vector=datos.split('||');
                $('#caja_id').val(vector[0]);
            }

            $(document).ready(function() {
                // REGISTRO DE UNA NUEVA CAJA
                $('#create_caja').click(function(){
                    //SI EL VALOR DEL MONTO INICIAL ES MAYOR O IGUAL A CERO Y DIFERENTE DE VACIO SE HABRE LA CAJA
                    if ($('#caja_monto_inicial').val() >= 0 && $('#caja_monto_inicial').val() != "") { 
                        var datos = $('#formulario_crear_caja').serialize();
                        //alert(datos); return false;
                        $.ajax({
                            type:"POST",
                            url:"assets/inc/create_caja.php",
                            data:datos,
                            success:function(response){
                                if (response == 1) {
                                    $('#tabla_caja').load('tabla_caja_admin.php');
                                    $('#modal_crear_caja').on('hidden.bs.modal', function (){
                                        $(this).find('#formulario_crear_caja')[0].reset();
                                    });
                                    /*$('#c_paciente')[0].reset();*/ //Limpia los inputs del formulario con id=c_paciente*/
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Apertura de Caja Exitosa',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                } else {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Primero, cierre la caja abierta...',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                }

                            }
                        });
                    } else {
                        Swal.fire({
                            type: 'info',
                            title: 'Ingrese, Monto de Apertura Válido...',
                            showConfirmButton: false,
                            timer: 2000,
                            onAfterClose: () => {
                                setTimeout(() => $("#caja_monto_inicial").focus(), 110);
                            }
                        })
                        return false;
                    }
                });
                // CIERRE DE LA CAJA ABIERTA
                $('#cerrar_caja').click(function(){
                    //PARA CERRAR CAJA VERIFICAMOS QUE EL MONTO FINAL Y CAMBIO NO SEAN VACIOS
                    caja_final = parseInt($('#caja_monto_final').val());
                    caja_cambio = parseInt($('#caja_cambio').val());
                    var datos = $('#formulario_cerrar_caja').serialize();
                    //alert(datos); return false;
                    if (caja_final >= 0 && caja_cambio >= 0) {
                        $.ajax({
                            type:"POST",
                            url:"assets/inc/update_caja.php",
                            data:datos,
                            success:function(response){
                                if (response == 1) {
                                    $('#tabla_caja').load('tabla_caja_admin.php');
                                    $('#modal_cerrar_caja').on('hidden.bs.modal', function (){
                                        //$(this).find('#formulario_cerrar_caja')[0].reset();
                                        //$(this).removeData('bs.modal');
                                        window.location.reload();
                                    });
                                    /*$('#c_paciente')[0].reset();*/ //Limpia los inputs del formulario con id=c_paciente*/
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Cierre de Caja Exitosa',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                } else {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'La Caja ya esta Cerrada',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                }

                            }
                        });                    
                    } else {
                        Swal.fire({
                            type: 'info',
                            title: 'Debe Ingresar Monto de Cierre y Cambio',
                            showConfirmButton: false,
                            timer: 2000,
                            onAfterClose: () => {
                                setTimeout(() => $("#caja_monto_final").focus(), 110);
                            }
                        })
                        return false;
                    }

                }); 
            });
        </script>



        <!--=============================  MEDICAMENTOS  =============================-->
        <script>
            /*function EliminarMedicamento(datos) {
                vector=datos.split('||');
                Swal.fire({
                    title: 'Se Borrará ' + vector[1],
                    text: "No podrás revertir esto!",
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminarlo!'
                }).then((result) => {
                    if (result.value) {
                        cadena = "id=" + vector[0];
                        alert(cadena);
                        $.ajax({
                            url: "assets/inc/delete_medicamento.php",
                            data: cadena,
                            type: "POST",
                            success: function (response) {
                                if (response == 1) {
                                    $('#tabla_medicamento').load('tabla_medicamento_serverside.php');
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
            }*/

            /*function EditarMedicamento(datos){
                //alert(datos);
                vector=datos.split('||');
                $('#prod_id_update').val(vector[0]);
                $('#prod_nombre_comercial_update').val(vector[1]);
                $('#prod_propaganda_update').val(vector[2]);
                $('#prod_forma_update').val(vector[3]);
                $('#prod_ingrediente_update').val(vector[4]);
                $('#prod_laboratorio_update').val(vector[6]);
                $('#prod_nicklaboratorio_update').val(vector[7]);
                $('#prod_representante_update').val(vector[9]);
                $('#prod_codigo_update').val(vector[10]);
                //$('#prod_stock_minimo_update').val(vector[11]);
                $('#prod_ubicacion_update').val(vector[12]);
                //$('#prod_caducidad_update').val(vector[13]);
                $('#prod_stock_update').val(vector[14]);
                //$('#prod_precio_unitario_update').val(vector[15]);
                $('#prod_precio_venta_update').val(vector[16]);
            }*/

            /*function ActualizarMedicamento(){

                var datos = $('#formulario_editar_medicamento').serialize();
                //alert(datos);
                //return false;
                $.ajax({
                    type:"POST",
                    url:"assets/inc/update_medicamento.php",
                    data:datos,
                    success:function(response){
                        if(response==1){
                            $('#tabla_medicamento').load('tabla_medicamento_serverside.php');
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

            }*/

            /*function AbastecerMedicamento(datos){
                //ESTA FUNCION RECUPERA LOS DATOS NECESARIOS PARA REGISTRAR LA COMPRA DEL PRODUCT0
                //Y COLOCARLO EN EL MODAL DE ABASTECIMIENTO O COMPRA DE UN PRODUCTO
                //alert(datos);
                vector=datos.split('||');
                $('#prod_id_abastecer').val(vector[0]);//prod_id
                $('#prod_nombre_comercial_abastecer').val(vector[1]);//prod_nombre_comercial
                $('#prod_fecha_vencimiento_abastecer').val(vector[2]);//prod_caducidad
                $('#prod_stock_abastecer').val(vector[3]);//prod_stock
                //COLOCAMOS EL FOCO EN EL INPUT
                $('#modal_abastecer_medicamento').on('shown.bs.modal', function (){$('#cantidad_comprada_abastecer').focus();});
            }*/


            //------------------------------------------------------------------------------------//
            //------------------------------------------------------------------------------------//
            $(document).ready(function() {
                var fila; //captura la fila, para editar o eliminar
                //Editar
                /*$(document).on("click", ".btnEditar", function() {
                    fila = $(this).closest("tr");

                    $('#prod_id_update').val(parseInt(fila.find('td:eq(0)').text()));
                    $('#prod_nombre_comercial_update').val(fila.find('td:eq(2)').text());
                    $('#prod_propaganda_update').val(fila.find('td:eq(3)').text());
                    $('#prod_forma_update').val(fila.find('td:eq(4)').text());
                    $('#prod_ingrediente_update').val(fila.find('td:eq(5)').text());
                    $('#prod_laboratorio_update').val(fila.find('td:eq(6)').text());
                    //$('#prod_nicklaboratorio_update').val();
                    $('#prod_representante_update').val(fila.find('td:eq(7)').text());
                    $('#prod_codigo_update').val(fila.find('td:eq(1)').text());
                    //$('#prod_stock_minimo_update').val(vector[11]);
                    $('#prod_ubicacion_update').val(fila.find('td:eq(10)').text());
                    //$('#prod_caducidad_update').val(vector[13]);
                    $('#prod_stock_update').val(fila.find('td:eq(9)').text());
                    //$('#prod_precio_unitario_update').val(vector[15]);
                    $('#prod_precio_venta_update').val(fila.find('td:eq(11)').text());
                });*/
                //Borrar
                /*$(document).on("click", ".btnBorrar", function() {
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
                        if (result.value) {
                            cadena = "id=" + prod_id;
                            //alert(cadena);
                            $.ajax({
                                url: "assets/inc/delete_medicamento.php",
                                data: cadena,
                                type: "POST",
                                success: function (response) {
                                    if (response == 1) {
                                        //medicamento.row(fila.parents('tr')).remove().draw();
                                        Swal.fire({
                                            type: 'success',
                                            title: 'Tu registro a sido Borrado.',
                                            showConfirmButton: false,
                                            timer: 2000
                                        })
                                        $('#tabla_medicamento').load('tabla_medicamento_serverside.php');
                                    }
                                }
                            });
                        }
                    })
                });*/
                //Abastecer
                $(document).on("click", ".btnAbastecer", function() {
                    $('#prod_id_abastecer').val($(this).closest('tr').find('td:eq(0)').text());//prod_id
                    $('#prod_nombre_comercial_abastecer').val($(this).closest('tr').find('td:eq(2)').text());//prod_nombre_comercial
                    $('#prod_codigo_abastecer').val($(this).closest('tr').find('td:eq(1)').text());//prod_codigo_abastecer
                    $('#prod_fecha_vencimiento_abastecer').val($(this).closest('tr').find('td:eq(8)').text());//prod_caducidad
                    $('#prod_stock_abastecer').val($(this).closest('tr').find('td:eq(9)').text());//prod_stock
                    //COLOCAMOS EL FOCO EN EL INPUT
                    $('#modal_abastecer_medicamento').on('shown.bs.modal', function (){$('#cantidad_comprada_abastecer').focus();});
                });
                //Historial
                $(document).on("click", ".btnHistorial", function() {
                    /*RECIBE COMO DATOS EL ID y NOMBRE DEL PRODUCTO, EL ID SE ACTUALIZA EN LA
                    TABLA CONFIGURACION, LUEGO SE MUESTRA EL RESULTADO DE LA CONSULTA
                    PARA ESE ID, EN EL DIV ---> #tabla_producto_historial */
                    cadena="prod_id=" + $(this).closest('tr').find('td:eq(0)').text();
                    document.getElementById("prod_nombre").innerHTML = "Historial De Compras : " + $(this).closest('tr').find('td:eq(2)').text();
                    //alert(vector);
                    $.ajax({
                        type:"POST",
                        url:"assets/inc/update_producto_id.php",
                        data:cadena,
                        success:function(r){
                            if(r==1){
                            $('#tabla_compra_historial').load('tabla_compra_historial.php');
                            }//Fin if
                        }//Fin success
                    });//fin ajax
                });

                // 1.  REGISTRO DE UN NUEVO MEDICAMENTO
                $('#create_medicamento').click(function(){
                    var datos = $('#formulario_crear_medicamento').serialize();
                    //alert(datos);
                    //return false;
                    $.ajax({
                        type:"POST",
                        url:"assets/inc/create_medicamento.php",
                        data:datos,
                        success:function(response){
                            if (response == 1) {
                                /*$('#c_paciente')[0].reset();*/ //Limpia los inputs del formulario con id=c_paciente*/
                                Swal.fire({
                                    type: 'success',
                                    title: 'Medicamento Agregado Exitosamente.',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                $('#tabla_medicamento').load('tabla_medicamento_serverside.php');
                                $('#modal_crear_medicamento').on('hidden.bs.modal', function (){
                                    $(this).find('#formulario_crear_medicamento')[0].reset();
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
                $('#abastecer_medicamento').click(function(){
                    var datos = $('#formulario_abastecer_medicamento').serialize();
                    //alert(datos);
                    //return false;
                    $.ajax({
                        type:"POST",
                        url:"assets/inc/create_compra.php",
                        data:datos,
                        success:function(response){
                            if (response == 1) {
                                $('#tabla_medicamento').load('tabla_medicamento_serverside.php');
                                $('#modal_abastecer_medicamento').on('hidden.bs.modal', function (){
                                    $(this).find('#formulario_abastecer_medicamento')[0].reset();
                                });
                                /*$('#c_paciente')[0].reset();*/ //Limpia los inputs del formulario con id=c_paciente*/
                                Swal.fire({
                                    type: 'success',
                                    title: 'Actualizacion exitosa.',
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
                //CARGAMOS TODOS LOS MEDICAMENTOS
                $('#tabla_medicamento').load('tabla_medicamento_serverside.php');
                //COLOCAMOS EL FOCO EN UN INPUT
                $('#modal_crear_medicamento').on('shown.bs.modal',function(){
                    $('#prod_nombre_comercial').trigger('focus');
                });
                //AUTOCOMPLETA DATOS DEL MEDICAMENTO A REGISTRAR DESDE EL VADEMÉCUM
                $("#prod_nombre_comercial").autocomplete({
                    appendTo: '#modal_crear_medicamento',
                    source: function(request, response){
                        $.ajax({
                            url: "autocomplete_medicamento.php",
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
                        $('#prod_nombre_comercial').val(ui.item.nombre);
                        $('#prod_propaganda').val(ui.item.propaganda);
                        $('#prod_forma').val(ui.item.forma);
                        $('#prod_ingrediente').val(ui.item.ingrediente);
                        $('#prod_laboratorio').val(ui.item.laboratorio);
                        $('#prod_nicklaboratorio').val(ui.item.nick);
                        $('#prod_representante').val(ui.item.representante);
                        return false;
                    }
                });
                //AUTOCOMPLETA EL NOMBRE DEL LABORATORIO FABRICANTE EN EL MODAL DE REGISTRO
                $("#prod_laboratorio").autocomplete({
                    appendTo: '#modal_crear_medicamento',
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
                    appendTo: '#modal_editar_medicamento',
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
                //CALCULA EL PRECIO UNITARIO, CUANDO CAMBIA EL PRECIO DE COMPRA, DADO LA CANTIDAD
                //Cuando ingreso el valor de cantidad comprada no pasa nada, no se realiza ningun calculo....
                //pero cuando ingreso el segundo dato de precio de compra se puede dividir precio/cantidad y suponiendo
                //que el descuento es cero se puede calculamos el precio de venta.
                $("#precio_compra_abastecer").on('keyup change',function() {
                    var cantidad = document.getElementById("cantidad_comprada_abastecer").value;
                    var precio = $(this).val();
                    var descuento = document.getElementById("descuento_compra_abastecer").value;
                    var resultado = ((parseFloat(precio)-parseFloat(descuento)) / parseFloat(cantidad)).toFixed(2);
                    document.getElementById("precio_unitario_abastecer").value = resultado;
                });
                //CALCULAMOS EL PRECIO UNITARIO, CUANDO CAMBIA EL DESCUENTO, DADO LA CANTIDAD
                $("#descuento_compra_abastecer").on('keyup change',function() {
                    var cantidad = document.getElementById("cantidad_comprada_abastecer").value;
                    var precio = document.getElementById("precio_compra_abastecer").value;
                    var descuento = $(this).val();
                    var resultado = ((parseFloat(precio)-parseFloat(precio)*parseFloat(descuento)/100) / parseFloat(cantidad)).toFixed(2);
                    document.getElementById("precio_unitario_abastecer").value = resultado;
                });
                //---------------------CALCULO DE PRECIOS EN REGISTRO DE UN NUEVO PRODUCTO--------------------------------//}
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
                //---------------------CALCULO DE PRECIOS EN REGISTRO DE UN NUEVO PRODUCTO--------------------------------//
                //AUTOCOMPLETA EL ULTIMO CODIGO USADO PARA EL REGISTRO DE MEDICAMENTOS DE UN DETERMINADO LABORATORIO
                $("#prod_codigo").autocomplete({
                    appendTo: '#modal_crear_medicamento',
                    source: "autocomplete_codigo.php",
                    minLength: 1,
                    select: function(event, ui) {
                        event.preventDefault();
                        $('#prod_codigo').val(ui.item.codigo);
                    }
                });

                //REGISTRO DE UN NUEVO MEDICAMENTO
                /*$('#create_medicamento').click(function(){
                    valor1 = $('#prod_nombre_comercial').val();
                    valor2 = $('#prod_propaganda').val();
                    valor3 = $('#prod_forma').val();
                    valor4 = $('#prod_ingrediente').val();
                    valor5 = $('#prod_laboratorio').val();
                    valor6 = $('#prod_nicklaboratorio').val();
                    valor7 = $('#prod_representante').val();
                    valor8 = $('#prod_codigo').val();
                    valor9 = $('#prod_stock_minimo').val();
                    valor10 = $('#prod_ubicacion').val();
                    valor11 = $('#prod_caducidad').val();
                    valor12 = $('#prod_stock_inicial').val();
                    valor13 = $('#prod_precio_compra').val();
                    valor14 = $('#prod_precio_unitario').val();
                    valor15 = $('#prod_precio_venta').val();
                    CrearMedicamento(valor1, valor2, valor3, valor4, valor5, valor6, valor7, valor8, valor9, valor10, valor11, valor12, valor13, valor14, valor15);
                });*/
                $('#update_medicamento').click(function(){
                    ActualizarMedicamento();
                });
                //ABASTECER PRODUCTO
                $('#abastecer_producto').click(function(){
                    var datos = $('#formulario_abastecer_medicamento').serialize();
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
                                $('#modal_abastecer_medicamento').on('hidden.bs.modal',function(){
                                    $(this).find('#formulario_abastecer_medicamento')[0].reset();
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
            //------------------------------------------------------------------------------------//
            //------------------------------------------------------------------------------------//
            });
        </script>
    </body>
</html>