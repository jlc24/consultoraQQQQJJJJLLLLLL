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
<html lang="en">
    <head>
        <?php include 'assets/inc/head.php'; ?>
    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <?php include 'assets/inc/topbar_ventas.php'; ?>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <?php include 'assets/inc/left_sidebar_ventas.php'; ?>
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Panel de Control</a></li>
                                            <li class="breadcrumb-item active">Indicadores</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Panel de Control</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <!--========================================
                        =            Contenido Principal           =
                        =========================================-->
                        <div class="row">
                            <!-- INFORMACION INGRESOS -->
                            <div class="col-xl-3 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <div class="media">
                                        <div class="avatar-lg bg-icon rounded-circle align-self-center">
                                            <img class="avatar-md" src="assets/images/icons/cash-register.svg" title="cash-register.svg">
                                        </div>

                                        <div class="wigdet-two-content media-body">
                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Ingresos Bs.</p>
                                            <h3 class="font-weight-medium my-2">
                                                <span data-plugin="counterup">
                                                    <?php
                                                    $filas = mysqli_fetch_row(mysqli_query($conexion,"SELECT SUM(fac_total) FROM factura"));
                                                    echo number_format($filas[0]); ?>
                                                </span>
                                            </h3>
                                            <p class="m-0">Ene - Dic <?php echo date("Y"); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                            <!-- INFORMACION CLIENTES -->
                            <div class="col-xl-3 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom ">
                                    <div class="media">
                                        <div class="avatar-lg bg-icon rounded-circle align-self-center">
                                            <img class="avatar-md" src="assets/images/icons/client.svg" title="client.svg">
                                        </div>

                                        <div class="wigdet-two-content media-body">
                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Clientes</p>
                                            <h3 class="font-weight-medium my-2">
                                                <span data-plugin="counterup">
                                                    <?php $sql="SELECT COUNT(*) FROM cliente";
                                                    $resultado = mysqli_query($conexion,$sql);
                                                    $filas = mysqli_fetch_row($resultado);
                                                    $total = (int)$filas[0]; echo $total;?>
                                                </span>
                                            </h3>
                                            <p class="m-0">Ene - Dic <?php echo date("Y"); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                            <!-- INFORMACION VENTAS -->
                            <div class="col-xl-3 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom ">
                                    <div class="media">
                                        <div class="avatar-lg bg-icon rounded-circle align-self-center">
                                            <img class="avatar-md" src="assets/images/icons/cart.svg" title="cart.svg">
                                        </div>

                                        <div class="wigdet-two-content media-body">
                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Ventas</p>
                                            <h3 class="font-weight-medium my-2">
                                                <span data-plugin="counterup">
                                                    <?php $sql="SELECT COUNT(*) FROM factura";
                                                    $resultado = mysqli_query($conexion,$sql);
                                                    $filas = mysqli_fetch_row($resultado);
                                                    echo number_format($filas[0]);?>
                                                </span>
                                            </h3>
                                            <p class="m-0">Ene - Dic <?php echo date("Y"); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                            <!-- INFORMACION PROVEEDORES -->
                            <div class="col-xl-3 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom ">
                                    <div class="media">
                                        <div class="avatar-lg bg-icon rounded-circle align-self-center">
                                            <img class="avatar-md" src="assets/images/icons/provider.svg" title="provider.svg">
                                        </div>

                                        <div class="wigdet-two-content media-body">
                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Proveedores</p>
                                            <h3 class="font-weight-medium my-2">
                                                <span data-plugin="counterup">
                                                    <?php $sql="SELECT COUNT(*) FROM laboratorio";
                                                    $resultado = mysqli_query($conexion,$sql);
                                                    $filas = mysqli_fetch_row($resultado);
                                                    $total = (int)$filas[0]; echo $total;?>
                                                </span>
                                            </h3>
                                            <p class="m-0">Ene - Dic <?php echo date("Y"); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card-box">
                                    <!--<h4 class="header-title">Caducidad</h4>
                                    <p class="sub-header">
                                        Ordenado ascendentemente por fecha de vencimiento.
                                    </p>-->
                                    <ul class="nav nav-tabs nav-justified">
                                        <li class="nav-item">
                                            <a href="#caducidad" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                                <span class="d-block d-sm-none">Por Caducar</i></span>
                                                <span class="d-none d-sm-block">POR CADUCAR</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#caducidad1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                <span class="d-block d-sm-none">Cadudados</i></span>
                                                <span class="d-none d-sm-block">CADUCADOS</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="caducidad">
                                            <!--<p class="sub-header">Ordenado descendentemente por número de venta.</p>-->
                                            <div class="table-responsive">
                                                <table id="vencimientoResumen" class="table mb-0 table-sm table-striped table-bordered dt-responsive" width="100%">
                                                    <thead>
                                                        <th data-priority="1">Nombre Comercial</th>
                                                        <th data-priority="5">Forma</th>
                                                        <th data-priority="4">Laboratorio</th>
                                                        <th data-priority="2">Caducidad</th>
                                                        <th data-priority="3">Dias</th>
                                                        <th data-priority="6">Stock</th>
                                                    </thead>
                                                    <!-- aqui va el contenido del serverside -->
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="caducidad1">
                                            <!--<p class="sub-header">Ordenado descendentemente por número de venta.</p>-->
                                            <div class="table-responsive">
                                                <table id="caducadoResumen" class="table mb-0 table-sm table-striped table-bordered dt-responsive" width="100%">
                                                    <thead>
                                                        <th data-priority="1">Nombre Comercial</th>
                                                        <th data-priority="5">Forma</th>
                                                        <th data-priority="4">Laboratorio</th>
                                                        <th data-priority="2">Caducidad</th>
                                                        <th data-priority="3">Días</th>
                                                        <th data-priority="6">Stock</th>
                                                    </thead>
                                                    <!-- aqui va el contenido del serverside -->
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- end col -->
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
        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=factura-->
        <script type="text/javascript">

            $(document).ready(function (){
                $('#vencimientoResumen').dataTable({
                    responsive: true,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "serverside_caducidad.php",
                    "lengthMenu":[5,10,20,30,50],
                    "order": [[ 4,"asc" ]],//ORDERNAR ASCENDENTEMENTE POR EL NUMERO DE DIAS
                    "language": {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                });
                $('#caducadoResumen').dataTable({
                    responsive: true,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "serverside_caducado.php",
                    "lengthMenu":[5,10,20,30,50],
                    "order": [[ 4,"desc" ]],//ORDERNAR DESCENDENTEMENTE POR EL NUMERO DE DIAS
                    "language": {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                });
                $('#facturaResumen').dataTable({
                    responsive: true,
                    columnDefs: [{
                        "targets": -1,
                        "defaultContent": "<a style='color:black;' href='#' data-toggle='modal' data-target='#ModalDetalleFactura' onclick='VerDetalle('')'><i class='far fa-eye fa-lg'></i></a>&nbsp;<a style='color:black;' href='#' data-toggle='modal' data-target='#ModalNotaVenta' onclick='VerDetalle('')'><i class='fas fa-print fa-lg'></i></a>"
                    }],
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "serverside_factura.php",
                    "lengthMenu":[10,20,30,50],
                    "order": [[ 0,"desc" ]],//ORDERNAR ASCENDENTEMENTE POR EL NUMERO DE DIAS
                    "language": {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                });
            });

        </script>

    </body>
</html>