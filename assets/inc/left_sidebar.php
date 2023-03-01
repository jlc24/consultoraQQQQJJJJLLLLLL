        <?php
        $sql = "SELECT adm_id, adm_nombre, adm_area FROM administrador WHERE adm_id = '$adm_id'";
        $resultado = $conexion->query($sql);
        $row = $resultado->fetch_assoc();
        ?>
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
                            <li>
                                <a href="administrador.php">
                                    <i class="fas fa-user-tie"></i>
                                    <span> Administradores </span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="fas fa-balance-scale"></i>
                                    <span> Área Jurídica </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <?php
                                    if ($adm_id == '3' || $adm_id == '10') {
                                        echo "
                                        <li><a href='hoja_ruta_penal.php'>Penal</a></li>
                                        <li><a href='hoja_ruta_penal_ad.php'>Penal Aduanero</a></li>
                                        ";
                                    }elseif ($adm_id == '4') {
                                        echo "
                                        <li><a href='hoja_ruta_administrativo.php'>Administrativo</a></li>
                                        <li><a href='hoja_ruta_ait.php'>A.I.T.</a></li>
                                        <li><a href='#'>Contenciosos Tributario</a></li>
                                        <li><a href='hoja_ruta_familia.php'>Familia</a></li>
                                        ";
                                    }elseif ($adm_id == '7') {
                                        echo "
                                        <li><a href='hoja_ruta_civil.php'>Civil</a></li>
                                        ";
                                    }elseif ($adm_id == '11') {
                                        echo "
                                        <li><a href='hoja_ruta_administrativo.php'>Administrativo</a></li>
                                        <li><a href='hoja_ruta_civil.php'>Civil</a></li>
                                        ";
                                    }
                                    elseif ($adm_id == '2') {
                                        echo "
                                        <li><a href='hoja_ruta_aduana.php'>Aduana</a></li>
                                        <li><a href='hoja_ruta_penal_ad.php'>Penal Aduanero</a></li>
                                        <li><a href='hoja_ruta_ait.php'>A.I.T.</a></li>
                                        <li><a href='#'>Contenciosos Tributario</a></li>
                                        ";
                                    }else{
                                        echo "
                                        <li><a href='hoja_ruta_administrativo.php'>Administrativo</a></li>
                                        <li><a href='hoja_ruta_aduana.php'>Aduana</a></li>
                                        <li><a href='hoja_ruta_ait.php'>A.I.T.</a></li>
                                        <li><a href='hoja_ruta_civil.php'>Civil</a></li>
                                        <li><a href='#'>Contenciosos Tributario</a></li>
                                        <li><a href='hoja_ruta_familia.php'>Familia</a></li>
                                        <li><a href='hoja_ruta_penal.php'>Penal</a></li>
                                        <li><a href='hoja_ruta_penal_ad.php'>Penal Aduanero</a></li>
                                        ";
                                    }
                                    ?>
                                </ul>
                            </li>
                            <?php
                                if ($row['adm_area'] == 'CONTABILIDAD') {?>
                                    <li>
                                        <a href="javascript: void(0);">
                                            <i class="fas fa-dollar-sign"></i>
                                            <span> Área Contable </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-second-level" aria-expanded="false">
                                            <li><a href="#">Contable</a></li>
                                            <li><a href="#">Financiero</a></li>
                                            <li><a href="#">Auditoria</a></li>
                                            <li><a href="#">Administrativo</a></li>
                                        </ul>
                                    </li>
                            <?php
                                }
                            ?>
                            <?php
                                if ($row['adm_area'] == 'MARKETING') {?>
                                    <li>
                                        <a href="javascript: void(0);">
                                            <i class="fas fa-laptop-code"></i>
                                            <span> Área Marketing </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-second-level" aria-expanded="false">
                                            <li><a href="#">Publicidad</a></li>
                                            <li><a href="#">Marketing Digital</a></li>
                                            <li><a href="#">Diseño Web</a></li>
                                            <li><a href="#">Aplicacion Web</a></li>
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
                                    <!-- javascript: void(0); -->
                                    <li><a href="#">Hojas Activas</a></li>
                                    <li><a href="#">Hojas Inactivas</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="config.php">
                                    <i class="fas fa-cog"></i>
                                    <span> Configuración </span>
                                </a>
                            </li>
                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>