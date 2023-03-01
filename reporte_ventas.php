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
                                            <li class="breadcrumb-item active">Ventas</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">
                                        <a style="color:purple;" href="#" data-toggle="modal" data-target="#modal_crear_laboratorio" title="Registrar Proveedor">
                                            <i class="far fa-plus-square"></i>
                                        </a>Reporte de Ventas
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <!--========================================
                        =            Contenido Principal           =
                        =========================================-->
                        <div class="row">
                            <!--===========================================================================
                            =   MODAL PARA VER EL DETALLE DE TODAS LAS VENTAS DE UNA DETERMINADA FACTURA  =
                            ============================================================================-->
                            <div id="modal_detalle_factura" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">DETALLE DE VENTAS DE LA FACTURA Nº
                                                <span id="numero_factura">
                                                </span>
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row" id="tabla_factura_detalle">
                                            </div>
                                        </div>
                                        <!-- <div class="modal-footer"></div> -->
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            <!--===========================================================================
                            =   MODAL PARA ACTUALIZAR EL TIPO DE PAGO DE LA NOTA DE VENTA AL CONTADO      =
                            ============================================================================-->
                            <div id="modal_actualizar_pago" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">NOTA DE VENTA Nº
                                                <span id="numero_factura_credito">
                                                </span>
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="formulario_actualizar_pago">
                                            </div>
                                        </div>
                                        <!-- <div class="modal-footer"></div> -->
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                            <div class="col-lg-12">
                                <div class="card-box">
                                    <!-- <h4 class="header-title mb-4">Default Tabs</h4> -->
                                    <ul class="nav nav-tabs navtab-bg nav-justified">
                                        <li class="nav-item">
                                            <a href="#dia" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                                Ventas Diarias
                                            </a>
                                        </li>
                                        <li class="nav-item navtab-bg nav-justified">
                                            <a href="#semana" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                Ventas Semanales
                                            </a>
                                        </li>
                                        <li class="nav-item navtab-bg nav-justified">
                                            <a href="#mes" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                Ventas Mensuales
                                            </a>
                                        </li>
                                        <li class="nav-item navtab-bg nav-justified">
                                            <a href="#anio" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                Ventas Anuales
                                            </a>
                                        </li>
                                        <li class="nav-item navtab-bg nav-justified">
                                            <a href="#credito" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                Ventas al Crédito
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
                                                        <button type="button" class="btn btn-purple mb-2" id="button_dia">GENERAR REPORTE</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="card-box">
                                                <div class="row" id="tabla_dia">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane show" id="semana">
                                            <div class="alert alert-dark alert-dismissible fade bg-light text-dark show mb-0" role="alert">
                                                <h5 style="text-align:center;">
                                                    <?php
                                                        $year=date("Y"); //echo $year;
                                                        $month=date("m"); //echo $month;
                                                        $day=date("d"); //echo $day;

                                                        # Obtenemos el numero de la semana
                                                        $semana=date("W",mktime(0,0,0,$month,$day,$year));

                                                        # Obtenemos el día de la semana de la fecha dada
                                                        $diaSemana=date("w",mktime(0,0,0,$month,$day,$year));

                                                        # el 0 equivale al domingo...
                                                        if($diaSemana==0)
                                                            $diaSemana=7;

                                                        # A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes
                                                        $primerDia=date("d-m-Y",mktime(0,0,0,$month,$day-$diaSemana+1,$year));

                                                        # A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo
                                                        $ultimoDia=date("d-m-Y",mktime(0,0,0,$month,$day+(7-$diaSemana),$year));
                                                        echo "Semana: ".$semana." - Año: ".$year."<br/>"."Del : ".$primerDia."&nbsp;&nbsp;al : ".$ultimoDia;
                                                    ?>
                                                </h5>
                                            </div>
                                            <div class="card-box">
                                                <div class="row" id="tabla_semana"></div>
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
                                                        <button type="button" id="button_mes" class="btn btn-purple mb-2">GENERAR REPORTE</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- end row -->
                                            <div class="card-box">
                                                <div class="row" id="tabla_mes"></div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="anio">
                                            <div class="container">
                                                <div class="row justify-content-center">
                                                    <form class="form-inline">
                                                        <label class="mb-2 mr-sm-2">REPORTE DEL AÑO :</label>
                                                        <input type="number" class="form-control mb-2 mr-sm-2" id="numero_year" min="2018" step="1" value="<?php echo date("Y"); ?>">
                                                        <button type="button" id="button_anio" class="btn btn-purple mb-2">GENERAR REPORTE</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- end row -->
                                            <div class="card-box">
                                                <div class="row" id="tabla_anio"></div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="credito">
                                            <div class="container">
                                                <div class="row justify-content-center">
                                                    <form class="form-inline">
                                                        <label class="mb-2 mr-sm-2">VENTAS AL CRÉDITO DEL AÑO :</label>
                                                        <input type="number" class="form-control mb-2 mr-sm-2" id="numero_year_credito" min="2018" step="1" value="<?php echo date("Y"); ?>">
                                                        <button type="button" id="button_credito" class="btn btn-purple mb-2">GENERAR REPORTE</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- end row -->
                                            <div class="card-box">
                                                <div class="row" id="tabla_credito"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card-box-->
                            </div>


                            <!--======================================================================
                            =   MODAL PARA VER EL DETALLE DE TODAS LAS VENTAS DE UN DETERMINADO DIA  =
                            =======================================================================-->
                            <div id="modal_detalle_dia" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">DETALLE DE VENTAS DEL DIA :
                                                <span id="literal_dia_detalle">
                                                </span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row" id="tabla_dia_detalle">

                                            </div>
                                        </div>
                                        <!-- <div class="modal-footer"></div> -->
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
            function ReporteDia(fecha){
              cadena="date=" + fecha;
                //alert(cadena);
                $.ajax({
                  type:"POST",
                  url:"assets/inc/update_dia.php",
                  data:cadena,
                  success:function(){
                    $('#tabla_dia').load('salesreport_dia.php');
                  }
                });
            }
            function ReporteMes(mes,anio){
              cadena="mes=" + mes + "&anio=" + anio;
                //alert(cadena);
                $.ajax({
                  type:"POST",
                  url:"assets/inc/update_mes.php",
                  data:cadena,
                  success:function(){//r puede ser 1 o 0, es uno si la eliminacion fue exitosa, y 0 si fallo.
                    $('#tabla_mes').load('salesreport_mes.php');
                  }//Fin success
                });//fin ajax
            }
            function ReporteAnual(numero){
              cadena="anio=" + numero;
                //alert(cadena);
                $.ajax({
                  type:"POST",
                  url:"assets/inc/update_anio.php",
                  data:cadena,
                  success:function(){//r puede ser 1 o 0, es uno si la eliminacion fue exitosa, y 0 si fallo.
                    $('#tabla_anio').load('salesreport_anio.php');
                  }//Fin success
                });//fin ajax
            }
            function ReporteCredito(numero){
              cadena="anio=" + numero;
                //alert(cadena);
                $.ajax({
                  type:"POST",
                  url:"assets/inc/update_anio.php",
                  data:cadena,
                  success:function(){//r puede ser 1 o 0, es uno si la eliminacion fue exitosa, y 0 si fallo.
                    $('#tabla_credito').load('salesreport_credito.php');
                  }//Fin success
                });//fin ajax
            }
            function VerDetalle(numero){
              cadena="id="+numero;
              //alert(cadena);
              $.ajax({
                type:"POST",
                url:"inc/actualizarNumeroDetalle.php",
                data:cadena,
                success:function(r){
                  if(r==1){
                    $('#tdetalle').load('tablaDetalleModal.php');
                  }//Fin if
                }//Fin success
              });//fin ajax

            }
            function VerDetalleVentaDia(fecha){
              cadena="date="+fecha;
              //alert(cadena);
              $.ajax({
                type:"POST",
                url:"assets/inc/update_dia.php",
                data:cadena,
                success:function(r){
                  if(r==1){
                    $('#literal_dia_detalle').load('literal_dia_detalle.php');
                    $('#tabla_dia_detalle').load('salesreport_dia_detalle.php');
                  }//Fin if
                }//Fin success
              });//fin ajax
            }
            function PedidoProducto(cantidad){
              cadena="cantidad=" + cantidad;
                //alert(cadena);
                $.ajax({
                  type:"POST",
                  url:"assets/inc/update_eoq.php",
                  data:cadena,
                  success:function(){
                    $('#tabla_pedido').load('order_producto_tabla.php');
                  }
                });
            }
            //1. COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO INMEDIATAMENTE DESPUES DE ABRIR LA PAGINA pos.php
            //$('#producto').focus();
            //CARGAMOS LA TABLA DETALLE DE COMPRA en el DIV con id=tabla_detalle
            $(document).ready(function() {
                $('#tabla_dia').load('salesreport_dia.php');
                $('#tabla_semana').load('salesreport_semana.php');
                $('#tabla_mes').load('salesreport_mes.php');
                $('#tabla_anio').load('salesreport_anio.php');
                $('#tabla_credito').load('salesreport_credito.php');
                //$('#literal_dia_detalle').load('literal_dia_detalle.php');

                //CUANDO DAMOS CLICK EN EL BOTON PARA GENERAR INFORME POR DIA SEMANA MES Y AÑO
                //LOS BOTONES TIENEN IDs, dia, semana, mes, anio
                $('#button_dia').click(function(){
                    fecha=$('#fecha_dia').val();
                    ReporteDia(fecha);
                });
                //ENVIAMOS DATOS PARA QUE SE GUARDEN EN LA TABLA CONFIGURACION, PARA QUE LUEGO
                //SE USE EN LA CONSULTA PARA LA TABLA DE VENTAS DEL MES
                $('#button_mes').click(function(){
                    mes = $('#numero_mes').val();
                    anio = $('#numero_anio').val();
                    ReporteMes(mes,anio);
                });
                //ENVIAMOS EL AÑO A LA TABLA CONFIGURACION
                $('#button_anio').click(function(){
                    numero=$('#numero_year').val();
                    ReporteAnual(numero);
                });
                //ENVIAMOS EL AÑO A LA TABLA CONFIGURACION
                $('#button_credito').click(function(){
                    numero=$('#numero_year_credito').val();
                    ReporteCredito(numero);
                });
                //MUESTRA EL DETALLE DE PRODUCTOS DE LAS NOTAS DE VENTA POR PAGAR
                $(document).on("click", ".btnDetalleFactura", function() {
                    /*RECIBE COMO DATOS EL ID DE LA FACTURA, EL ID SE ACTUALIZA EN LA
                    TABLA CONFIGURACION, LUEGO SE MUESTRA EL RESULTADO DE LA CONSULTA
                    PARA ESE ID DE FACTURA, EN EL DIV ---> #tabla_factura_detalle */
                    cadena = "fac_id=" + $(this).closest('tr').find('td:eq(0)').text();
                    document.getElementById("numero_factura").innerHTML = $(this).closest('tr').find('td:eq(0)').text();
                    //alert(cadena);
                    //return false;
                    $.ajax({
                        type: "POST",
                        url: "assets/inc/update_numero_detalle.php",
                        data: cadena,
                        success: function(r) {
                            if (r == 1) {
                                $('#tabla_factura_detalle').load('tabla_detalle_modal.php');
                            }
                        }
                    });
                });
                //MUESTRA EL FORMULARIO PARA ACTUALIZAR EL TIPO DE PAGO
                $(document).on("click", ".btnActualizarPago", function() {
                    /*RECIBE COMO DATOS EL ID DE LA FACTURA, EL ID SE ACTUALIZA EN LA
                    TABLA CONFIGURACION, LUEGO SE MUESTRA EL RESULTADO DE LA CONSULTA
                    PARA ESE ID DE FACTURA, EN EL DIV ---> #tabla_factura_detalle */
                    cadena = "fac_id=" + $(this).closest('tr').find('td:eq(0)').text();
                    document.getElementById("numero_factura_credito").innerHTML = $(this).closest('tr').find('td:eq(0)').text();
                    //alert(cadena); return false;
                    $.ajax({
                        type: "POST",
                        url: "assets/inc/update_numero_detalle.php",
                        data: cadena,
                        success: function(r) {
                            if (r == 1) {
                                $('#formulario_actualizar_pago').load('formulario_actualizar_pago.php');
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>