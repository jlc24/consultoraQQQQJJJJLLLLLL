                                    <!-- MODAL PARA REGISTRAR MEDICAMENTO -->
                                    <div id="modal_crear_laboratorio" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="myModalLabel">Registrar Laboratorio</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" id="formulario_crear_laboratorio">
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Nombre Laboratorio:</label>
                                                            <div class="col-md-7">
                                                                <input type="text" id="lab_nombre" name="lab_nombre" class="form-control form-control-sm" value="" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Nick Laboratorio :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" id="lab_nick" name="lab_nick" class="form-control form-control-sm" value="" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Dirección :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" id="lab_direccion" name="lab_direccion" class="form-control form-control-sm" value="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Email :</label>
                                                            <div class="col-md-7">
                                                                <input type="email" id="lab_email" name="lab_email" class="form-control form-control-sm" value="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Website :</label>
                                                            <div class="col-md-7">
                                                                <input type="url" id="lab_web" name="lab_web" class="form-control form-control-sm" value="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Preventista :</label>
                                                            <div class="col-md-7">
                                                                <textarea class="form-control" rows="3" id="lab_preventista" name="lab_preventista"></textarea>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="cerrar_laboratorio" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                                    <button type="button" id="create_laboratorio" class="btn btn-purple waves-effect" data-dismiss="modal">Guardar</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->