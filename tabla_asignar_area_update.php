        <!--=================================================
        =            CONEXION A LA BASE DE DATOS            =
        ==================================================-->
        <?php include('assets/inc/conexion.php');
            session_start();
            if (!isset($_SESSION['adm_id'])) {
                header('Location: login.php');
            }
            $admid = $_SESSION['adm_id'];
            $sql = "SELECT area_nombre FROM area WHERE area_id  = (SELECT area_id FROM configuracion);";
            $result = mysqli_query($conexion,$sql);
            $adm = mysqli_fetch_assoc($result);
        ?>

        <table class="table table-sm table-striped table-bordered dt-responsive">
            <thead class="text-center" style="background-color: #40CC6C; color: #fff; font-size: 20px;">
                <th width="250px">Procesos</th>
                <th><?php echo $adm['area_nombre']; ?></th>
            </thead>
            <tbody> <?php
                $sql1 = "SELECT proceso.proceso_id, proceso_nombre, asig_estado FROM asignacion, proceso WHERE asignacion.proceso_id = proceso.proceso_id AND asignacion.area_id = (SELECT area_id FROM configuracion) AND adm_id = (SELECT adm_id FROM configuracion);";
                $result = mysqli_query($conexion,$sql1);
                while ($row = mysqli_fetch_assoc($result)){ ?>
                    <tr>
                        <td><?php echo $row['proceso_nombre']; ?></td>
                        <td class="text-center" ><?php
                            if ($row['asig_estado'] != '0') { ?>
                                <input class="form-check-input"  type="checkbox" name="<?php echo $row['proceso_id']; ?>" id="<?php echo $row['proceso_id']; ?>" aria-label="Checkbox for following text input" checked>
                            <?php
                            }else { ?>
                                <input class="form-check-input"  type="checkbox" name="<?php echo $row['proceso_id']; ?>" id="<?php echo $row['proceso_id']; ?>" aria-label="Checkbox for following text input">
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
            <?php
                }
            ?>
            </tbody>
        </table>

