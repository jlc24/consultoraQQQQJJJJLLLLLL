            <div class="left-side-menu">
                <div class="slimscroll-menu">
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Menú de Navegación</li>
                            <li>
                                <a href="index.php">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span> Panel de Control </span>
                                </a>
                            </li>
                            <li>
                                <a href="cliente.php">
                                    <i class="far fa-user"></i>
                                    <span> Clientes </span>
                                </a>
                            </li>
                            <?php
                                if ($row['adm_rol'] == 'admin') { ?>
                                    <li>
                                        <a href="administrador.php">
                                            <i class="fas fa-user-tie"></i>
                                            <span> Administración </span>
                                        </a>
                                    </li>
                                <?php
                                }
                            ?>
                            <?php if ($row['area_id'] == '1' || $row['adm_rol'] == 'admin') { ?>
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="fas fa-balance-scale"></i>
                                    <span> Área Jurídica </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <?php
                                        $sql = "SELECT asignacion.proceso_id, proceso_nombre FROM asignacion, proceso WHERE asignacion.proceso_id = proceso.proceso_id AND asignacion.area_id = '1' AND adm_id = '".$adm_id."' AND asig_estado = '1';";
                                        $resultado = mysqli_query($conexion, $sql);
                                        while ($registro = mysqli_fetch_assoc($resultado))
                                        { ?>
                                            <li><a href="hoja_ruta_<?php echo preg_replace('([^A-Za-z])', '', strtolower($registro['proceso_nombre'])) ; ?>.php"><?php echo ucwords(strtolower($registro['proceso_nombre'])); ?></a></li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </li>
                            <?php
                            }
                            if ($row['area_id'] == '2' || $row['adm_rol'] == 'admin') {?>
                                <li>
                                    <a href="javascript: void(0);">
                                        <i class="fas fa-dollar-sign"></i>
                                        <span> Área Contable </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul class="nav-second-level" aria-expanded="false">
                                        <?php
                                            $sql = "SELECT asignacion.proceso_id, proceso_nombre FROM asignacion, proceso WHERE asignacion.proceso_id = proceso.proceso_id AND asignacion.area_id = '2' AND adm_id = '".$adm_id."' AND asig_estado = '1';";
                                            $resultado = mysqli_query($conexion, $sql);
                                            while ($registro = mysqli_fetch_assoc($resultado))
                                            { ?>
                                                <li><a href="hoja_ruta_<?php echo preg_replace('([^A-Za-z])', '', strtolower($registro['proceso_nombre'])) ; ?>.php"><?php echo ucwords(strtolower($registro['proceso_nombre'])); ?></a></li>
                                        <?php
                                            }
                                        ?>
                                    </ul>
                                </li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($row['area_id'] == '3' || $row['adm_rol'] == 'admin') { ?>
                                <li>
                                    <a href="javascript: void(0);">
                                        <i class="fas fa-laptop-code"></i>
                                        <span> Área Marketing </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul class="nav-second-level" aria-expanded="false">
                                        <?php
                                            $sql = "SELECT asignacion.proceso_id, proceso_nombre FROM asignacion, proceso WHERE asignacion.proceso_id = proceso.proceso_id AND asignacion.area_id = '3' AND adm_id = '".$adm_id."' AND asig_estado = '1';";
                                            $resultado = mysqli_query($conexion, $sql);
                                            while ($registro = mysqli_fetch_assoc($resultado))
                                            { ?>
                                                <li><a href="hoja_ruta_<?php echo preg_replace('([^A-Za-z])', '', strtolower($registro['proceso_nombre'])) ; ?>.php"><?php echo ucwords(strtolower($registro['proceso_nombre'])); ?></a></li>
                                        <?php
                                            }
                                        ?>
                                    </ul>
                                </li>
                            <?php
                            }
                            ?>
                            <li>
                                <a href="agenda.php">
                                    <i class="far fa-calendar-alt"></i>
                                    <span> Agenda </span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="fas fa-chart-pie"></i>
                                    <span> Reportes </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                <?php
                                if ($row['adm_rol'] == 'admin') { 
                                    $area = "SELECT area_nombre FROM area;";
                                    $resp = mysqli_query($conexion, $area);
                                    while ($a = mysqli_fetch_assoc($resp)) { ?>
                                        <li><a href="reporte_hoja_ruta_<?php echo preg_replace('([^A-Za-z])', '', strtolower($a['area_nombre'])); ?>.php"><?php echo ucwords(strtolower($a['area_nombre'])); ?></a></li>
                                 <?php
                                    }
                                }else { 
                                    $area = "SELECT DISTINCT area_nombre FROM area, administrador WHERE area.area_id = administrador.area_id AND adm_id = '".$adm_id."';";
                                    $resp = mysqli_query($conexion, $area);
                                    while ($a = mysqli_fetch_assoc($resp)) { ?>
                                        <li><a href="reporte_hoja_ruta_<?php echo preg_replace('([^A-Za-z])', '', strtolower($a['area_nombre'])); ?>.php"><?php echo ucwords(strtolower($a['area_nombre'])); ?></a></li>
                                 <?php
                                    }
                                }
                                ?>
                                    
                                </ul>
                            </li>
                            <li>
                            <?php
                                if ($row['adm_rol'] == 'admin') { ?>
                                    <a href="config.php">
                                        <i class="fas fa-cog"></i>
                                        <span> Configuración </span>
                                    </a>
                                <?php
                                }
                                ?>
                            </li>
                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>