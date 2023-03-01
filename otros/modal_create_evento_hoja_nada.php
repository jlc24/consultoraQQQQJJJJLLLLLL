            <?php include("assets/inc/conexion.php");?>
            <!-- MODAL PARA REGISTRAR UN EVNTO DE LA HOJA DE RUTA -->
            <?php
                // OBTENEMOS LOS DATOS DE LA HOJA DE RUTA QUE SE VA ACTUALIZAR
                $sql="SELECT * FROM hoja WHERE hoja_id = (SELECT hoja_id FROM configuracion)";
                $result=mysqli_query($conexion,$sql);
                if (!empty($result)) {
                    $row = mysqli_fetch_assoc($result);
            ?>
                <form class="form-horizontal" id="formulario_crear_evento_hoja">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label ui-front">Trámite N°</label>
                        <div class="col-md-8">
                            <input type="hidden" id="hoja_id" name="hoja_id" value="<?php echo $row['hoja_id'];?>">
                            <input type="text" id="hoja_numero_tramite" name="hoja_numero_tramite" class="form-control form-control-sm" value="<?php echo $row['hoja_numero_tramite'];?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label ui-front">Solicitante</label>
                        <div class="col-md-8">
                            <input type="text" id="hoja_nombre_solicitante" name="hoja_nombre_solicitante" class="form-control form-control-sm" value="<?php echo $row['hoja_nombre_solicitante'];?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Etapa del Proceso</label>
                        <div class="col-md-8">
                            <input type="text" id="detalle_etapa" name="detalle_etapa" class="form-control form-control-md" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Acciones</label>
                        <div class="col-md-8">
                            <textarea class="form-control" rows="2" id="detalle_accion" name="detalle_accion" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label ui-front">Fecha Inicio</label>
                        <div class="col-md-8">
                            <input type="date" id="detalle_inicio" name="detalle_inicio" class="form-control form-control-sm" value="<?php echo date('Y-m-d');?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Fecha Respuesta</label>
                        <div class="col-md-8">
                            <input type="date" id="detalle_fin" name="detalle_fin" class="form-control form-control-sm" value="<?php $row['hoja_fecha_salida'];?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Fecha Audiencia</label>
                        <div class="col-md-8">
                            <input type="date" id="detalle_audiencia" name="detalle_audiencia" class="form-control form-control-sm" value="<?php $row['hoja_fecha_salida'];?>">
                        </div>
                    </div>

                    <!--<div class="form-group row">
                        <label class="col-md-4 col-form-label">Estado</label>
                        <div class="col-md-8">
                            <select class="custom-select custom-select-sm" id="detalle_estado" name="detalle_estado">
                                <option value="INICIAL">INICIAL</option>
                                <option value="PROCESO">EN PROCESO</option>
                                <option value="EJECUCION" selected>EN EJECUCIÓN</option>
                                <option value="FINALIZADO">FINALIZADO</option>
                            </select>
                        </div>
                    </div>-->
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Observación</label>
                        <div class="col-md-8">
                            <textarea class="form-control" rows="3" id="detalle_observacion" name="detalle_observacion" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Encargado Acción</label>
                        <div class="col-md-8">
                            <input type="text" id="detalle_encargado" name="detalle_encargado" class="form-control form-control-md" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                    </div>
                </form>
            <?php
                }
            ?>