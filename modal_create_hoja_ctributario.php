    <!-- MODAL PARA REGISTRAR HOJA DE RUTA -->
    <?php //session_start();
        if (!isset($_SESSION['adm_id'])) {
            header('Location: login.php');
        }
        $admid = $_SESSION['adm_id'];
    ?>
    <div id="modal_crear_hoja" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Registrar Hoja de Ruta Contencioso Tributario</h4>
                </div>
                <div class="modal-body">
                    <form id="formulario_crear_hoja" action="#" class="parsley_create_hoja" novalidate="">
                        <fieldset title="1">
                        <legend style="display: none;">Datos del Cliente</legend>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label ui-front">Nombre del Cliente</label>
                                
                                <div class="col-md-8 input-group">
                                    <input type="hidden" class="form-control form-control-md" id="cli_id" name="cli_id">
                                    <input type="hidden" class="form-control form-control-md" id="area_proceso" name="area_proceso" value="CONTENCIOSO TRIBUTARIO">
                                    <input type="hidden" class="form-control form-control-md" id="admin" name="admin" value="<?php echo $admid; ?>">
                                    <input type="text" class="form-control form-control-md" id="hoja_nombre_solicitante" name="hoja_nombre_solicitante" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <a href="#" data-toggle="modal" data-target="#modal_crear_cliente" title="Registrar Cliente"><i style="color: purple;" class="far fa-user"></i></a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Patrocinio</label>
                                <div class="col-md-8">
                                    <input type="text" id="hoja_actor_cliente" name="hoja_actor_cliente" class="form-control form-control-md" value="DEMANDANTE" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label ui-front">En contra de</label>
                                <div class="col-md-8">
                                    <input type="text" id="hoja_nom_contra" name="hoja_nom_contra" class="form-control form-control-md" onkeyup="javascript:this.value=this.value.toUpperCase(); verificarCliente()">
                                </div>
                            </div>
                            <div class="form-group row" hidden>
                                <label class="col-md-4 col-form-label">Actor Jurídico</label>
                                <div class="col-md-8">
                                    <select class="custom-select custom-select-sm" id="hoja_actor_contra" name="hoja_actor_contra">
                                        <option selected="">---- SELECCIONAR ----</option>
                                        <option value="DEMANDANTE">DEMANDANTE</option>
                                        <option value="DEMANDADO">DEMANDADO</option>
                                    </select>
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
                                    value="<?php $fila = mysqli_fetch_row(mysqli_query($conexion,"SELECT COUNT(*) FROM hoja WHERE hoja_area_proceso = 'CIVIL';"));
                                    $numero_hoja_ruta = (int)$fila[0]+1; echo 'QJCT-'.$numero_hoja_ruta ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">NUREJ</label>
                                <div class="col-md-8">
                                    <input type="text" id="hoja_id_proc" name="hoja_id_proc" class="form-control form-control-md" onkeyup="verificarCliente()">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Fecha de Ingreso</label>
                                <div class="col-md-8">
                                    <input type="datetime-local" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}" id="hoja_fecha_ingreso" name="hoja_fecha_ingreso" class="form-control form-control-md" value="<?php echo Date('Y-m-d\TH:i',time()) ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Tipo de Proceso</label>
                                <div class="col-md-8">
                                    <input type="text" id="hoja_tipo_delito" name="hoja_tipo_delito" class="form-control form-control-md" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-6 col-form-label">Juzgado de Partido del Trabajo y Seguridad Social Administrativo, Coactivo Fiscal y Tributario</label>
                                <div class="col-md-6">
                                    <input type="text" id="hoja_num_juzgado" name="hoja_num_juzgado" class="form-control form-control-md" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                            </div>
                            
                            <div class="form-group row" hidden>
                                <label class="col-md-4 col-form-label">Fiscalía e Interno</label>
                                <div class="col-md-8">
                                    <input type="text" id="hoja_fiscalia_interno" name="hoja_fiscalia_interno" class="form-control form-control-md" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Etapa del Proceso</label>
                                <div class="col-md-8">
                                    <input type="text" id="hoja_etapa_proceso" name="hoja_etapa_proceso" class="form-control form-control-md" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                            </div>
                            
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
                            
                        </fieldset>
                        <button type="button" id="create_hoja" class="btn btn-purple stepy-finish" data-dismiss="modal">Guardar</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->