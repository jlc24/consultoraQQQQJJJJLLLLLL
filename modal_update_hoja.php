    <?php include("assets/inc/conexion.php");?>
    <!-- MODAL PARA REGISTRAR ACTUALIZAR DATOS DE LA HOJA DE RUTA -->
    <?php
        // OBTENEMOS LOS DATOS DE LA HOJA DE RUTA QUE SE VA ACTUALIZAR
        $sql="SELECT * FROM hoja WHERE hoja_id = (SELECT hoja_id FROM configuracion)";
        $result=mysqli_query($conexion,$sql);
        if (!empty($result)) {
            $row = mysqli_fetch_assoc($result);
            //echo $row;
    ?>
        <form class="form-horizontal" id="formulario_actualizar_hoja">
            <div class="form-group row">
                <label class="col-md-4 col-form-label ui-front">Nombre Solicitante</label>
                <div class="col-md-8">
                    <input type="hidden" id="hoja_id_update" name="hoja_id_update" value="<?php echo $row['hoja_id'];?>">
                    <input type="text" id="nombre_update" name="nombre_update" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $row['hoja_nombre_solicitante'];?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label ui-front">C.I. Solicitante</label>
                <div class="col-md-8">
                    <input type="text" id="ci_update" name="ci_update" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $row['hoja_ci_solicitante'];?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label ui-front">Celular Solicitante</label>
                <div class="col-md-8">
                    <input type="text" id="cel_update" name="cel_update" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $row['hoja_celular_solicitante'];?>">
                </div>
            </div>
            <!-- DATOS DEL CASO -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label ui-front">Trámite N°</label>
                <div class="col-md-8">
                    <input type="text" id="tramite_update" name="tramite_update" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $row['hoja_numero_tramite'];?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label ui-front">Fecha de Ingreso</label>
                <div class="col-md-8">
                    <input type="text" id="ingreso_update" name="ingreso_update" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $row['hoja_fecha_ingreso'];?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Fecha de Salida :</label>
                <div class="col-md-8">
                    <input type="datetime-local" id="salida_update" name="salida_update" class="form-control form-control-sm" value="<?php $row['hoja_fecha_salida'];?>">
                </div>
            </div>
            <!-- DATOS DESTINATARIO -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Referencia</label>
                <div class="col-md-8">
                    <textarea class="form-control" rows="2" id="referencia_update" name="referencia_update" style="text-transform: uppercase;"><?php echo $row['hoja_referencia'];?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Área Destino</label>
                <div class="col-md-8">
                    <input type="text" id="area_update" name="area_update" class="form-control form-control-md" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $row['hoja_area_destino'];?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label">Responsable de área</label>
                <div class="col-md-8">
                    <input type="text" id="responsable_update" name="responsable_update" class="form-control form-control-md" value="<?php echo $row['hoja_responsable_area'];?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Observación</label>
                <div class="col-md-8">
                    <textarea class="form-control" rows="2" id="obs_update" name="obs_update" style="text-transform: uppercase;"><?php echo $row['hoja_observacion'];?></textarea>
                </div>
            </div>
        </form>
    <?php
        }
    ?>