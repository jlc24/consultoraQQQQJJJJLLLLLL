<!-- MODAL PARA REGISTRAR, ACTUALIZAR Y BORRAR UN EVENTO -->
<div id="modal_crear_evento" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabelEventoCalendar">Registrar Evento en la Agenda</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="formulario_crear_evento">
                    <!--<div class="form-group row">
                        <label class="col-md-5 col-form-label" for="simpleinput">ID:</label>
                        <div class="col-md-7">
                            <input type="number" min="0" id="id" name="id" class="form-control form-control-sm" value="">
                        </div>
                    </div>-->
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label" for="simpleinput">Nombre del Evento :</label>
                        <div class="col-md-7">
                            <input type="hidden" id="eventoId" name="eventoId" class="form-control form-control-sm">
                            <input type="text" id="eventoNombre" name="eventoNombre" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label" for="simpleinput">Fecha de Inicio :</label>
                        <div class="col-md-7">
                            <input type="datetime-local" id="inicioEvento" name="inicioEvento" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label" for="simpleinput">Fecha de Finalización :</label>
                        <div class="col-md-7">
                            <input type="datetime-local" id="finEvento" name="finEvento" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label" for="simpleinput">Descripción del Evento :</label>
                        <div class="col-md-7">
                            <textarea id="descripcionEvento" name="descripcionEvento" class="form-control form-control-sm" value="" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label" for="simpleinput">Área :</label>
                        <div class="col-md-7">
                        <select class="custom-select custom-select-sm" id="areaEvento" name="areaEvento">
                            <option selected="" style="text-align:center">-&nbsp;-&nbsp;-&nbsp;- SELECCIONAR -&nbsp;-&nbsp;-&nbsp;-</option>
                            <option value="JURIDICA">JURÍDICA</option>
                            <option value="CONTABLE">CONTABLE</option>
                            <option value="MARKETING">MARKETING</option>
                            <option value="OTRO">OTRO</option>
                        </select>
                        </div>
                    </div>
                    <!--<div class="form-group row">
                        <label class="col-md-5 col-form-label" for="simpleinput">Color Texto :</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control form-control-sm" id="textoEvento" name="textoEvento" value="" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label" for="simpleinput">Color Fondo :</label>
                        <div class="col-md-7">
                            <input type="text" min="0" class="form-control form-control-sm" id="fondoEvento" name="fondoEvento" value="">
                        </div>
                    </div>-->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="close_evento" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                <button type="button" id="create_evento" class="btn btn-purple waves-effect" data-dismiss="modal">Guardar</button>
                <button type="button" id="update_evento" class="btn btn-purple waves-effect" data-dismiss="modal">Actualizar</button>
                <button type="button" id="delete_evento" class="btn btn-purple waves-effect" data-dismiss="modal" hidden>Borrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->