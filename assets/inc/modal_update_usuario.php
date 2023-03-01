<!-- MODAL PARA REGISTRAR NOTA -->
<div id="modal_actualizar_usuario" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Actualizar Datos de la cuenta</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="formulario_actualizar_usuario">
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Nombre Completo :</label>
                        <div class="col-md-7">
                            <input type="hidden" class="form-control form-control-sm" id="usuario_id_update" name="usuario_id_update">
                            <input type="text" class="form-control form-control-sm" id="usuario_nombre_update" name="usuario_nombre_update">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Nombre de Usuario :</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control form-control-sm" id="usuario_user_update" name="usuario_user_update">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Contraseña :</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control form-control-sm" id="usuario_pass_update" name="usuario_pass_update">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label" for="simpleinput">Rol :</label>
                        <div class="col-md-7">
                        <select class="custom-select form-control-sm" id="usuario_rol_update" name="usuario_rol_update">
                            <option selected="">&nbsp;-&nbsp;-&nbsp;-&nbsp;-&nbsp;- SELECCIONAR -&nbsp;-&nbsp;-&nbsp;-&nbsp;-&nbsp;</option>
                            <option value="admin">Administrador</option>
                            <option value="user">Usuario</option>
                        </select>
                        </div>
                    </div>
                    <!--<div class="form-group row">
                        <label class="col-md-5 col-form-label">Fecha y Hora:</label>
                        <div class="col-md-7">
                            <input type="text" min="0" id="nota_fecha_hora_update" name="nota_fecha_hora_update" class="form-control form-control-sm" value="<?php echo date('m-d-Y h:i:s a', time());?>" readonly>
                        </div>
                    </div>-->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="close_usuario" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                <button type="button" id="update_usuario" class="btn btn-purple waves-effect" data-dismiss="modal">Actualizar Cuenta</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->