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
                                            <!-- <li class="breadcrumb-item active"><a href="javascript: void(0);">Panel de control</a></li> -->
                                            <li class="breadcrumb-item active">Punto de Venta</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">
                                        <a style="color:purple;" href="#" data-toggle="modal" data-target="#modal_crear_factura" title="Finalizar Venta">
                                            <i class="far fa-plus-square"></i>
                                        </a>Punto de Venta
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <!--========================================
                        =            Contenido Principal           =
                        =========================================-->
                        <div class="row">
                            <?php include 'modal_create_cliente.php'; ?>
                            <?php include 'modal_dolar_boliviano.php'; ?>
                            <!-- MODAL PARA REGISTRAR UN PRODUCTO EN EL CARRITO MODELO ANTIGUO -->
                            <div id="modal_crear_detalle" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">AGREGAR PRODUCTO</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="formulario_detalle">
                                                    <!-- AQUI SE MUESTRA EL FORMULARIO CON LOS DATOS DEL PRODUCTO SELECCIONADO -->
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal" id="cerrar_detalle">Cerrar (Esc)</button>
                                                <button type="button" class="btn btn-purple waves-effect" data-dismiss="modal" id="create_detalle">Agregar (Intro)</button>
                                            </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                            <div class="col-md-12">
                                <!--=====================================
                                =    BUSCADOR DEL PRODUCTO A VENDER     =
                                ======================================-->
                                <div class="card-box">
                                    <div class="table-responsive">
                                        <table id="productoDisponible" class="table mb-0 table-sm table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <th data-priority="2">ID</th>
                                                <th data-priority="6">Código</th>
                                                <th data-priority="4">Nombre Comercial</th>
                                                <th data-priority="11">Nombre Genérico</th>
                                                <th data-priority="10">Categoria Terapéutica</th>
                                                <th data-priority="5">Forma</th>
                                                <th data-priority="3">Laboratorio</th>
                                                <th data-priority="8">Stock</th>
                                                <th class="none">Caducidad</th>
                                                <th data-priority="7">Precio</th>
                                                <th class="none">BarCode</th>
                                                <th data-priority="1">Add</th>
                                            </thead>
                                                <!-- aqui va el contenido del serverside -->
                                        </table>
                                    </div>
                                </div>
                                <!--====================================================
                                =    MUESTRA EL DETALLE DE PRODUCTOS DE LA FACTURA     =
                                =====================================================-->
                                <div class="card-box">
                                    <div class="row" id="tabla_pos"></div>
                                </div>
                            </div><!-- end col buscador y tabla detalle -->


                            <!-- MODAL PARA REGISTRAR DATOS DEL CLIENTE Y LA FACTURA -->
                            <div id="modal_crear_factura" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">REGISTRAR NOTA DE VENTA</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
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
                                                        <h5>DATOS DE LA NOTA DE VENTA:</h5>
                                                        <div class="form-row">
                                                            <div class="form-group col-sm-4">
                                                                <label class="col-form-label">Número</label>
                                                                <!--======================================
                                                                =     MOSTRAMOS EL NUMERO DE FACTURA    ==
                                                                =======================================-->
                                                                <div id="numero_factura"></div>
                                                            </div>
                                                            <div class="form-group col-sm-4">
                                                                <label class="col-form-label">Fecha</label>
                                                                <input type="text" class="form-control" readonly="" id="fac_fecha_hora" name="fac_fecha_hora" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                                            </div>
                                                            <div class="form-group col-sm-4">
                                                                <label class="col-form-label">Forma de Pago</label>
                                                                <select class="custom-select form-control-sm" id="fac_forma_pago" name="fac_forma_pago">
                                                                    <option value="CONTADO" selected="true">CONTADO</option>
                                                                    <option value="CREDITO">CRÉDITO</option>
                                                                </select>
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
                                                                <input type="number" min="0.00" step="0.50" lang="en-US" class="form-control" id="fac_importe" name="fac_importe" value="0.00">
                                                            </div>
                                                            <div class="form-group col-sm-4">
                                                                <label class="col-form-label">Cambio</label>
                                                                <input type="number" class="form-control" readonly="" id="fac_cambio" name="fac_cambio" value="0.00">
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12" align="center">
                                                                <button type="button" id="create_factura" class="btn btn-block mt-1 btn-purple"> Registrar Nota de Venta </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                            </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

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
        <!--================  RESETEAR EL TIPO DE PAGO AL CERRAR MODAL  --================-->
        <script>
            $(document).ready(function () {
                $("#modal_crear_factura").on("hidden.bs.modal", function () {
                    $("#fac_forma_pago option[value='CONTADO']").prop('selected', true);
                    $('#productoDisponible_filter input').value="";
                    $('#productoDisponible_filter input').focus();
                });

            });
        </script>
        <!--=========================  FILTER MULTIPLE COLUMNS  =========================-->
        <script>
            $(document).ready(function ()
            {
                // Setup - add a text input to each header cell
                $('#productoDisponible thead th').each(function() {
                    var title = $(this).text();
                    $(this).html(title + ' <input type="text" class="col-search-input" placeholder="&#xF002;" />');
                });

                // DataTable
                var otable = $('#productoDisponible').DataTable();

                // Apply the search
                otable.columns().every(function() {

                    var that = this;
                    $('input', this.header()).on('keyup change', function() {
                        if (that.search() !== this.value) {
                            that
                                .search(this.value)
                                .draw();
                        }
                    });
                });
            });
        </script>
        <!--=============================  PUNTO DE VENTA  =============================-->
        <script>
            /* Tabla de medicamentos registrados para la venta*/
            var table = $('#productoDisponible').dataTable({
                responsive: true,
                columnDefs: [{
                    "targets": -1,
                    //https://codebeautify.org/htmlviewer/
                    "defaultContent": "<a style='color:purple;' href='#' data-toggle='modal' data-target='#modal_crear_detalle' title='Agregar Producto'><i class='mdi mdi-18px mdi-cart-outline btnSeleccionar'></i></a>"
                }],
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "serverside_producto_tpv.php",
                //"paging": false,
                "info": false,
                "lengthMenu": [2, 4, 8],
                "order": [
                    [4, "asc"]
                ], //ORDERNAR ASCENDENTEMENTE POR EL NUMERO DE DIAS
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
            $('#productoDisponible_filter input').focus();

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
                                $('#productoDisponible').DataTable().ajax.reload();
                                //RECARGAMOS LA TABLA DETALLE
                                $('#tabla_pos').load('tabla_pos.php');
                                //CARGAMOS EL TOTAL NUMERAL DE LA FACTURA
                                $('#total_factura').load('factura_total.php');
                                //CAMBIAMOS EL TOTAL NUMERAL EN LA CABECERA DE LA FACTURA
                                $('#fac_total_cabecera').load('factura_total_cabecera.php');
                                //COLOCAMOS EL FOCO EN EL INPUT SEARCH PARA BUSCAR EL MEDICAMENTO
                                //$('#producto input').focus();
                                //LIMPIA EL FORMULARIO DE BUSQUEDA DE PRODUCTO
                                $('#productoDisponible_filter input').value="";
                                //COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO
                                //$('#producto').trigger('focus');
                                $('#productoDisponible_filter input').focus();
                            } //Fin if
                        } //Fin success
                }); //fin ajax
            }

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
                /* CAPTURA EL EVENTO ENTER DEL LECTOR DE CODIGO DE BARRAS DESPUES, DE LEER EL CODIGO DE BARRAS
                BUSCA EL ID DE PRODUCTO RELACIONADO CON ESE CODIGO DE BARRAS Y GUARDA ESE ID EN LA TABLA
                CONFIGURACION, Y AL ABRIRSE EL MODAL CARGA TODOS LOS DATOS DEL PRODUCTO CON ESE ID. */
                $("#productoDisponible_filter input").keypress(function(e) {
                    var code = (e.keyCode ? e.keyCode : e.which);
                    if (code == 13) {
                        var datos = "prod_barcode=" + $(this).val();
                        //alert(datos); return false;
                        $.ajax({
                            type: "POST",
                            url: "assets/inc/update_producto_id_barcode.php",
                            data: datos,
                            success: function(r) {
                                if (r == 1) {
                                    $('#modal_crear_detalle').modal('show'); // abrir modal
                                    $('#formulario_detalle').load('formulario_crear_detalle.php');
                                    $('#productoDisponible_filter input').value="";
                                    $('#productoDisponible_filter input').focus();
                                }
                            }
                        });
                    }
                });
                //PONE EL FOCO EN CANTIDAD, DESPUES DE ABRIR EL MODAL
                $('#modal_crear_detalle').on('shown.bs.modal', function() {
                    $('#prod_cantidad').trigger('focus');
                });

                //INSERTA EL ID DEL PRODUCTO, EN LA TABLA CONFIGURACION    
                $(document).on("click", ".btnSeleccionar", function() {
                    /*CAPTURA EL ID DEL PRODUCTO DE ESA FILA, Y LO ACTUALIZAMOS EN LA TABLA DE CONFIGURACION,
                    PARA PODER EDITAR O ELIMINAR EL PRODUCTO USANDO ESE ID QUE OBTENEMOS CON $(this), EN
                    ESTE CASO USAMOS EL ID DEL PRODUCTO PARA AÑADIR EL PRODUCTO AL CARRITO DE COMPRAS, AL
                    ABRIR EL MODAL RECUPERAMOS EL ID DEL PRODUCTO DE LA TABLA DE CONFIGURACION Y CARGAMOS
                    LOS DATOS DESDE LA TABLA PRODUCTO USANDO ESE ID, Y RELLENANDO LOS INPUTS DEL MODAL CON
                    LOS DATOS RECUPERADOS DE LA TABLA PRODUCTO.*/
                    cadena="prod_id=" + $(this).closest('tr').find('td:eq(0)').text();
                    //alert(cadena); return false;
                    $.ajax({
                        type:"POST",
                        url:"assets/inc/update_producto_id.php",
                        data:cadena,
                        success:function(r){
                            if(r==1){
                                $('#formulario_detalle').load('formulario_crear_detalle.php');
                            }
                        }
                    });
                });
            /*--===============================================================================================================
            =     1. COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO y REGISTRO DE UN PRODUCTO EN LA TABLA DETALLE      =
            ================================================================================================================-*/
                // CARGAMOS LA TABLA DETALLE DE LA FACTURA, EL NUMERO DE FACTURA Y EL TOTAL DE LA FACTURA.

                //CARGAMOS LA TABLA DETALLE DE LA FACTURA
                $('#tabla_pos').load('tabla_pos.php');
                $('#formulario_detalle').load('formulario_crear_detalle.php');
                //CARGAMOS EL NUMERO DE FACTURA
                $('#numero_factura').load('assets/inc/create_numero_factura.php');
                //CARGAMOS EL TOTAL DE LA FACTURA
                $('#total_factura').load('factura_total.php');
                $('#fac_total_cabecera').load('factura_total_cabecera.php');


            /*--===========================================================================
            =     2. COLOCA EL FOCO EN CANTIDAD A COMPRAR SOLO SI HAY STOCK DISPONIBLE    =
            ============================================================================-*/
                //COLOCAMOS EL FOCO EN EL INPUT DE CANTIDAD A COMPRAR, DESPUES DE ABRIR EL MODAL CREAR DETALLE
                //DEPENDIENDO SI HAY STOCK DISPONIBLE, SI EL STOCK ES MAYOR A 0 ENTONCES SE PONE EL FOCO, SI NO NÓ.
                $('#modal_crear_detalle').on('shown.bs.modal', function() {
                    //SI EL STOCK ES CERO, NO SE PUEDE COMPRAR ESE PRODUCTO, POR TANTO EL LA CANTIDA A COMPRAR = 0 Y EL TOTAL = 0
                    //SI EL STOCK DISPONIBLE PARA VENDER EN MAYOR A CERO ENTONCES, LA CANTIDAD = 1 Y EL TOTAL VARIA
                    stock = parseInt($('#prod_stock').val());
                    if(stock > 0) {
                        //COLOCAMOS CANTIDAD = 1 Y EL TOTAL DEPENDE DEL PRECIO DE VENTA UNITARIO DEL PRODUCTO
                        $('#prod_cantidad').val(1);
                        var valor = $("#prod_cantidad").removeAttr("readonly");
                        document.getElementById("prod_subtotal").value = parseFloat($('#prod_cantidad').val()) * parseFloat($('#prod_precio_venta').val());
                        //AL ATRIBUTO MAX DEL INPUT con id=prod_cantidad SE ASIGNACION EL VALOR DEL STOCK
                        //ESO QUIERE DECIR QUE NO SE PUEDE COMPRAR MAS QUE ES STOCK DISPONIBLE
                        var input = document.getElementById("prod_cantidad");
                        input.setAttribute("max", stock); // set a new value;
                        //COLOCAMOS LA UTILIDAD EN EL INPUT QUE ESTA OCULTO
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

            /*--==================================================================================
            =        4. ASIGNACION DE HotKey A LOS BOTONES ENTER Y ESC USANDO JavaSCcript        =
            ===================================================================================-*/
                document.addEventListener('keyup', event => {
                    // combinación de teclas ctrl + a        http://keycode.info/
                    /*if (event.ctrlKey && event.keyCode === 65) {
                        document.getElementById("create_detalle").click();
                    }*/
                    if (event.keyCode == 13) {//13 tecla enter
                        document.getElementById("create_detalle").click();
                        //LIMPIA EL MODAL PARA REGISTRAR PRODUCTO
                        $('#modal_crear_detalle').on('hidden.bs.modal',function(){
                            $(this).find('#formulario_crear_detalle')[0].reset();
                        });
                        //COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO
                        
                        $('#productoDisponible_filter input').focus();
                    }
                    else if (event.keyCode == 27) {//27 tecla escape
                        document.getElementById("cerrar_detalle").click();
                        //LIMPIA EL MODAL PARA REGISTRAR PRODUCTO
                        $('#modal_crear_detalle').on('hidden.bs.modal',function(){
                            $(this).find('#formulario_crear_detalle')[0].reset();
                        });
                        //COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO
                        $('#productoDisponible_filter input').value="";
                        $('#productoDisponible_filter input').focus();
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
                        $('#productoDisponible_filter input').value="";
                        $('#productoDisponible_filter input').focus();
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
                        $('#productoDisponible_filter input').value="";
                        $('#productoDisponible_filter input').focus();
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
                        $('#productoDisponible_filter input').value="";
                        $('#productoDisponible_filter input').focus();
                    }
                    if( cantidad_a_comprar > 0 && cantidad_a_comprar <= stock){
                        var datos = $('#formulario_crear_detalle').serialize();
                        //alert(datos); return false;
                        $.ajax({
                            type:"POST",
                            url:"assets/inc/create_detalle.php",
                            data:datos,
                            success:function(response){
                                if(response==1){
                                        //RECARGAMOS LA TABLA DETALLE
                                        $('#productoDisponible').DataTable().ajax.reload();
                                        //RECARGAMOS LA TABLA DEL CARRITO DE COMPRAS
                                        $('#tabla_pos').load('tabla_pos.php');
                                        //CARGAMOS EL TOTAL NUMERAL DE LA FACTURA
                                        $('#total_factura').load('factura_total.php');
                                        //CAMBIAMOS EL TOTAL NUMERAL EN LA CABECERA DE LA FACTURA
                                        $('#fac_total_cabecera').load('factura_total_cabecera.php');
                                        //COLOCAMOS EL FOCO EN EL INPUT SEARCH PARA BUSCAR EL MEDICAMENTO
                                        $('#productoDisponible_filter input').val('');
                                        $('#productoDisponible_filter input').focus();
                                }else{
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Error Al Registrar El Detalle',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                    //COLOCAMOS EL FOCO EN EL INPUT SEARCH PARA BUSCAR EL MEDICAMENTO
                                    $('#productoDisponible_filter input').value="";
                                    $('#productoDisponible_filter input').focus();
                                }
                            }
                        });//FIN AJAX
                    }//FIN IF
                });
                $('#cerrar_detalle').click(function(){
                        //LIMPIA EL FORMULARIO DE BUSQUEDA DE PRODUCTO
                        $('#productoDisponible_filter input').value="";
                        //COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO
                        $('#productoDisponible_filter input').focus();
                });
            /*--========================================================================
            =       6. AUTOCOMPLETA DATOS DE LA FACTURA Y REGISTRA LA FACTURA          =
            =========================================================================-*/
                $("#fac_ci_nit").autocomplete({
                    appendTo: '#modal_crear_factura',
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
                    appendTo: '#modal_crear_factura',
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
                                                //$('#producto input').focus();
                                                $('#productoDisponible_filter input').focus();
                                                //window.location = "caja.php";
                                                window.open('tcpdf/pdf/comprobante.php', "_blank");
                                            }else{
                                                $('#modal_crear_factura').modal('hide');
                                                $('#tabla_pos').load('tabla_pos.php');
                                                //$('#producto input').focus();
                                                $('#productoDisponible_filter input').focus();
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
        <!--=============================  TIPO DE CAMBIO  =============================-->
        <script>
            // COLOCAMOS EN FOCO EN EL USD
            $('#modal_dolar_boliviano').on('shown.bs.modal',function(){
                $('#usd').trigger('focus');
            });
            // REGISTRO DE UN NUEVO CLIENTE
            $(document).ready(function() {
                $('#usd').on('keyup change',function() {
                    var cantidad = $(this).val();
                    subtotal = (parseFloat(cantidad)*parseFloat($('#tipo_cambio').val())).toFixed(2);
                    $('#bob').val(subtotal);
                  }).keyup();
                $('#create_importe').click(function(){
                    $('#fac_importe').val($('#bob').val());
                    var total = document.getElementById("fac_total").value;
                    var importe = document.getElementById("fac_importe").value;
                    var cambio = (parseFloat(importe) - parseFloat(total)).toFixed(2);
                    document.getElementById("fac_cambio").value = cambio;
                    $('#usd').val(1);
                    $('#bob').val($('#tipo_cambio').val());
                    //$(this).find('#formulario_dolar_boliviano')[0].reset();
                    //$(this).removeData('#formulario_dolar_boliviano');
                });
            });
        </script>
    </body>
</html>