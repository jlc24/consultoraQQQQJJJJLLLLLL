                                    <!-- MODAL PARA REGISTRAR MEDICAMENTO -->
                                    <div id="modal_dolar_boliviano" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="myModalLabel">Convertir USD/BOB</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" id="formulario_dolar_boliviano">
                                                        <div class="form-group row">
                                                            <label class="col-md-8 col-form-label" for="simpleinput"><i class="flag-icon flag-icon-us"></i> USD - Dólar Americano</label>
                                                            <div class="col-md-4">
                                                                <input type="number" min="1" id="usd" name="usd" class="form-control form-control-sm" value="1">
                                                            </div>
                                                        </div>
                                                        <input type="hidden" id="tipo_cambio" name="tipo_cambio" value="<?php $consulta = "SELECT tipo_cambio FROM configuracion";
                                                                        $fila = mysqli_fetch_row(mysqli_query($conexion,$consulta));
                                                                        echo number_format((float)$fila[0], 2, '.', ''); ?>" >
                                                        <div class="form-group row">
                                                            <label class="col-md-8 col-form-label" for="simpleinput"><i class="flag-icon flag-icon-bo"></i> BOB - Boliviano de Bolivia</label>
                                                            <div class="col-md-4">
                                                                <input type="number" id="bob" name="bob" class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="close_importe" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                                    <button type="button" id="create_importe" class="btn btn-purple waves-effect" data-dismiss="modal">Registrar Importe</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->