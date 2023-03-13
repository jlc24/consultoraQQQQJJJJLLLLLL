    <?php //session_start();
        if (!isset($_SESSION['adm_id'])) {
            header('Location: login.php');
        }
        $admid = $_SESSION['adm_id'];
    ?>
        <!-- MODAL PARA REGISTRAR MEDICAMENTO -->
        <div id="modal_crear_area" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Registrar Área</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="formulario_crear_area" class="parsley_create_hoja" novalidate="">
                            <fieldset title="1">
                                <legend style="display: none;">Datos del Área</legend>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="area_nombre">Nombre Área</label>
                                    <div class="col-md-9">
                                        <input type="text" id="area_nombre" name="area_nombre" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); showError('area_nombre'); ">
                                        <small><span style="color: red;" id="error_area_nombre">(Se requiere nombre)</span></small>
                                    </div>
                                </div>
                            </fieldset>
                            <button type="button" id="create_area" class="btn btn-purple waves-effect stepy-finish" data-dismiss="modal">Guardar</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->