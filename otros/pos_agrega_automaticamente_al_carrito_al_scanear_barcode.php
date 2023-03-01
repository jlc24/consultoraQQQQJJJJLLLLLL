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

    //OBTENEMOS EL ESTADO DE LA CAJA 0=CERRADO, 1=ABIERTO, DE LA ULTIMA CAJA CREADA
    //SELECT DATE(ColumnName) FROM tablename; select DATE_FORMAT(date,'%y-%m-%d') from tablename;
    $consulta = "SELECT caja_id, DATE(caja_fecha_apertura), caja_estado FROM caja WHERE caja_id = (SELECT MAX(caja_id) FROM caja)";
    $resultado = mysqli_query($conexion,$consulta);
    $fila = mysqli_fetch_row($resultado);
    $caja_estado = (int)$fila[2];
    $fecha_apertura = $fila[1];
    $hoy = date('Y-m-d');
    if ($caja_estado == 0) {//SI LA CAJA ESTA CERRADA
        /*$message = "Primero debe abrir la Caja!";
        echo "<script> alert('".$message."'); </script>";
        sleep(5);
        header('Location: caja.php');
        echo "<script type='text/javascript'>alert('Oops... Primero debe abrir la Caja');location='caja.php';</script>";*/

        echo "<link rel='stylesheet' href='assets/css/bootstrap.min.css'>";
        echo "<link rel='stylesheet' href='assets/css/app.min.css'>";
        echo "<link rel='stylesheet' href='assets/libs/sweetalert2/sweetalert2.min.css'>";
        echo "<script src='assets/libs/jquery/jquery-3.6.0.min.js'></script>";
        echo "<script src='assets/libs/sweetalert2/sweetalert2.min.js'></script>";
        echo '<script>
            setTimeout(function() {
                Swal.fire({
                    type: "info",
                    title: "Oops...",
                    text: "Primero debes Abrir Caja!"
                }).then(function() {
                    window.location = "caja.php";
                });
            }, 1000);
        </script>';
        exit;
    }else{//SI LA CAJA ESTA ABIERTA, VERIFICAMOS SI SE ABRIO HOY
        if($fecha_apertura != $hoy){
            echo "<link rel='stylesheet' href='assets/css/bootstrap.min.css'>";
            echo "<link rel='stylesheet' href='assets/css/app.min.css'>";
            echo "<link rel='stylesheet' href='assets/libs/sweetalert2/sweetalert2.min.css'>";
            echo "<script src='assets/libs/jquery/jquery-3.6.0.min.js'></script>";
            echo "<script src='assets/libs/sweetalert2/sweetalert2.min.js'></script>";
            echo '<script>
                setTimeout(function() {
                    Swal.fire({
                        type: "info",
                        title: "Oops...",
                        text: "Primero debes Cerrar la Caja!"
                    }).then(function() {
                        window.location = "caja.php";
                    });
                }, 1000);
            </script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include 'assets/inc/head.php'; ?>
        <style type="text/css">
            .each{
                border-bottom: 1px solid #689F38;
                padding: 1px 0;
                background-color: #F1F8E9;
                }
            .acItem .name{
              font-size: 14px;
              font-weight: 500;
              font-family: Montserrat, Helvetica, sans-serif;
            }

            .acItem .desc{
              font-size: 12px;
              font-family: Montserrat, Helvetica, sans-serif;
              color:#212121;
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
                                            <!-- <li class="breadcrumb-item active"><a href="javascript: void(0);">Panel de control</a></li> -->
                                            <li class="breadcrumb-item active">Punto de Venta</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Punto de Venta</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <!--========================================
                        =            Contenido Principal           =
                        =========================================-->
                        <div class="row">
                            <?php include 'modal_create_cliente.php'; ?>
                            <?php include 'modal_create_detalle.php'; ?>
                            <?php include 'modal_dolar_boliviano.php'; ?>
                            <div class="col-md-8">
                                <!--=====================================
                                =    BUSCADOR DEL PRODUCTO A VENDER     =
                                ======================================-->
                                <div class="card-box">
                                    <form id="formulario_buscar_producto">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <!--<input type="search" class="form-control" id="producto" placeholder="Buscar por nombre del producto, Categoria Terapéutica, Principio Activo" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">-->
                                                <input type="text" class="form-control search" id="producto" placeholder="Buscar por Nombre, Categoría Terapéutica, Principio Activo ó Código de Barras" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-search fa-lg"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!--====================================================
                                =    MUESTRA EL DETALLE DE PRODUCTOS DE LA FACTURA     =
                                =====================================================-->
                                <div class="card-box">
                                    <div class="row" id="tabla_pos"></div>
                                </div>
                            </div><!-- end col buscador y tabla detalle -->
                            <div class="col-md-4 card-box">
                                <h3 class="card-header" align="center">Bs. 
                                    <span id="fac_total_cabecera"></span>
                                </h3>
                                <!-- <div class="card-body"> -->
                                <div>
                                    <form id="formulario_crear_factura">
                                        <h5>DATOS DEL CLIENTE:</h5>
                                        <div class="form-group">
                                            <label class="col-form-label">NIT ó C.I.</label>
                                            <input type="hidden" class="form-control" id="cli_id" name="cli_id">
                                            <div class="input-group">
                                                <input type="number" min="0" class="form-control" id="fac_ci_nit" name="fac_ci_nit">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <a href="#" data-toggle="modal" data-target="#modal_crear_cliente" title="Registrar Cliente"><i style="color: purple;" class="far fa-user fa-lg"></i></a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Nombre del Cliente</label>
                                            <input type="text" class="form-control" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" id="fac_nombre" name="fac_nombre">
                                        </div>
                                        <h5>DATOS DE LA FACTURA:</h5>
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <label class="col-form-label">Factura Nº</label>
                                                <!--======================================
                                                =     MOSTRAMOS EL NUMERO DE FACTURA    ==
                                                =======================================-->
                                                <div id="numero_factura"></div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label class="col-form-label">Forma de Pago</label>
                                                <select class="custom-select form-control-sm" id="fac_forma_pago" name="fac_forma_pago">
                                                    <option value="CONTADO" selected="true">CONTADO</option>
                                                    <option value="CREDITO">CRÉDITO</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label class="col-form-label">Fecha y Hora</label>
                                                <input type="text" class="form-control" readonly="" id="fac_fecha_hora" name="fac_fecha_hora" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <input type="hidden" class="form-control" id="adm_id" name="adm_id" value="<?php echo utf8_decode($row['adm_id']); ?>">
                                                <label class="col-form-label">Nombre del Cajero</label>
                                                <input type="text" class="form-control" id="fac_usuario" name="fac_usuario" readonly="" value="<?php echo utf8_decode($row['adm_nombre']); ?>">
                                            </div>
                                            <div class="form-group col-sm-4">
                                                <label class="col-form-label">Total</label>
                                                <!--======================================
                                                =    MOSTRAMOS EL TOTAL DE LA FACTURA   ==
                                                =======================================-->
                                                <div id="total_factura"></div>
                                            </div>
                                            <div class="form-group col-sm-4">
                                                <label class="col-form-label">Importe&nbsp;&nbsp;<a href="javascript:void(0);" data-toggle="modal" data-target="#modal_dolar_boliviano"><i style="color: purple;" class="fe-refresh-cw btnDetalleFactura"></i></a></label>
                                                <input type="number" min="0" class="form-control" id="fac_importe" name="fac_importe" value="0.00">
                                            </div>
                                            <div class="form-group col-sm-4">
                                                <label class="col-form-label">Cambio</label>
                                                <input type="number" class="form-control" readonly="" id="fac_cambio" name="fac_cambio" value="0.00">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12" align="center">
                                                <button type="button" id="create_factura" class="btn btn-block mt-1 btn-purple"> Registrar Factura </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> <!-- end card-box col resumen de compra-->
                        </div>
                        <!--========================================
                        =        Fin Contenido Principal           =
                        =========================================-->
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

        <!--=============================  PUNTO DE VENTA  =============================-->
        <script type="text/javascript">

            function EliminarDetalle(datos) {
                vector = datos.split('||');
                cadena = "det_id=" + vector[0] + "&sumar_stock=" + vector[1] + "&prod_id=" + vector[2];
                //alert(cadena); return false;
                $.ajax({
                    url: "assets/inc/delete_detalle.php",
                    data: cadena,
                    type: "POST",
                    success: function(response) {
                            if(response == 1) {
                                //COLOCAMOS EL FOCO EN EL INPUT SEARCH PARA BUSCAR EL MEDICAMENTO
                                //$('#producto input').focus();
                                //$('#producto').trigger('focus');
                                //RECARGAMOS LA TABLA DETALLE
                                $('#tabla_pos').load('tabla_pos.php');
                                //CARGAMOS EL TOTAL NUMERAL DE LA FACTURA
                                $('#total_factura').load('factura_total.php');
                                //CAMBIAMOS EL TOTAL NUMERAL EN LA CABECERA DE LA FACTURA
                                $('#fac_total_cabecera').load('factura_total_cabecera.php');
                                //COLOCAMOS EL FOCO EN EL INPUT SEARCH PARA BUSCAR EL MEDICAMENTO
                                //$('#producto input').focus();
                                //LIMPIA EL FORMULARIO DE BUSQUEDA DE PRODUCTO
                                $('#formulario_buscar_producto')[0].reset();
                                //COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO
                                //$('#producto').trigger('focus');
                                $('#producto').focus();
                            } //Fin if
                        } //Fin success
                }); //fin ajax
            }

            $(document).ready(function() {
            /* CAPTURA EL EVENTO ENTER DEL LECTOR DE CODIGO DE BARRAS DESPUES, DE LEER EL CODIGO DE BARRAS */   
                $("#producto").keypress(function(e) {
                    var code = (e.keyCode ? e.keyCode : e.which);
                    if(code == 13) {
                        var datos = "prod_barcode=" + $(this).val();
                        //alert(datos); //return false;
                        $.ajax({
                        type:"POST",
                        url:"assets/inc/create_detalle_barcode.php",
                        data:datos,
                        success:function(response){
                            if(response == true){
                                $('#tabla_pos').load('tabla_pos.php');
                                $('#total_factura').load('factura_total.php');
                                $('#fac_total_cabecera').load('factura_total_cabecera.php');
                                //LIMPIA EL FORMULARIO DE BUSQUEDA DE PRODUCTO
                                $('#formulario_buscar_producto')[0].reset();
                                //COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO
                                $('#producto').val('');
                                $('#producto').focus();
                            }else{
                                Swal.fire({
                                      type: 'error',
                                      title: 'El Producto ó el Código de Barras No Esta Registrado',
                                      showConfirmButton: false,
                                      timer: 2000
                                })
                                //COLOCAMOS EL FOCO EN EL INPUT SEARCH PARA BUSCAR EL MEDICAMENTO
                                $('#producto').val('');
                                $('#producto input').focus();
                            }
                          }
                        });
                    }
                });
                /*$("input").on("keypress",function search(e) {
                    //var code = (e.keyCode ? e.keyCode : e.which);
                    //var code = e.which;
                    if(e.which == 13) {
                        var datos = "prod_barcode=" + $(this).val();
                        alert(datos); //return false;
                        $.ajax({
                        type:"POST",
                        url:"assets/inc/create_detalle_barcode.php",
                        data:datos,
                        success:function(response){
                            if(response == 1){
                                    //RECARGAMOS LA TABLA DETALLE
                                    $('#tabla_pos').load('tabla_pos.php');
                                    //CARGAMOS EL TOTAL NUMERAL DE LA FACTURA
                                    $('#total_factura').load('factura_total.php');
                                    //CAMBIAMOS EL TOTAL NUMERAL EN LA CABECERA DE LA FACTURA
                                    $('#fac_total_cabecera').load('factura_total_cabecera.php');
                                    //COLOCAMOS EL FOCO EN EL INPUT SEARCH PARA BUSCAR EL MEDICAMENTO
                                    //$('#producto input').focus();
                                    //LIMPIA EL FORMULARIO DE BUSQUEDA DE PRODUCTO
                                    $('#formulario_buscar_producto')[0].reset();
                                    //COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO
                                    //$('#producto').trigger('focus');
                                    $('#producto').focus();
                            }else{
                                Swal.fire({
                                      type: 'error',
                                      title: 'Error Al Registrar El Detalle',
                                      showConfirmButton: false,
                                      timer: 2000
                                })
                                //COLOCAMOS EL FOCO EN EL INPUT SEARCH PARA BUSCAR EL MEDICAMENTO
                                $('#producto input').focus();
                            }
                          }
                        });
                    }
                });*/
                /*$("input").on("keypress",function search(e) {
                    var code = (e.keyCode ? e.keyCode : e.which);
                    //var code = e.which;
                    if(code == 13) {
                        var datos = "barcode=" + $(this).val();
                        alert(datos); //return false;
                        $.ajax({
                        type:"POST",
                        url:"assets/inc/update_numero_barcode.php",
                        data:datos,
                        success:function(response){
                            if(response == true){
                                Swal.fire({
                                      type: 'info',
                                      title: 'Barcode registrado en tabla Configuración...',
                                      showConfirmButton: false,
                                      timer: 2000
                                })
                            }else{
                                Swal.fire({
                                      type: 'error',
                                      title: 'Error Al Registrar El Barcode en la tabla Configuració...',
                                      showConfirmButton: false,
                                      timer: 2000
                                })
                                //COLOCAMOS EL FOCO EN EL INPUT SEARCH PARA BUSCAR EL MEDICAMENTO
                                $('#producto input').focus();
                            }
                          }
                        });
                    }
                });*/
            /*--===============================================================================================================
            =     1. COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO y REGISTRO DE UN PRODUCTOR EN LA TABLA DETALLE     =
            ================================================================================================================-*/
            // CARGAMOS LA TABLA DETALLE DE LA FACTURA, EL NUMERO DE FACTURA Y EL TOTAL DE LA FACTURA.
                // COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO INMEDIATAMENTE DESPUES DE ABRIR LA PAGINA pos.php
                $('#producto').focus();
                //CARGAMOS LA TABLA DETALLE DE LA FACTURA
                $('#tabla_pos').load('tabla_pos.php');
                //CARGAMOS EL NUMERO DE FACTURA
                $('#numero_factura').load('assets/inc/create_numero_factura.php');
                //CARGAMOS EL TOTAL DE LA FACTURA
                $('#total_factura').load('factura_total.php');
                $('#fac_total_cabecera').load('factura_total_cabecera.php');

                // BUSCAMOS EL PRODUCTO A COMPRAR, LO SELECCIONAMOS Y MOSTRAMOS SUS DATOS EN UN MODAL CREAR DETALLE
                $("#producto").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: "autocomplete_producto.php",
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
                        $('#prod_id').val(ui.item.id);
                        $('#prod_nombre').val(ui.item.nombre);
                        $('#prod_stock').val(ui.item.stock);
                        $('#prod_precio_compra').val(ui.item.precio_compra);
                        $('#prod_precio_venta').val(ui.item.precio_venta);
                        $('#prod_codigo').val(ui.item.codigo);
                        $('#prod_forma').val(ui.item.forma);
                        $('#prod_caducidad').val(ui.item.vencimiento);
                        //ABRE VENTANA MODAL...(CON DATOS DEL PRODUCTO SELECCIONADO)
                        $('#modal_crear_detalle').modal("show");
                        return false;
                    }
                }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
                    return $( "<li class='each'></li>" )
                    .data( "item.autocomplete", item )
                    //.append( "<table class='table table-bordered table-sm  mb-0'><tr><td style='width: 10%;'>" + item.codigo + "</td><td>" + item.nombre + "</td><td>" + item.precio_venta + "</td></tr></table>" )
                    //.append( "<a>" + item.codigo + " " + item.nombre + " " + item.precio_venta + " " + item.propaganda + "<br>" + item.ingrediente + "</a>" )
                    .append("<div class='acItem'><span class='name'>"+item.vencimiento+"</span>"+"&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.laboratorio+"</span>"+"&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.codigo+"</span><span class='name'>"+ "&nbsp;&nbsp;&nbsp;&nbsp;" + item.nombre+"</span><br><span class='desc'>"+item.forma+"</span>"+ ",&nbsp;&nbsp;" +"<span class='desc'>"+item.propaganda+"</span><br><span class='desc'>"+item.ingrediente+"</span></div>")
                    .appendTo( ul );
                };


            /*--===========================================================================
            =     2. COLOCA EL FOCO EN CANTIDAD A COMPRAR SOLO SI HAY STOCK DISPONIBLE    =
            ============================================================================-*/
                //COLOCAMOS EL FOCO EN EL INPUT DE CANTIDAD A COMPRAR, DESPUES DE ABRIR EL MODAL CREAR DETALLE
                //DEPENDIENDO SI HAY STOCK DISPONIBLE, SI EL STOCK ES MAYOR A 0 ENTONCES SE PONE EL FOCO, SI NO NÓ.
                $('#modal_crear_detalle').on('shown.bs.modal', function() {
                    //SI EL STOCK ES CERO, NO SE PUEDE COMPRAR ESE PRODUCTO, POR TANTO EL VALUE MINIMO DE CANTIDAD A COMPRAR SERA 0, CASO CONTRARIO 1
                    stock = parseInt($('#prod_stock').val());
                    if(stock > 0) {
                        //COLOCAMOS EL VALOR DEL SUB TOTAL AL ABRIR EL MODAL, DONDE MUESTRA EN CANTIDAD UN PRODUCTO Y SIN DESCUENTO
                        //ESTO ES SOLO PARA CUANDO SE ABRE EL MODAL.
                        $('#prod_cantidad').val(1);
                        var valor = $("#prod_cantidad").removeAttr("readonly");
                        document.getElementById("prod_subtotal").value = parseFloat($('#prod_cantidad').val()) * parseFloat($('#prod_precio_venta').val());
                        //AL ATRIBUTO MAX DEL INPUT con id=prod_cantidad SE ASIGNACION EL VALOR DEL STOCK
                        //ESO QUIERE DECIR QUE NO SE PUEDE COMPRAR MAS QUE ES STOCK DISPONIBLE
                        var input = document.getElementById("prod_cantidad");
                        input.setAttribute("max", stock); // set a new value;
                        //COLOCAMOS LA UTILIDAD EN EL INPUT 
                        $('#prod_utilidad').val((parseFloat($('#prod_cantidad').val()) * ((parseFloat((parseFloat($('#prod_precio_venta').val()) - parseFloat($('#prod_precio_compra').val()))) - parseFloat((parseFloat($('#prod_precio_venta').val()) - parseFloat($('#prod_precio_compra').val()))) * (parseFloat($('#prod_descuento').val()) / 100)))).toFixed(2));
                        //COLOCAMOS EL FOCO EN EL INPUT CANTIDAD A COMPRAR
                        $('#prod_cantidad').focus();
                    } else { //SI EL STOCK ES CERO...
                        //SETEAMOS EL VALUE DE CANTIDAD A COMPRAR A CERO y DE SOLO LECTURA
                        $('#prod_cantidad').val(0);
                        var valor = $("#prod_cantidad").attr("readonly", "readonly");
                        //SI EL STOCK ES CERO, ENTONCES EL SUB TOTAL ES CERO
                        document.getElementById("prod_subtotal").value = 0;
                        //AL ATRIBUTO MAX DEL INPUT con id=prod_cantidad SE ASIGNACION EL VALOR DEL STOCK
                        //ESO QUIERE DECIR QUE NO SE PUEDE COMPRAR MAS QUE ES STOCK DISPONIBLE
                        //var input = document.getElementById("prod_cantidad");
                        //input.setAttribute("max",0); // set a new value;
                    }
                });
            /*--==================================================================================
            =     3. CALCULA EL SUBTOTAL y UTILIDAD DADO LA CANTIDAd A COMPRAR y EL DESCUENTO    =
            ===================================================================================-*/
                $('#prod_cantidad').on('keyup change',function() {
                    var cantidad = $(this).val();

                    pc = parseFloat($('#prod_precio_compra').val());
                    pv = parseFloat($('#prod_precio_venta').val());
                    descuento = parseFloat($('#prod_descuento').val());
                    util = (parseFloat(pv)-parseFloat(pc)).toFixed(2);
                    // SUBTOTAL = CANTIDAD * (PRECIO_COMPRA + (UTILIDAD - UTILIDAD*DESCUENTO/100))
                    subtotal = (parseFloat(cantidad)*((parseFloat(pc)+(parseFloat(util)-parseFloat(util)*(parseFloat(descuento)/100))))).toFixed(2);
                    utilidad = (parseFloat(cantidad)*((parseFloat(util)-parseFloat(util)*(parseFloat(descuento)/100)))).toFixed(2);
                    // UTILIDAD = CANTIDAD * (UTILIDAD - UTILIDAD*DESCUENTO/100)
                    $('#prod_subtotal').val(subtotal);
                    $('#prod_utilidad').val(utilidad);

                  }).keyup();

                $('#prod_descuento').on('keyup change',function(){
                    var descuento = $( this ).val();
                    //$( "p" ).text( cantidad );
                    //porcentaje del valor total para precios de ventas
                    pc = parseFloat($('#prod_precio_compra').val());
                    pv = parseFloat($('#prod_precio_venta').val());
                    cantidad = parseFloat($('#prod_cantidad').val());
                    util = (parseFloat(pv)-parseFloat(pc)).toFixed(2);

                    subtotal = (parseFloat(cantidad)*((parseFloat(pc)+(parseFloat(util)-parseFloat(util)*(parseFloat(descuento)/100))))).toFixed(2);
                    utilidad = (parseFloat(cantidad)*((parseFloat(util)-parseFloat(util)*(parseFloat(descuento)/100)))).toFixed(2);

                    //$('#subtotal').text(subtotal);
                    $('#prod_subtotal').val(subtotal);
                    $('#prod_utilidad').val(utilidad);

                }).keyup();
            /*--==================================================================================
            =        4. ASIGNACION DE HotKey A LOS BOTONES ENTER Y ESC USANDO JavaSCcript        =
            ===================================================================================-*/
                document.addEventListener('keyup', event => {
                    // combinación de teclas ctrl + a        http://keycode.info/
                    /*if (event.ctrlKey && event.keyCode === 65) {
                        document.getElementById("create_detalle").click();
                    }*/
                    if (event.keyCode == 32) {//13 tecla espaciadora
                        document.getElementById("create_detalle").click();
                        //LIMPIA EL FORMULARIO DE BUSQUEDA DE PRODUCTO
                        $('#formulario_buscar_producto')[0].reset();
                        //LIMPIA EL MODAL PARA REGISTRAR PRODUCTO
                        $('#modal_crear_detalle').on('hidden.bs.modal',function(){
                            $(this).find('#formulario_crear_detalle')[0].reset();
                        });
                        //COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO
                        $('#producto').focus();
                    }
                    else if (event.keyCode == 27) {//27 tecla escape
                        document.getElementById("cerrar_detalle").click();
                        //LIMPIA EL FORMULARIO DE BUSQUEDA DE PRODUCTO
                        $('#formulario_buscar_producto')[0].reset();
                        //LIMPIA EL MODAL PARA REGISTRAR PRODUCTO
                        $('#modal_crear_detalle').on('hidden.bs.modal',function(){
                            $(this).find('#formulario_crear_detalle')[0].reset();
                        });
                        //COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO
                        $('#producto').focus();
                    }
                }, false)
            /*--==================================================================================
            =       5. REGISTRA UN PRODUCTO EN LA TABLA DETALLE DE COMPRA DE LA FACTURA          =
            ===================================================================================-*/
                $('#create_detalle').click(function(){
                    /*=============================================
                    =            FUNCION CREAR DETALLE            =
                    =============================================*/
                    cantidad_a_comprar = parseInt($('#prod_cantidad').val());
                    //stock = parseInt(valor5)+parseInt(valor4);
                    stock = parseInt($('#prod_stock').val());
                    //alert(cantidad);
                    if(stock == 0){
                        Swal.fire({
                            title: 'Oops...No hay stock disponible',
                            text: 'REALICE UN PEDIDO',
                            type: 'info',
                            showConfirmButton: false,
                            timer: 2500
                        })
                        //COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO
                        $('#producto').trigger('focus');
                    }
                    if(cantidad_a_comprar < 0){
                        Swal.fire({
                            title: 'Oops...Error en la cantidad',
                            text: 'INGRESE NUMERO MAYOR A CERO',
                            type: 'info',
                            showConfirmButton: false,
                            timer: 2500
                        })
                        //COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO
                        $('#producto').trigger('focus');
                    }
                    if(cantidad_a_comprar > stock){
                        Swal.fire({
                            title: 'Oops...No hay suficiente stock',
                            text: 'VUELVA A INTENTARLO',
                            type: 'info',
                            showConfirmButton: false,
                            timer: 2500
                        })
                        //COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO
                        $('#producto').trigger('focus');
                    }
                    if( cantidad_a_comprar > 0 && cantidad_a_comprar <= stock){
                        var datos = $('#formulario_crear_detalle').serialize();
                        //alert(datos);
                        $.ajax({
                        type:"POST",
                        url:"assets/inc/create_detalle.php",
                        data:datos,
                        success:function(response){
                            if(response==1){
                                    //RECARGAMOS LA TABLA DETALLE
                                    $('#tabla_pos').load('tabla_pos.php');
                                    //CARGAMOS EL TOTAL NUMERAL DE LA FACTURA
                                    $('#total_factura').load('factura_total.php');
                                    //CAMBIAMOS EL TOTAL NUMERAL EN LA CABECERA DE LA FACTURA
                                    $('#fac_total_cabecera').load('factura_total_cabecera.php');
                                    //COLOCAMOS EL FOCO EN EL INPUT SEARCH PARA BUSCAR EL MEDICAMENTO
                                    //$('#producto input').focus();
                                    //LIMPIA EL FORMULARIO DE BUSQUEDA DE PRODUCTO
                                    $('#formulario_buscar_producto')[0].reset();
                                    //COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO
                                    //$('#producto').trigger('focus');
                                    $('#producto').focus();
                            }else{
                                Swal.fire({
                                      type: 'error',
                                      title: 'Error Al Registrar El Detalle',
                                      showConfirmButton: false,
                                      timer: 2000
                                })
                                //COLOCAMOS EL FOCO EN EL INPUT SEARCH PARA BUSCAR EL MEDICAMENTO
                                $('#producto input').focus();
                            }
                          }
                        });//FIN AJAX
                    }//FIN IF
                });
                $('#cerrar_detalle').click(function(){
                        //LIMPIA EL FORMULARIO DE BUSQUEDA DE PRODUCTO
                        $('#formulario_buscar_producto')[0].reset();
                        //COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO
                        $('#producto').focus();
                });
            /*--========================================================================
            =       6. AUTOCOMPLETA DATOS DE LA FACTURA Y REGISTRA LA FACTURA          =
            =========================================================================-*/
                $("#fac_ci_nit").autocomplete({
                    source: "autocomplete_factura_ci_nit.php",
                    minLength: 2,
                    select: function(event, ui) {
                        event.preventDefault();
                        $('#cli_id').val(ui.item.id);
                        $('#fac_ci_nit').val(ui.item.ci_nit);
                        $('#fac_nombre').val(ui.item.nombre);
                    }
                });
                $("#fac_nombre").autocomplete({
                    source: "autocomplete_factura_nombre.php",
                    minLength: 2,
                    select: function(event, ui) {
                        event.preventDefault();
                        $('#cli_id').val(ui.item.id);
                        $('#fac_ci_nit').val(ui.item.ci_nit);
                        $('#fac_nombre').val(ui.item.nombre);
                    }
                });
                //CALCULA EL CAMBIO, DADO EL TOTAL DE LA FACTURA
                $("#fac_importe").on('keyup change',function() {
                    var total = document.getElementById("fac_total").value;
                    var importe = $(this).val();
                    var cambio = (parseFloat(importe) - parseFloat(total)).toFixed(2);
                    document.getElementById("fac_cambio").value = cambio;
                });
                //REGISTRAMOS LA FACTURA Y CON ESTO CONCLUYE LA VENTA
                $('#create_factura').click(function() {
                    var total = Number.parseFloat($('#fac_total').val()).toFixed(2);
                    var importe = Number.parseFloat($('#fac_importe').val()).toFixed(2);
                    var cambio = Number.parseFloat($('#fac_cambio').val()).toFixed(2);
                    //VERIFICAMOS SI AL MENOS HAY UN PRODUCTO REGISTRADO
                    if ($('#fac_total').val() == '' || total == 0.00) { //SI EL TOTAL ES CERO
                        Swal.fire({
                            title: 'Oops...Registre Al Menos Un Producto',
                            text: 'BUSQUE UN PRODUCTO',
                            type: 'info',
                            showConfirmButton: false,
                            timer: 2500,
                            onAfterClose: () => {
                                setTimeout(() => $("#productoDisponible_filter input").focus(), 110);
                            }
                        })
                        return false;
                    }
                    //VERIFICAMOS SI LA FACTURA TIENE NOMBRE DEL CLIENTE
                    if ($('#fac_nombre').val() == "") {
                        Swal.fire({
                            title: 'Oops...Ingrese Datos del Cliente',
                            text: 'INGRESE C.I. PARA BUSCAR',
                            type: 'info',
                            showConfirmButton: false,
                            timer: 2500,
                            onAfterClose: () => {
                                setTimeout(() => $("#fac_ci_nit").focus(), 110);
                            }
                        })
                        return false;
                    }
                    //VERIFICAMOS SI EL MODO DE PAGO ES AL CONTADO
                    if($("#fac_forma_pago option:selected").val() == 'CONTADO'){
                        //VERIFICAMOS SI AL MENOS HAY UN PRODUCTO REGISTRADO
                        if (total == 0.00) {
                            Swal.fire({
                                title: 'Oops...Registre Al Menos Un Producto',
                                text: 'BUSQUE UN PRODUCTO',
                                type: 'info',
                                showConfirmButton: false,
                                timer: 2500,
                                onAfterClose: () => {
                                    setTimeout(() => $("#productoDisponible_filter input").focus(), 110);
                                }
                            })
                            return false;
                        }
                        //VERIFICAMOS SI SE HA REGISTRADO UN MONTO DE PAGO O IMPORTE VALIDO
                        if (parseFloat($('#fac_importe').val()) < parseFloat($('#fac_total').val())) {
                            Swal.fire({
                                title: 'Oops...Ingrese Monto de Pago Correcto',
                                text: 'INGRESE IMPORTE',
                                type: 'info',
                                showConfirmButton: false,
                                timer: 2500,
                                onAfterClose: () => {
                                    setTimeout(() => $("#fac_importe").focus(), 110);
                                }
                            })
                            return false;
                        }
                        //AJAX PARA GUARDAR TOTAL DE UNA FACTURA
                        if ($('#fac_total').val() > 0 && $('#fac_nombre').val() != "") {
                            //SI EL TOTAL ES MAYOR A CERO, Y EL NOMBRE DEL CLIENTE NO ESTA VACIO
                            var datos = $('#formulario_crear_factura').serialize();
                            //alert(datos); return false;
                            $.ajax({
                                type: "POST",
                                url: "assets/inc/create_factura.php",
                                data: datos,
                                success: function(response) {
                                    if (response == 1) {
                                        //RECARGAMOS LA TABLA DETALLE
                                        //$('#tabla_pos').load('tabla_pos.php');
                                        //RECARGAMOS EL NUMERO DE FACTURA ACTUAL
                                        $('#numero_factura').load('assets/inc/create_numero_factura.php');
                                        //CAMBIAMOS EL TOTAL NUMERAL DE LA FACTURA A CERO
                                        $('#fac_total').val('0.00');
                                        $('#fac_total_cabecera').text('0.00');
                                        $('#fac_importe').val('0.00');
                                        $('#fac_cambio').val('0.00');
                                        //LIMPIAMOS LOS DATOS DEL FORMULARIO, CI/NIT y NOBRE CLIENTE
                                        $('#fac_ci_nit').val('');
                                        $('#fac_nombre').val('');

                                        //COLOCAMOS EL FOCO EN EL INPUT SEARCH PARA BUSCAR EL MEDICAMENTO
                                        //$('#producto').trigger('focus');
                                        $("#producto").focus();
                                        //COLOCAMOS EL SWAL AL FINAL CASO CONTRARIO EL FOCO EN EL INPUT PRODUCTO SE PIERDE
                                        Swal.fire({
                                            type: 'success',
                                            title: 'Nota de Venta Registrada Exitosamente',
                                            text: 'AHORA YA PUEDE REALIZAR OTRA VENTA',
                                            showConfirmButton: true,
                                            showCancelButton: true,
                                            confirmButtonText: 'Imprimir Nota',
                                            cancelButtonText: 'Imprimir Después',
                                            //timer: 2000
                                        }).then((result) => {
                                            /* Read more about isConfirmed, isDenied below */
                                            if (result.value) {
                                                $('#modal_crear_factura').modal('hide');
                                                $('#tabla_pos').load('tabla_pos.php');
                                                $('#producto input').focus();
                                                //window.location = "caja.php";
                                                window.open('tcpdf/pdf/comprobante.php', "_blank");
                                            }else{
                                                $('#tabla_pos').load('tabla_pos.php');
                                                $('#producto input').focus();
                                            }
                                        })

                                    } else {
                                        Swal.fire({
                                            type: 'error',
                                            title: 'Error al Registrar la Factura',
                                            showConfirmButton: false,
                                            timer: 2000
                                        })
                                    }
                                }
                            }); //FIN AJAX
                            //REFRESCA UNICAMENTE EL DOM CON id=contenido, ES OBLIGATORIO EL ESPACIO
                            //DESPUES DEL load TAL Y COMO SE VE.
                            $("#contenido").load();
                        }
                    }else{
                        var datos = $('#formulario_crear_factura').serialize();
                        //alert(datos); return false;
                        $.ajax({
                            type: "POST",
                            url: "assets/inc/create_factura.php",
                            data: datos,
                            success: function(response) {
                                if (response == 1) {
                                    //RECARGAMOS LA TABLA DETALLE
                                    //$('#tabla_pos').load('tabla_pos.php');
                                    //RECARGAMOS EL NUMERO DE FACTURA ACTUAL
                                    $('#numero_factura').load('assets/inc/create_numero_factura.php');
                                    //CAMBIAMOS EL TOTAL NUMERAL DE LA FACTURA A CERO
                                    $('#fac_total').val('0.00');
                                    $('#fac_total_cabecera').text('0.00');
                                    $('#fac_importe').val('0.00');
                                    $('#fac_cambio').val('0.00');
                                    //LIMPIAMOS LOS DATOS DEL FORMULARIO, CI/NIT y NOBRE CLIENTE
                                    $('#fac_ci_nit').val('');
                                    $('#fac_nombre').val('');
                                    //COLOCAMOS EL FOCO EN EL INPUT SEARCH PARA BUSCAR EL MEDICAMENTO
                                    //$('#producto').trigger('focus');
                                    $("#producto").focus();
                                    //COLOCAMOS EL SWAL AL FINAL CASO CONTRARIO EL FOCO EN EL INPUT PRODUCTO SE PIERDE
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Nota de Venta Registrada Exitosamente',
                                        text: 'AHORA YA PUEDE REALIZAR OTRA VENTA',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                    $("#modal_crear_factura").modal('hide');
                                    //RECARGAMOS LA TABLA DETALLE
                                    $('#tabla_pos').load('tabla_pos.php');
                                } else {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Error al Registrar la Factura',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                }
                            }
                        }); 
                        $("#contenido").load();
                    }
                });

            });

        </script>
        <!--================================  CLIENTES  ================================-->
        <script>
            // COLOCAMOS EN FOCO EN EL INPUT CI/NIT
            $('#modal_crear_cliente').on('shown.bs.modal',function(){
                $('#cli_ci_nit').trigger('focus');
            });
            // REGISTRO DE UN NUEVO CLIENTE
            $(document).ready(function() {
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
            });
        </script>
        <!--================================  TIPO DE CAMBIO  ================================-->
        <script>
            // COLOCAMOS EN FOCO EN EL USD
            $('#modal_dolar_boliviano').on('shown.bs.modal',function(){
                $('#usd').trigger('focus');
            });
            // REGISTRO DE UN NUEVO CLIENTE
            $(document).ready(function() {
                $('#usd').on('keyup change',function() {
                    var cantidad = $(this).val();
                    subtotal = (parseFloat(cantidad)*(6.95)).toFixed(2);
                    $('#bob').val(subtotal);
                  }).keyup();
                $('#create_importe').click(function(){
                    $('#fac_importe').val($('#bob').val());
                    var total = document.getElementById("fac_total").value;
                    var importe = document.getElementById("fac_importe").value;
                    var cambio = (parseFloat(importe) - parseFloat(total)).toFixed(2);
                    document.getElementById("fac_cambio").value = cambio;
                    $('#usd').val(1);
                    $('#bob').val(6.95);
                    //$(this).find('#formulario_dolar_boliviano')[0].reset();
                    //$(this).removeData('#formulario_dolar_boliviano');
                });
            });
        </script>
    </body>
</html>