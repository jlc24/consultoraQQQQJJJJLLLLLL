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
    <style>
        input[readonly], input[readonly="readonly"] {
            background-color: white !important;
        }
	</style>
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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Panel de Control</a></li>
                                        <li class="breadcrumb-item active">Parámetros</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Configuración de Parámetros</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!--========================================
                        =            Contenido Principal           =
                    =========================================-->
                    <?php include "modal_update_usuario.php"; ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <h4 class="header-title">Tipo de Cambio</h4>
                                <!--<p class="sub-header">
                                    You may also swap <code class="highlighter-rouge">.row</code> for <code class="highlighter-rouge">.form-row</code>, a variation of our standard grid row that overrides the default column gutters for tighter and more compact layouts.
                                </p>-->

                                <form id="update_form_tipo_cambio">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                        <label class="col-md-8 col-form-label"><i class="flag-icon flag-icon-us" style="height:24px;width:32px;"></i> USD - Dólar Americano</label>
                                            <div class="input-group input-group-lg">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">&nbsp;$&nbsp;</span>
                                                </div>
                                                <input type="text" class="form-control" aria-label="Username" value="1" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label class="col-md-8 col-form-label"><i class="flag-icon flag-icon-bo" style="height:24px;width:32px;"></i> BOB - Boliviano de Bolivia</label>
                                            <div class="input-group input-group-lg">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Bs.</span>
                                                </div>
                                                <input
                                                  type="number"
                                                  step="0.01"
                                                  class="form-control" id="tipo_cambio" name="tipo_cambio"
                                                  aria-label="Username"
                                                  value="<?php $consulta = "SELECT tipo_cambio FROM configuracion";
                                                  $fila = mysqli_fetch_row(mysqli_query($conexion,$consulta));
                                                  echo number_format((float)$fila[0], 2, '.', ''); ?>">
                                                  
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-purple" id="update_tipo_cambio">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <h4 class="header-title"><a style="color:purple;" href="#" data-toggle="modal" data-target="#modal_crear_usuario" title="Registrar Administrador o Vendedor">
                                            <i class="far fa-plus-square"></i></a>&nbsp;Administración de Usuarios del Sistema</h4>
                                <!-- inicio tabla usuarios -->
                                <div class="card-box table-responsive" id="tabla_usuario">

                                </div>
                                <!-- fin tabla usuarios -->
                            </div>
                        </div>
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
        //CARGAMOS TODOS LOS USUARIOS DEL SISTEMA, ADMINISTRADORES Y VENDEDORES
        $('#tabla_usuario').load('tabla_usuario.php');
        //EDITAR DATOS DE USUARIOS
        function EditarUsuario(datos){
            //alert(datos);
            vector=datos.split('||');
            $('#usuario_id_update').val(vector[0]);
            $('#usuario_nombre_update').val(vector[1]);
            $('#usuario_user_update').val(vector[2]);
            $('#usuario_pass_update').val(vector[3]);
            $('#usuario_rol_update').val(vector[4]);
        }

        // ACTUALIZACION DATOS DE USUARIOS
        $('#update_usuario').click(function(){
                var datos = $('#formulario_actualizar_usuario').serialize();
                //alert(datos); return false;
                $.ajax({
                    type:"POST",
                    url:"assets/inc/update_usuario.php",
                    data:datos,
                    success:function(response){
                        if(response==1){
                            $('#tabla_usuario').load('tabla_usuario.php');
                            Swal.fire({
                                type: 'success',
                                title: 'Actualizacion Exitosamente.',
                                showConfirmButton: false,
                                    timer: 2000//1500
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
        });


        $(document).ready(function() {
            // ACTUALIZACION DEL % DE UTILIDAD QUE SE ASIGNA A LA BILLETERA VIRTUAL DEL CLIENTE
            $('#update_utilidad_billetera').click(function(){
                var datos = $('#update_form_billetera').serialize();
                //alert(datos); return false;
                $.ajax({
                    type:"POST",
                    url:"assets/inc/update_billetera.php",
                    data:datos,
                    success:function(response){
                        if (response == 1) {
                            Swal.fire({
                                type: 'success',
                                title: 'Actualización Exitosamente',
                                showConfirmButton: false,
                                timer: 2000
                            })
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
            // ACTUALIZACION DEL TIPO DE CAMBIO PARA VENTAS CON MONEDA EXTRANJERA (DOLAR)
            $('#update_tipo_cambio').click(function(){
                var datos = $('#update_form_tipo_cambio').serialize();
                //alert(datos); return false;
                $.ajax({
                    type:"POST",
                    url:"assets/inc/update_tipo_cambio.php",
                    data:datos,
                    success:function(response){
                        if (response == 1) {
                            Swal.fire({
                                type: 'success',
                                title: 'Actualización Exitosamente',
                                showConfirmButton: false,
                                timer: 2000
                            })
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
            //Editar Datos de la cuenta del usuario
            $('#modal_actualizar_usuario').on('shown.bs.modal',function(){
                    //$('#nota_titulo').trigger('focus'); $('#prod_stock_update').focus();
            });

        });
    </script>
</body>
</html>