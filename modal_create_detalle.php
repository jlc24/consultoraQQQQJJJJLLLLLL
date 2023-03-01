                                <!-- MODAL PARA REGISTRAR UN PRODUCTO EN -->
                                <div id="modal_crear_detalle" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">AGREGAR PRODUCTO</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" id="formulario_crear_detalle">
                                                    <!--=================================
                                                    =  DATOS DEL PRODUCTO SELECCIONADO  =
                                                    ==================================-->
                                                    <div class="form-row">
                                                        <div class="form-group col-sm-8">
                                                            <label class="col-form-label">Nombre Comercial</label>
                                                            <input type="hidden" class="form-control" readonly="" id="prod_id" name="prod_id">
                                                            <input type="text" class="form-control" readonly="" id="prod_nombre" name="prod_nombre" value="" style="background-color:#EBF9D6;">
                                                        </div>
                                                        <div class="form-group col-sm-2">
                                                            <label class="col-form-label">Precio</label>
                                                            <input type="hidden" class="form-control" readonly="" id="prod_precio_compra" name="prod_precio_compra" value="">
                                                            <input type="text" class="form-control" readonly="" id="prod_precio_venta" name="prod_precio_venta" value="" style="background-color:#EBF9D6;">
                                                        </div>
                                                        <div class="form-group col-sm-2">
                                                            <label class="col-form-label">Stock</label>
                                                            <input type="text" class="form-control" readonly="" id="prod_stock" name="prod_stock" value="" style="background-color:#EBF9D6;">
                                                        </div>

                                                        <div class="form-group col-sm-3">
                                                            <label class="col-form-label">Código</label>
                                                            <input type="text" class="form-control" readonly="" id="prod_codigo" name="prod_codigo" value="">
                                                        </div>
                                                        <div class="form-group col-sm-5">
                                                            <label class="col-form-label">Forma</label>
                                                            <input type="text" class="form-control" readonly="" id="prod_forma" name="prod_forma" value="">
                                                        </div>
                                                        <div class="form-group col-sm-4">
                                                            <label class="col-form-label">Caducidad</label>
                                                            <input type="text" class="form-control" readonly="" id="prod_caducidad" name="prod_caducidad" value="">
                                                        </div>

                                                        <div class="form-group col-sm-4">
                                                            <label class="col-form-label">Cantidad</label>
                                                            <input type="number" min="1" step="1" class="form-control" id="prod_cantidad" name="prod_cantidad" value="">
                                                        </div>
                                                        <div class="form-group col-sm-4">
                                                            <label class="col-form-label">Descuento</label>
                                                            <div class="input-group">
                                                                <input type="number" value="0" min="0" max="100" step="10" class="form-control" id="prod_descuento" name="prod_descuento">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-sm-4">
                                                            <label class="col-form-label">Sub Total</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" readonly="" id="prod_subtotal" name="prod_subtotal" value="0">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Bs</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" class="form-control" readonly="" id="prod_utilidad" name="prod_utilidad" value="0">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal" id="cerrar_detalle">Cerrar (Esc)</button>
                                                <button type="button" class="btn btn-purple waves-effect" data-dismiss="modal" id="create_detalle">Agregar (Intro)</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

