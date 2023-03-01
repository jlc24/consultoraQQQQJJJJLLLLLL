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
                                            <li class="breadcrumb-item active">Medicamentos</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">
                                        <a style="color:purple;" href="#" data-toggle="modal" data-target="#modal_crear_medicamento" title="Registrar Medicamento">
                                            <i class="far fa-plus-square"></i>
                                        </a>Administración de Medicamentos
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
                                <div class="card-box table-responsive" id="tabla_medicamento">

                                </div>
                                <!-- fin tabla medicamento -->

                                <!-- Modales para Crear y Actualizar, Medicamentos, Etc -->
                                <?php include "modal_create_medicamento.php"; ?>
                                <?php include "modal_update_medicamento.php"; ?>
                                <?php include "modal_abastecer_medicamento.php"; ?>
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
        <script>
            function EliminarMedicamento(datos) {
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
                                    $('#tabla_medicamento').load('tabla_medicamento.php');
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

            function EditarMedicamento(datos){
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
            }

            function ActualizarMedicamento(){

                var datos = $('#formulario_editar_medicamento').serialize();
                //alert(datos);
                //return false;
                $.ajax({
                    type:"POST",
                    url:"assets/inc/update_medicamento.php",
                    data:datos,
                    success:function(response){
                        if(response==1){
                            $('#tabla_medicamento').load('tabla_medicamento.php');
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

            }

            function AbastecerMedicamento(datos){
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
            }

            function HistorialMedicamento(datos){
                /*RECIBE COMO DATOS EL ID y NOMBRE DEL PRODUCTO, EL ID SE ACTUALIZA EN LA
                TABLA CONFIGURACION, LUEGO SE MUESTRA EL RESULTADO DE LA CONSULTA
                PARA ESE ID, EN EL DIV ---> #tabla_producto_historial */
                vector=datos.split('||');
                cadena="prod_id=" + vector[0];
                document.getElementById("prod_nombre").innerHTML = "Historial De Compras : "+vector[1];
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
            }
            //------------------------------------------------------------------------------------//
            //------------------------------------------------------------------------------------//
            $(document).ready(function() {
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
                                $('#tabla_medicamento').load('tabla_medicamento.php');
                                $('#modal_crear_medicamento').on('hidden.bs.modal', function (){
                                    $(this).find('#formulario_crear_medicamento')[0].reset();
                                });
                                /*$('#c_paciente')[0].reset();*/ //Limpia los inputs del formulario con id=c_paciente*/
                                Swal.fire({
                                    type: 'success',
                                    title: 'Medicamento Agregado Exitosamente.',
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
                                $('#tabla_medicamento').load('tabla_medicamento.php');
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
                $('#tabla_medicamento').load('tabla_medicamento.php');
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
                //CALCULA EL PRECIO DE VENTA UNITARIO, DADO LA CANTIDAD COMPRADA y SU PRECIO DE COMPRA
                $("#prod_precio_compra").keyup(function () {
                    var cantidad = document.getElementById("prod_stock_inicial").value;
                    var precio = $(this).val();
                    var resultado = (parseFloat(precio) / parseFloat(cantidad)).toFixed(2);
                    document.getElementById("prod_precio_unitario").value = resultado;
                });
                //CALCULA EL PRECIO DE VENTA UNITARIO, DADO LA CANTIDAD COMPRADA y SU PRECIO DE COMPRA, EN EL MODAL ABASTECER
                $("#precio_compra_abastecer").keyup(function () {
                    var cantidad = document.getElementById("cantidad_comprada_abastecer").value;
                    var precio = $(this).val();
                    var resultado = (parseFloat(precio) / parseFloat(cantidad)).toFixed(2);
                    document.getElementById("precio_unitario_abastecer").value = resultado;
                });
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