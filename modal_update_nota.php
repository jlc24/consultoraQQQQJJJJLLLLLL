<!-- MODAL PARA REGISTRAR NOTA -->
<div id="modal_actualizar_nota" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Actualizar Nota</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="formulario_actualizar_nota">
                    <div class="form-group row">
                        <!--<label class="col-md-5 col-form-label" for="simpleinput">Adm_id :</label>-->
                        <div class="col-md-7">
                            <input type="hidden" class="form-control form-control-sm" id="not_id" name="not_id" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Administrador :</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control form-control-sm" id="nota_usuario_update" name="nota_usuario_update" value="<?php echo utf8_decode($row['adm_nombre']); ?>" style="text-transform: uppercase;" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Título de la nota :</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control form-control-sm" id="nota_titulo_update" name="nota_titulo_update" style="text-transform: uppercase;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Contenido de la nota :</label>
                        <div class="col-md-7">
                            <textarea class="form-control" rows="5" id="nota_comentario_update" name="nota_comentario_update" style="text-transform: uppercase;"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label" for="simpleinput">Estado :</label>
                        <div class="col-md-7">
                        <select class="custom-select form-control-sm" id="nota_estado_update" name="nota_estado_update">
                            <option selected="">&nbsp;--- SELECCIONAR ---&nbsp;</option>
                            <option value="1">VISIBLE POR DEFECTO</option>
                            <option value="0">ARCHIVAR NOTA</option>
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
                <button type="button" id="close_nota" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                <button type="button" id="update_nota" class="btn btn-purple waves-effect" data-dismiss="modal">Actualizar Nota</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->