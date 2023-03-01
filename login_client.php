<?php
include("assets/inc/conexion.php");

session_start();
if (isset($_SESSION['ci_nit'])) {
	header('Location: cliente_info.php');
}
//login https://md5decrypt.net/en/Sha1/
if (isset($_POST['ingresar'])) {
	$cli_ci_nit = mysqli_real_escape_string($conexion,$_POST['ci_nit']);
	$sql = "SELECT * FROM cliente WHERE cli_ci_nit = '$cli_ci_nit'";
	$resultado = $conexion->query($sql);
	$rows =  $resultado->num_rows;
	if ($rows > 0) {
		$row = $resultado->fetch_assoc();
		$_SESSION['ci_nit'] = $row['cli_ci_nit'];
        if (isset($_SESSION['ci_nit'])) {
            header('Location: cliente_info.php');
        }
        else{
            header('Location: login_client.php');
        }
	} else {
		echo "<script>
		alert('Carnet de Identidad incorrecto');
		windows.location = 'login_client.php';
		</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include 'assets/inc/head.php'; ?>
</head>

<body class="authentication-bg bg-warning authentication-bg-pattern d-flex align-items-center pb-0 vh-100">
    <div class="account-pages w-100 mt-5 mb-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mb-0">

                        <div class="card-body p-4">

                            <div class="account-box">
                                <div class="account-logo-box">
                                    <div class="text-center">
                                        <img src="assets/images/logo-dark.png" alt="" height="45">
                                    </div><hr>
                                    <h5 class="text-uppercase mb-1 mt-4">QJLWeb 1.0</h5>
                                    <p class="mb-0">Consulte su proceso con su Carnet de Identidad</p>
                                </div>
                                
                                <div class="account-content mt-4">
                                    <form class="form-horizontal" autocomplete="off" action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="user">Número de Identidad</label>
                                                <input autocomplete="off" class="form-control" type="number" min="0" id="ci_nit" name="ci_nit" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">

                                             <br>

                                            </div>
                                        </div>

                                        <div class="form-group row text-center mt-2">
                                            <div class="col-12">
                                                <button class="btn btn-md btn-block btn-dark waves-effect waves-light" type="submit" name="ingresar">Consultar Proceso</button>
                                            </div>
                                        </div>
                                        <!--
                                        <div class="form-group row text-center mt-2">
                                            <div class="col-6">
                                                <button class="btn btn-md btn-block btn-dark waves-effect waves-light" type="button" id="administrador" name="administrador" value="">Administrador</button>
                                            </div>
                                            <div class="col-6">
                                                <button class="btn btn-md btn-block btn-dark waves-effect waves-light" type="button" id="vendedor" name="vendedor" value="">Vendedor</button>
                                            </div>
                                        </div>
                                        -->
                                    </form>

                                    <div class="row mt-4 pt-2">
                                        <div class="col-sm-12 text-center">
                                            <p class="text-muted mb-0">Este Punto de Información le permite consultar el estado su trámite, en línea, a través de internet</b></a></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#ci_nit').focus();
        });
    </script>
</body>
</html>