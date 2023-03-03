    <?php //session_start();
        if (!isset($_SESSION['adm_id'])) {
            header('Location: login.php');
        }
        $admid = $_SESSION['adm_id'];
    ?>
        <!-- MODAL PARA REGISTRAR MEDICAMENTO -->
        
            <form class="form-horizontal" id="formulario_crear_administrador" class="parsley_create_hoja" novalidate="">
                <fieldset title="1">
                    <legend style="display: none;">Datos del Administrador</legend>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="adm_ci_nit_update" >C.I.</label>
                        <div class="col-md-9">
                            <input type="number" min="0" id="adm_ci_nit_update" name="adm_ci_nit_update" class="form-control form-control-sm" autocomplete="off" onkeyup="showError('adm_ci_nit'); verificar()">
                            <small><span style="color: red;" id="error_adm_ci_nit">(Se requiere Nº carnet de identidad)</span></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="adm_nombre_update">Nombre</label>
                        <div class="col-md-9">
                            <input type="text" id="adm_nombre_update" name="adm_nombre_update" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); showError('adm_nombre'); verificar()">
                            <small><span style="color: red;" id="error_adm_nombre">(Se requiere nombre)</span></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="adm_direccion_update">Dirección</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control form-control-sm" id="adm_direccion_update" name="adm_direccion_update" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <small><span style="color: red;" id="error_adm_direccion" hidden>(Elija una opcion)</span></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="adm_celular_update">Celular</label>
                        <div class="col-md-9">
                            <input type="number" min="0" class="form-control form-control-sm" id="adm_celular_update" name="adm_celular_update" autocomplete="off">
                            <small><span style="color: red;" id="error_adm_celular" hidden>(Elija una opcion)</span></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="adm_area_update">Área</label>
                        <div class="col-md-9">
                            <select class="custom-select custom-select-sm" id="adm_area_update" name="adm_area_update" onchange="showError('adm_area')">
                                <option value="" selected="" disabled>---------- SELECCIONAR ----------</option>
                                <option value="JURIDICO">JURÍDICO</option>
                                <option value="CONTABLE">CONTABLE</option>
                                <option value="MARKETING">MARKETING</option>
                            </select>
                            <small><span style="color: red;" id="error_adm_area" >(Elija una opcion)</span></small>
                        </div>
                    </div>
                </fieldset>
                <fieldset title="2">
                    <legend style="display: none;">Datos de la cuenta</legend>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="usuario_user">Nombre de Usuario</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control form-control-sm" id="usuario_user" name="usuario_user" onkeyup="showError('usuario_user'); verificar()">
                            <small><span style="color: red;" id="error_usuario_user">(Se requiere usuario)</span></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="usuario_pass">Contraseña</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control form-control-sm" id="usuario_pass" name="usuario_pass" onchange="showErrorPass('usuario_pass'); verificar()">
                            <small><span style="color: red;" id="error_usuario_pass">(Se requiere contraseña)</span></small>
                            <small><span style="color: red; display: none;" id="error_usuario_pass_noverif">(Las contraseñas no coinciden)</span></small>
                            <small><span style="color: green; display: none;" id="error_usuario_pass_ok">(Contraseñas verificadas)</span></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="usuario_pass_verif">Verificar Contraseña</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control form-control-sm" id="usuario_pass_verif" name="usuario_pass_verif" onchange="showErrorPass('usuario_pass_verif'); verifPass(); verificar()">
                            <small><span style="color: red;" id="error_usuario_pass_verif">(Verificar contraseña)</span></small>
                            <small><span style="color: red; display: none;" id="error_usuario_pass_noverif2">(Las contraseñas no coinciden)</span></small>
                            <small><span style="color: green; display: none;" id="error_usuario_pass_ok2">(Contraseñas verificadas)</span></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="simpleinput">Foto de perfil</label>
                        <div class="custom-file col-md-9">
                            <input type="file" id="upload_foto" name="upload_foto" class="form-control" accept="image/*">
                        </div>
                    </div>
                </fieldset>
                <button type="button" id="create_administrador" class="btn btn-purple waves-effect stepy-finish" data-dismiss="modal" disabled>Guardar</button>
            </form>
                    