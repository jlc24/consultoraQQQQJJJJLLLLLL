            <!-- MODAL PARA REGISTRAR UN EVNTO DE LA HOJA DE RUTA -->
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
                            `hoja_area_proceso`,
                            `hoja_patrocinio`,
                            det_encargado,
                            `fec_reg_evento`,
                            `enc_reg`,
                            `hoja_area_destino`
                        FROM
                            hoja,
                            hoja_detalle
                        WHERE
                            hoja.hoja_id = hoja_detalle.hoja_id 
                        AND 
                            hoja_detalle.det_id = (SELECT hoja_id FROM configuracion);";
                $result=mysqli_query($conexion,$sql);
                if (!empty($result)) {
                    $row = mysqli_fetch_assoc($result); ?>

                    <form class="form-horizontal" id="formulario_mensaje">
                        
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="simpleinput">Para :</label>
                            <div class="col-md-9">
                                <input type="hidden" id="hoja_id" name="hoja_id" value="<?php echo $row['hoja_id'];?>">
                                <input type="hidden" id="det_id" name="det_id" value="<?php echo $row['det_id'];?>">
                                <input type="hidden" id="adm_id" name="adm_id" value="<?php echo $admid; ?>">
                                <input type="hidden" id="enc_id" name="enc_id" value="<?php echo $row['det_encargado']; ?>">
                                <input type="text" id="destino" name="destino" class="form-control form-control-sm" 
                                value="<?php 
                                    $sql1 = "SELECT adm_nombre FROM administrador WHERE adm_id = '".$row['det_encargado']."';";
                                    $result1 = mysqli_query($conexion,$sql1);
                                    $res1 = mysqli_fetch_assoc($result1);
                                    echo $res1['adm_nombre'];  
                                ?>" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="simpleinput">Asunto :</label>
                            <div class="col-md-9">
                                <input type="text" id="asunto" name="asunto" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Mensaje :</label>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="4" id="desc_mensaje" name="desc_mensaje" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                            </div>
                        </div>
                    </form>
            <?php
                }
            ?>