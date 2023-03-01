            <!-- MODAL PARA REGISTRAR UN EVNTO DE LA HOJA DE RUTA -->
            <?php include("assets/inc/conexion.php");
                session_start();
                $admid = $_SESSION['adm_id'];
                // OBTENEMOS LOS DATOS DE LA HOJA DE RUTA QUE SE VA ACTUALIZAR
                
                $sql="SELECT * FROM nota WHERE not_id = (SELECT hoja_id FROM configuracion) || det_id = (SELECT hoja_id FROM configuracion);";
                $result=mysqli_query($conexion,$sql);
                if (!empty($result)) {
                    $row = mysqli_fetch_assoc($result); ?>
            
                    <form class="form-horizontal" id="formulario_mensaje">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="simpleinput">De :</label>
                            <div class="col-md-9">
                                <input type="text" id="remitente" name="remitente" class="form-control form-control-sm" value="<?php 
                                    $sql1 = "SELECT adm_nombre FROM administrador WHERE adm_id = '".$row['adm_id']."';";
                                    $result1 = mysqli_query($conexion,$sql1);
                                    $res1 = mysqli_fetch_assoc($result1);
                                    echo $res1['adm_nombre'];
                                ?>" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="simpleinput">Asunto :</label>
                            <div class="col-md-9">
                                <input type="text" id="asunto" name="asunto" class="form-control form-control-sm" value="<?php echo $row['not_asunto']; ?>" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Mensaje :</label>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="4" id="hoja_observacion" name="hoja_observacion" style="text-transform: uppercase;" readonly><?php echo $row['not_mensaje']; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>    
            <?php
                }
            ?>