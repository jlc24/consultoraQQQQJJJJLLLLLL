    <?php //session_start();
        if (!isset($_SESSION['adm_id'])) {
            header('Location: login.php');
        }
        $admid = $_SESSION['adm_id'];
    ?>
        <!-- MODAL PARA REGISTRAR MEDICAMENTO -->
        <div id="modal_crear_proceso" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Registrar Proceso</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="formulario_crear_proceso" class="parsley_create_hoja" novalidate="">
                            <fieldset title="1">
                                <legend style="display: none;">Datos del Proceso</legend>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="proceso_nombre">Nombre Proceso</label>
                                    <div class="col-md-9">
                                        <input type="text" id="proceso_nombre" name="proceso_nombre" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); showError('proceso_nombre'); ">
                                        <small><span style="color: red;" id="error_proceso_nombre">(Se requiere nombre)</span></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="proceso_cod" >Codigo de Proceso</label>
                                    <div class="col-md-9">
                                        <input type="text" id="proceso_cod" name="proceso_cod" class="form-control form-control-sm" autocomplete="off" onkeyup="showError('proceso_cod');" placeholder="EJ: QJF">
                                        <small><span style="color: red;" id="error_proceso_cod">(Se requiere Codigo)</span></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="proceso_area">Área</label>
                                    <div class="col-md-9">
                                        <select class="custom-select custom-select-sm" id="proceso_area" name="proceso_area" onchange="showError('proceso_area')">
                                            <option value="" selected="" disabled>---------- SELECCIONAR ----------</option>
                                            <?php
                                                $sql_area = "SELECT area_id, area_nombre FROM area;";
                                                $resultado = mysqli_query($conexion, $sql_area);
                                                while ($reg = mysqli_fetch_assoc($resultado)) { ?>
                                                    <option value="<?php echo $reg['area_id']; ?>"><?php echo $reg['area_nombre']; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                        <small><span style="color: red;" id="error_proceso_area" >(Elija una opcion)</span></small>
                                    </div>
                                </div>
                            </fieldset>
                            <button type="button" id="create_proceso" class="btn btn-purple waves-effect stepy-finish" data-dismiss="modal">Guardar</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->