        <?php include("assets/inc/conexion.php");
                session_start();
                $admid = $_SESSION['adm_id'];
                // OBTENEMOS LOS DATOS DE LA HOJA DE RUTA QUE SE VA ACTUALIZAR
                $sql="SELECT
                            det_id,
                            hoja.`hoja_id`,
                            `cli_id`,
                            `hoja_numero_tramite`,
                            `hoja_demandante`,
                            `hoja_demandado`,
                            `hoja_patrocinio`,
                            `det_etapa`,
                            `det_accion`,
                            `det_inicio`,
                            `det_fin`,
                            `det_estado`,
                            `det_audiencia`,
                            `det_observacion`,
                            `det_encargado`,
                            `det_respuesta_encargado`,
                            `fec_reg_evento`,
                            `enc_reg`,
                            det_envio_ruta_file,
                            det_recepcion_ruta_file    
                        FROM
                            hoja,
                            hoja_detalle
                        WHERE
                            hoja.hoja_id = hoja_detalle.hoja_id AND hoja_detalle.det_id =(SELECT hoja_id FROM configuracion);";
                    $result=mysqli_query($conexion,$sql);
                    if (!empty($result)) {
                        $row = mysqli_fetch_assoc($result);
        ?>
            <form class="form-horizontal" id="formulario_actualizar_hoja_detalle">
                <div class="form-group row">
                    <label class="col-md-4 col-form-label" for="hoja_numero_tramite_show">Nº Trámite</label>
                    <div class="col-md-8">
                        <input type="hidden" id="det_id_show" name="det_id_show">
                        <input type="text" min="0" id="hoja_numero_tramite_show" name="hoja_numero_tramite_show" class="form-control form-control-sm is-valid" value="<?php echo $row['hoja_numero_tramite']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label" for="hoja_demandante_show">Nombre Cliente</label>
                    <div class="col-md-8">
                        <input type="text" id="hoja_demandante_show" name="hoja_demandante_show" class="form-control form-control-sm is-valid" style="text-transform: uppercase;" 
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
                <div class="form-group row" hidden>
                    <label class="col-md-4 col-form-label">Nombre Demandado</label>
                    <div class="col-md-8">
                        <input type="text" id="hoja_demandado_show" name="hoja_demandado_show" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                    </div>
                </div>
                <div class="form-group row" hidden>
                    <label class="col-md-4 col-form-label">Patrocinio</label>
                    <div class="col-md-8">
                        <input type="text" id="hoja_patrocinio_show" name="hoja_patrocinio_show" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                    </div>
                </div>
                <div class="form-group row" hidden>
                    <label class="col-md-4 col-form-label">Tipo Proceso</label>
                    <div class="col-md-8">
                        <input type="text" id="hoja_tipo_proceso_show" name="hoja_tipo_proceso_show" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label" for="det_accion_show">Acción Proceso</label>
                    <div class="col-md-8">
                        <input type="text" id="det_accion_show" name="det_accion_show" class="form-control form-control-sm is-valid" style="text-transform: uppercase;" value="<?php echo $row['det_accion']; ?>" readonly>
                    </div>
                </div>
                <?php
                    if ($row['det_audiencia'] != '0000-00-00 00:00:00') { ?>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="detalle_audiencia">Fecha Audiencia</label>
                            <div class="col-md-8">
                                <input type="datetime-local" id="detalle_audiencia" name="detalle_audiencia" class="form-control form-control-sm is-valid" value="<?php echo $row['det_audiencia']; ?>" readonly>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                
                <div class="form-group row">
                    <label class="col-md-4 col-form-label" for="det_fin_show">Fin Proceso</label>
                    <div class="col-md-8">
                        <input type="text" id="det_fin_show" name="det_fin_show" class="form-control form-control-sm is-valid" style="text-transform: uppercase;" value="<?php echo $row['det_fin']; ?>" readonly>
                    </div>
                </div>
                
                <?php
                    $fecreg = strtotime($row['fec_reg_evento']);
                    $fecfinevento = strtotime($row['det_fin']);
                    if ($fecreg > $fecfinevento) { ?>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="det_reg_show">Registro proceso</label>
                            <div class="col-md-8">
                                <input type="text" id="det_reg_show" name="det_reg_show" class="form-control form-control-sm is-invalid" style="text-transform: uppercase;" 
                                value="<?php 
                                    echo $row['fec_reg_evento']; 
                                ?>" readonly>
                            </div>
                        </div>
                <?php }else { ?>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label" for="det_reg_show">Registro proceso</label>
                        <div class="col-md-8">
                            <input type="text" id="det_reg_show" name="det_reg_show" class="form-control form-control-sm is-valid" style="text-transform: uppercase;" 
                            value="<?php 
                                echo $row['fec_reg_evento']; 
                            ?>" readonly>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                <?php
                    $fecreg = strtotime($row['fec_reg_evento']);
                    $fecfinevento = strtotime($row['det_fin']);
                    if ($fecreg > $fecfinevento) { ?>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="det_etapa_show">Estado Proceso</label>
                            <div class="col-md-8">
                                <input type="text" id="det_etapa_show" name="det_etapa_show" class="form-control form-control-sm is-invalid" style="text-transform: uppercase;" value="<?php echo $row['det_estado']; ?> FUERA DE TIEMPO" readonly>
                            </div>
                        </div>
                <?php }else { ?>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label" for="det_etapa_show">Estado Proceso</label>
                        <div class="col-md-8">
                            <input type="text" id="det_etapa_show" name="det_etapa_show" class="form-control form-control-sm is-valid" style="text-transform: uppercase;" value="<?php echo $row['det_estado']; ?>" readonly>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                <div class="form-group row" >
                    <label class="col-md-4 col-form-label">Archivo Adjunto</label>
                    <div class="col-md-8 custom-file">
                    <?php
                            if ($row['det_recepcion_ruta_file'] == '') { ?>
                                <input type="text" id="recepcion_file" name="recepcion_file" class="form-control form-control-sm" style="text-transform: uppercase;" value="No hay archivos adjuntos" readonly>
                        <?php    
                            }else{ ?>
                                <a type="button" class="btn btn-success btn-sm" href="<?php echo $row['det_recepcion_ruta_file']; ?>" target="_blank" rel="noreferrer noopener">Descargar Archivo Adjunto</a>
                        <?php    
                            }
                        ?>
                    </div>
                </div>
            </form>
                
    <?php
        }
    ?>