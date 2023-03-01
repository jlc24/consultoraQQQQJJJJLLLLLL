                        <!-- MODAL PARA REGISTRAR HOJA DE RUTA -->
                        <div id="modal_crear_hoja" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">Registrar Hoja de Ruta - Familia</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formulario_crear_hoja_familia" action="#" class="parsley_create_hoja" novalidate="">
                                          <fieldset title="1">
                                            <legend style="display: none;">Datos del Cliente</legend>
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label ui-front">Nombre Completo</label>
                                                    <!-- <div class="col-md-8">
                                                        <input type="search" id="prod_nombre_comercial" name="prod_nombre_comercial" class="form-control form-control-sm" value="" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" parsley-trigger="change" data-parsley-error-message="‎Este valor es obligatorio.‎" required>
                                                    </div>-->
                                                    <div class="col-md-8 input-group">
                                                    <input type="hidden" class="form-control form-control-md" id="cli_id" name="cli_id">
                                                        <input type="text" class="form-control form-control-md" id="hoja_nombre_solicitante" name="hoja_nombre_solicitante">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <a href="#" data-toggle="modal" data-target="#modal_crear_cliente" title="Registrar Cliente"><i style="color: purple;" class="far fa-user"></i></a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">CI ó NIT</label>
                                                    <div class="col-md-8">
                                                        <input type="number" min= "0" id="hoja_ci_solicitante" name="hoja_ci_solicitante" class="form-control form-control-md" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Celular</label>
                                                    <div class="col-md-8">
                                                        <input type="number" min="0" id="hoja_celular_solicitante" name="hoja_celular_solicitante" class="form-control form-control-md" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Actor Jurídico</label>
                                                    <div class="col-md-8">
                                                        <select class="custom-select custom-select-sm" id="hoja_actor" name="hoja_actor">
                                                            <option selected="">---- SELECCIONAR ----</option>
                                                            <option value="IMPUTADO">DEMANDANTE</option>
                                                            <option value="VICTIMA">DEMANDADO</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Opositor</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="hoja_opositor" name="hoja_opositor" class="form-control form-control-md">
                                                    </div>
                                                </div>
                                          </fieldset>
                                          <fieldset title="2">
                                            <legend style="display: none;">Datos del Caso</legend>
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Trámite N°</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="hoja_numero_tramite" name="hoja_numero_tramite" 
                                                        class="form-control form-control-md" style="text-transform: uppercase;" 
                                                        onkeyup="javascript:this.value=this.value.toUpperCase();" 
                                                        value="<?php $fila = mysqli_fetch_row(mysqli_query($conexion,"SELECT COUNT(*) FROM hoja"));
                                                        $numero_hoja_ruta = (int)$fila[0]+1; echo 'QJ'.$numero_hoja_ruta ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Fecha de Inicio</label>
                                                    <div class="col-md-8">
                                                        <input type="datetime-local" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}" id="hoja_fecha_ingreso" name="hoja_fecha_ingreso" class="form-control form-control-md" value="<?php echo Date('Y-m-d\TH:i',time()) ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Tipo de Proceso</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="hoja_tipo_proceso" name="hoja_tipo_proceso" class="form-control form-control-md">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Juzgado Público de Familia </label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="hoja_num_juzgado" name="hoja_num_juzgado" class="form-control form-control-md">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">NUREJ</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="hoja_nurej" name="hoja_nurej" class="form-control form-control-md">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Etapa del Proceso</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="hoja_etapa_proceso" name="hoja_etapa_proceso" class="form-control form-control-md">
                                                    </div>
                                                </div>
                                                <!--<div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Fecha de Salida</label>
                                                    <div class="col-md-8">
                                                        <input type="datetime-local" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}" id="hoja_fecha_salida" name="hoja_fecha_salida" class="form-control form-control-md">
                                                    </div>
                                                </div>-->
                                          </fieldset>
                                          <fieldset title="3">
                                            <legend style="display: none;">Datos del Destinatario</legend>
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Referencia</label>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control" rows="2" id="hoja_referencia" name="hoja_referencia" style="text-transform: uppercase;"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Área Destino</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="hoja_area_destino" name="hoja_area_destino" class="form-control form-control-md" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Responsable de área</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="hoja_responsable_area" name="hoja_responsable_area" class="form-control form-control-md">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Observación</label>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control" rows="2" id="hoja_observacion" name="hoja_observacion" style="text-transform: uppercase;"></textarea>
                                                    </div>
                                                </div>
                                                <!--
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Área Destino</label>
                                                    <div class="col-md-8">
                                                        <select class="custom-select custom-select-sm" id="prod_tipo_compra" name="prod_tipo_compra">
                                                            <option value="JURIDICA">JURÍDICA</option>
                                                            <option value="CONTABLE">CONTABLE</option>
                                                            <option value="MARKETING">MARKETING</option>
                                                        </select>
                                                    </div>
                                                </div>-->
                                          </fieldset>
                                          <button type="button" id="create_hoja_familia" class="btn btn-purple stepy-finish" data-dismiss="modal">Guardar</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->