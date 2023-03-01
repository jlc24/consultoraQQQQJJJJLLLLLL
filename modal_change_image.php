
            <div id="modal_cambiar_imagen" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Cambiar foto de perfil</h4>
                        </div>
                        <div class="modal-body" id="subir_archivo">
                            <form class="form-horizontal" id="formulario_file_evento_hoja">
                                <div class="form-group row">
                                    <label class="col-md-8 col-form-label"> </label>
                                    <div class="col-md-4">
                                        <input type="hidden" id="adminid" name="adminid" value="<?php echo $adm_id;?>">
                                        <input type="hidden" id="identificador" name="identificador" value="envio_file">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="custom-file">
                                        <input type="file" id="uploadFile" name="uploadFile" class="form-control" accept="image/*">
                                    </div>
                                </div>
                                
                                <div class="modal-footer">
                                    <button  class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" id="upload_image" class="btn btn-purple waves-effect" >Guardar imagen</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            