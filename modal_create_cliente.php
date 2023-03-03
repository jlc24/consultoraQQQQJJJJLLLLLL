                                    <!-- MODAL PARA REGISTRAR MEDICAMENTO -->
    <div id="modal_crear_cliente" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Registrar Cliente</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="formulario_crear_cliente">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="cli_ci_nit">CI ó NIT:</label>
                            <div class="col-md-9">
                                <input type="number" min="0" id="cli_ci_nit" name="cli_ci_nit" class="form-control form-control-sm">
                                <small><span style="color: red;" id="error_cli_nombre">(Se requiere Nº de carnet de identidad)</span></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="cli_nombre">Nombre:</label>
                            <div class="col-md-9">
                                <input type="text" id="cli_nombre" name="cli_nombre" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off">
                                <small><span style="color: red;" id="error_cli_nombre">(Se requiere nombre)</span></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="cli_genero">Género:</label>
                            <div class="col-md-9">
                                <select class="custom-select custom-select-sm" id="cli_genero" name="cli_genero">
                                    <option value="" selected="" disabled>-&nbsp;-&nbsp;-&nbsp;- SELECCIONAR -&nbsp;-&nbsp;-&nbsp;-</option>
                                    <option value="MASCULINO">MASCULINO</option>
                                    <option value="FEMENINO">FEMENINO</option>
                                    <option value="OTRO">OTRO</option>
                                </select>
                                <small><span style="color: red;" id="error_cli_genero">(Elija una opcion)</span></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="cli_direccion">Dirección:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control form-control-sm" id="cli_direccion" name="cli_direccion" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off">
                                <small><span style="color: red;" id="error_cli_direccion">(Se requiere direccion)</span></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="cli_celular">Celular:</label>
                            <div class="col-md-9">
                                <input type="number" min="0" class="form-control form-control-sm" id="cli_celular" name="cli_celular" autocomplete="off">
                                <small><span style="color: red;" id="error_cli_celular">(Se requiere numero de celular)</span></small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="create_cliente" class="btn btn-purple waves-effect" data-dismiss="modal" disabled>Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->