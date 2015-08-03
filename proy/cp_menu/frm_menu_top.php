<!-- #section:basics/navbar.layout -->
        <div id="navbar" class="navbar navbar-default">
            <script type="text/javascript">
                try{ace.settings.check('navbar' , 'fixed')}catch(e){}
            </script>

            <div class="navbar-container" id="navbar-container">
                <!-- #section:basics/sidebar.mobile.toggle -->
                <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                    <span class="sr-only">Toggle sidebar</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>
                </button>

                <!-- /section:basics/sidebar.mobile.toggle -->
                <div class="navbar-header pull-left">
                    <!-- #section:basics/navbar.layout.brand -->
                    <a href="../cp_menu/frm_menu.php" class="navbar-brand">
                        <small>
                            <i class="fa fa-leaf"></i>
                                Cosede
                        </small>
                    </a>

                    <!-- /section:basics/navbar.layout.brand -->

                    <!-- #section:basics/navbar.toggle -->

                    <!-- /section:basics/navbar.toggle -->
                </div>

                <!-- #section:basics/navbar.dropdown -->
                <div class="navbar-buttons navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        <!-- #section:basics/navbar.user_menu -->
                        <li class="light-blue">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">

                                <?php
                                    if (file_exists ('../img/'.$_SESSION['cat'].'.jpg')){
                                        echo '<img class="nav-user-photo" src="../img/'.$_SESSION['cat'].'.jpg"  />';
                                    }else{
                                        echo '<img class="nav-user-photo" src= "../img/sinfoto.jpg"  />';
                                    }
                                ?>
                                <span class="user-info">
                                    <small>Bienvenido,</small>
                                    <?php echo $_SESSION['nom_ape']; ?>
                                </span>

                                <i class="ace-icon fa fa-caret-down"></i>
                            </a>

                            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                <li>
                                    <a href="../cp_usuario/5_frm_usuario.php">
                                        <i class="ace-icon fa fa-cog"></i>
                                        Opciones
                                    </a>
                                </li>

                                <li>
                                    <a href="../cp_usuario/4_frm_usuario.php">
                                        <i class="ace-icon fa fa-user"></i>
                                        Mi Perfil
                                    </a>
                                </li>

                                <li class="divider"></li>

                                <li>
                                    <a href="../cp_login/logout.php">
                                        <i class="ace-icon fa fa-power-off"></i>
                                        Salir
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- /section:basics/navbar.user_menu -->
                    </ul>
                </div>

                <!-- /section:basics/navbar.dropdown -->
            </div><!-- /.navbar-container -->
        </div>