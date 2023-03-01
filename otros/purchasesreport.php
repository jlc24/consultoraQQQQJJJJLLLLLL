<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>PSMG - Material Escolar, de Escritorio y Papeleria</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon2.ico">

        <!-- DataTables -->
        <link href="assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css"/>

        <!-- Sweet Alert-->
        <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />  
        
        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
        
        <!-- JQuery UI -->
        <link href="assets/libs/jquery-ui/themes/dark-hive/jquery-ui.min.css" rel="stylesheet" type="text/css" />

        <!-- Funciones para el CRUD para los reportes de COMPRA -->
        <script src="assets/js/crud/crud_purchasesreport.js"></script>

    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <?php include('assets/inc/topbar.php'); ?>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <?php include('assets/inc/left-side-menu.php'); ?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content" id="contenido">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Papeleria</a></li>
                                            <li class="breadcrumb-item active">Reporte De Compras</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Reporte De Compras</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->


                        <!--==========================================
                        =   INICIO CONTENIDO DE LA PÁGINA PRINCIPAL   =
                        ===========================================-->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                    <!-- <h4 class="header-title mb-4">Default Tabs</h4> -->
                                    <ul class="nav nav-tabs navtab-bg nav-justified">
                                        <li class="nav-item">
                                            <a href="#dia" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                                Compras Diarias
                                            </a>
                                        </li>
                                        <li class="nav-item navtab-bg nav-justified">
                                            <a href="#semana" data-toggle="tab" aria-expanded="true" class="nav-link">
                                                Compras Semanales
                                            </a>
                                        </li>
                                        <li class="nav-item navtab-bg nav-justified">
                                            <a href="#mes" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                Compras Mensuales
                                            </a>
                                        </li>
                                        <li class="nav-item navtab-bg nav-justified">
                                            <a href="#anio" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                Compras Anuales
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="dia">
                                            <div class="container">
                                                <div class="row justify-content-center">
                                                    <form class="form-inline">
                                                        <label class="mb-2 mr-sm-2">REPORTE DEL DIA :</label>
                                                        <input type="date" class="form-control mb-2 mr-sm-2" id="fecha_dia" value="<?php echo date("Y-m-d"); ?>">
                                                        
                                                        <button type="button" class="btn btn-primary mb-2" id="button_compra_dia">GENERAR REPORTE</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="card-box">
                                                <div class="row" id="tabla_compra_dia">
                                                </div>                                                
                                            </div>
                                        </div>
                                        <div class="tab-pane show" id="semana">
                                            <div class="alert alert-dark alert-dismissible fade bg-light text-dark show mb-0" role="alert">
                                                <h5 style="text-align:center;">
                                                    <?php
                                                        $year=date("Y");
                                                        $week=date("W");   
                                                        # obtenemos el timestamp del primer dia del año
                                                        $timestamp=mktime(0, 0, 0, 1, 1, $year);
                                                        # sumamos el timestamp de la suma de las semanas actuales
                                                        $timestamp+=$week*7*24*60*60;
                                                        # restamos la posición inicial del primer dia del año
                                                        $ultimoDia=$timestamp-date("w", mktime(0, 0, 0, 1, 1, $year))*24*60*60; 
                                                        # le restamos los dias que hay hasta llegar al lunes
                                                        $primerDia=$ultimoDia-86400*(date('N',$ultimoDia)-1);
                                                        # mostramos la fecha correcta
                                                        echo "Semana: ".$week." - Año: ".$year."<br/>"."Primer día de la Semana : ".date("d-m-Y",$primerDia)."<br/>"."Ultimo día de la Semana : ".date("d-m-Y",$ultimoDia);
                                                        ?>                                                    
                                                </h5>
                                            </div>
                                            <div class="card-box">
                                                <div class="row" id="tabla_compra_semana"></div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="mes">
                                            <div class="container">
                                                <div class="row justify-content-center">
                                                    <form class="form-inline">
                                                        <label class="mb-2 mr-sm-2">REPORTE DEL MES DE :</label>
                                                        <select class="form-control mb-2 mr-sm-2" id="numero_mes">
                                                                <option value="1"<?php echo (date('n') == 1)? "selected":"";?>>ENERO</option>
                                                                <option value="2"<?php echo (date('n') == 2)? "selected":"";?>>FEBRERO</option>
                                                                <option value="3"<?php echo (date('n') == 3)? "selected":"";?>>MARZO</option>
                                                                <option value="4"<?php echo (date('n') == 4)? "selected":"";?>>ABRIL</option>
                                                                <option value="5"<?php echo (date('n') == 5)? "selected":"";?>>MAYO</option>
                                                                <option value="6"<?php echo (date('n') == 6)? "selected":"";?>>JUNIO</option>
                                                                <option value="7"<?php echo (date('n') == 7)? "selected":"";?>>JULIO</option>
                                                                <option value="8"<?php echo (date('n') == 8)? "selected":"";?>>AGOSTO</option>
                                                                <option value="9"<?php echo (date('n') == 9)? "selected":"";?>>SEPTIEMBRE</option>
                                                                <option value="10"<?php echo (date('n') == 10)? "selected":"";?>>OCTUBRE</option>
                                                                <option value="11"<?php echo (date('n') == 11)? "selected":"";?>>NOVIEMBRE</option>
                                                                <option value="12"<?php echo (date('n') == 12)? "selected":"";?>>DICIEMBRE</option>
                                                        </select>
                                                        <label class="mb-2 mr-sm-2">DEL AÑO :</label>
                                                        <input type="number" class="form-control mb-2 mr-sm-2" min="2018" step="1" id="numero_anio" value="<?php echo date("Y");?>">
                                                        <button type="button" id="button_compra_mes" class="btn btn-primary mb-2">GENERAR REPORTE</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- end row -->
                                            <div class="card-box">
                                                <div class="row" id="tabla_compra_mes"></div> 
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="anio">
                                            <div class="container">
                                                <div class="row justify-content-center">
                                                    <form class="form-inline">
                                                        <label class="mb-2 mr-sm-2">REPORTE DEL AÑO :</label>
                                                        <input type="number" class="form-control mb-2 mr-sm-2" id="numero_year" min="2018" step="1" value="<?php echo date("Y"); ?>">
                                                        <button type="button" id="button_compra_anio" class="btn btn-primary mb-2">GENERAR REPORTE</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- end row -->
                                            <div class="card-box">
                                                <div class="row" id="tabla_compra_anio"></div> 
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card-box-->
                            </div>

                            <!-- MODAL PARA LA ACTUALIZACION DE UNA COMPRA -->
                            <div id="modal_actualizar_compra" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Actualizar Datos de la compra</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" role="form" id="formulario_actualizar_compra">
                                                <div class="form-row">
                                                    <input type="text" name="" class="form-control form-control-md" id="comp_id">
                                                    <div class="form-group col-md-12">
                                                        <label class="col-form-label">Producto</label>
                                                        <input type="text" class="form-control form-control-md" id="u_nombre" readonly>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label class="col-form-label">Detalle</label>
                                                        <input type="text" class="form-control form-control-md" id="u_detalle">
                                                    </div>                                              
                                                    <div class="form-group col-lg-4">
                                                        <label class="col-form-label">Cantidad</label>
                                                        <input type="number" min="0" class="form-control form-control-md" id="u_cantidad">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label class="col-form-label">SubTotal(Bs)</label>
                                                        <input type="number" min="0" class="form-control form-control-md" id="u_subtotal">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label class="col-form-label">P.Unitario(Bs)</label>
                                                        <input type="number" min="0" class="form-control form-control-md" id="u_punitario">
                                                    </div>                                          
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal" id="update_compra">Actualizar Registro</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </div><!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <?php include('assets/inc/footer.php'); ?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
        <?php /*include('assets/inc/right-side-bar.php');*/ ?>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <!--<div class="rightbar-overlay"></div>-->

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- JQuery UI <script src="assets/libs/jquery/jquery-3.4.1.min.js"></script>-->
        
        <script src="assets/libs/jquery-ui/jquery-ui.min.js"></script>
        
        <!-- Datatable js -->
        <script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Sweet Alerts js -->
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
        
        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

        <!-- FOCO, BUSQUEDA, SELECCION PRODUCTO, MODAL DEL PRODUCTO, GUARDAR DETALLE, GUARDAR FACTURA  -->
        <script type="text/javascript">
        	//1. COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO INMEDIATAMENTE DESPUES DE ABRIR LA PAGINA pos.php
            //$('#producto').focus();
            //CARGAMOS LA TABLA DETALLE DE COMPRA en el DIV con id=tabla_detalle
            $(document).ready(function() {
                $('#tabla_compra_dia').load('purchasesreport_dia.php');
                //$('#tabla_dia_detalle').load('salesreport_dia_detalle.php');
                $('#tabla_compra_semana').load('purchasesreport_semana.php');
                $('#tabla_compra_mes').load('purchasesreport_mes.php');
                $('#tabla_compra_anio').load('purchasesreport_anio.php');
                //$('#literal_dia_detalle').load('literal_dia_detalle.php');
            });
            //CUANDO DAMOS CLICK EN EL BOTON PARA GENERAR INFORME POR DIA SEMANA MES Y AÑO
            //LOS BOTONES TIENEN IDs, dia, semana, mes, anio
            $(document).ready(function(){
                $('#button_compra_dia').click(function(){
                fecha=$('#fecha_dia').val();        
                ReporteCompraDia(fecha);
               });
            });
            //ENVIAMOS DATOS PARA QUE SE GUARDEN EN LA TABLA CONFIGURACION, PARA QUE LUEGO
            //SE USE EN LA CONSULTA PARA LA TABLA DE VENTAS DEL MES
            $(document).ready(function(){
                $('#button_compra_mes').click(function(){
                mes = $('#numero_mes').val();
                anio = $('#numero_anio').val();        
                ReporteCompraMes(mes,anio);
               });
            });
            //ENVIAMOS EL AÑO A LA TABLA CONFIGURACION
            $(document).ready(function(){
                $('#button_compra_anio').click(function(){
                numero=$('#numero_year').val();        
                ReporteCompraAnual(numero);
               });
            });

            //Calcula el precio de venta unitario Dado la cantidad y precio de compra EN el formualrio de EDICION DE COMPRA
            $(document).ready(function () {
                $("#u_subtotal").keyup(function () {
                    var cantidad = document.getElementById("u_cantidad").value;
                    var precio = $(this).val();
                    var resultado = (parseFloat(precio) / parseFloat(cantidad)).toFixed(2);
                    document.getElementById("u_punitario").value = resultado;
                });
            });
            //ACTUALIZAMOS DATOS DE LA COMPRA DEL PRODUCTO
            $('#update_compra').click(function(){
                ActualizarCompra();
            });


        </script>
    </body>
</html>