<?php
include("assets/inc/conexion.php");
session_start();
if (!isset($_SESSION['adm_id'])) {
    header('Location: login.php');
}
function fechaletra($fecha){
    $day = date('d',strtotime($fecha));
    $month = date('m',strtotime($fecha));
    $year = date('Y',strtotime($fecha));
    $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    $letra = $day.' de '.$meses[$month - 1].' de '.$year;
    return $letra;
}
$adm_id = $_SESSION['adm_id'];
$sql = "SELECT adm_id, adm_nombre, adm_rol, area_id FROM administrador WHERE adm_id = '$adm_id'";
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
                    <?php 
                        $sql1 = "SELECT adm_id, adm_nombre, area_id FROM administrador WHERE adm_id = '$adm_id'";
                        $resultado1 = $conexion->query($sql1);
                        $row1 = $resultado1->fetch_assoc(); 
                    ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    
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
                        <!-- end col -->
                        <div class="col-xl-3 col-sm-6">
                            <div class="card-box widget-box-two widget-two-custom ">
                                <div class="media">
                                    <div class="avatar-lg bg-icon rounded-circle align-self-center">
                                        <img class="avatar-md" src="assets/images/icons/businessman.svg" title="businessman.svg">
                                    </div>
                                    <div class="wigdet-two-content media-body">
                                        <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Clientes</p>
                                        <h3 class="font-weight-medium my-2">
                                            <span data-plugin="counterup">
                                                <?php $sql = "SELECT COUNT(*) FROM cliente";
                                                $resultado = mysqli_query($conexion, $sql);
                                                $filas = mysqli_fetch_row($resultado);
                                                $total = (int)$filas[0];
                                                echo $total; ?>
                                            </span>
                                        </h3>
                                        <p class="m-0">Ene - Dic <?php echo date("Y"); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-box widget-box-two widget-two-custom ">
                                <div class="media">
                                    <div class="avatar-lg bg-icon rounded-circle align-self-center">
                                        <img class="avatar-md" src="assets/images/icons/contacts.svg" title="contacts.svg">
                                    </div>
                                    <div class="wigdet-two-content media-body">
                                        <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Hojas de Ruta</p>
                                        <h3 class="font-weight-medium my-2">
                                            <span data-plugin="counterup">
                                                <?php $sql = "SELECT COUNT(*) FROM hoja";
                                                $resultado = mysqli_query($conexion, $sql);
                                                $filas = mysqli_fetch_row($resultado);
                                                echo number_format($filas[0]); ?>
                                            </span>
                                        </h3>
                                        <p class="m-0">Ene - Dic <?php echo date("Y"); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->

                        <!-- end col -->
                        <div class="col-xl-4 col-sm-6">
                            <div class="card-box widget-box-two widget-two-custom">
                                <div class="datepicker">

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-sm-6">
                            <div class="card-box widget-box-two widget-two-custom ">
                                <div class="media">
                                    <div class="avatar-lg bg-icon rounded-circle align-self-center">
                                        <img class="avatar-md" src="assets/images/icon_png/audiencia.png" title="customer_support.svg">
                                    </div>
                                    <div class="wigdet-two-content media-body">
                                        <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Audiencias : <?php echo fechaletra(date('Y-m-d')); ?></p>
                                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php 
                                                $hoyver = date('Y-m-d');
                                                $hoy = date('Y-m-d', strtotime($hoyver."+ 1 days"));
                                                $manana = date('Y-m-d', strtotime($hoy."+ 1 days"));
                                                $sql = "SELECT det_id, hoja.hoja_id, hoja_numero_tramite, det_observacion, det_lugar_juzgado, det_juzgado, det_audiencia FROM hoja,hoja_detalle WHERE hoja.hoja_id = hoja_detalle.hoja_id AND det_audiencia BETWEEN '".$hoy."' AND '".$manana."';";
                                                $cont = 0;
                                                $resultado = mysqli_query($conexion, $sql); 
                                                if (!empty($resultado)) { 
                                                    while($a = mysqli_fetch_assoc($resultado)){
                                                        if ($cont == 0) { ?>
                                                            <div class="carousel-item active">
                                                                <h3><?php echo $a['hoja_numero_tramite']; ?></h3>
                                                                <h5><?php echo $a['det_lugar_juzgado']." | ".$a['det_juzgado']." | ".(date('H:i', strtotime($a['det_audiencia']))); ?></h5>
                                                            </div>
                                                        <?php
                                                        }else { ?>
                                                            <div class="carousel-item">
                                                                <h3><?php echo $a['hoja_numero_tramite']; ?></h3>
                                                                <h5><?php echo $a['det_lugar_juzgado']." | ".$a['det_juzgado']." | ".(date('H:i', strtotime($a['det_audiencia']))); ?></h5>
                                                            </div>
                                                        <?php
                                                        }
                                                        $cont++;
                                                    }
                                                }else { ?>
                                                    <h3>Sin Audiencias</h3>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-box widget-box-two widget-two-custom ">
                                <div class="media">
                                    <div class="avatar-lg bg-icon rounded-circle align-self-center">
                                        <img class="avatar-md" src="assets/images/icons/calendar.svg" title="calendar.svg">
                                    </div>
                                    <div class="wigdet-two-content media-body">
                                        <?php 
                                            $month = date('m',strtotime(date('Y-m-d')));
                                            $mes = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                                            $let = $mes[$month - 1];?>
                                        <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Proxima Audiencia : <strong> <?php echo $let; ?></strong></p>
                                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php 
                                                $hoyver = date('Y-m-d');
                                                $hoy = date('Y-m-d', strtotime($hoyver."+ 2 days"));
                                                $manana = date('Y-m-d', strtotime($hoy."+ 30 days"));
                                                $sql = "SELECT det_id, hoja.hoja_id, hoja_numero_tramite, det_observacion, det_lugar_juzgado, det_juzgado, det_audiencia FROM hoja,hoja_detalle WHERE hoja.hoja_id = hoja_detalle.hoja_id AND det_audiencia BETWEEN '".$hoy."' AND '".$manana."';";
                                                $cont = 0;
                                                $resultado = mysqli_query($conexion, $sql); 
                                                if (!empty($resultado)) { 
                                                    while($a = mysqli_fetch_assoc($resultado)){
                                                        if ($cont == 0) { ?>
                                                            <div class="carousel-item active">
                                                                <h3><?php echo $a['hoja_numero_tramite']; ?></h3>
                                                                <h5><?php echo $a['det_lugar_juzgado']." | ".$a['det_juzgado']." | ".(date('d-m', strtotime($a['det_audiencia']))); ?></h5>
                                                            </div>
                                                        <?php
                                                        }else{ ?>
                                                            <div class="carousel-item">
                                                                <h3><?php echo $a['hoja_numero_tramite']; ?></h3>
                                                                <h5><?php echo $a['det_lugar_juzgado']." | ".$a['det_juzgado']." | ".(date('d-m', strtotime($a['det_audiencia']))); ?></h5>
                                                            </div>
                                                        <?php
                                                        }
                                                        $cont++;
                                                    }
                                                }else{ ?>
                                                    <h3>Sin Audiencias</h3>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php 
                            if ($adm_id == '1' || $adm_id == '9') { ?>
                                <div class="col-12">
                                    <div class="card-box widget-box-two widget-two-custom p-2">
                                        <div class="row">
                                            <div class="widget-two-content media-body col-xl-1" style="text-align: left; display: inline-block; padding-right: 0px;">
                                                <span><i class="fas fa-balance-scale fa-2x"></i></span>
                                            </div>
                                            <div class="widget-two-content media-body col-xl-3" style="text-align: left; display: inline-block; padding-left: 0px;">
                                                <span class="m-0  font-weight-medium text-truncate" style="font-size: 20px;"> ÁREA JURÍDICA </span>
                                            </div>
                                            <div id="alarma_notificaciones" class="wigdet-two-content media-body col-xl-2" style=" padding-top: 5px; display: inline-block; text-align: left; margin-left: 0px; padding-left: 0px;">
                                                
                                            </div>
                                            <div class="wigdet-two-content media-body col-xl-2" style="padding-top: 5px; display: inline-block; text-align: left;">
                                                <span class="m-0  font-weight-medium text-truncate" style="font-size: 15px;">Audiencias </span>
                                                <?php
                                                    $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_audiencia >= NOW() AND det_estado = 'EJECUCION';";
                                                    $resultado = mysqli_query($conexion, $sql);
                                                    $filas = mysqli_fetch_row($resultado);
                                                    $total = (int)$filas[0];
                                                    if ($total != '0') { ?>
                                                        <span class="badge badge-success" data-plugin="counterup" style="font-size: 15px;">
                                                            <?php echo $total; ?>
                                                        </span>
                                                    <?php   
                                                    }
                                                    ?>
                                            </div>
                                            <div class="wigdet-two-content media-body col-xl-2" style="padding-top: 5px; display: inline-block; text-align: left; margin-left: 0px; padding-left: 0px;">
                                                <span class="m-0  font-weight-medium text-truncate" style="font-size: 15px;">Incumplidas </span>
                                                <span class="badge badge-danger" data-plugin="counterup" style="font-size: 15px;" id="alarma_tincumplidas">
                                                    
                                                </span>
                                            </div>
                                            <div class="wigdet-two-content media-body col-xl-2" style="padding-top: 2px;">
                                                <span>
                                                    <button type="button" class="btn btn-outline-info btn-sm" data-toggle="collapse" data-target="#juridico">Ver</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="juridico" class="row collapse in">
                                        <div class="col-xl-6 col-sm-16">
                                            <div class="card-box widget-box-two widget-two-custom " style="height: 300px;">
                                                <div class="media">
                                                    <div class="wigdet-two-content media-body" style="text-align: left;">
                                                        <span class="m-0  font-weight-medium text-truncate" title="Statistics">Notificaciones</span>
                                                    </div>
                                                </div><br>
                                                <div style="width: 483px; height: 35px; margin: 0px; padding: 0px;">
                                                    <table class="table table-sm table-striped table-responsive-sm" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #E67E22;">
                                                        <thead style="background-color: #E67E22; color: #fff; text-align: center;">
                                                            <th hidden>ID</th>
                                                            <th width="80px">Tramite</th>
                                                            <th width="100px">Proceso</th>
                                                            <th width="70px">Area</th>
                                                            <th width="100px">Accion</th>
                                                            <th width="50px">Op</th>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <div id="notificaciones_table" style="width: 500px; height: 160px; overflow-y: scroll; margin: 0px; padding: 0px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-16">
                                            <div class="card-box widget-box-two widget-two-custom ">
                                                <div class="media">
                                                    <div class="wigdet-two-content media-body" style="text-align: left;">
                                                        <span class="m-0  font-weight-medium text-truncate" title="Statistics">Audiencias</span>
                                                    </div>
                                                    
                                                </div><br>
                                                <div style="width: 483px; height: 35px; margin: 0px; padding: 0px;">
                                                    <table class="table table-sm table-striped table-responsive-sm" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #32C861;">
                                                        <thead style="background-color: #32C861; color: #fff; text-align: center;">
                                                            <th hidden>ID</th>
                                                            <th width="50px">Tramite</th>
                                                            <th width="130px">Audiencia</th>
                                                            <th width="100px">Fecha</th>
                                                            <th width="80px">Hora</th>
                                                            <th width="100px">Lugar</th>
                                                            <th width="80px">Op</th>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <div id="audiencia_table" style="width: 500px; height: 175px; overflow-y: scroll; margin: 0px; padding: 0px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-16">
                                            <div class="card-box widget-box-two widget-two-custom ">
                                                <div class="media">
                                                    <div class="wigdet-two-content media-body" style="text-align: left;">
                                                        <span class="m-0  font-weight-medium text-truncate" title="Statistics">Tareas Incumplidas</span>
                                                    </div>
                                                </div><br>
                                                <div style="width: 483px; height: 35px; margin: 0px; padding: 0px;">
                                                    <table class="table table-sm table-striped" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #F96A74;">
                                                        <thead style="background-color: #F96A74; color: #fff;">
                                                            <th hidden>ID</th>
                                                            <th width="100px">Tramite</th>
                                                            <th width="100px">Proceso</th>
                                                            <th width="100px">Encargado</th>
                                                            <th width="80px" style="text-align: center;">Op</th>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <div  id="tincumplidas_table" style="width: 500px; height: 175px; overflow-y: scroll; margin: 0px; padding: 0px;">

                                                </div>
                                            </div>
                                        </div>
                                    </div> <!--div Collapse -->
                                </div>
                                <div class="col-12">
                                    <div class="card-box widget-box-two widget-two-custom p-2">
                                        <div class="row">
                                            <div class="widget-two-content media-body col-xl-1" style="text-align: left; display: inline-block; padding-right: 0px;">
                                                <span><i class="fas fa-dollar-sign fa-2x"></i></span>
                                            </div>
                                            <div class="widget-two-content media-body col-xl-3" style="text-align: left; display: inline-block; padding-left: 0px;">
                                                <span class="m-0  font-weight-medium text-truncate" style="font-size: 20px;"> ÁREA CONTABLE </span>
                                            </div>
                                            
                                            <div class="wigdet-two-content media-body col-xl-2" style=" padding-top: 5px; display: inline-block; text-align: left; margin-left: 0px; padding-left: 0px;">
                                                <span class="m-0  font-weight-medium text-truncate" style="font-size: 15px;">Notificaciones</span>
                                                <span class="badge badge-warning" data-plugin="counterup" style="font-size: 15px;">
                                                        <?php
                                                    /*$sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                    $resultado = mysqli_query($conexion, $sql);
                                                    $filas = mysqli_fetch_row($resultado);
                                                    $total = (int)$filas[0];*/
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="wigdet-two-content media-body col-xl-2" style="padding-top: 5px; display: inline-block; text-align: left;">
                                                <span class="m-0  font-weight-medium text-truncate" style="font-size: 15px;">Audiencias </span>
                                                <span class="badge badge-warning" data-plugin="counterup" style="font-size: 15px;">
                                                        <?php
                                                    /*$sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                    $resultado = mysqli_query($conexion, $sql);
                                                    $filas = mysqli_fetch_row($resultado);
                                                    $total = (int)$filas[0];*/
                                                     ?>
                                                </span>
                                            </div>
                                            <div class="wigdet-two-content media-body col-xl-2" style="padding-top: 5px; display: inline-block; text-align: left; margin-left: 0px; padding-left: 0px;">
                                                <span class="m-0  font-weight-medium text-truncate" style="font-size: 15px;">Incumplidas </span>
                                                <span class="badge badge-warning" data-plugin="counterup" style="font-size: 15px;">
                                                        <?php
                                                    /*$sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                    $resultado = mysqli_query($conexion, $sql);
                                                    $filas = mysqli_fetch_row($resultado);
                                                    $total = (int)$filas[0];*/
                                                     ?>
                                                </span>
                                            </div>
                                            <div class="wigdet-two-content media-body col-xl-2" style="padding-top: 2px;">
                                                <span>
                                                    <button type="button" class="btn btn-outline-info btn-sm" data-toggle="collapse" data-target="#contable">Ver</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="contable" class="row collapse in">
                                        <div class="col-xl-6 col-sm-16">
                                            <div class="card-box widget-box-two widget-two-custom " style="height: 300px;">
                                                <div class="media">
                                                    <div class="wigdet-two-content media-body" style="text-align: left;">
                                                        <span class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Notificaciones</span>
                                                        
                                                    </div>
                                                    <div>
                                                        <span class="badge badge-warning" data-plugin="counterup" style="font-size: 15px;">
                                                                <?php
                                                            $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                            $resultado = mysqli_query($conexion, $sql);
                                                            $filas = mysqli_fetch_row($resultado);
                                                            $total = (int)$filas[0];
                                                             ?>
                                                        </span>
                                                    </div>
                                                </div><br>
                                                
                                                <div>
                                                    <table class="table table-sm table-striped" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #E67E22;">
                                                        <thead style="background-color: #E67E22; color: #fff;">
                                                            <th hidden>ID</th>
                                                            <th width="80px">Tramite</th>
                                                            <th width="100px">Proceso</th>
                                                            <th width="70px">Area</th>
                                                            <th width="100px">Accion</th>
                                                            <th width="50px">Op</th>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-16">
                                            <div class="card-box widget-box-two widget-two-custom ">
                                                <div class="media">
                                                    <div class="wigdet-two-content media-body" style="text-align: left;">
                                                        <span class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Tareas Incumplidas</span>
                                                    </div>
                                                    <div>
                                                        <span class="badge badge-danger" data-plugin="counterup" style="font-size: 15px;">
                                                                <?php
                                                            $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND NOW() > det_fin AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                            $resultado = mysqli_query($conexion, $sql);
                                                            $filas = mysqli_fetch_row($resultado);
                                                            $total = (int)$filas[0];
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div><br>
                                                <div style="width: 483px; height: 35px; margin: 0px; padding: 0px;">
                                                    <table class="table table-sm table-striped table-responsive-sm" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #F96A74;">
                                                        <thead style="background-color: #F96A74; color: #fff;">
                                                            <th hidden>ID</th>
                                                            <th width="100px">Tramite</th>
                                                            <th width="100px">Proceso</th>
                                                            <th width="100px">Encargado</th>
                                                            <th width="80px">Op</th>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <div style="width: 500px; height: 160px; overflow-y: scroll; margin: 0px; padding: 0px;">
                                                    <table class="table table-sm table-striped table-responsive-sm" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #F96A74;">
                                                        
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-16">
                                            <div class="card-box widget-box-two widget-two-custom ">
                                                <div class="media">
                                                    <div class="wigdet-two-content media-body" style="text-align: left;">
                                                        <span class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Tareas Incumplidas</span>
                                                    </div>
                                                    <div>
                                                        <span class="badge badge-danger" data-plugin="counterup" style="font-size: 15px;">
                                                                <?php
                                                            $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND NOW() > det_fin AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                            $resultado = mysqli_query($conexion, $sql);
                                                            $filas = mysqli_fetch_row($resultado);
                                                            $total = (int)$filas[0];
                                                             ?>
                                                        </span>
                                                    </div>
                                                </div><br>
                                                <div>
                                                    <table class="table table-sm table-striped" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #F96A74;">
                                                        <thead style="background-color: #F96A74; color: #fff;">
                                                            <th hidden>ID</th>
                                                            <th width="100px">Tramite</th>
                                                            <th width="100px">Proceso</th>
                                                            <th width="100px">Encargado</th>
                                                            <th width="80px">Op</th>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!--div Collapse -->
                                </div>
                                <div class="col-12">
                                    <div class="card-box widget-box-two widget-two-custom p-2">
                                        <div class="row">
                                            <div class="widget-two-content media-body col-xl-1" style="text-align: left; display: inline-block; padding-right: 0px;">
                                                <span><i class="fas fa-laptop-code fa-2x"></i></span>
                                            </div>
                                            <div class="widget-two-content media-body col-xl-3" style="text-align: left; display: inline-block; padding-left: 0px;">
                                                <span class="m-0 font-weight-medium text-truncate" style="font-size: 20px;"> ÁREA MARKETING </span>
                                            </div>
                                            <div class="wigdet-two-content media-body col-xl-2" style=" padding-top: 5px; display: inline-block; text-align: left; margin-left: 0px; padding-left: 0px;">
                                                <span class="m-0 font-weight-medium text-truncate" style="font-size: 15px;">Notificaciones </span>
                                                <span class="badge badge-warning" data-plugin="counterup" style="font-size: 15px;">
                                                        <?php
                                                    /*$sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                    $resultado = mysqli_query($conexion, $sql);
                                                    $filas = mysqli_fetch_row($resultado);
                                                    $total = (int)$filas[0];*/
                                                     ?>
                                                </span>
                                            </div>
                                            <div class="wigdet-two-content media-body col-xl-2" style="padding-top: 5px; display: inline-block; text-align: left;">
                                                <span class="m-0 font-weight-medium text-truncate" style="font-size: 15px;">Audiencias </span>
                                                <span class="badge badge-warning" data-plugin="counterup" style="font-size: 15px;">
                                                        <?php
                                                    /*$sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                    $resultado = mysqli_query($conexion, $sql);
                                                    $filas = mysqli_fetch_row($resultado);
                                                    $total = (int)$filas[0];*/
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="wigdet-two-content media-body col-xl-2" style="padding-top: 5px; display: inline-block; text-align: left; margin-left: 0px; padding-left: 0px;">
                                                <span class="m-0 font-weight-medium text-truncate" style="font-size: 15px;">Incumplidas </span>
                                                <span class="badge badge-warning" data-plugin="counterup" style="font-size: 15px;">
                                                        <?php
                                                    /*$sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                    $resultado = mysqli_query($conexion, $sql);
                                                    $filas = mysqli_fetch_row($resultado);
                                                    $total = (int)$filas[0];*/
                                                     ?>
                                                </span>
                                            </div>
                                            <div class="wigdet-two-content media-body col-xl-2" style="padding-top: 2px;">
                                                <span>
                                                    <button type="button" class="btn btn-outline-info btn-sm" data-toggle="collapse" data-target="#marketing">Ver</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="marketing" class="row collapse in">
                                        <div class="col-xl-6 col-sm-16">
                                            <div class="card-box widget-box-two widget-two-custom " style="height: 300px;">
                                                <div class="media">
                                                    <div class="wigdet-two-content media-body" style="text-align: left;">
                                                        <span class="m-0 font-weight-medium text-truncate" title="Statistics">Notificaciones</span>
                                                    </div>
                                                </div><br>
                                                <div>
                                                    <table class="table table-sm table-striped" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #E67E22;">
                                                        <thead style="background-color: #E67E22; color: #fff;">
                                                            <th hidden>ID</th>
                                                            <th width="80px">Tramite</th>
                                                            <th width="100px">Proceso</th>
                                                            <th width="70px">Area</th>
                                                            <th width="100px">Accion</th>
                                                            <th width="50px">Op</th>
                                                        </thead>
                                                    </table>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-16">
                                            <div class="card-box widget-box-two widget-two-custom ">
                                                <div class="media">
                                                    <div class="wigdet-two-content media-body" style="text-align: left;">
                                                        <span class="m-0 font-weight-medium text-truncate" title="Statistics">Tareas Incumplidas</span>
                                                    </div>
                                                    <div>
                                                        <span class="badge badge-danger" data-plugin="counterup" style="font-size: 15px;">
                                                                <?php
                                                            $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND NOW() > det_fin AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                            $resultado = mysqli_query($conexion, $sql);
                                                            $filas = mysqli_fetch_row($resultado);
                                                            $total = (int)$filas[0];
                                                             ?>
                                                        </span>
                                                    </div>
                                                </div><br>
                                                <div style="width: 483px; height: 35px; margin: 0px; padding: 0px;">
                                                    <table class="table table-sm table-striped table-responsive-sm" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #F96A74;">
                                                        <thead style="background-color: #F96A74; color: #fff;">
                                                            <th hidden>ID</th>
                                                            <th width="100px">Tramite</th>
                                                            <th width="100px">Proceso</th>
                                                            <th width="100px">Encargado</th>
                                                            <th width="80px">Op</th>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <div style="width: 500px; height: 160px; overflow-y: scroll; margin: 0px; padding: 0px;">
                                                    <table class="table table-sm table-striped table-responsive-sm" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #F96A74;">
                                                        
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-16">
                                            <div class="card-box widget-box-two widget-two-custom ">
                                                <div class="media">
                                                    <div class="wigdet-two-content media-body" style="text-align: left;">
                                                        <span class="m-0 font-weight-medium text-truncate" title="Statistics">Tareas Incumplidas</span>
                                                    </div>
                                                    <div>
                                                        <span class="badge badge-danger" data-plugin="counterup" style="font-size: 15px;">
                                                                <?php
                                                            $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND NOW() > det_fin AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                            $resultado = mysqli_query($conexion, $sql);
                                                            $filas = mysqli_fetch_row($resultado);
                                                            $total = (int)$filas[0];
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div><br>
                                                <div>
                                                    <table class="table table-sm table-striped" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #F96A74;">
                                                        <thead style="background-color: #F96A74; color: #fff;">
                                                            <th hidden>ID</th>
                                                            <th width="100px">Tramite</th>
                                                            <th width="100px">Proceso</th>
                                                            <th width="100px">Encargado</th>
                                                            <th width="80px">Op</th>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!--div Collapse -->
                                </div>
                        <?php
                            }elseif ($row['area_id'] == '1') { ?>
                                <div class="col-12">
                                    <div class="card-box widget-box-two widget-two-custom p-2">
                                        <div class="row">
                                            <div class="widget-two-content media-body col-xl-1" style="text-align: left; display: inline-block; padding-right: 0px;">
                                                <span><i class="fas fa-balance-scale fa-2x"></i></span>
                                            </div>
                                            <div class="widget-two-content media-body col-xl-3" style="text-align: left; display: inline-block; padding-left: 0px;">
                                                <span class="m-0 font-weight-medium text-truncate" style="font-size: 20px;"> ÁREA JURÍDICA </span>
                                            </div>
                                            <div id="alarma_notificaciones" class="wigdet-two-content media-body col-xl-2" style=" padding-top: 5px; display: inline-block; text-align: left; margin-left: 0px; padding-left: 0px;">
                                                
                                            </div>
                                            <div class="wigdet-two-content media-body col-xl-2" style="padding-top: 5px; display: inline-block; text-align: left;">
                                                <span class="m-0 font-weight-medium text-truncate" style="font-size: 15px;">Audiencias </span>
                                                <?php
                                                    $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_audiencia >= NOW() AND det_estado = 'EJECUCION';";
                                                    $resultado = mysqli_query($conexion, $sql);
                                                    $filas = mysqli_fetch_row($resultado);
                                                    $total = (int)$filas[0];
                                                    if ($total != '0') { ?>
                                                        <span class="badge badge-success" data-plugin="counterup" style="font-size: 15px;">
                                                            <?php echo $total; ?>
                                                        </span>
                                                    <?php   
                                                    }
                                                    ?>
                                            </div>
                                            <div class="wigdet-two-content media-body col-xl-2" style="padding-top: 5px; display: inline-block; text-align: left; margin-left: 0px; padding-left: 0px;">
                                                <span class="m-0 font-weight-medium text-truncate" style="font-size: 15px;">Incumplidas </span>
                                                <span class="badge badge-danger" data-plugin="counterup" style="font-size: 15px;" id="alarma_tincumplidas">
                                                    
                                                </span>
                                            </div>
                                            <div class="wigdet-two-content media-body col-xl-2" style="padding-top: 2px;">
                                                <span>
                                                    <button type="button" class="btn btn-info btn-sm" >Ver</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-xl-6 col-sm-16">
                                            <div class="card-box widget-box-two widget-two-custom " style="height: 300px;">
                                                <div class="media">
                                                    <div class="wigdet-two-content media-body" style="text-align: left;">
                                                        <span class="m-0 font-weight-medium text-truncate" title="Statistics">Notificaciones</span>
                                                    </div>
                                                </div><br>
                                                <div style="width: 483px; height: 35px; margin: 0px; padding: 0px;">
                                                    <table class="table table-sm table-striped table-responsive-sm" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #E67E22;">
                                                        <thead style="background-color: #E67E22; color: #fff; text-align: center;">
                                                            <th hidden>ID</th>
                                                            <th width="80px">Tramite</th>
                                                            <th width="100px">Proceso</th>
                                                            <th width="70px">Area</th>
                                                            <th width="100px">Accion</th>
                                                            <th width="50px">Op</th>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <div id="notificaciones_table" style="width: 500px; height: 160px; overflow-y: scroll; margin: 0px; padding: 0px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-16">
                                            <div class="card-box widget-box-two widget-two-custom ">
                                                <div class="media">
                                                    <div class="wigdet-two-content media-body" style="text-align: left;">
                                                        <span class="m-0 font-weight-medium text-truncate" title="Statistics">Audiencias</span>
                                                    </div>
                                                </div><br>
                                                <div style="width: 483px; height: 35px; margin: 0px; padding: 0px;">
                                                    <table class="table table-sm table-striped table-responsive-sm" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #32C861;">
                                                        <thead style="background-color: #32C861; color: #fff; text-align: center;">
                                                            <th hidden>ID</th>
                                                            <th width="50px">Tramite</th>
                                                            <th width="130px">Audiencia</th>
                                                            <th width="100px">Fecha</th>
                                                            <th width="80px">Hora</th>
                                                            <th width="100px">Lugar</th>
                                                            <th width="80px">Op</th>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <div id="audiencia_table" style="width: 500px; height: 175px; overflow-y: scroll; margin: 0px; padding: 0px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-16">
                                            <div class="card-box widget-box-two widget-two-custom ">
                                                <div class="media">
                                                    <div class="wigdet-two-content media-body" style="text-align: left;">
                                                        <span class="m-0 font-weight-medium text-truncate" title="Statistics">Tareas Incumplidas</span>
                                                    </div>
                                                </div><br>
                                                <div style="width: 483px; height: 35px; margin: 0px; padding: 0px;">
                                                    <table class="table table-sm table-striped" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #F96A74;">
                                                        <thead style="background-color: #F96A74; color: #fff;">
                                                            <th hidden>ID</th>
                                                            <th width="100px">Tramite</th>
                                                            <th width="100px">Proceso</th>
                                                            <th width="100px">Encargado</th>
                                                            <th width="80px" style="text-align: center;">Op</th>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <div  id="tincumplidas_table" style="width: 500px; height: 175px; overflow-y: scroll; margin: 0px; padding: 0px;">

                                                </div>
                                            </div>
                                        </div>
                                    </div> <!--div Collapse -->
                                </div>
                        <?php
                            }elseif ($row['area_id'] == '2') { ?>
                                <div class="col-12">
                                    <div class="card-box widget-box-two widget-two-custom p-2">
                                        <div class="row">
                                            <div class="widget-two-content media-body col-xl-1" style="text-align: left; display: inline-block; padding-right: 0px;">
                                                <span><i class="fas fa-dollar-sign fa-2x"></i></span>
                                            </div>
                                            <div class="widget-two-content media-body col-xl-3" style="text-align: left; display: inline-block; padding-left: 0px;">
                                                <span class="m-0 font-weight-medium text-truncate" style="font-size: 20px;"> ÁREA CONTABLE </span>
                                            </div>
                                            <div class="wigdet-two-content media-body col-xl-2" style=" padding-top: 5px; display: inline-block; text-align: left; margin-left: 0px; padding-left: 0px;">
                                                <span class="m-0 font-weight-medium text-truncate" style="font-size: 15px;">Notificaciones </span>
                                                <span class="badge badge-warning" data-plugin="counterup" style="font-size: 15px;">
                                                        <?php
                                                    $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                    $resultado = mysqli_query($conexion, $sql);
                                                    $filas = mysqli_fetch_row($resultado);
                                                    $total = (int)$filas[0];
                                                    echo $total; ?>
                                                </span>
                                            </div>
                                            <div class="wigdet-two-content media-body col-xl-2" style="padding-top: 5px; display: inline-block; text-align: left;">
                                                <span class="m-0 font-weight-medium text-truncate" style="font-size: 15px;">Audiencias </span>
                                                <span class="badge badge-warning" data-plugin="counterup" style="font-size: 15px;">
                                                        <?php
                                                    $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                    $resultado = mysqli_query($conexion, $sql);
                                                    $filas = mysqli_fetch_row($resultado);
                                                    $total = (int)$filas[0];
                                                    echo $total; ?>
                                                </span>
                                            </div>
                                            <div class="wigdet-two-content media-body col-xl-2" style="padding-top: 5px; display: inline-block; text-align: left; margin-left: 0px; padding-left: 0px;">
                                                <span class="m-0 font-weight-medium text-truncate" style="font-size: 15px;">Incumplidas </span>
                                                <span class="badge badge-warning" data-plugin="counterup" style="font-size: 15px;">
                                                        <?php
                                                    $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                    $resultado = mysqli_query($conexion, $sql);
                                                    $filas = mysqli_fetch_row($resultado);
                                                    $total = (int)$filas[0];
                                                    echo $total; ?>
                                                </span>
                                            </div>
                                            <div class="wigdet-two-content media-body col-xl-2" style="padding-top: 2px;">
                                                <span>
                                                    <button type="button" class="btn btn-outline-info btn-sm" data-toggle="collapse" data-target="#contable">Ver</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="contable" class="row collapse in">
                                        <div class="col-xl-6 col-sm-16">
                                            <div class="card-box widget-box-two widget-two-custom " style="height: 300px;">
                                                <div class="media">
                                                    <div class="wigdet-two-content media-body" style="text-align: left;">
                                                        <span class="m-0 font-weight-medium text-truncate" title="Statistics">Notificaciones</span>
                                                    </div>
                                                    <div>
                                                        <span class="badge badge-warning" data-plugin="counterup" style="font-size: 15px;">
                                                                <?php
                                                            $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                            $resultado = mysqli_query($conexion, $sql);
                                                            $filas = mysqli_fetch_row($resultado);
                                                            $total = (int)$filas[0];
                                                            echo $total; ?>
                                                        </span>
                                                    </div>
                                                </div><br>
                                                <div>
                                                    <table class="table table-sm table-striped" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #E67E22;">
                                                        <thead style="background-color: #E67E22; color: #fff;">
                                                            <th hidden>ID</th>
                                                            <th width="80px">Tramite</th>
                                                            <th width="100px">Proceso</th>
                                                            <th width="70px">Area</th>
                                                            <th width="100px">Accion</th>
                                                            <th width="50px">Op</th>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            $sql = "SELECT `det_id`,`hoja_numero_tramite`, `hoja_tipo_proceso`, hoja_area_proceso,`det_etapa`,`det_accion`,`det_observacion`, det_leido 
                                                                    FROM hoja_detalle JOIN hoja 
                                                                    WHERE hoja_detalle.hoja_id = hoja.hoja_id AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                            $resultado = mysqli_query($conexion, $sql);
                                                            while ($registro = mysqli_fetch_assoc($resultado))
                                                            {
                                                            ?>
                                                                <tr>
                                                                    <td hidden><?php echo $registro["det_id"]; ?></td>
                                                                    <td><?php echo $registro["hoja_numero_tramite"]; ?></td>
                                                                    <td><?php echo $registro["hoja_tipo_proceso"]; ?></td>
                                                                    <td><?php echo $registro["hoja_area_proceso"]; ?></td>
                                                                    <td>
                                                                        <?php echo $registro['det_observacion']; ?>
                                                                    </td>
                                                                    <td style="text-align: center;">
                                                                    <?php 
                                                                        if ($registro['det_leido'] == '0') { ?>
                                                                            <a style="color:black;" href="javascript:void(0);" class='btnVerEventoHojaFinalizado btnUpdateLeido' title="Ver Accion">
                                                                                <i style="color: #E67E22; --darkreader-inline-color:#230443; font-size:20px;" class="fas fa-envelope"></i>
                                                                            </a>
                                                                        <?php
                                                                        }else { ?>
                                                                            <a style="color:black;" href="javascript:void(0);" class='btnVerEventoHojaFinalizado' title="Visto">
                                                                                <i style="color: #27AE60; --darkreader-inline-color:#230443; font-size:20px;" class="fas fa-envelope-open-text"></i>
                                                                            </a>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-16">
                                            <div class="card-box widget-box-two widget-two-custom ">
                                                <div class="media">
                                                    <div class="wigdet-two-content media-body" style="text-align: left;">
                                                        <span class="m-0 font-weight-medium text-truncate" title="Statistics">Tareas Incumplidas</span>
                                                    </div>
                                                    <div>
                                                        <span class="badge badge-danger" data-plugin="counterup" style="font-size: 15px;">
                                                                <?php
                                                            $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND NOW() > det_fin AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                            $resultado = mysqli_query($conexion, $sql);
                                                            $filas = mysqli_fetch_row($resultado);
                                                            $total = (int)$filas[0];
                                                            echo $total; ?>
                                                        </span>
                                                    </div>
                                                </div><br>
                                                <div style="width: 483px; height: 35px; margin: 0px; padding: 0px;">
                                                    <table class="table table-sm table-striped table-responsive-sm" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #F96A74;">
                                                        <thead style="background-color: #F96A74; color: #fff;">
                                                            <th hidden>ID</th>
                                                            <th width="100px">Tramite</th>
                                                            <th width="100px">Proceso</th>
                                                            <th width="100px">Encargado</th>
                                                            <th width="80px">Op</th>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <div style="width: 500px; height: 160px; overflow-y: scroll; margin: 0px; padding: 0px;">
                                                    <table class="table table-sm table-striped table-responsive-sm" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #F96A74;">
                                                        <tbody>
                                                        <?php
                                                            $sql = "SELECT `det_id`,`hoja_numero_tramite`, `hoja_tipo_proceso`,`det_encargado`, det_leido
                                                                    FROM hoja_detalle JOIN hoja 
                                                                    WHERE hoja_detalle.hoja_id = hoja.hoja_id AND NOW() > det_fin AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                            $resultado = mysqli_query($conexion, $sql);
                                                            while ($registro = mysqli_fetch_assoc($resultado))
                                                            {
                                                        ?>
                                                            <tr>
                                                                <td hidden><?php echo $registro["det_id"]; ?></td>
                                                                <td width="100px"><?php echo $registro["hoja_numero_tramite"]; ?></td>
                                                                <td width="100px"><?php echo $registro["hoja_tipo_proceso"]; ?></td>
                                                                <td width="100px"><?php 
                                                                    $sql1 = "SELECT adm_nombre FROM administrador WHERE adm_id = '".$registro['det_encargado']."';";
                                                                    $result1 = mysqli_query($conexion,$sql1);
                                                                    $res1 = mysqli_fetch_assoc($result1);
                                                                    echo $res1['adm_nombre']; ?>
                                                                </td>
                                                                <td width="80px" style="text-align: center;">
                                                                <?php 
                                                                    if ($registro['det_leido'] == '0') { ?>
                                                                        <a style="color:black;" href="javascript:void(0);" class='btnVerEventoHojaFinalizado btnUpdateLeido' title="Ver Accion">
                                                                            <i style="color: #F96A74; --darkreader-inline-color:#230443; font-size:20px;" class="fas fa-envelope"></i>
                                                                        </a>
                                                                    <?php
                                                                    }else { ?>
                                                                        <a style="color:black;" href="javascript:void(0);" class='btnVerEventoHojaFinalizado' title="Visto">
                                                                            <i style="color: #27AE60; --darkreader-inline-color:#230443; font-size:20px;" class="fas fa-envelope-open-text"></i>
                                                                        </a>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                            }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-16">
                                            <div class="card-box widget-box-two widget-two-custom ">
                                                <div class="media">
                                                    <div class="wigdet-two-content media-body" style="text-align: left;">
                                                        <span class="m-0 font-weight-medium text-truncate" title="Statistics">Tareas Incumplidas</span>
                                                    </div>
                                                    <div>
                                                        <span class="badge badge-danger" data-plugin="counterup" style="font-size: 15px;">
                                                                <?php
                                                            $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND NOW() > det_fin AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                            $resultado = mysqli_query($conexion, $sql);
                                                            $filas = mysqli_fetch_row($resultado);
                                                            $total = (int)$filas[0];
                                                            echo $total; ?>
                                                        </span>
                                                    </div>
                                                </div><br>
                                                <div>
                                                    <table class="table table-sm table-striped" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #F96A74;">
                                                        <thead style="background-color: #F96A74; color: #fff;">
                                                            <th hidden>ID</th>
                                                            <th width="100px">Tramite</th>
                                                            <th width="100px">Proceso</th>
                                                            <th width="100px">Encargado</th>
                                                            <th width="80px">Op</th>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            $sql = "SELECT `det_id`,`hoja_numero_tramite`, `hoja_tipo_proceso`,`det_encargado`, det_leido
                                                                    FROM hoja_detalle JOIN hoja 
                                                                    WHERE hoja_detalle.hoja_id = hoja.hoja_id AND NOW() > det_fin AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                            $resultado = mysqli_query($conexion, $sql);
                                                            while ($registro = mysqli_fetch_assoc($resultado))
                                                            {
                                                        ?>
                                                            <tr>
                                                                <td hidden><?php echo $registro["det_id"]; ?></td>
                                                                <td><?php echo $registro["hoja_numero_tramite"]; ?></td>
                                                                <td><?php echo $registro["hoja_tipo_proceso"]; ?></td>
                                                                <td><?php 
                                                                    $sql1 = "SELECT adm_nombre FROM administrador WHERE adm_id = '".$registro['det_encargado']."';";
                                                                    $result1 = mysqli_query($conexion,$sql1);
                                                                    $res1 = mysqli_fetch_assoc($result1);
                                                                    echo $res1['adm_nombre']; ?>
                                                                </td>
                                                                <td style="text-align: center;">
                                                                <?php 
                                                                    if ($registro['det_leido'] == '0') { ?>
                                                                        <a style="color:black;" href="javascript:void(0);" class='btnVerEventoHojaFinalizado btnUpdateLeido' title="Ver Accion">
                                                                            <i style="color: #F96A74; --darkreader-inline-color:#230443; font-size:20px;" class="fas fa-envelope"></i>
                                                                        </a>
                                                                    <?php
                                                                    }else { ?>
                                                                        <a style="color:black;" href="javascript:void(0);" class='btnVerEventoHojaFinalizado' title="Visto">
                                                                            <i style="color: #27AE60; --darkreader-inline-color:#230443; font-size:20px;" class="fas fa-envelope-open-text"></i>
                                                                        </a>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                            }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!--div Collapse -->
                                </div>
                        <?php
                            }elseif ($row['area_id'] == '3') { ?>
                                <div class="col-12">
                                    <div class="card-box widget-box-two widget-two-custom p-2">
                                        <div class="row">
                                            <div class="widget-two-content media-body col-xl-1" style="text-align: left; display: inline-block; padding-right: 0px;">
                                                <span><i class="fas fa-laptop-code fa-2x"></i></span>
                                            </div>
                                            <div class="widget-two-content media-body col-xl-3" style="text-align: left; display: inline-block; padding-left: 0px;">
                                                <span class="m-0 font-weight-medium text-truncate" style="font-size: 20px;"> ÁREA MARKETING </span>
                                            </div>
                                            <div class="wigdet-two-content media-body col-xl-2" style=" padding-top: 5px; display: inline-block; text-align: left; margin-left: 0px; padding-left: 0px;">
                                                <span class="m-0 font-weight-medium text-truncate" style="font-size: 15px;">Notificaciones </span>
                                                <span class="badge badge-warning" data-plugin="counterup" style="font-size: 15px;">
                                                        <?php
                                                    $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                    $resultado = mysqli_query($conexion, $sql);
                                                    $filas = mysqli_fetch_row($resultado);
                                                    $total = (int)$filas[0];
                                                    echo $total; ?>
                                                </span>
                                            </div>
                                            <div class="wigdet-two-content media-body col-xl-2" style="padding-top: 5px; display: inline-block; text-align: left;">
                                                <span class="m-0 font-weight-medium text-truncate" style="font-size: 15px;">Audiencias </span>
                                                <span class="badge badge-warning" data-plugin="counterup" style="font-size: 15px;">
                                                        <?php
                                                    $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                    $resultado = mysqli_query($conexion, $sql);
                                                    $filas = mysqli_fetch_row($resultado);
                                                    $total = (int)$filas[0];
                                                    echo $total; ?>
                                                </span>
                                            </div>
                                            <div class="wigdet-two-content media-body col-xl-2" style="padding-top: 5px; display: inline-block; text-align: left; margin-left: 0px; padding-left: 0px;">
                                                <span class="m-0 font-weight-medium text-truncate" style="font-size: 15px;">Incumplidas </span>
                                                <span class="badge badge-warning" data-plugin="counterup" style="font-size: 15px;">
                                                        <?php
                                                    $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                    $resultado = mysqli_query($conexion, $sql);
                                                    $filas = mysqli_fetch_row($resultado);
                                                    $total = (int)$filas[0];
                                                    echo $total; ?>
                                                </span>
                                            </div>
                                            <div class="wigdet-two-content media-body col-xl-2" style="padding-top: 2px;">
                                                <span>
                                                    <button type="button" class="btn btn-outline-info btn-sm" data-toggle="collapse" data-target="#marketing">Ver</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="marketing" class="row collapse in">
                                        <div class="col-xl-6 col-sm-16">
                                            <div class="card-box widget-box-two widget-two-custom " style="height: 300px;">
                                                <div class="media">
                                                    <div class="wigdet-two-content media-body" style="text-align: left;">
                                                        <span class="m-0 font-weight-medium text-truncate" title="Statistics">Notificaciones</span>
                                                    </div>
                                                    <div>
                                                        <span class="badge badge-warning" data-plugin="counterup" style="font-size: 15px;">
                                                                <?php
                                                            $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                            $resultado = mysqli_query($conexion, $sql);
                                                            $filas = mysqli_fetch_row($resultado);
                                                            $total = (int)$filas[0];
                                                            echo $total; ?>
                                                        </span>
                                                    </div>
                                                </div><br>
                                                <div>
                                                    <table class="table table-sm table-striped" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #E67E22;">
                                                        <thead style="background-color: #E67E22; color: #fff;">
                                                            <th hidden>ID</th>
                                                            <th width="80px">Tramite</th>
                                                            <th width="100px">Proceso</th>
                                                            <th width="70px">Area</th>
                                                            <th width="100px">Accion</th>
                                                            <th width="50px">Op</th>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            $sql = "SELECT `det_id`,`hoja_numero_tramite`, `hoja_tipo_proceso`, hoja_area_proceso,`det_etapa`,`det_accion`,`det_observacion`, det_leido 
                                                                    FROM hoja_detalle JOIN hoja 
                                                                    WHERE hoja_detalle.hoja_id = hoja.hoja_id AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                            $resultado = mysqli_query($conexion, $sql);
                                                            while ($registro = mysqli_fetch_assoc($resultado))
                                                            {
                                                            ?>
                                                                <tr>
                                                                    <td hidden><?php echo $registro["det_id"]; ?></td>
                                                                    <td><?php echo $registro["hoja_numero_tramite"]; ?></td>
                                                                    <td><?php echo $registro["hoja_tipo_proceso"]; ?></td>
                                                                    <td><?php echo $registro["hoja_area_proceso"]; ?></td>
                                                                    <td>
                                                                        <?php echo $registro['det_observacion']; ?>
                                                                    </td>
                                                                    <td style="text-align: center;">
                                                                    <?php 
                                                                        if ($registro['det_leido'] == '0') { ?>
                                                                            <a style="color:black;" href="javascript:void(0);" class='btnVerEventoHojaFinalizado btnUpdateLeido' title="Ver Accion">
                                                                                <i style="color: #E67E22; --darkreader-inline-color:#230443; font-size:20px;" class="fas fa-envelope"></i>
                                                                            </a>
                                                                        <?php
                                                                        }else { ?>
                                                                            <a style="color:black;" href="javascript:void(0);" class='btnVerEventoHojaFinalizado' title="Visto">
                                                                                <i style="color: #27AE60; --darkreader-inline-color:#230443; font-size:20px;" class="fas fa-envelope-open-text"></i>
                                                                            </a>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-16">
                                            <div class="card-box widget-box-two widget-two-custom ">
                                                <div class="media">
                                                    <div class="wigdet-two-content media-body" style="text-align: left;">
                                                        <span class="m-0 font-weight-medium text-truncate" title="Statistics">Tareas Incumplidas</span>
                                                    </div>
                                                    <div>
                                                        <span class="badge badge-danger" data-plugin="counterup" style="font-size: 15px;">
                                                                <?php
                                                            $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND NOW() > det_fin AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                            $resultado = mysqli_query($conexion, $sql);
                                                            $filas = mysqli_fetch_row($resultado);
                                                            $total = (int)$filas[0];
                                                            echo $total; ?>
                                                        </span>
                                                    </div>
                                                </div><br>
                                                <div style="width: 483px; height: 35px; margin: 0px; padding: 0px;">
                                                    <table class="table table-sm table-striped table-responsive-sm" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #F96A74;">
                                                        <thead style="background-color: #F96A74; color: #fff;">
                                                            <th hidden>ID</th>
                                                            <th width="100px">Tramite</th>
                                                            <th width="100px">Proceso</th>
                                                            <th width="100px">Encargado</th>
                                                            <th width="80px">Op</th>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <div style="width: 500px; height: 160px; overflow-y: scroll; margin: 0px; padding: 0px;">
                                                    <table class="table table-sm table-striped table-responsive-sm" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #F96A74;">
                                                        <tbody>
                                                        <?php
                                                            $sql = "SELECT `det_id`,`hoja_numero_tramite`, `hoja_tipo_proceso`,`det_encargado`, det_leido
                                                                    FROM hoja_detalle JOIN hoja 
                                                                    WHERE hoja_detalle.hoja_id = hoja.hoja_id AND NOW() > det_fin AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                            $resultado = mysqli_query($conexion, $sql);
                                                            while ($registro = mysqli_fetch_assoc($resultado))
                                                            {
                                                        ?>
                                                            <tr>
                                                                <td hidden><?php echo $registro["det_id"]; ?></td>
                                                                <td width="100px"><?php echo $registro["hoja_numero_tramite"]; ?></td>
                                                                <td width="100px"><?php echo $registro["hoja_tipo_proceso"]; ?></td>
                                                                <td width="100px"><?php 
                                                                    $sql1 = "SELECT adm_nombre FROM administrador WHERE adm_id = '".$registro['det_encargado']."';";
                                                                    $result1 = mysqli_query($conexion,$sql1);
                                                                    $res1 = mysqli_fetch_assoc($result1);
                                                                    echo $res1['adm_nombre']; ?>
                                                                </td>
                                                                <td width="80px" style="text-align: center;">
                                                                <?php 
                                                                    if ($registro['det_leido'] == '0') { ?>
                                                                        <a style="color:black;" href="javascript:void(0);" class='btnVerEventoHojaFinalizado btnUpdateLeido' title="Ver Accion">
                                                                            <i style="color: #F96A74; --darkreader-inline-color:#230443; font-size:20px;" class="fas fa-envelope"></i>
                                                                        </a>
                                                                    <?php
                                                                    }else { ?>
                                                                        <a style="color:black;" href="javascript:void(0);" class='btnVerEventoHojaFinalizado' title="Visto">
                                                                            <i style="color: #27AE60; --darkreader-inline-color:#230443; font-size:20px;" class="fas fa-envelope-open-text"></i>
                                                                        </a>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                            }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-16">
                                            <div class="card-box widget-box-two widget-two-custom ">
                                                <div class="media">
                                                    <div class="wigdet-two-content media-body" style="text-align: left;">
                                                        <span class="m-0 font-weight-medium text-truncate" title="Statistics">Tareas Incumplidas</span>
                                                    </div>
                                                    <div>
                                                        <span class="badge badge-danger" data-plugin="counterup" style="font-size: 15px;">
                                                                <?php
                                                            $sql = "SELECT COUNT(*) FROM hoja_detalle WHERE det_leido = 0 AND NOW() > det_fin AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                            $resultado = mysqli_query($conexion, $sql);
                                                            $filas = mysqli_fetch_row($resultado);
                                                            $total = (int)$filas[0];
                                                            echo $total; ?>
                                                        </span>
                                                    </div>
                                                </div><br>
                                                <div>
                                                    <table class="table table-sm table-striped" style="text-align: left; font-size: 12px; border-style: solid; border-width: 2px; border-color: #F96A74;">
                                                        <thead style="background-color: #F96A74; color: #fff;">
                                                            <th hidden>ID</th>
                                                            <th width="100px">Tramite</th>
                                                            <th width="100px">Proceso</th>
                                                            <th width="100px">Encargado</th>
                                                            <th width="80px">Op</th>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            $sql = "SELECT `det_id`,`hoja_numero_tramite`, `hoja_tipo_proceso`,`det_encargado`, det_leido
                                                                    FROM hoja_detalle JOIN hoja 
                                                                    WHERE hoja_detalle.hoja_id = hoja.hoja_id AND NOW() > det_fin AND det_estado = 'EJECUCION' AND det_encargado = '".$_SESSION['adm_id']."';";
                                                            $resultado = mysqli_query($conexion, $sql);
                                                            while ($registro = mysqli_fetch_assoc($resultado))
                                                            {
                                                        ?>
                                                            <tr>
                                                                <td hidden><?php echo $registro["det_id"]; ?></td>
                                                                <td><?php echo $registro["hoja_numero_tramite"]; ?></td>
                                                                <td><?php echo $registro["hoja_tipo_proceso"]; ?></td>
                                                                <td><?php 
                                                                    $sql1 = "SELECT adm_nombre FROM administrador WHERE adm_id = '".$registro['det_encargado']."';";
                                                                    $result1 = mysqli_query($conexion,$sql1);
                                                                    $res1 = mysqli_fetch_assoc($result1);
                                                                    echo $res1['adm_nombre']; ?>
                                                                </td>
                                                                <td style="text-align: center;">
                                                                <?php 
                                                                    if ($registro['det_leido'] == '0') { ?>
                                                                        <a style="color:black;" href="javascript:void(0);" class='btnVerEventoHojaFinalizado btnUpdateLeido' title="Ver Accion">
                                                                            <i style="color: #F96A74; --darkreader-inline-color:#230443; font-size:20px;" class="fas fa-envelope"></i>
                                                                        </a>
                                                                    <?php
                                                                    }else { ?>
                                                                        <a style="color:black;" href="javascript:void(0);" class='btnVerEventoHojaFinalizado' title="Visto">
                                                                            <i style="color: #27AE60; --darkreader-inline-color:#230443; font-size:20px;" class="fas fa-envelope-open-text"></i>
                                                                        </a>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                            }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!--div Collapse -->
                                </div>
                        <?php
                            }
                        ?>
                    </div>
                    
                    <!-- end row -->
                    
                    <div id="modal_respuesta_hoja_detalle" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Respuesta Accion de Hoja de Ruta</h4>
                                </div>
                                <div class="modal-body" id="respuesta_hoja_detalle">
                                    
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" id="update_respuesta_accion_fin" class="btn btn-success waves-effect">Finalizar Evento</button>
                                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Cerrar</button>
                                    <button type="button" id="update_respuesta_accion" class="btn btn-purple waves-effect" disabled>Reenviar Accion</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    <div id="modal_finalizar_hoja_detalle" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Finalizar Accion de Hoja de Ruta</h4>
                                </div>
                                <div class="modal-body py-md-1" id="finalizar_hoja_detalle">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Cerrar</button>
                                    <button type="button" id="update_file_hoja" class="btn btn-purple waves-effect" disabled>Enviar Respuesta</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <div id="modal_hoja_detalle_audiencia" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Agendar fecha de Audiencia</h4>
                                </div>
                                <div class="modal-body" id="fecha_audiencia">
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Cerrar</button>
                                    <button type="button" id="update_audiencia_hoja" class="btn btn-purple waves-effect" disabled>Enviar Respuesta</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    <div id="modal_crear_evento_hoja" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Registrar Evento de Hojas de Ruta</h4>
                                </div>
                                <div class="modal-body" id="evento_hoja">
                                    <!-- Dentro de este DIV, se muestra el formulario de registro de un evento de la hoja de ruta -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="close_evento_hoja" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                    <button type="button" id="create_evento_hoja" name="create_evento_hoja" class="btn btn-purple waves-effect" data-dismiss="modal" disabled>Guardar</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
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
            $('#alarma_notificaciones').load('alarma/alarma_notificaciones.php');
            $('#alarma_notificaciones_topbar').load('alarma/alarma_notificaciones_topbar.php');
            $('#alarma_newmensajes_topbar').load('alarma/alarma_newmensajes_topbar.php');
            $('#alarma_viewmensajes_topbar').load('alarma/alarma_viewmensajes_topbar.php');
            $('#alarma_sendmensajes_topbar').load('alarma/alarma_sendmensajes_topbar.php');
            $('#alarma_audiencia').load('alarma/alarma_audiencia.php');
            $('#alarma_tincumplidas').load('alarma/alarma_tincumplidas.php');
            $('#audiencia_table').load('tabla_audiencias.php');
            $('#notificaciones_table').load('tabla_notificaciones.php');
            $('#tincumplidas_table').load('tabla_tincumplidas.php');
            $('#tabla_all_tareas').load('tabla_all_tareas.php');
            $('#tabla_tincumplida').load('tabla_tareas_incumplidas.php');
            $(".datepicker").datepicker();
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

        $(document).on("click", ".btnEditarEventoHojaPendiente", function() {
            cadena = "hoja_id=" + $(this).closest('tr').find('td:eq(0)').text();
            //alert(cadena); return false;
            //https://jsonformatter.org/jsbeautifier
            $.ajax({
                type: "POST",
                url: "assets/inc/update_hoja_id.php",
                data: cadena,
                success: function(r) {
                        if(r) {
                            $('#finalizar_hoja_detalle').load('modal_finalizar_evento_hoja.php');
                            $('#modal_finalizar_hoja_detalle').modal('show');
                        }
                    }
            });
        });
        
        function verif(detalle) {
            if (detalle == "registro") {
                var audiencia = document.getElementById("detalle_audiencia").value;
                var juzgado = document.getElementById("detalle_juzgado").value;
                var obs = document.getElementById("det_observacion").value;
                var encargado = document.getElementById("responsable_area").value;
                if (juzgado != "" && obs != "" && encargado != "") {
                    document.getElementById("update_audiencia_hoja").disabled = false;
                }else{
                    document.getElementById("update_audiencia_hoja").disabled = true;
                }
            }else if (detalle == "fin"){
                var obs = $("#det_respuesta").val();
                if (obs != "" ) {
                    document.getElementById("update_file_hoja").disabled = false;
                }else{
                    document.getElementById("update_file_hoja").disabled = true;
                }
            }else if (detalle == "reenvio"){
                var obs = $("#det_respuesta_fin").val();
                var fecfin = $("#detalle_resp_fin").val();
                //alert(fecfin); return false;
                if (obs != "" && fecfin != "") {
                    document.getElementById("update_respuesta_accion").disabled = false;
                }else{
                    document.getElementById("update_respuesta_accion").disabled = true;
                }
            }
        }

        function showError(cadena){
            var dato = $('#'+cadena+'').val();
            if (dato != '') {
                document.getElementById("error_"+cadena+"").style.display = "none";
            }else{
                document.getElementById("error_"+cadena+"").style.display = "";
            }
        }

        $(document).ready(function(){
            $("#update_file_hoja").click(function(){
                cadena = "hoja_id="+$("#hoja_id").val();
                tramite = $("#hoja_numero_tramite_update").val();
                audi_sw = $("#audi_switch").val();
                //alert(audi_sw); return false;
                
                var file_data = $("#newFile").prop("files")[0];
                var datos = new FormData();
                
                datos.append("newFile", file_data);
                datos.append("detalle_id", $("#detalle_id").val());
                datos.append("admin_eve", $("#admin_eve").val());
                datos.append("det_respuesta", $("#det_respuesta").val());
                datos.append("det_leido", $("#det_leido").val());
                datos.append("det_estado_update", $("#det_estado_update").val());
                
                //console.log(datos); 
                //alert(datos); return false;
                $.ajax({
                    cache: false,
                    contentType: false,
                    data: datos,
                    dataType: 'JSON',
                    enctype: 'multipart/form-data',
                    processData: false,
                    method: "POST",
                    url: "assets/inc/upload_file.php",
                    success:function(response){
                        if(response){
                            if (audi_sw != "0000-00-00 00:00:00") {
                                Swal.fire({
                                    type: 'success',
                                    title: '¿Desea fijar otra fecha de Audiencia para la hoja de ruta ',
                                    text: tramite+"?",
                                    showCancelButton: true,
                                    cancelButtonText: 'No',
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Si'
                                }).then((result) => {
                                    if(result.value) {
                                        $.ajax({
                                            type: "POST",
                                            url: "assets/inc/update_hoja_id.php",
                                            data: cadena,
                                            success: function(r) {
                                                if(r) {
                                                    $('#audiencia_table').load('tabla_audiencias.php');
                                                    $('#modal_finalizar_hoja_detalle').modal('hide');
                                                    $('#fecha_audiencia').load('modal_create_audiencia.php');
                                                    $('#modal_hoja_detalle_audiencia').modal('show');
                                                }
                                            }
                                        });
                                    }else{
                                        $('#audiencia_table').load('tabla_audiencias.php');
                                        $('#modal_finalizar_hoja_detalle').modal('hide');
                                        Swal.fire({
                                            type: 'success',
                                            title: 'Audiencia finalizada.',
                                            showConfirmButton: false,
                                            timer: 2000
                                        })
                                    }
                                })
                            }else{
                                $('#notificaciones_table').load('tabla_notificaciones.php');
                                $('#alarma_notificaciones_topbar').load('alarma/alarma_notificaciones_topbar.php');
                                $('#modal_finalizar_hoja_detalle').modal('hide');
                                Swal.fire({
                                    type: 'success',
                                    title: 'Evento finalizado.',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            }

                        }else{
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
        $(document).on("click", ".btnVerEventoHojaFinalizado", function() {
            cadena = "hoja_id=" + $(this).closest('tr').find('td:eq(0)').text();
            //alert(cadena); return false;
            //https://jsonformatter.org/jsbeautifier
            $.ajax({
                type: "POST",
                url: "assets/inc/update_hoja_id.php",
                data: cadena,
                success: function(r) {
                    if(r) {
                        $("#formulario_actualizar_hoja_detalle").trigger("reset");
                        document.getElementById("update_file_hoja").disabled = true;
                        $('#finalizar_hoja_detalle').load('modal_finalizar_evento_hoja.php');
                        $('#modal_finalizar_hoja_detalle').modal('show');
                        $('#modal_finalizar_hoja_detalle').on('shown.bs.modal',function(){
                            $('#det_respuesta').trigger('focus');
                        });
                    }
                }
            });
        });
        $(document).on("click", ".btnUpdateLeido", function() {
            cadena = "det_id=" + $(this).closest('tr').find('td:eq(0)').text();
            //alert(cadena); return false;
            //https://jsonformatter.org/jsbeautifier
            $.ajax({
                type: "POST",
                url: "assets/inc/update_detalle_leido.php",
                data: cadena,
                success: function(r) {
                    if(r) {
                        $('#notificaciones_table').load('tabla_notificaciones.php');
                        $('#alarma_notificaciones').load('alarma/alarma_notificaciones.php');
                        $('#tincumplidas_table').load('tabla_tincumplidas.php');
                    }
                }
            });
        });

        function showInp(){
            var accion = document.getElementById("detalle_accion").value;
            if(accion == "AUDIENCIA"){
                document.getElementById("audiencia").style.display = "";
                document.getElementById("juzgado").style.display = "";
                document.getElementById("respuesta").style.display = "none";
                document.getElementById("error_accion").style.display = "none";
                document.getElementById("field_file").style.display = "none";
                document.getElementById("field_f").style.display = "none";
                document.getElementById("det_obs").style.display = "";
                document.getElementById("resp_area").style.display = "";
            }else if(accion=="") {
                document.getElementById("error_accion").style.display = "";
                document.getElementById("respuesta").style.display = "";
                document.getElementById("audiencia").style.display = "none";
                document.getElementById("create_evento_hoja").disabled = true;
            }else {
                document.getElementById("audiencia").style.display = "none";
                document.getElementById("juzgado").style.display = "none";
                document.getElementById("respuesta").style.display = "";
                document.getElementById("error_accion").style.display = "none";
                document.getElementById("field_file").style.display = "";
                document.getElementById("field_f").style.display = "";
                document.getElementById("det_obs").style.display = "";
                document.getElementById("resp_area").style.display = "";
            }
        }
        function verificar() {
            var etapa = document.getElementById("detalle_etapa").value;
            var accion = document.getElementById("detalle_accion").value;
            var detfin = document.getElementById("detalle_fecha_fin").value;
            var audiencia = document.getElementById("detalle_audiencia").value;
            var juzgado = document.getElementById("detalle_juzgado").value;
            var obs = document.getElementById("detalle_observacion").value;
            var encargado = document.getElementById("responsable_area").value;
            if (etapa != "") {
                if (accion == "AUDIENCIA") {
                    if (detfin != "0000-00-00 00:00:00" && juzgado != "" && obs != "" && encargado != "") {
                        document.getElementById("create_evento_hoja").disabled = false;
                    }else{
                        document.getElementById("create_evento_hoja").disabled = true;
                    }
                }else if (detfin != "0000-00-00 00:00:00" && obs != "" && encargado != "") {
                    document.getElementById("create_evento_hoja").disabled = false;
                }else{
                    document.getElementById("create_evento_hoja").disabled = true;
                }
            }else{
                document.getElementById("create_evento_hoja").disabled = true;
            }
        }
        $('#create_evento_hoja').click(function(){
            var file_data = $("#uploadFile").prop("files")[0];
            var datos = new FormData();
            datos.append("uploadFile", file_data);
            datos.append("hoja_id", $("#hoja_id").val());
            datos.append("admin", $("#admin").val());
            datos.append("hoja_numero_tramite", $("#hoja_numero_tramite").val());
            datos.append("nombre_update_cliente", $("#nombre_update_cliente").val());
            datos.append("detalle_etapa", $("#detalle_etapa").val());
            datos.append("detalle_accion", $("#detalle_accion").val());
            datos.append("detalle_inicio", $("#detalle_inicio").val());
            datos.append("detalle_fecha_fin", $("#detalle_fecha_fin").val());
            datos.append("detalle_audiencia", $("#detalle_audiencia").val());
            datos.append("detalle_juzgado", $("#detalle_juzgado").val());
            datos.append("lugar_juzgado", $("#lugar_juzgado").val());
            datos.append("detalle_estado", $("#detalle_estado").val());
            datos.append("detalle_observacion", $("#detalle_observacion").val());
            datos.append("responsable_area", $("#responsable_area").val());
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
                url:"assets/inc/create_evento_hoja.php",
                success:function(response){
                    if(response){
                        Swal.fire({
                            type: 'success',
                            title: 'Registro de Evento Exitoso',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        $('#audiencia_table').load('tabla_audiencias.php');
                        $('#notificaciones_table').load('tabla_notificaciones.php');
                        $('#alarma_notificaciones').load('alarma/alarma_notificaciones.php');
                        $('#formulario_crear_evento_hoja').trigger("reset");
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
        $(document).on("click", ".btnRespLeido", function() {
            cadena = "resp_id=" + $(this).closest('tr').find('td:eq(0)').text();
            //alert(cadena); return false;
            //https://jsonformatter.org/jsbeautifier
            $.ajax({
                type: "POST",
                url: "assets/inc/update_detalle_leido.php",
                data: cadena,
                success: function(r) {
                    if(r) {
                        $('#notificaciones_table').load('tabla_notificaciones.php');
                    }
                }
            });
        });
        $(document).on("click", ".btnVerRespuesta", function() {
            cadena = "hoja_id=" + $(this).closest('tr').find('td:eq(0)').text();
            //alert(cadena); return false;
            //https://jsonformatter.org/jsbeautifier
            $.ajax({
                type: "POST",
                url: "assets/inc/update_hoja_id.php",
                data: cadena,
                success: function(r) {
                    if(r) {
                        $('#respuesta_hoja_detalle').load('modal_respuesta_evento_hoja.php');
                        $('#modal_respuesta_hoja_detalle').modal('show');
                    }
                }
            });
        });
        $(document).on("click", "#update_respuesta_accion_fin", function() {
            cadena = "resp_fin="+$("#detalle_id_fin").val();
            hoja = "hoja_id="+$("#hoja_id").val();
            tramite = $("#hoja_numero_tramite_fin").val();
            //alert(cadena); return false;
            //https://jsonformatter.org/jsbeautifier
            Swal.fire({
                type: 'warning',
                title: '¿Desea finalizar la accion de '+tramite+'?',
                text: "",
                showCancelButton: true,
                cancelButtonText: 'No',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then((result) => {
                if(result.value) {
                    $.ajax({
                        type: "POST",
                        url: "assets/inc/update_detalle_leido.php",
                        data: cadena,
                        success: function(r) {
                            if(r) {
                                Swal.fire({
                                type: 'success',
                                title: '¿Desea fijar otro evento para la hoja de ruta ',
                                text: tramite+"?",
                                showCancelButton: true,
                                cancelButtonText: 'No',
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Si'
                                }).then((result) => {
                                    if(result.value) {
                                        $.ajax({
                                            type: "POST",
                                            url: "assets/inc/update_hoja_id.php",
                                            data: hoja,
                                            success: function(r) {
                                                if(r) {
                                                    $('#notificaciones_table').load('tabla_notificaciones.php');
                                                    $('#alarma_notificaciones_topbar').load('alarma/alarma_notificaciones_topbar.php');
                                                    $('#modal_respuesta_hoja_detalle').modal('hide');
                                                    $('#evento_hoja').load('modal_create_evento_hoja.php');
                                                    $('#modal_crear_evento_hoja').modal('show');
                                                }
                                            }
                                        });
                                    }else{
                                        $('#notificaciones_table').load('tabla_notificaciones.php');
                                        $('#alarma_notificaciones_topbar').load('alarma/alarma_notificaciones_topbar.php');
                                        $('#modal_respuesta_hoja_detalle').modal('hide');
                                        Swal.fire({
                                            type: 'success',
                                            title: 'Evento finalizado.',
                                            showConfirmButton: false,
                                            timer: 2000
                                        })
                                    }
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
            })
        });
        $("#update_respuesta_accion").click(function(){
            cadena = "hoja_id="+$("#hoja_id").val();
            tramite = $("#hoja_numero_tramite_update").val();
            //alert(audi_sw); return false;
            
            var file_data = $("#endFile").prop("files")[0];
            var datos = new FormData();
            
            datos.append("newFile", file_data);
            datos.append("detalle_id", $("#detalle_id_fin").val());
            datos.append("admin_eve", $("#admin_eve_fin").val());
            datos.append("det_respuesta", $("#det_respuesta_fin").val());
            datos.append("det_fecha_fin", $("#detalle_resp_fin").val());
            datos.append("det_leido", $("#det_leido_fin").val());
            datos.append("det_estado_update", $("#det_estado_fin").val());
            for (var value of datos.values()) {
                console.log(value);
            }
            //console.log(datos); 
            //alert(datos); return false;
            $.ajax({
                cache: false,
                contentType: false,
                data: datos,
                dataType: 'JSON',
                enctype: 'multipart/form-data',
                processData: false,
                method: "POST",
                url: "assets/inc/upload_file.php",
                success:function(response){
                    if(response){
                        $('#notificaciones_table').load('tabla_notificaciones.php');
                        $('#alarma_notificaciones_topbar').load('alarma/alarma_notificaciones_topbar.php');
                        $('#modal_respuesta_hoja_detalle').modal('hide');
                        Swal.fire({
                            type: 'success',
                            title: 'Tarea reenviada.',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }else{
                        Swal.fire({
                            type: 'error',
                            title: 'Se ha Producido un Error.',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                }
            })
        });
        $(document).on("click", ".btnVerRespuesta", function() {
            cadena = "hoja_id=" + $(this).closest('tr').find('td:eq(0)').text();
            //alert(cadena); return false;
            //https://jsonformatter.org/jsbeautifier
            $.ajax({
                type: "POST",
                url: "assets/inc/update_hoja_id.php",
                data: cadena,
                success: function(r) {
                    if(r) {
                        $('#respuesta_hoja_detalle').load('modal_respuesta_evento_hoja.php');
                        $('#modal_respuesta_hoja_detalle').modal('show');
                    }
                }
            });
        });
        function verFileSize(file_nombre){
            var archivo = $("#"+file_nombre).prop("files")[0].name;
            var ext=["doc","docx","pdf","jpge","jpg","xls","xlsx"];
            var tam= $("#"+file_nombre).prop("files")[0].size;
            archnom = archivo.slice((archivo.lastIndexOf(".") - 1 >>> 0) + 2);
            var buscar = ext.indexOf(archnom);
            if (buscar == -1) {
                Swal.fire({
                    type: 'warning',
                    title: 'Archivo no permitido',
                    text: 'El archivo debe ser: doc, pdf o jpg',
                    showConfirmButton: false,
                    timer: 2000
                })
                $("#"+file_nombre).val('');
                $("#"+file_nombre).html('');
            } else {
                if (tam > 5242880) {
                    Swal.fire({
                        type: 'warning',
                        title: 'El archivo es demasiado grande',
                        text: 'Los archivos deben pesar menos de 5MB',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $("#"+file_nombre).val('');
                    $("#"+file_nombre).html('');
                }
            }
        }
    </script>
</body>
</html>