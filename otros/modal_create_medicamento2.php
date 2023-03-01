                                    <!-- MODAL PARA REGISTRAR MEDICAMENTO -->
                                    <div id="modal_crear_medicamento" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="myModalLabel">Registrar Medicamento</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" id="formulario_crear_medicamento">
                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label ui-front">Nombre Comercial:</label>
                                                            <div class="col-md-8">
                                                                <input type="search" id="prod_nombre_comercial" name="prod_nombre_comercial" class="form-control form-control-sm" value="" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label">Acción Terapeútica :</label>
                                                            <div class="col-md-8">
                                                                <input type="text" id="prod_propaganda" name="prod_propaganda" class="form-control form-control-sm" value="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label">Forma Farmaceútica :</label>
                                                            <div class="col-md-8">
                                                                <input type="text" id="prod_forma" name="prod_forma" class="form-control form-control-sm" value="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label">Principio Activo (N.G.) :</label>
                                                            <div class="col-md-8">
                                                                <input type="text" id="prod_ingrediente" name="prod_ingrediente" class="form-control form-control-sm" value="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label">Laboratorio Fabricante :</label>
                                                            <div class="col-md-8">
                                                                <input type="text" id="prod_laboratorio" name="prod_laboratorio" class="form-control form-control-sm" value="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label">Nickname Lab. Fabricante :</label>
                                                            <div class="col-md-8">
                                                                <input type="text" id="prod_nicklaboratorio" name="prod_nicklaboratorio" class="form-control form-control-sm" value="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label">Distribuido por (Vendedor) :</label>
                                                            <div class="col-md-8">
                                                                <input type="text" id="prod_representante" name="prod_representante" class="form-control form-control-sm" value="">
                                                            </div>
                                                        </div>
                                                        <h5><p><strong>DATOS PARA EL CONTROL INTERNO DE LA FARMACIA</strong></p></h5>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-3">
                                                                <label class="col-form-label">Código de Farmacia</label>
                                                                <input type="text" id="prod_codigo" name="prod_codigo" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="col-form-label">Stock Mínino</label>
                                                                <input type="number" min="1" id="prod_stock_minimo" name="prod_stock_minimo" class="form-control form-control-sm">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="col-form-label">Ubicación</label>
                                                                <input type="text" id="prod_ubicacion" name="prod_ubicacion" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="col-form-label">Caducidad</label>
                                                                <input type="date" id="prod_caducidad" name="prod_caducidad" class="form-control form-control-sm">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="col-form-label">Código de Barras</label>
                                                                <input type="text" id="prod_barcode" name="prod_barcode" class="form-control form-control-sm">
                                                            </div>
                                                        </div>

                                                        <h5><p><strong>DATOS DE REGISTRO DE LA PRIMERA COMPRA</strong></p></h5>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-3">
                                                                <label class="col-form-label">Cantidad</label>
                                                                <input type="number" min="0" id="prod_stock_inicial" name="prod_stock_inicial" class="form-control form-control-sm">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="col-form-label">P. Compra (Bs)</label>
                                                                <input type="number" min="0" id="prod_precio_compra" name="prod_precio_compra" class="form-control form-control-sm">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="col-form-label">Desc. (%)</label>
                                                                <input type="number" min="0" id="prod_precio_descuento" name="prod_precio_descuento" value="0" class="form-control form-control-sm">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="col-form-label">P. Unitario (Bs)</label>
                                                                <input type="number" min="0" id="prod_precio_unitario" name="prod_precio_unitario" class="form-control form-control-sm">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="col-form-label">P. de Venta (Bs)</label>
                                                                <input type="number" min="0" id="prod_precio_venta" name="prod_precio_venta" class="form-control form-control-sm">
                                                            </div>
                                                            <div class="form-group col-lg-3">
                                                                <label class="col-form-label">Tipo Compra</label>
                                                                <select class="custom-select form-control-sm" id="prod_tipo_compra" name="prod_tipo_compra">
                                                                    <option value="CONTADO">CONTADO</option>
                                                                    <option value="CREDITO">CRÉDITO</option>
                                                                    <option value="OTRO">OTRO</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <label class="col-form-label">Detalle de Compra</label>
                                                                <input type="text" class="form-control form-control-sm" id="prod_detalle" name="prod_detalle" placeholder="Ej. Caja de 48 unidades de 210 Gr.">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="close_medicamento" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                                    <button type="button" id="create_medicamento" class="btn btn-purple waves-effect" data-dismiss="modal">Guardar</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->