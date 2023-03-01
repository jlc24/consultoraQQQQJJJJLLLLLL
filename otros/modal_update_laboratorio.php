                                    <!-- MODAL PARA REGISTRAR MEDICAMENTO -->
                                    <div id="modal_actualizar_laboratorio" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="myModalLabel">Actualizar datos del Laboratorio</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" id="formulario_actualizar_laboratorio">
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Nombre Laboratorio:</label>
                                                            <div class="col-md-7">
                                                                <input type="hidden" id="lab_id" name="lab_id">
                                                                <input type="text" id="lab_nombre_update" name="lab_nombre_update" class="form-control form-control-sm" value="" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Nick Laboratorio :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" id="lab_nick_update" name="lab_nick_update" class="form-control form-control-sm" value="" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Dirección :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" id="lab_direccion_update" name="lab_direccion_update" class="form-control form-control-sm" value="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Email :</label>
                                                            <div class="col-md-7">
                                                                <input type="email" id="lab_email_update" name="lab_email_update" class="form-control form-control-sm" value="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Website :</label>
                                                            <div class="col-md-7">
                                                                <input type="url" id="lab_web_update" name="lab_web_update" class="form-control form-control-sm" value="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label" for="example-date">Preventista :</label>
                                                            <div class="col-md-7">
                                                                <textarea class="form-control" rows="3" id="lab_preventista_update" name="lab_preventista_update"></textarea>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="cerrar_laboratorio" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                                    <button type="button" id="update_laboratorio" class="btn btn-purple waves-effect" data-dismiss="modal">Actualizar</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->