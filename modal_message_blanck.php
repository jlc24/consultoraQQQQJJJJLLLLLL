<!-- MODAL PARA REGISTRAR UN EVNTO DE LA HOJA DE RUTA -->
<?php //include("assets/inc/conexion.php");
    //session_start();
    $admid = $_SESSION['adm_id'];
    // OBTENEMOS LOS DATOS DE LA HOJA DE RUTA QUE SE VA ACTUALIZAR
    ?>
    <div id="modal_mensaje_blanco" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Mensaje Nuevo</h4>
                </div>
                <div class="modal-body" id="contenido_mensaje_blanco">
                    <form class="form-horizontal" id="formulario_mensaje_blanco">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="simpleinput">Para :</label>
                            <div class="col-md-9">
                                <input type="hidden" id="adm_id_blanco" name="adm_id_blanco" value="<?php echo $admid; ?>">
                                <input type="hidden" id="enc_id_blanco" name="enc_id_blanco">
                                <input autofocus type="text" id="destino_mensaje_blanco" name="destino_mensaje_blanco" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="simpleinput">Asunto :</label>
                            <div class="col-md-9">
                                <input type="text" id="asunto_blanco" name="asunto_blanco" class="form-control form-control-sm" value="" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Mensaje :</label>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="4" id="desc_mensaje_blanco" name="desc_mensaje_blanco" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="enviar_mensaje_blanco" class="btn btn-purple waves-effect" data-dismiss="modal">Enviar mensaje</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
            