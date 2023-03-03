<!-- MODAL PARA REGISTRAR NOTA -->
<?php include("assets/inc/conexion.php");?>
    <!-- MODAL PARA REGISTRAR ACTUALIZAR DATOS DE LA HOJA DE RUTA -->
    <?php
        // OBTENEMOS LOS DATOS DE LA HOJA DE RUTA QUE SE VA ACTUALIZAR
        $sql="SELECT * FROM administrador WHERE adm_id = (SELECT hoja_id FROM configuracion)";
        $result=mysqli_query($conexion,$sql);
        if (!empty($result)) {
            $row = mysqli_fetch_assoc($result);
            //echo $row;
    ?>

                <form class="form-horizontal" id="formulario_actualizar_usuario">
                    <div class="form-group row" hidden>
                        <label class="col-md-4 col-form-label">Nombre Completo</label>
                        <div class="col-md-8">
                            <input type="hidden" class="form-control form-control-sm" id="usuario_id_update" name="usuario_id_update" value="<?php echo $row['adm_id'] ?>">
                            <input type="text" class="form-control form-control-sm" id="usuario_nombre_update" name="usuario_nombre_update" value="<?php echo $row['adm_nombre'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Nombre de Usuario</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm" id="usuario_user_update" name="usuario_user_update" value="<?php echo $row['adm_usuario'] ?>" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Contraseña</label>
                        <div class="col-md-8">
                            <input type="password" class="form-control form-control-sm" id="usuario_pass_update" name="usuario_pass_update" value="<?php echo $row['adm_pass'] ?>" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row" hidden>
                        <label class="col-md-5 col-form-label" for="simpleinput">Rol</label>
                        <div class="col-md-7">
                        <select class="custom-select form-control-sm" id="usuario_rol_update" name="usuario_rol_update">
                            <option selected disabled>&nbsp;-&nbsp;-&nbsp;-&nbsp;-&nbsp;- SELECCIONAR -&nbsp;-&nbsp;-&nbsp;-&nbsp;-&nbsp;</option>
                            <option value="admin">Administrador</option>
                            <option value="user">Usuario</option>
                        </select>
                        </div>
                    </div>
                </form>
            
<?php
}
?>
