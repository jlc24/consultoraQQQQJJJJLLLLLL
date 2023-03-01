                                    <!-- MODAL PARA REGISTRAR MEDICAMENTO -->
                                    <div id="modal_actualizar_cliente" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="myModalLabel">Actualizar Datos del Cliente</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" id="formulario_actualizar_cliente">
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">CI ó NIT:</label>
                                                            <div class="col-md-7">
                                                                <input type="hidden" id="cli_id" name="cli_id">
                                                                <input type="number" min="0" id="cli_ci_nit_update" name="cli_ci_nit_update" class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Nombre Completo :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" id="cli_nombre_update" name="cli_nombre_update" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Género :</label>
                                                            <div class="col-md-7">
                                                            <select class="custom-select custom-select-sm" id="cli_genero_update" name="cli_genero_update">
                                                                <option selected="">-- SELECCIONAR --</option>
                                                                <option value="FEMENINO">FEMENINO</option>
                                                                <option value="MASCULINO">MASCULINO</option>
                                                                <option value="OTRO">OTRO</option>
                                                            </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Dirección :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control form-control-sm" id="cli_direccion_update" name="cli_direccion_update" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Celular :</label>
                                                            <div class="col-md-7">
                                                                <input type="number" min="0" class="form-control form-control-sm" id="cli_celular_update" name="cli_celular_update">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="cerrar_cliente" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                                    <button type="button" id="update_cliente" class="btn btn-purple waves-effect" data-dismiss="modal">Actualizar</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->