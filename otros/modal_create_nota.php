<!-- MODAL PARA REGISTRAR NOTA -->
<div id="modal_crear_nota" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Registrar Nota</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="formulario_crear_nota">
                    <div class="form-group row">
                        <!--<label class="col-md-5 col-form-label" for="simpleinput">Adm_id :</label>-->
                        <div class="col-md-7">
                            <input type="hidden" class="form-control form-control-sm" id="adm_id" name="adm_id" value="<?php echo utf8_decode($row['adm_id']); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Administrador :</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control form-control-sm" id="nota_usuario" name="nota_usuario" value="<?php echo utf8_decode($row['adm_nombre']); ?>" style="text-transform: uppercase;" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Título de la nota :</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control form-control-sm" id="nota_titulo" name="nota_titulo" style="text-transform: uppercase;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Contenido de la nota :</label>
                        <div class="col-md-7">
                            <textarea class="form-control" rows="5" id="nota_comentario" name="nota_comentario" style="text-transform: uppercase;"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Fecha y Hora:</label>
                        <div class="col-md-7">
                            <input type="text" min="0" id="nota_fecha_hora" name="nota_fecha_hora" class="form-control form-control-sm" value="<?php echo date('m-d-Y h:i:s a', time());?>" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="close_nota" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                <button type="button" id="create_nota" class="btn btn-purple waves-effect" data-dismiss="modal">Registrar Nota</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->