                                    <!-- MODAL PARA REGISTRAR MEDICAMENTO -->
                                    <div id="modal_actualizar_recuento" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="myModalLabel">Actualizar Inventario e Inversión</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" id="formulario_actualizar_recuento">
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Código :</label>
                                                            <div class="col-md-7">
                                                                <input type="hidden" id="prod_id_update" name="prod_id_update" readonly>
                                                                <input type="text" id="prod_codigo_update" name="prod_codigo_update" class="form-control form-control-sm" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Nombre Comercial :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" id="prod_nombre_comercial_update" name="prod_nombre_comercial_update" class="form-control form-control-sm" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Forma :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" id="prod_forma_update" name="prod_forma_update" class="form-control form-control-sm" readonly>
                                                            </div>
                                                        </div>
                                                        <!--<div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Principio Activo :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" id="prod_ingrediente_update" name="prod_ingrediente_update" class="form-control form-control-sm" readonly>
                                                            </div>
                                                        </div>-->
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Laboratorio :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" id="prod_laboratorio_update" name="prod_laboratorio_update" class="form-control form-control-sm" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Caducidad :</label>
                                                            <div class="col-md-7">
                                                                <input type="date" id="prod_caducidad_update" name="prod_caducidad_update" class="form-control form-control-sm" min=<?php echo date("Y-m-d");?>>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Código de Barras :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" id="prod_barcode_update" name="prod_barcode_update" class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Stock :</label>
                                                            <div class="col-md-7">
                                                                <input type="number" min="0" id="prod_stock_update" name="prod_stock_update" class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Precio de Compra (Bs) :</label>
                                                            <div class="col-md-7">
                                                                <input type="number" id="prod_precio_compra_update" name="prod_precio_compra_update" class="form-control form-control-sm" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Inversión (Bs) :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" id="prod_inversion_update" name="prod_inversion_update" class="form-control form-control-sm"  value="" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-5 col-form-label">Fecha :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" id="prod_fecha_actualizacion" name="prod_fecha_actualizacion" class="form-control form-control-sm" value="<?php echo date('m-d-Y h:i:s a', time());?>" readonly>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="cerrar_recuento" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                                    <button type="button" id="update_recuento" class="btn btn-purple waves-effect" data-dismiss="modal">Actualizar Inventario</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->