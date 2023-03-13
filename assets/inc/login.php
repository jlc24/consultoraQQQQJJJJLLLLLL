<?php
include("assets/inc/conexion.php");

session_start();
if (isset($_SESSION['adm_id'])) {
	header('Location: index.php');
}
//login https://md5decrypt.net/en/Sha1/
if (isset($_POST['ingresar'])) {
	$usuario = mysqli_real_escape_string($conexion,$_POST['user']);
	$password = mysqli_real_escape_string($conexion,$_POST['pass']);
	$pass_sha1 =  sha1($password);
	$sql = "SELECT adm_id, adm_rol FROM administrador WHERE adm_usuario = '$usuario' AND adm_pass = '$pass_sha1'";
	$resultado = $conexion->query($sql);
	$rows =  $resultado->num_rows;
	if ($rows > 0) {
		$row = $resultado->fetch_assoc();
		$_SESSION['adm_id'] = $row['adm_id'];
        $_SESSION['adm_rol'] = $row['adm_rol'];
        if ($row['adm_rol'] == 'admin' || $row['adm_rol'] == 'user') {
            header('Location: index.php');
        } else {
            header('Location: index.php');
        }
	} else {
		echo "<script>
		alert('Usuario o Password Incorrecto');
		windows.location = 'index.php';
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
                                    </div>
                                    <h5 class="text-uppercase mb-1 mt-4">INICIA SESIÓN</h5>
                                    <p class="mb-0">Inicie sesión en su cuenta de administrador</p>
                                </div>

                                <div class="account-content mt-4">
                                    <form class="form-horizontal" autocomplete="off" action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="user">Nombre de Usuario o Email</label>
                                                <input autocomplete="off" class="form-control" type="text" id="user" name="user" required="" placeholder="Ingrese su Nombre de Usuario">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <!--<a href="page-recoverpw.html" class="text-muted float-right"><small>¿Olvidaste tu contraseña? </small></a>-->
                                                <label for="password">Contraseña</label>
                                                <input autocomplete="off" class="form-control" type="password" id="pass" name="pass" required="" placeholder="Ingresa su Contraseña">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">

                                                <div class="checkbox checkbox-dark">
                                                    <input id="remember" type="checkbox">
                                                    <label for="remember">
                                                        Recuérdame
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group row text-center mt-2">
                                            <div class="col-12">
                                                <button class="btn btn-md btn-block btn-dark waves-effect waves-light" type="submit" name="ingresar">Inicia sesión</button>
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

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-center">
                                                <button type="button" class="btn mr-1 btn-facebook waves-effect waves-light">
                                                    <i class="fab fa-facebook-f"></i>
                                                </button>
                                                <button type="button" class="btn mr-1 btn-googleplus waves-effect waves-light">
                                                    <i class="fab fa-google"></i>
                                                </button>
                                                <button type="button" class="btn mr-1 btn-twitter waves-effect waves-light">
                                                    <i class="fab fa-twitter"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4 pt-2">
                                        <div class="col-sm-12 text-center">
                                            <p class="text-muted mb-0">¿No tienes una cuenta? <a href="register.php" class="text-dark ml-1"><b>Regístrate</b></a></p>
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
            $("#administrador").click(function(){
                $("#user").val("erlan@erlan.com");
                $("#pass").val("erlan");
            });
            $("#vendedor").click(function(){
                $("#user").val("vendedor@vendedor.com");
                $("#pass").val("vendedor");
            });
        });
    </script>
</body>
</html>