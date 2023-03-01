    <!-- MODAL PARA REGISTRAR MEDICAMENTO -->
    <?php include("assets/inc/conexion.php");
        function fechaletra($fecha){
            $hora = date('H:i', strtotime($fecha));
            $day = date('d',strtotime($fecha."- 1 days"));
            $month = date('m',strtotime($fecha));
            $year = date('Y',strtotime($fecha));
            $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
            $letra = $day.' de '.$meses[$month - 1].' de '.$year." ".$hora;
            return $letra;
        }
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
                    det_envio_ruta_file,
                    `fec_reg_evento`,
                    `enc_reg`    
                FROM
                    hoja,
                    hoja_detalle
                WHERE
                    hoja.hoja_id = hoja_detalle.hoja_id AND hoja_detalle.det_id =(SELECT hoja_id FROM configuracion);";
            $result=mysqli_query($conexion,$sql);
            if (!empty($result)) {
                $row = mysqli_fetch_assoc($result);
    ?>
    
        <form class="form-horizontal" id="formulario_actualizar_hoja_detalle" enctype="multipart/form-data">
            <?php
            if ($row['det_audiencia'] != '0000-00-00 00:00:00') { ?>
                <div class="row">
                    <div class="col-6 py-1" style="border-style: solid; border-color: #32C861; border-width: 1px; border-radius: 5px; background-color: #BAECCA;">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">N Trámite</label>
                            <div class="col-md-8">
                                <input type="hidden" id="hoja_id" name="hoja_id" value="<?php echo $row['hoja_id'];?>">
                                <input type="hidden" id="detalle_id" name="detalle_id" value="<?php echo $row['det_id'] ?>">
                                <input type="text" min="0" id="hoja_numero_tramite_update" name="hoja_numero_tramite_update" class="form-control form-control-sm" value="<?php echo $row['hoja_numero_tramite']; ?>" readonly>
                                <input type="hidden" id="admin_eve" name="admin_eve" value="<?php echo $admid;?>">
                                <input type="hidden" id="identificador" name="identificador" value="recepcion_file">
                            </div>
                        </div><br>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Cliente</label>
                            <div class="col-md-8">
                                <input type="text" id="hoja_demandante_update" name="hoja_demandante_update" class="form-control form-control-sm" style="text-transform: uppercase;" 
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
                        </div><br>
                        <input type="datetime" id="audi_switch" name="audi_switch" value="<?php echo $row['det_audiencia']; ?>" readonly hidden>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Acción Proceso</label>
                            <div class="col-md-8">
                                <input type="text" id="det_accion_update" name="det_accion_update" class="form-control form-control-sm" style="text-transform: uppercase;" value="Audiencia" readonly>
                            </div>
                        </div><br>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Fecha Audiencia</label>
                            <div class="col-md-8">
                                <input type="datetime" id="detalle_audiencia" name="detalle_audiencia" class="form-control form-control-sm" value="<?php echo fechaletra($row['det_audiencia']); ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 py-1" style="border-style: solid; border-color: #32C861; border-width: 1px; border-radius: 5px;">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Resultado de la Audiencia</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="det_respuesta" id="det_respuesta" rows="3" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="showError('det_respuesta'); verif('fin')"></textarea>
                                <span style="color: red;" id="error_det_respuesta">(Se requiere Observacion)</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-8 col-form-label">Adjuntar archivos</label>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="file" id="newFile" name="newFile" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row" hidden>
                            <label class="col-md-4 col-form-label">Estado proceso</label>
                            <div class="col-md-8">
                                <input type="text" id="det_estado_update" name="det_estado_update" class="form-control form-control-sm" style="text-transform: uppercase;" value="FINALIZADO" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }else { ?>
            <div class="row">
                <div class="col-6 py-1" style="border-style: solid; border-color: #E67E22; border-width: 1px; border-radius: 5px; background-color: #F6D4B5;">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">N Trámite</label>
                        <div class="col-md-9">
                            <input type="hidden" id="hoja_id" name="hoja_id" value="<?php echo $row['hoja_id'];?>">
                            <input type="hidden" id="detalle_id" name="detalle_id" value="<?php echo $row['det_id'] ?>">
                            <input type="text" min="0" id="hoja_numero_tramite_update" name="hoja_numero_tramite_update" class="form-control form-control-sm" value="<?php echo $row['hoja_numero_tramite']; ?>" readonly>
                            <input type="hidden" id="admin_eve" name="admin_eve" value="<?php echo $admid;?>">
                            <input type="hidden" id="identificador" name="identificador" value="recepcion_file">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Cliente</label>
                        <div class="col-md-9">
                            <input type="text" id="hoja_demandante_update" name="hoja_demandante_update" class="form-control form-control-sm" style="text-transform: uppercase;" 
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
                    <input type="datetime" id="audi_switch" name="audi_switch" value="<?php echo $row['det_audiencia']; ?>" readonly hidden>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Proceso</label>
                        <div class="col-md-9">
                            <input type="text" id="det_accion_update" name="det_accion_update" class="form-control form-control-sm" style="text-transform: uppercase;" value="<?php echo $row['det_accion']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Tarea</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="det_observacion" id="det_observacion" rows="3" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly><?php echo $row['det_observacion'];?></textarea>
                        </div>
                    </div>
                    <?php 
                        if ($row['det_envio_ruta_file'] == '') { ?>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Archivo</label>
                                <div class="col-md-9">
                                   <p>No hay archivos adjuntos</p>
                                </div>
                            </div>
                    <?php
                        }else { ?>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Archivo</label>
                                <div class="col-md-9">
                                    <a name="file" id="file" class="btn btn-primary" href="<?php echo $row['det_envio_ruta_file']; ?>" role="button" target="_blank" rel="noreferrer noopener">Descargar archivo adjunto</a>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Fecha Respuesta</label>
                        <div class="col-md-9">
                            <input type="datetime-local" id="detalle_fin" name="detalle_fin" class="form-control form-control-sm" value="<?php echo $row['det_fin'] ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-6 py-1" style="border-style: solid; border-color: #E67E22; border-width: 1px; border-radius: 5px;">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Comentario de Finalización</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="det_respuesta" id="det_respuesta" rows="3" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="showError('det_respuesta'); verif('fin')"></textarea>
                            <span style="color: red;" id="error_det_respuesta">(Se requiere Observacion)</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-6 col-form-label">Adjuntar archivos</label>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="file" id="newFile" name="newFile" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row" hidden>
                        <label class="col-md-4 col-form-label">Estado proceso</label>
                        <div class="col-md-8">
                            <input type="text" id="det_estado_update" name="det_estado_update" class="form-control form-control-sm" style="text-transform: uppercase;" value="FINALIZADO" readonly>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </form>
    <?php
        }
    ?>