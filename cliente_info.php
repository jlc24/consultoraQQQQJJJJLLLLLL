<?php
include("assets/inc/conexion.php");

session_start();
if (!isset($_SESSION['ci_nit'])) {
	header('Location: login_client.php');
}

$cli_ci_nit = $_SESSION['ci_nit'];
$sql0 = "SELECT * FROM cliente WHERE cli_ci_nit = '$cli_ci_nit'";
$resultado = $conexion->query($sql0);
$row = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include 'assets/inc/head.php'; ?>
    </head>
    <body data-layout="horizontal">
        <!-- Begin page -->
        <div id="wrapper">
            <!-- Topbar Start -->
            <!-- end Topbar -->
            <!-- ========== Left Sidebar Start ========== -->
                <!-- Topbar Start -->
                <div class="navbar-custom" style="background-color: #ffffff;">
                    <div class="container-fluid">
                        <ul class="list-unstyled topnav-menu float-right mb-0">
                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="assets/images/users/avatar-1.png" alt="user-image" class="rounded-circle">
                                    <span class="pro-user-name ml-1">
                                        <?php echo utf8_decode($row['cli_nombre']); ?> <i class="mdi mdi-chevron-down"></i>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <div class="dropdown-header noti-title">
                                        <h6 class="text-overflow m-0">Bienvenid@ !</h6>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <!-- item-->
                                    <a href="salir_client.php" class="dropdown-item notify-item">
                                        <i class="fe-log-out"></i>
                                        <span>Cerrar sesión</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <!-- LOGO -->
                        <div class="logo-box">
                            <a class="logo text-center logo-dark">
                                <span class="logo-lg">
                                    <img src="assets/images/logo-dark.png" alt="" height="50">
                                    <!-- <span class="logo-lg-text-dark">Adminox</span> -->
                                </span>
                                <span class="logo-sm">
                                    <!-- <span class="logo-lg-text-dark">A</span> -->
                                    <img src="assets/images/logo-sm.png" alt="" height="24">
                                </span>
                            </a>
                        </div>
                        
                    </div>
                </div>
                <!-- end Topbar -->
            
            <!-- End Navigation Bar-->
            <!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <div class="content-page" style="margin: 0px;padding-top: 90px;">
                <div class="content">
                    <!-- Start Content-->
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row text-center">
                            <div class="col-12">
                                <div class="page-title-box p-0">
                                    <div class="page-title-box p-0">
                                        <h1 class="page-title" style="font-size: 30px;">
                                            QJLWeb 1.0
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="row text-center" style="border-style: solid; border-width: 1px; border-color: #F48A1D;">
                            <div class="col-12" style="margin: 0px auto; background-color: #F48A1D; padding-left: 10px; border-left: 6px solid #E91C2B; border-color: #E91C2B;">
                                <h5 style="color: #ffffff; padding: 0px; margin: opx; font-size: 15px; text-align: left;">Consulta de Procesos</h5> 
                            </div>
                            <br>
                            <div class="col-11" style="margin: 0px auto;">
                                <h5 style="margin-left: 20px; text-align: left;">»  Nombre: <?php echo $row['cli_nombre']; ?> | C.I.: <?php echo $row['cli_ci_nit']; ?></h5>
                            </div>
                            <br>
                            <div class="col-10" style="margin: 0px auto;">
                                <table class="table table-sm border table-responsive-lg" style="border-style: solid; border-width: 5px; border-color: #F7B168; font-size: 12px; text-align: left;">
                                    <thead style="text-align: center;">
                                        <tr style="background-color: #F7B168; color: #ffffff;">
                                            <th scope="col" width="30px" hidden>ID</th>
                                            <th scope="col" width="30px"></th>
                                            <th scope="col" width="100px">Nº Trámite</th>
                                            <th scope="col" width="150px">Nombre Proceso</th>
                                            <th scope="col" width="150px">Contra</th>
                                            <th scope="col" width="100px">Materia</th>
                                            <th scope="col" width="200px">Tipo Proceso</th>
                                            <th scope="col" width="100px">Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody style="border-style: solid; border-width: 1px; border-color: #F7B168;">
                                        <?php
                                            //OBTENEMOS EL ID DEL PRODUCTO, DE LA TABLA CONFIGURACION
                                            $sql2="SELECT * FROM hoja WHERE cli_id = '".$row['cli_id']."';";
                                            $res=mysqli_query($conexion,$sql2);
                                            while($reg = mysqli_fetch_assoc($res)){
                                                if ($reg['hoja_patrocinio'] == 'DEMANDANTE' || $reg['hoja_patrocinio'] == 'VICTIMA' || $reg['hoja_patrocinio'] == 'RECURRENTE' || $reg['hoja_patrocinio'] == 'ADMINISTRADO' || $reg['hoja_patrocinio'] == 'DENUNCIANTE'){
                                                    $cliente = $reg["hoja_demandado"];
                                                }else {
                                                    $cliente = $reg["hoja_demandante"];
                                                }
                                        ?>
                                            <tr>
                                                <td hidden><?php echo $reg['hoja_id']; ?></td>
                                                <td>
                                                    <a style="color:black;" href="javascript:void(0);" class='btnVerDetalleAccionCliente' title="Ver detalle">
                                                        <i style="color: #F7B168; --darkreader-inline-color:#230443; font-size:20px;" class="far fa-eye"></i>
                                                    </a>
                                                </td>
                                                <td><?php echo $reg['hoja_numero_tramite']; ?></td>
                                                <td><?php echo $reg['hoja_tipo_proceso'] ?></td>
                                                <td><?php echo $cliente; ?></td>
                                                <td><?php echo $reg['hoja_area_proceso']; ?></td>
                                                <td><?php echo $reg['hoja_referencia']; ?></td>
                                                <td><?php echo $reg['hoja_etapa']; ?></td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div class="col-9" style="margin: 0px auto;" id="detalle_accion">
                                
                            </div>
                        </div>
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
        <!--=============================  CLIENTES  =============================-->
        <script>
            $(document).on("click", ".btnVerDetalleAccionCliente", function() {
                cadena = "hoja_id=" + $(this).closest('tr').find('td:eq(0)').text();
                //alert(cadena); return false;
                //https://jsonformatter.org/jsbeautifier
                $.ajax({
                    type: "POST",
                    url: "assets/inc/update_hoja_id.php",
                    data: cadena,
                    success: function(r) {
                            if(r) {
                                $('#detalle_accion').load('detalle_accion_cliente.php');
                            }
                        }
                });
            });
        </script>
    </body>
</html>