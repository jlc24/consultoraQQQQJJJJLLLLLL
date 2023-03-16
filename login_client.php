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
        $('#form_login').trigger('reset');
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
                                    <h5 class="text-uppercase mb-1 mt-4">QJLWeb 1.0</h5><br>
                                    <p class="mb-0">Consulte su proceso</p>
                                </div>
                                <div class="account-content mt-4">
                                    <form class="form-horizontal" autocomplete="off" action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST" id="form_login">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input autocomplete="off" class="form-control" type="text" min="0" id="ci_nombre" name="ci_nombre" placeholder="Nombre Completo" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <input autocomplete="off" class="form-control" type="number" min="0" id="ci_nit" name="ci_nit" placeholder="Carnet C.I." required>
                                            </div>
                                            <div class="col-1 p-2">
                                                <label for="ci_exp">Exp. </label>
                                            </div>
                                            <div class="col-5">
                                                <select name="ci_exp" id="ci_exp" class="form-control">
                                                    <option value="1">Beni</option>
                                                    <option value="2">Chuquisaca</option>
                                                    <option value="3">Cochabamba</option>
                                                    <option value="4">La Paz</option>
                                                    <option value="5" selected>Oruro</option>
                                                    <option value="6">Pando</option>
                                                    <option value="7">Potosi</option>
                                                    <option value="8">Santa Cruz</option>
                                                    <option value="9">Tarija</option>
                                                </select>
                                            </div>
                                        </div><hr>

                                        <div class="form-group row text-center mt-2 justify-content-center">
                                            <div class="col-12">
                                                <button class="btn btn-md btn-block btn-dark waves-effect waves-light" type="submit" name="ingresar">Consultar Proceso</button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="row mt-4 pt-2">
                                        <div class="col-sm-12 text-center">
                                            <p class="text-muted mb-0">Este Punto de Información le permite consultar el estado de su trámite en línea a través de internet</b></a></p>
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
            $('#ci_nombre').focus();
        });
    </script>
</body>
</html>