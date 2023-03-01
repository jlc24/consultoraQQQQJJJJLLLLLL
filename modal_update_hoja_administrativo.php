    <?php include("assets/inc/conexion.php");?>
    <!-- MODAL PARA REGISTRAR ACTUALIZAR DATOS DE LA HOJA DE RUTA -->
    <?php session_start();
        $admid = $_SESSION['adm_id'];
        // OBTENEMOS LOS DATOS DE LA HOJA DE RUTA QUE SE VA ACTUALIZAR
        $sql="SELECT * FROM hoja WHERE hoja_id = (SELECT hoja_id FROM configuracion);";
        $result=mysqli_query($conexion,$sql);
        if (!empty($result)) {
            $rows = mysqli_fetch_assoc($result);
            //echo $rows;
    ?>
        <form class="form-horizontal" id="formulario_actualizar_hoja">
            <div class="form-group row">
                <label class="col-md-4 col-form-label ui-front">Nombre Cliente</label>
                <div class="col-md-8">
                    <input type="hidden" id="hoja_id_update" name="hoja_id_update" value="<?php echo $rows['hoja_id'];?>">
                    <input type="hidden" class="form-control form-control-md" id="area_proceso" name="area_proceso" value="ADMINISTRATIVO">
                    <input type="hidden" class="form-control form-control-md" id="admin" name="admin" value="<?php echo $admid; ?>">
                    <input type="text" id="nombre_update_cliente" name="nombre_update_cliente" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" 
                    value="<?php 
                        if ($rows['hoja_patrocinio'] == 'DENUNCIANTE') {
                            echo $rows['hoja_demandante'];
                        }else {
                            echo $rows['hoja_demandado'];
                        }
                    //echo $rows['nombre_cliente'];
                    ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label ui-front">Patrocinio</label>
                <div class="col-md-8">
                    <input type="text" id="patrocinio_update_cliente" name="patrocinio_update_cliente" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $rows['hoja_patrocinio'];?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label ui-front">Nombre Contraparte</label>
                <div class="col-md-8">
                    <input type="text" id="nombre_update_contra" name="nombre_update_contra" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" 
                    value="<?php 
                        if ($rows['hoja_patrocinio'] == 'DENUNCIADO') {
                            echo $rows['hoja_demandante'];
                        }else {
                            echo $rows['hoja_demandado'];
                        }
                    ?>">
                </div>
            </div>
            <!-- DATOS DEL CASO -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label ui-front">Trámite N°</label>
                <div class="col-md-8">
                    <input type="text" id="tramite_update" name="tramite_update" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $rows['hoja_numero_tramite'];?>" readonly>
                </div>
            </div>
            <div class="form-group row" hidden>
                <label class="col-md-4 col-form-label ui-front">Fecha de Ingreso</label>
                <div class="col-md-8">
                    <input type="text" id="ingreso_update" name="ingreso_update" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $rows['hoja_fecha_ingreso'];?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">NUREJ</label>
                <div class="col-md-8">
                    <input type="text" id="id_proceso_update" name="id_proceso_update" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $rows['hoja_id_proceso'];?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Tipo de Proceso</label>
                <div class="col-md-8">
                    <input type="text" id="tipo_proceso_update" name="tipo_proceso_update" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $rows['hoja_tipo_proceso'];?>">
                </div>
            </div>
            <div class="form-group row" hidden>
                <label class="col-md-4 col-form-label">Juzgado Público Civil y Comercial</label>
                <div class="col-md-8">
                    <input type="text" id="num_juzgado_update" name="num_juzgado_update" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $rows['hoja_num_juzgado'];?>">
                </div>
            </div>
            <div class="form-group row" hidden>
                <label class="col-md-4 col-form-label">Juzgado de Sentencia</label>
                <div class="col-md-8">
                    <input type="text" id="num_sentencia_update" name="num_sentencia_update" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $rows['hoja_num_sentencia'];?>">
                </div>
            </div>
            <div class="form-group row" hidden>
                <label class="col-md-4 col-form-label">Fiscalía e Interno</label>
                <div class="col-md-8">
                    <input type="text" id="fis_int_update" name="fis_int_update" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $rows['hoja_fiscalia_interno'];?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Etapa del Proceso</label>
                <div class="col-md-8">
                    <input type="text" id="etapa_proceso_update" name="etapa_proceso_update" class="form-control form-control-sm" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $rows['hoja_etapa'];?>">
                </div>
            </div>
            <!-- DATOS DESTINATARIO -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Referencia</label>
                <div class="col-md-8">
                    <textarea class="form-control" rows="2" id="referencia_update" name="referencia_update" style="text-transform: uppercase;"><?php echo $rows['hoja_referencia'];?></textarea>
                </div>
            </div>
            <div class="form-group row" hidden>
                <label class="col-md-4 col-form-label">Área Destino</label>
                <div class="col-md-8">
                    <input type="text" id="area_update" name="area_update" class="form-control form-control-md" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $rows['hoja_area_destino'];?>" readonly>
                </div>
            </div>

            <div class="form-group row" hidden>
                <label class="col-md-4 col-form-label">Responsable de área</label>
                <div class="col-md-8">
                    <input type="text" id="responsable_update" name="responsable_update" class="form-control form-control-md" value="<?php echo $rows['hoja_responsable_area'];?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Observación</label>
                <div class="col-md-8">
                    <textarea class="form-control" rows="2" id="obs_update" name="obs_update" style="text-transform: uppercase;"><?php echo $rows['hoja_observacion'];?></textarea>
                </div>
            </div>
        </form>
    <?php
        }
    ?>