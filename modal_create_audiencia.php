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
                <form class="form-horizontal" id="formulario_crear_audiencia_evento_hoja" action="#">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label ui-front">Trámite N°</label>
                        <div class="col-md-8">
                            <input type="hidden" id="hoja_id" name="hoja_id" value="<?php echo $row['hoja_id'];?>">
                            <input type="hidden" id="admin_eve" name="admin_eve" value="<?php echo $admid;?>">
                            <input type="hidden" id="identificador" name="identificador" value="recepcion_file">
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
                            <select class="custom-select custom-select-sm" name="detalle_etapa" id="detalle_etapa">
                                <option value="" disabled>---- SELECCIONAR ----</option>
                                <option value="INICIO">INICIO</option>
                                <option value="SEGUIMIENTO" selected>SEGUIMIENTO</option>
                                <option value="FINALIZADO">FINALIZADO</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Acciones</label>
                        <div class="col-md-8">
                            <select class="custom-select custom-select-sm" name="detalle_accion" id="detalle_accion">
                                <option value="AUDIENCIA" selected>AUDIENCIA</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label ui-front">Fecha Inicio</label>
                        <div class="col-md-8">
                            <input type="datetime-local" id="detalle_inicio" name="detalle_inicio" class="form-control form-control-sm" value="<?php echo date('Y-m-d H:i:s');?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group row" id="create_audiencia">
                        <label class="col-md-4 col-form-label">Fecha Audiencia</label>
                        <div class="col-md-8">
                            <input type="datetime-local" id="detalle_audiencia" name="detalle_audiencia" class="form-control form-control-sm" value="0000-00-00 00:00:00" onchange="showError('detalle_audiencia'); verif('registro')">
                            <span style="color: red;" id="error_detalle_audiencia">(Se requiere Fecha Audiencia)</span>
                        </div>
                    </div>
                    <?php 
                        if ($row['hoja_area_proceso'] == 'PENAL' || $row['hoja_area_proceso'] == 'PENAL ADUANERO') { 
                            if ($row['hoja_num_juzgado'] != '' && $row['hoja_num_sentencia'] == '') { ?>
                                <div class="form-group row" id="juzgado">
                                    <label class="col-md-4 col-form-label">Juzgado </label>
                                    <div class="col-md-8">
                                        <select class="custom-select custom-select-sm" name="juzgado" id="juzgado">
                                            <option value="INSTRUCCION">INSTRUCCION PENAL</option>
                                            <option value="SENTENCIA">SENTENCIA PENAL</option>
                                        </select>
                                        <input type="text" id="detalle_juzgado" name="detalle_juzgado" class="form-control form-control-sm" value="<?php echo $row['hoja_num_juzgado'] ?>" onchange="showError('detalle_juzgado'); verif('registro')">
                                        <span style="color: red;" id="error_detalle_juzgado">(Se requiere Sala de juzgado)</span>
                                    </div>
                                </div>
                        <?php
                            }elseif ($row['hoja_num_juzgado'] == '' && $row['hoja_num_sentencia'] != '') {?>
                                <div class="form-group row" id="juzgado">
                                    <label class="col-md-4 col-form-label">Juzgado </label>
                                    <div class="col-md-8">
                                        <select class="custom-select custom-select-sm" name="juzgado" id="juzgado">
                                            <option value="INSTRUCCION">INSTRUCCION PENAL</option>
                                            <option value="SENTENCIA">SENTENCIA PENAL</option>
                                        </select>
                                        <input type="text" id="detalle_juzgado" name="detalle_juzgado" class="form-control form-control-sm" value="<?php echo $row['hoja_num_sentencia'] ?>" onchange="showError('detalle_juzgado'); verif('registro')">
                                        <span style="color: red;" id="error_detalle_juzgado">(Se requiere Sala de juzgado)</span>
                                    </div>
                                </div>
                    <?php   }elseif ($row['hoja_num_juzgado'] == '' && $row['hoja_num_sentencia'] == '') {?>
                                <div class="form-group row" id="juzgado">
                                    <label class="col-md-4 col-form-label">Juzgado </label>
                                    <div class="col-md-8">
                                        <select class="custom-select custom-select-sm" name="juzgado" id="juzgado">
                                            <option value="INSTRUCCION">INSTRUCCION PENAL</option>
                                            <option value="SENTENCIA">SENTENCIA PENAL</option>
                                        </select>
                                        <input type="text" id="detalle_juzgado" name="detalle_juzgado" class="form-control form-control-sm" value="<?php echo $row['hoja_num_sentencia'] ?>" onchange="showError('detalle_juzgado'); verif('registro')">
                                        <span style="color: red;" id="error_detalle_juzgado">(Se requiere Sala de juzgado)</span>
                                    </div>
                                </div>
                    <?php   }
                        }elseif ($row['hoja_area_proceso'] == 'FAMILIA') { ?>
                            <div class="form-group row" id="juzgado">
                                <label class="col-md-4 col-form-label">Juzgado Público de Familia</label>
                                <div class="col-md-8">
                                    <input type="text" id="detalle_juzgado" name="detalle_juzgado" class="form-control form-control-sm" value="<?php echo $row['hoja_num_juzgado'] ?>" onchange="showError('detalle_juzgado'); verif('registro')">
                                    <span style="color: red;" id="error_detalle_juzgado">(Se requiere Sala de juzgado)</span>
                                </div>
                            </div>
                    <?php        
                        }elseif ($row['hoja_area_proceso'] == 'CIVIL') { ?>
                            <div class="form-group row" id="juzgado">
                                <label class="col-md-4 col-form-label">Juzgado Público Civil y Comercial</label>
                                <div class="col-md-8">
                                    <input type="text" id="detalle_juzgado" name="detalle_juzgado" class="form-control form-control-sm" value="<?php echo $row['hoja_num_juzgado'] ?>" onchange="showError('detalle_juzgado'); verif('registro')">
                                    <span style="color: red;" id="error_detalle_juzgado">(Se requiere Sala de juzgado)</span>
                                </div>
                            </div>
                    <?php        
                        }
                    ?>
                    
                    <div class="form-group row" hidden>
                        <label class="col-md-4 col-form-label">Estado</label>
                        <div class="col-md-8">
                            <input type="text" id="detalle_estado" name="detalle_estado" class="form-control form-control-md" style="text-transform: uppercase;" value="FINALIZADO">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Observación</label>
                        <div class="col-md-8">
                            <textarea class="form-control" rows="3" id="det_observacion" name="det_observacion" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="showError('det_observacion'); verif('registro')"></textarea>
                            <span style="color: red;" id="error_det_observacion">(Se requiere Observacion)</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Encargado Acción</label>
                        <div class="col-md-8">
                            <select class="custom-select custom-select-sm" name="responsable_area" id="responsable_area" onchange="showError('responsable_area'); verif('registro')">
                                <option value="" disabled selected>---- SELECCIONAR ----</option>
                                <?php
                                    $sql="SELECT adm_id, adm_nombre FROM `administrador` WHERE `adm_area` = 'JURIDICA';";
                                    $res=mysqli_query($conexion,$sql);
                                    while ($valores = mysqli_fetch_array($res)) {
                                        echo '<option value="'.$valores['adm_id'].'">'.$valores['adm_nombre'].'</option>';
                                    }
                                ?>
                            </select>
                            <span style="color: red;" id="error_responsable_area">(Elija una opcion)</span>
                        </div>
                    </div>
                </form>
                
            <?php
                }
            ?>