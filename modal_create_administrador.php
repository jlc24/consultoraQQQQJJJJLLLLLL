                                    <!-- MODAL PARA REGISTRAR MEDICAMENTO -->
                                    <div id="modal_crear_administrador" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="myModalLabel">Registrar Administrador</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" id="formulario_crear_administrador">
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label" for="simpleinput">Carnet de Identidad :</label>
                                                            <div class="col-md-7">
                                                                <input type="number" min="0" id="adm_ci_nit" name="adm_ci_nit" class="form-control form-control-sm" value="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label" for="simpleinput">Nombre Completo :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" id="adm_nombre" name="adm_nombre" class="form-control form-control-sm" value="" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                            </div>
                                                        </div>
                                                        <!--<div class="form-group row">
                                                            <label class="col-md-5 col-form-label" for="simpleinput">Género :</label>
                                                            <div class="col-md-7">
                                                            <select class="custom-select custom-select-sm" id="adm_genero" name="adm_genero">
                                                                <option selected="" style="text-align:center">-&nbsp;-&nbsp;-&nbsp;- SELECCIONAR -&nbsp;-&nbsp;-&nbsp;-</option>
                                                                <option value="MASCULINO">MASCULINO</option>
                                                                <option value="FEMENINO">FEMENINO</option>
                                                            </select>
                                                            </div>
                                                        </div>-->
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label" for="simpleinput">Dirección :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control form-control-sm" id="adm_direccion" name="adm_direccion" value="" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label" for="simpleinput">Celular :</label>
                                                            <div class="col-md-7">
                                                                <input type="number" min="0" class="form-control form-control-sm" id="adm_celular" name="adm_celular" value="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label" for="simpleinput">Área Laboral :</label>
                                                            <div class="col-md-7">
                                                            <select class="custom-select custom-select-sm" id="adm_area" name="adm_area">
                                                                <option selected="" style="text-align:center">-&nbsp;-&nbsp;-&nbsp;- SELECCIONAR -&nbsp;-&nbsp;-&nbsp;-</option>
                                                                <option value="JURIDICO">JURÍDICO</option>
                                                                <option value="CONTABLE">CONTABLE</option>
                                                                <option value="MARKETING">MARKETING</option>
                                                            </select>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="close_administrador" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                                    <button type="button" id="create_administrador" class="btn btn-purple waves-effect" data-dismiss="modal">Guardar</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->