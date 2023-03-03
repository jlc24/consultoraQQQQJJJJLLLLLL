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
                <form class="form-horizontal" id="formulario_crear_evento_hoja" action="#">
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
                            <select class="custom-select custom-select-sm" name="detalle_etapa" id="detalle_etapa" onchange="showError('detalle_etapa'); verificar()">
                                <option value="" disabled selected >---- SELECCIONAR ----</option>
                                <option value="INICIO">INICIO</option>
                                <option value="SEGUIMIENTO">SEGUIMIENTO</option>
                                <option value="FINALIZADO">FINALIZADO</option>
                            </select>
                            <small><span style="color: red;" id="error_detalle_etapa">(Elija una opcion)</span></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Acciones</label>
                        <div class="col-md-8">
                            <select class="custom-select custom-select-sm" name="detalle_accion" id="detalle_accion" onchange="showInp(); verificar()">
                                <option value="" disabled selected >---- SELECCIONAR ----</option>
                                <option value="PROYECTAR">PROYECTAR</option>
                                <option value="PRESENTAR">PRESENTAR</option>
                                <option value="SEGUIMIENTO">SEGUIMIENTO</option>
                                <option value="AUDIENCIA">AUDIENCIA</option>
                            </select>
                            <small><span style="color: red;" id="error_accion">(Elija una opcion)</span></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label ui-front">Fecha Inicio</label>
                        <div class="col-md-8">
                            <input type="datetime-local" id="detalle_inicio" name="detalle_inicio" class="form-control form-control-sm" value="<?php echo date('Y-m-d H:i');?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row" id="respuesta" style="display: none;">
                        <label class="col-md-4 col-form-label" >Fecha Respuesta</label>
                        <div class="col-md-8">
                            <input type="datetime-local" id="detalle_fecha_fin" name="detalle_fecha_fin" class="form-control form-control-sm" onchange="showError('detalle_fecha_fin'); verificar()">
                            <small><span style="color: red;" id="error_detalle_fecha_fin">(Se requiere Fecha Fin)</span></small>
                        </div>
                    </div>
                    <div class="form-group row" id="audiencia" style="display: none;">
                        <label class="col-md-4 col-form-label">Fecha Audiencia</label>
                        <div class="col-md-8">
                            <input type="datetime-local" id="detalle_audiencia" name="detalle_audiencia" class="form-control form-control-sm" onchange="showError('detalle_audiencia'); verificar()">
                            <small><span style="color: red;" id="error_detalle_audiencia">(Se requiere Fecha Audiencia)</span></small>
                        </div>
                    </div>
                    <?php 
                        if ($row['hoja_area_proceso'] == 'PENAL' || $row['hoja_area_proceso'] == 'PENAL ADUANERO') { ?>
                            <div class="form-group row" id="juzgado" style="display: none;">
                                <label class="col-md-4 col-form-label">Juzgado </label>
                                <div class="col-md-8">
                                    <select class="custom-select custom-select-sm" name="lugar_juzgado" id="lugar_juzgado" onchange="showError('lugar_juzgado');">
                                        <option value="" disabled selected>---- SELECCIONAR ----</option>
                                        <option value="INSTRUCCION PENAL">INSTRUCCION PENAL</option>
                                        <option value="SENTENCIA PENAL">SENTENCIA PENAL</option>
                                    </select>
                                    <small><span style="color: red;" id="error_lugar_juzgado">(Se requiere Sala de juzgado)</span></small>
                                    <input type="text" id="detalle_juzgado" name="detalle_juzgado" class="form-control form-control-sm" onchange="showError('detalle_juzgado'); verificar()">
                                    <small><span style="color: red;" id="error_detalle_juzgado">(Se requiere Sala de juzgado)</span></small>
                                </div>
                            </div>
                        <?php
                        }elseif ($row['hoja_area_proceso'] == 'FAMILIA') { ?>
                            <div class="form-group row" id="juzgado" style="display: none;">
                                <label class="col-md-4 col-form-label">Juzgado Público de Familia</label>
                                <div class="col-md-8">
                                    <input type="hidden" id="lugar_juzgado" name="lugar_juzgado" value="Público de Familia">
                                    <input type="text" id="detalle_juzgado" name="detalle_juzgado" class="form-control form-control-sm" onchange="showError('detalle_juzgado'); verificar()">
                                    <small><span style="color: red;" id="error_detalle_juzgado">(Se requiere Sala de juzgado)</span></small>
                                </div>
                            </div>
                    <?php        
                        }elseif ($row['hoja_area_proceso'] == 'CIVIL') { ?>
                            <div class="form-group row" id="juzgado" style="display: none;">
                                <label class="col-md-4 col-form-label">Juzgado Público Civil y Comercial</label>
                                <div class="col-md-8">
                                    <input type="hidden" id="lugar_juzgado" name="lugar_juzgado" value="Público Civil y Comercial">
                                    <input type="text" id="detalle_juzgado" name="detalle_juzgado" class="form-control form-control-sm" onchange="showError('detalle_juzgado'); verificar()">
                                    <small><span style="color: red;" id="error_detalle_juzgado">(Se requiere Sala de juzgado)</span></small>
                                </div>
                            </div>
                    <?php        
                        }elseif ($row['hoja_area_proceso'] == 'AIT') { ?>
                            <div class="form-group row" id="juzgado" style="display: none;" hidden>
                                <label class="col-md-4 col-form-label">Juzgado Público Civil y Comercial</label>
                                <div class="col-md-8">
                                    <input type="hidden" id="lugar_juzgado" name="lugar_juzgado" value="AIT">
                                    <input type="text" id="detalle_juzgado" name="detalle_juzgado" value="0" class="form-control form-control-sm" onchange="showError('detalle_juzgado'); verificar()">
                                    <small><span style="color: red;" id="error_detalle_juzgado">(Se requiere Sala de juzgado)</span></small>
                                </div>
                            </div>
                    <?php        
                        }elseif ($row['hoja_area_proceso'] == 'ADUANA') { ?>
                            <div class="form-group row" id="juzgado" style="display: none;" hidden>
                                <label class="col-md-4 col-form-label">Juzgado Público Civil y Comercial</label>
                                <div class="col-md-8">
                                    <input type="hidden" id="lugar_juzgado" name="lugar_juzgado" value="ADUANA">
                                    <input type="text" id="detalle_juzgado" name="detalle_juzgado" value="0" class="form-control form-control-sm" onchange="showError('detalle_juzgado'); verificar()">
                                    <small><span style="color: red;" id="error_detalle_juzgado">(Se requiere Sala de juzgado)</span></small>
                                </div>
                            </div>
                    <?php        
                        }elseif ($row['hoja_area_proceso'] == 'ADMINISTRATIVO') { ?>
                            <div class="form-group row" id="juzgado" style="display: none;" hidden>
                                <label class="col-md-4 col-form-label">Juzgado Público Civil y Comercial</label>
                                <div class="col-md-8">
                                    <input type="hidden" id="lugar_juzgado" name="lugar_juzgado" value="ADMINISTRATIVO">
                                    <input type="text" id="detalle_juzgado" name="detalle_juzgado" value="0" class="form-control form-control-sm" onchange="showError('detalle_juzgado'); verificar()">
                                    <small><span style="color: red;" id="error_detalle_juzgado">(Se requiere Sala de juzgado)</span></small>
                                </div>
                            </div>
                    <?php        
                        }
                    ?>
                    
                    <div class="form-group row" hidden>
                        <label class="col-md-4 col-form-label">Estado</label>
                        <div class="col-md-8">
                        <input type="text" id="detalle_estado" name="detalle_estado" class="form-control form-control-md" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="EJECUCION">
                        </div>
                    </div>
                    <div class="form-group row" style="display: none;" id="det_obs">
                        <label class="col-md-4 col-form-label">Observación</label>
                        <div class="col-md-8">
                            <textarea class="form-control" rows="3" id="detalle_observacion" name="detalle_observacion" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" onchange="showError('detalle_observacion'); verificar()"></textarea>
                            <small><span style="color: red;" id="error_detalle_observacion">(Se requiere Observacion)</span></small>
                        </div>
                    </div>
                    <div class="form-group row" id="field_f" style="display: none;">
                        <label class="col-md-4 col-form-label">Adjuntar archivos</label>
                    </div>
                    <div class="form-group row" id="field_file" style="display: none;">
                        <div class="col-md-12">
                            <input type="file" id="uploadFile" name="uploadFile" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row" style="display: none;" id="resp_area">
                        <label class="col-md-4 col-form-label">Encargado Acción</label>
                        <div class="col-md-8">
                            <select class="custom-select custom-select-sm" name="responsable_area" id="responsable_area" onchange="showError('responsable_area'); verificar()">
                                <option value="" disabled selected>---- SELECCIONAR ----</option>
                                <?php
                                    $sql="SELECT adm_id, adm_nombre FROM `administrador` WHERE `adm_area` = 'JURIDICA';";
                                    $res=mysqli_query($conexion,$sql);
                                    while ($valores = mysqli_fetch_array($res)) {
                                        echo '<option value="'.$valores['adm_id'].'">'.$valores['adm_nombre'].'</option>';
                                    }
                                ?>
                            </select>
                            <small><span style="color: red;" id="error_responsable_area">(Elija una opcion)</span></small>
                        </div>
                    </div>

                </form>
                
            <?php
                }
            ?>