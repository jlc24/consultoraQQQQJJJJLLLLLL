    <?php include("assets/inc/conexion.php");
        session_start();
        $admid = $_SESSION['adm_id'];
        $sql = "SELECT adm_id, adm_nombre, adm_rol, administrador.area_id, area_nombre FROM administrador, area WHERE administrador.area_id = area.area_id AND adm_id = (SELECT adm_id FROM configuracion);";
        $result = mysqli_query($conexion,$sql);
        $adm = mysqli_fetch_assoc($result);
        ?>
        <!-- MODAL PARA REGISTRAR MEDICAMENTO -->
    <?php 
        if ($adm['adm_rol'] == 'admin') { ?>
            <form class="form-horizontal" id="formulario_crear_asignacion" class="parsley_create_hoja" novalidate="">
                <label for="">Administrador: <?php echo $adm['adm_nombre'] ?></label>
                <input type="hidden" name="qjl_adm_id" id="qjl_adm_id" value="<?php echo $adm['adm_id'] ?>">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="qjl_area">Área</label>
                    <div class="col-md-9">
                        <select class="custom-select custom-select-sm" id="qjl_area" name="qjl_area">
                            <option value="" selected="" disabled>---------- SELECCIONAR ----------</option>
                            <?php
                                $sql_area = "SELECT area_id, area_nombre FROM area;";
                                $resultado = mysqli_query($conexion, $sql_area);
                                while ($reg = mysqli_fetch_assoc($resultado)) { ?>
                                    <option value="<?php echo $reg['area_id']; ?>"><?php echo $reg['area_nombre']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12" id="tabla_asignar_area">

                    </div>
                </div>
            </form>
        <?php
        }else{ ?>
            <form class="form-horizontal" id="formulario_crear_asignacion" >
                <label for="">Usuario: <?php echo $adm['adm_nombre']; ?></label>
                <input type="hidden" name="qjl_adm_id" id="qjl_adm_id" value="<?php echo $adm['adm_id'] ?>">
                <input type="hidden" name="qjl_area" id="qjl_area" value="<?php echo $adm['area_id'] ?>">
                <table class="table table-sm table-striped table-bordered dt-responsive">
                    <thead class="text-center" style="background-color: #40CC6C; color: #fff; font-size: 20px;">
                        <th width="250px">Procesos</th>
                        <th><?php echo $adm['area_nombre']; ?></th>
                    </thead>
                    <tbody> <?php
                        $sql1 = "SELECT proceso_id, proceso_nombre FROM proceso WHERE area_id = '".$adm['area_id']."';";
                        $result = mysqli_query($conexion,$sql1);
                        while ($row = mysqli_fetch_assoc($result)){ ?>
                            <tr>
                                <td><?php echo $row['proceso_nombre']; ?></td>
                                <td class="text-center" ><input class="form-check-input"  type="checkbox" name="<?php echo $row['proceso_id']; ?>" id="<?php echo $row['proceso_id']; ?>" aria-label="Checkbox for following text input"></td>
                            </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </form>  
    <?php
        }
    ?>
    <script>
        $("#qjl_area").change(function(){
            var area = "area_id=" + $("#qjl_area").val();
            //alert(area); return false;
            $.ajax({
                type: "POST",
                url: "assets/inc/update_id_config.php",
                data: area,
                success: function(r) {
                    if(r) {
                        $('#tabla_asignar_area').load('tabla_asignar_area.php');
                    }
                }
            })
        })
    </script>
        