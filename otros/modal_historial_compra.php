                        <!-- MODAL QUE MUESTRA EL HISTORIAL DE COMPRA DE UN PRODUCTO -->
                        <div id="modal_historial_compra" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="prod_nombre"></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                            <!-- Muestra los registros en un DataTable desde una consulta MySQL -->
                                            <div id="tabla_compra_historial"></div>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->