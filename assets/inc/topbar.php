            <div class="navbar-custom">
                <ul class="list-unstyled topnav-menu float-right mb-0">
                    <li class="dropdown notification-list">
                        <button class="btn btn-light btn-circle" type="button" title="Nuevo mensaje" data-toggle="modal" data-target="#modal_mensaje_blanco" style="width: 50px; height: 50px; padding: 7px 10px; margin-top: 10px; border-radius: 50%;">
                            <i class="noti-icon fas fa-envelope" style="font-size: 30px; color: #DC5C05;"></i>
                            <span class="badge badge-light noti-icon-badge" style="font-size: 15px; color: #DC5C05;">+</span>
                        </button>
                    </li>
                    <li class="dropdown notification-list" id="alarma_viewmensajes_topbar">
                        
                    </li>
                    <li class="dropdown notification-list" id="alarma_sendmensajes_topbar">
                        
                    </li>
                    <li class="dropdown notification-list" id="alarma_newmensajes_topbar">
                        
                    </li>
                    <li class="dropdown notification-list" id="alarma_notificaciones_topbar">
                        
                    </li>
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="assets/images/users/avatar-1.png" alt="user-image" class="rounded-circle">
                            <span class="pro-user-name ml-1">
                                <?php echo utf8_decode($row['adm_nombre']); ?> <i class="mdi mdi-chevron-down"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Bienvenid@ !</h6>
                            </div>

                            <!-- item-->
                            <a href="profile.php" class="dropdown-item notify-item">
                                <i class="fe-user"></i>
                                <span>Perfil</span>
                            </a>

                            <!-- item-->
                            <?php
                                if ($row['adm_id'] == '9' || $row['adm_id'] == '1') {?>
                                    <a href="config.php" class="dropdown-item notify-item">
                                        <i class="fe-settings"></i>
                                        <span>Configuraciones</span>
                                    </a>
                            <?php
                                }
                                ?>
                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            <a href="salir.php" class="dropdown-item notify-item">
                                <i class="fe-log-out"></i>
                                <span>Cerrar sesión</span>
                            </a>

                        </div>
                    </li>
                </ul>
                <!-- LOGO -->
                <div class="logo-box">
                    <a href="index.php" class="logo text-center">
                        <span class="logo-lg">
                            <img src="assets/images/logo-light.png" alt="" height="35">
                            <!-- <span class="logo-lg-text-light">UBold</span> -->
                        </span>
                        <span class="logo-sm">
                            <!-- <span class="logo-sm-text-dark">U</span> -->
                            <img src="assets/images/logo-sm.png" alt="" height="35">
                        </span>
                    </a>
                </div>
                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                            <i class="fe-menu"></i>
                        </button>
                    </li>
                </ul>
            </div>