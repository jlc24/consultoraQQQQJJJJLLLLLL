            <!-- MODAL PARA REGISTRAR UN EVNTO DE LA HOJA DE RUTA -->
            <?php include("assets/inc/conexion.php");
                session_start();
                $admid = $_SESSION['adm_id'];
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
                            <input type="hidden" class="form-control form-control-md" id="admin" name="admin" value="<?php echo $admid; ?>">
                            <input type="text" id="hoja_numero_tramite" name="hoja_numero_tramite" class="form-control form-control-sm" value="<?php echo $row['hoja_numero_tramite'];?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label ui-front">Cliente</label>
                        <div class="col-md-8">
                            <input type="text" id="nombre_update_cliente" name="nombre_update_cliente" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" 
                                value="<?php 
                                    if ($row['hoja_patrocinio'] == 'VICTIMA' || $row['hoja_patrocinio'] == 'DEMANDANTE' || $row['hoja_patrocinio'] == 'DENUNCIANTE') {
                                        echo $row['hoja_demandante'];
                                    }elseif ($row['hoja_patrocinio'] == 'IMPUTADO' || $row['hoja_patrocinio'] == 'DEMANDADO' || $row['hoja_patrocinio'] == 'DENUNCIADO') {
                                        echo $row['hoja_demandado'];
                                    }elseif ($row['hoja_patrocinio'] == 'RECURRENTE') {
                                        echo $row['hoja_demandante'];
                                    }elseif ($row['hoja_patrocinio'] == 'ADMINISTRADO') {
                                        echo $row['hoja_demandante'];
                                    }
                                ?>" readonly>
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
                            <input type="datetime-local" id="detalle_inicio" name="detalle_inicio" class="form-control form-control-sm" value="<?php echo date('Y-m-d h:i:s');?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Fecha Respuesta</label>
                        <div class="col-md-8">
                            <input type="datetime-local" id="detalle_fin" name="detalle_fin" class="form-control form-control-sm" value="0000-00-00 00:00:00">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Fecha Audiencia</label>
                        <div class="col-md-8">
                            <input type="datetime-local" id="detalle_audiencia" name="detalle_audiencia" class="form-control form-control-sm" value="0000-00-00 00:00:00">
                        </div>
                    </div>
                    <div class="form-group row" hidden>
                        <label class="col-md-4 col-form-label">Estado</label>
                        <div class="col-md-8">
                        <input type="text" id="detalle_estado" name="detalle_estado" class="form-control form-control-md" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="EJECUCION">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Observación</label>
                        <div class="col-md-8">
                            <textarea class="form-control" rows="3" id="detalle_observacion" name="detalle_observacion" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Encargado Acción</label>
                        <div class="col-md-8">
                            <select class="custom-select custom-select-sm" name="responsable_area" id="responsable_area">
                                <option select="">---- SELECCIONAR ----</option>
                                <?php
                                    $sql="SELECT adm_id, adm_nombre FROM `administrador` WHERE `adm_area` = 'JURIDICA';";
                                    $res=mysqli_query($conexion,$sql);
                                    while ($valores = mysqli_fetch_array($res)) {
                                        echo '<option value="'.$valores['adm_id'].'">'.$valores['adm_nombre'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </form>
            <?php
                }
            ?>