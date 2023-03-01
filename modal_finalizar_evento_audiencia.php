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
    
        <form class="form-horizontal" id="formulario_actualizar_audiencia_detalle" enctype="multipart/form-data">
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Nº Trámite</label>
                <div class="col-md-8">
                    <input type="hidden" id="hoja_id" name="hoja_id" value="<?php echo $row['hoja_id'];?>">
                    <input type="hidden" id="detalle_id" name="detalle_id" value="<?php echo $row['det_id'] ?>">
                    <input type="text" min="0" id="hoja_numero_tramite_update" name="hoja_numero_tramite_update" class="form-control form-control-sm" value="<?php echo $row['hoja_numero_tramite']; ?>" readonly>
                    <input type="hidden" id="admin_eve" name="admin_eve" value="<?php echo $admid;?>">
                    <input type="hidden" id="identificador" name="identificador" value="recepcion_file">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Nombre Cliente</label>
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
            </div>
            <?php
                if ($row['det_audiencia'] != '0000-00-00 00:00:00') { ?>
                    <input type="datetime" id="audi_switch" name="audi_switch" value="<?php echo $row['det_audiencia']; ?>" readonly hidden>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Acción Proceso</label>
                        <div class="col-md-8">
                            <input type="text" id="det_accion_update" name="det_accion_update" class="form-control form-control-sm" style="text-transform: uppercase;" value="Audiencia" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Fecha Audiencia</label>
                        <div class="col-md-8">
                            <input type="datetime" id="detalle_audiencia" name="detalle_audiencia" class="form-control form-control-sm" value="<?php echo fechaletra($row['det_audiencia']); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Resultado de la Audiencia</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="det_respuesta" id="det_respuesta" rows="3" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="showError('det_respuesta'); verif('fin')"></textarea>
                            <span style="color: red;" id="error_det_respuesta">(Se requiere Resultado de Audiencia)</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Adjuntar archivos</label>
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
                <?php
                }
                ?>
        </form>
    <?php
        }
    ?>