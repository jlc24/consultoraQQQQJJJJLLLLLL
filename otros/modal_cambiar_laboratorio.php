                                    <!-- MODAL PARA REGISTRAR MEDICAMENTO -->
                                    <div id="modal_cambiar_laboratorio" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="myModalLabel">Laboratorio Fabricante</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" id="formulario_cambiar_laboratorio">
                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label">Nick Laboratorio :</label>
                                                            <div class="col-md-8">
                                                            <select class="form-control mb-2 mr-sm-2" id="prod_nicklaboratorio" name="prod_nicklaboratorio">
                                                                <option disabled selected> - - - SELECCIONAR - - - </option>
                                                                <?php
                                                                    $sql="SELECT DISTINCT prod_nicklaboratorio FROM producto ORDER BY prod_nicklaboratorio";
                                                                    $resultado=mysqli_query($conexion,$sql);
                                                                    while($nombre_lab = mysqli_fetch_row($resultado)){//mientras haya filas (nombres de laboratorios) a recorrer
                                                                    echo utf8_encode('<option value="'.$nombre_lab[0].'">'.$nombre_lab[0].'</option>');
                                                                    }
                                                                ?>
                                                            </select>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="close_laboratorio" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                                    <button type="button" id="cambiar_laboratorio" class="btn btn-purple waves-effect" data-dismiss="modal">Seleccionar</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->