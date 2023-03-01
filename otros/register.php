<?php
include("assets/inc/conexion.php");

session_start();
if (isset($_SESSION['adm_id'])) {
	header('Location: index.php');
}

//Registrar usuario
if (isset($_POST["registrar"])) {
	$nombre = mysqli_real_escape_string($conexion,$_POST['nombre']);
	$user = mysqli_real_escape_string($conexion,$_POST['user']);
	$pass = mysqli_real_escape_string($conexion,$_POST['pass']);
	$pass_sha1 =  sha1($pass);
	$sqluser = "SELECT adm_id FROM administrador WHERE adm_usuario = '$user'";
	$resultadouser = $conexion -> query($sqluser);
	$filas = $resultadouser->num_rows;
	if ($filas > 0) {
		echo "<script>alert('El usuario ya existe'); windows.location = 'register.php';</script>";
	} else {
		//Insertamos informacion del usuario
		$sqlusuario = "INSERT INTO administrador(adm_id, adm_nombre, adm_usuario, adm_pass, adm_rol) VALUES (NULL,'$nombre','$user','$pass_sha1','usuario')";
		$resultadousuario = $conexion -> query($sqlusuario);
		if ($resultadousuario > 0) {
			echo "<script>
            alert('Registro exitoso !');
            window.open('login.php', '_self')
            document.getElementById('formulario_registro').reset();
			</script>";
            unset($_POST);
		} else {
			echo "<script>
			alert('Error al registrarse');
            window.open('register.php', '_self')
			</script>";
		}
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
                                    <h5 class="text-uppercase mb-1 mt-4">Registro</h5>
                                    <p class="mb-0">‎‎Obtén acceso al sistema‎</p>
                                </div>

                                <div class="account-content mt-4">
                                    <form id="formulario_registro" class="form-horizontal" action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
                                        <div class="form-group row">
                                                <div class="col-12">
                                                    <label for="username">Nombre Completo</label>
                                                    <input class="form-control" type="text" id="nombre" name="nombre" required="" placeholder="Nombres y Apellidos">
                                                </div>
                                            </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="user">Nombre de Usuario o Email</label>
                                                <input class="form-control" type="text" id="user" name="user" required="" placeholder="nombresapellidos@gmail.com">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="password">‎Contraseña‎</label>
                                                <input class="form-control" type="password" id="pass" name="pass" required="" placeholder="Introduzca su contraseña">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <div class="checkbox checkbox-dark">
                                                    <input id="remember" type="checkbox" checked="">
                                                    <label for="remember">
                                                    Acepto <a href="#">‎‎términos y condiciones‎</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row text-center mt-2">
                                            <div class="col-12">
                                                <button class="btn btn-md btn-block btn-dark waves-effect waves-light" type="submit" name="registrar">‎Regístrese</button>
                                            </div>
                                        </div>

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
                                                <p class="text-muted">‎¿Ya tienes una cuenta? ‎<a href="login.php" class="text-dark ml-1"><b>Iniciar sesión‎‎</b></a></p>
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

</body>
</html>