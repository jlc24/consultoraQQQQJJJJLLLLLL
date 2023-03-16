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
                    det_leido,
                    `det_respuesta_encargado`,
                    det_mensaje,
                    det_envio_ruta_file,
                    det_recepcion_ruta_file,
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
    
        <form class="form-horizontal" id="formulario_reenvio_hoja_detalle" enctype="multipart/form-data">
            <div class="row">
                <div class="col-6 py-1" style="border-style: solid; border-color: #E67E22; border-width: 1px; border-radius: 5px; background-color: #F6D4B5;">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">N Trámite</label>
                        <div class="col-md-9">
                            <input type="hidden" id="hoja_id_fin" name="hoja_id_fin" value="<?php echo $row['hoja_id'];?>">
                            <input type="hidden" id="detalle_id_fin" name="detalle_id_fin" value="<?php echo $row['det_id'] ?>">
                            <input type="text" id="hoja_numero_tramite_fin" name="hoja_numero_tramite_fin" class="form-control form-control-sm" value="<?php echo $row['hoja_numero_tramite']; ?>" readonly>
                            <input type="hidden" id="admin_eve_fin" name="admin_eve_fin" value="<?php echo $admid;?>">
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
                                <label class="col-md-3 col-form-label">Archivo Envío</label>
                                <div class="col-md-9">
                                   <p>No hay archivos adjuntos</p>
                                </div>
                            </div>
                    <?php
                        }else { ?>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Archivo Envío</label>
                                <div class="col-md-9">
                                    <a name="file" id="file" class="btn btn-primary" href="<?php echo $row['det_envio_ruta_file']; ?>" role="button" target="_blank" rel="noreferrer noopener">Archivo envío </a><img src="assets/images/icons/document.svg" alt="" width="40PX">
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                    
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Respuesta</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="det_observacion" id="det_observacion" rows="3" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly><?php echo $row['det_respuesta_encargado'];?></textarea>
                        </div>
                    </div>
                   
                    <?php 
                        if ($row['det_recepcion_ruta_file'] == '') { ?>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Archivo Respuesta</label>
                                <div class="col-md-9">
                                   <p>No hay archivos adjuntos</p>
                                </div>
                            </div>
                    <?php
                        }else { ?>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Archivo Respuesta</label>
                                <div class="col-md-9">
                                    <a name="file" id="file" class="btn btn-primary" href="<?php echo $row['det_recepcion_ruta_file']; ?>" role="button" target="_blank" rel="noreferrer noopener">Archivo Respuesta </a><img src="assets/images/icons/document.svg" alt="" width="40PX">
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
                        <label class="col-md-12 col-form-label">Comentario de Reenvío</label>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <textarea class="form-control" name="det_respuesta_fin" id="det_respuesta_fin" rows="3" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="showError('det_respuesta_fin'); verif('reenvio')"></textarea>
                            <small><span style="color: red;" id="error_det_respuesta_fin">(Se requiere Observacion)</span></small>
                        </div>
                    </div><hr>
                    <div class="form-group row">
                        <label class="col-md-12 col-form-label">Adjuntar archivo</label>
                    </div>
                    <div class="form-group row justify-content-center">
                        <div class="col-md-12">
                            <input type="file" id="endFile" name="endFile" class="form-control" onchange="verFileSize('endFile')">
                        </div>
                        <small><span style="color: red;">Tamaño max. del archivo 5mb.</span></small>
                    </div><hr>
                    <div class="form-group row">
                        <label class="col-md-12 col-form-label">Fecha Respuesta</label>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="datetime-local" id="detalle_resp_fin" name="detalle_resp_fin" class="form-control form-control-sm" onchange="showError('detalle_resp_fin'); verif('reenvio')">
                            <small><span style="color: red;" id="error_detalle_resp_fin">(Se requiere Fecha Fin)</span></small>
                        </div>
                    </div>
                    <div class="form-group row" hidden>
                        <label class="col-md-4 col-form-label">Estado proceso</label>
                        <div class="col-md-8">
                            <input type="text" id="det_estado_fin" name="det_estado_fin" class="form-control form-control-sm" style="text-transform: uppercase;" value="EJECUCION" readonly>
                            <input type="text" id="det_leido_fin" name="det_leido_fin" class="form-control form-control-sm" style="text-transform: uppercase;" value="0" readonly>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </form>
