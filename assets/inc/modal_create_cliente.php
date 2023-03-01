                                    <!-- MODAL PARA REGISTRAR MEDICAMENTO -->
                                    <div id="modal_crear_cliente" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="myModalLabel">Registrar Cliente</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" id="formulario_crear_cliente">
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label" for="simpleinput">CI ó NIT:</label>
                                                            <div class="col-md-7">
                                                                <input type="number" min="0" id="cli_ci_nit" name="cli_ci_nit" class="form-control form-control-sm" value="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label" for="simpleinput">Nombre Completo :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" id="cli_nombre" name="cli_nombre" class="form-control form-control-sm" value="" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label" for="simpleinput">Género :</label>
                                                            <div class="col-md-7">
                                                                <select class="custom-select custom-select-sm" id="cli_genero" name="cli_genero">
                                                                    <option selected="">---- SELECCIONAR ----</option>
                                                                    <option value="MASCULINO">MASCULINO</option>
                                                                    <option value="FEMENINO">FEMENINO</option>
                                                                    <option value="OTRO">OTRO</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label" for="simpleinput">Dirección :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control form-control-sm" id="cli_direccion" name="cli_direccion" value="" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label" for="simpleinput">Celular :</label>
                                                            <div class="col-md-7">
                                                                <input type="number" min="0" class="form-control form-control-sm" id="cli_celular" name="cli_celular" value="">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="close_cliente" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                                    <button type="button" id="create_cliente" class="btn btn-purple waves-effect" data-dismiss="modal">Guardar</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->