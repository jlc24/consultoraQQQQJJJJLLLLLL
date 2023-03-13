<?php include('assets/inc/conexion.php'); 
    session_start();
    if (!isset($_SESSION['adm_id'])) {
        header('Location: login.php');
    }
    
    $adm_id = $_SESSION['adm_id'];
?>
<?php
    if ($adm_id == '3' || $adm_id == '10') { 
        ?>
        <div class="row justify-content-center">
            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; margin: 0px auto; padding:4%">
                        <h2 style="font-family: sans-serif;	color: white; font-size: 50px; font-weight: bold;">HR</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">Hojas de Ruta</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'PENAL' OR hoja_area_proceso = 'PENAL ADUANERO';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; margin: 0px auto; padding:4%">
                            <h2 style="font-family: sans-serif;	color: white; font-size: 50px; font-weight: bold;">P</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">PENAL</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'PENAL';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; margin: 0px auto; padding:4%">
                            <h2 style="font-family: sans-serif;	color: white; font-size: 50px; font-weight: bold;">PA</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">PENAL ADUANERO</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'PENAL ADUANERO';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }elseif ($adm_id == '4') { ?>
        <div class="row justify-content-center">
            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; margin: 0px auto; padding:4%">
                        <h2 style="font-family: sans-serif;	color: white; font-size: 50px; font-weight: bold;">HR</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">Hojas de Ruta</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'ADMINISTRATIVO' OR hoja_area_proceso = 'A.I.T.' OR hoja_area_proceso = 'CONTENCIOSO TRIBUTARIO' OR hoja_area_proceso = 'FAMILIA';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; margin: 0px auto; padding:4%">
                            <h2 style="font-family: sans-serif;	color: white; font-size: 30px; font-weight: bold;">ADM</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">ADMINISTRATIVO</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'ADMINISTRATIVO';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; margin: 0px auto; padding:4%">
                            <h2 style="font-family: sans-serif;	color: white; font-size: 30px; font-weight: bold;">A.I.T.</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">A.I.T.</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'A.I.T.';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; margin: 0px auto; padding:4%">
                            <h2 style="font-family: sans-serif;	color: white; font-size: 50px; font-weight: bold;">CT</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">Contencioso Tributario</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'CONTENCIOSO TRIBUTARIO';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; margin: 0px auto; padding:4%">
                            <h2 style="font-family: sans-serif;	color: white; font-size: 50px; font-weight: bold;">F</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">FAMILIA</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'FAMILIA';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }elseif ($adm_id == '7') { ?>
        <div class="row justify-content-center">
            <div class="col-xl-4 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; margin: 0px auto; padding:4%">
                        <h2 style="font-family: sans-serif;	color: white; font-size: 50px; font-weight: bold;">HR</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">Hojas de Ruta</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'CIVIL';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-xl-4 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; margin: 0px auto; padding:4%">
                            <h2 style="font-family: sans-serif;	color: white; font-size: 50px; font-weight: bold;">C</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">CIVIL</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'CIVIL';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }elseif ($adm_id == '11') { ?>
        <div class="row justify-content-center">
            <div class="col-xl-4 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center;	align-items: center; text-align: center; margin: 0px auto; padding:4%">
                        <h2 style="font-family: sans-serif;	color: white; font-size: 50px; font-weight: bold;">HR</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">Hojas de Ruta</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'ADMINISTRATIVO' OR hoja_area_proceso = 'CIVIL';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; margin: 0px auto; padding:4%">
                            <h2 style="font-family: sans-serif;	color: white; font-size: 30px; font-weight: bold;">ADM</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">ADMINISTRATIVO</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'ADMINISTRATIVO';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; margin: 0px auto; padding:4%">
                            <h2 style="font-family: sans-serif;	color: white; font-size: 50px; font-weight: bold;">C</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">CIVIL</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'CIVIL';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }elseif ($adm_id == '2') { ?>
        <div class="row justify-content-center">
            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center;	align-items: center; text-align: center; margin: 0px auto; padding:4%">
                        <h2 style="font-family: sans-serif;	color: white; font-size: 50px; font-weight: bold;">HR</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">Hojas de Ruta</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'ADUANA' OR hoja_area_proceso = 'PENAL ADUANERO' OR hoja_area_proceso = 'A.I.T.' OR hoja_area_proceso = 'CONTENCIOSO TRIBUTARIO';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center;	align-items: center; text-align: center; margin: 0px auto; padding:4%">
                            <h2 style="font-family: sans-serif;	color: white; font-size: 50px; font-weight: bold;">A</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">ADUANA</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'ADUANA';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; margin: 0px auto; padding:4%">
                            <h2 style="font-family: sans-serif;	color: white; font-size: 30px; font-weight: bold;">A.I.T.</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">A.I.T.</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'A.I.T.';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; margin: 0px auto; padding:4%">
                            <h2 style="font-family: sans-serif;	color: white; font-size: 50px; font-weight: bold;">CT</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">Contencioso Tributario</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'CONTENCIOSO TRIBUTARIO';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center;	align-items: center; text-align: center; margin: 0px auto; padding:4%">
                            <h2 style="font-family: sans-serif;	color: white; font-size: 50px; font-weight: bold;">PA</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">PENAL ADUANERO</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'PENAL ADUANERO';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }else { ?>
        <div class="row justify-content-center">
            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center;	align-items: center; text-align: center; margin: 0px auto; padding:4%">
                        <h2 style="font-family: sans-serif;	color: white; font-size: 50px; font-weight: bold;">HR</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">Hojas de Ruta</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja ;";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; margin: 0px auto; padding:4%">
                            <h2 style="font-family: sans-serif;	color: white; font-size: 30px; font-weight: bold;">ADM</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">ADMINISTRATIVO</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'ADMINISTRATIVO';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center;	align-items: center; text-align: center; margin: 0px auto; padding:4%">
                            <h2 style="font-family: sans-serif;	color: white; font-size: 50px; font-weight: bold;">A</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">ADUANA</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'ADUANA';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; margin: 0px auto; padding:4%">
                            <h2 style="font-family: sans-serif;	color: white; font-size: 30px; font-weight: bold;">A.I.T.</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">A.I.T.</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'A.I.T.';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; margin: 0px auto; padding:4%">
                            <h2 style="font-family: sans-serif;	color: white; font-size: 50px; font-weight: bold;">C</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">CIVIL</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'CIVIL';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; margin: 0px auto; padding:4%">
                            <h2 style="font-family: sans-serif;	color: white; font-size: 50px; font-weight: bold;">CT</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">Contencioso Tributario</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'CONTENCIOSO TRIBUTARIO';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; margin: 0px auto; padding:4%">
                            <h2 style="font-family: sans-serif;	color: white; font-size: 50px; font-weight: bold;">F</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">FAMILIA</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'FAMILIA';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; margin: 0px auto; padding:4%">
                            <h2 style="font-family: sans-serif;	color: white; font-size: 50px; font-weight: bold;">P</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">PENAL</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'PENAL';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom" style="border-style: solid; border-width: 1px; border-color: #64C5B1;">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary" style="width: 100px; height: 100px; display: flex; justify-content: center;	align-items: center; text-align: center; margin: 0px auto; padding:4%">
                            <h2 style="font-family: sans-serif;	color: white; font-size: 50px; font-weight: bold;">PA</h2>
                        </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium" title="Statistics">PENAL ADUANERO</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">
                            <?php
                                $sql1 = "SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'PENAL ADUANERO';";
                                $resultado = mysqli_query($conexion, $sql1);
                                $filas = mysqli_fetch_row($resultado);
                                $total = (int)$filas[0];?>
                                <span class="badge badge-success" data-plugin="counterup" style="font-size: 30px;">
                                    <?php echo $total; ?>
                                </span>
                            </span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }

    $hojas = "SELECT DISTINCT `hoja_area_proceso` FROM hoja INNER JOIN administrador WHERE hoja.administrador_reg = administrador.adm_id AND adm_id = '".$adm_id."';";
    $resul=mysqli_query($conexion,$hojas);
    while($registro = mysqli_fetch_assoc($resul)){ 
        if (!empty($registro)) {
    ?>
            
    <?php
        }else{ ?>

    <?php
        }
    }
?>
