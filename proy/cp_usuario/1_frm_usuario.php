<?php
	date_default_timezone_set('America/Guatemala');
	include_once("1_xajax_usuario.php");
	session_start();

	$bandera = 0;
	$usuario = $_SESSION['cat'];
	$cls_login = new cls_login();


	$res = $cls_login->trae_usuario($usuario);
    	foreach($res as $row){
            $_SESSION['nom'] = trim($row['usu_nom1'])." ".trim($row['usu_nom2']);
            $_SESSION['ape'] = trim($row['usu_ape1'])." ".trim($row['usu_ape2']);
            $_SESSION['nom_ape'] = trim($row['usu_nom1'])." ".trim($row['usu_ape1']);
            $arma = $row['arm_desc_md'];
            $armcod = $row['usu_arma'];
            $_SESSION['gra'] = $row['gra_desc_md'];
            $gracod = $row['usu_grado'];
            $nivel = $row['usu_nivel'];
            $_SESSION['nivel'] = $nivel;            
            $curso = $row['usu_curso'];
            $_SESSION['curso'] = $curso;
            $_SESSION['fec_u'] = $row['usu_fecha_pass'];
            $_SESSION['dias'] = $row['usu_dias_pass'];
            $avilita = $row['usu_avilita'];
            $_SESSION['usu_situacion'] = $row['usu_situacion'];
        }

        if ($gracod > 40 && $gracod < 90){
            $bandera = 1;
        }
        if($armcod != 6 && $bandera == 1){
            $_SESSION['arma'] = 'DE '.$arma;
        }else{
            $_SESSION['arma'] = " ";
        }
    
    //================CAMBIA PASSWORD====================
    if ($avilita == 1){
        $cls_util = new cls_util();
        $usuario = $cls_util->encrypt($usuario, 'A');
        header('Location: ../cp_usuario/0_frm_usuario.php?id='.$usuario.'');
    }
    //=================USUARIO ACTIVO=====================
    if ($_SESSION['usu_situacion'] != 1){
       
        header('Location: ../cp_login/logout.php');
    }
    //===================================================

	
?>
<!DOCTYPE html>
<html lang="en">
    <!-- ==================================================================================== -->
    <!-- ===================================SCRIPTS GENERALES================================ -->
    <!-- ==================================================================================== -->
    <head>
        <?php
            include_once("../cp_menu/frm_menu_script_top.php");
        ?>
        <!-- ==============================SCRIPTS ESPECIFICOS=============================== -->
        <!-- <link rel="stylesheet" href="css/css.css" /> -->
        <script src="js/1_js.js"></script>
        <!-- ================================================================================ -->
    </head>
    <!-- ==================================================================================== -->
    <!-- ===================================BODY============================================= -->
    <!-- ==================================================================================== -->
    <body class="no-skin">
        <!-- ==============================MENU DE ARRIBA==================================== -->
        <?php
            include_once("../cp_menu/frm_menu_top.php");
        ?>
        <!-- ==============================MENU DEL LADO IZQUIERDO=========================== -->
        <!-- /section:basics/navbar.layout -->
        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>
            <?php
                include_once("../cp_menu/frm_menu_sidebar.php");
                // ==============================INICIA AREA DE TRABAJO====================== -->
                include_once("../cp_menu/frm_menu_page.php");
            ?>
            

            
            <!-- ==================================================================================== -->
            <!-- ========================== INICIA AREA DE TRABAJO ================================== -->
            <!-- ==================================================================================== -->
            <div class="page-header">
                <h1>
                    Usuario
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                            Crear
                    </small>
                </h1>
            </div>


            <div class="row">

                <div class="col-sm-3"></div>

                <div class="col-sm-6" id="div_all">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4 class="widget-title">Formulario</h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main no-padding">
                                <form id="form">
                                    <!-- <legend>Form</legend> -->
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="catalogo">Catalogo</label>
                                            </div>
                                            <div class="col-sm-8">

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-check"></i>
                                                    </span>

                                                    <input type="text" name="catalogo" id="catalogo" class="form-control search-query" placeholder="Catalogo" />
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-purple btn-sm" onclick="buscar();">
                                                            <span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
                                                            Buscar
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="grado">Grado</label>
                                            </div>
                                            <div class="col-sm-8">

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-check"></i>
                                                    </span>

                                                    <input type="text" name="grado" id="grado" class="form-control" placeholder="Grado" readonly="readonly" />
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="arma">Arma</label>
                                            </div>
                                            <div class="col-sm-8">

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-check"></i>
                                                    </span>

                                                    <input type="text" name="arma" id="arma" class="form-control" placeholder="Arma" readonly="readonly" />
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="nom1">Primer Nombre</label>
                                            </div>
                                            <div class="col-sm-8">

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-check"></i>
                                                    </span>

                                                    <input type="text" name="nom1" id="nom1" class="form-control" placeholder="Primer Nombre" readonly="readonly" />
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="ape1">Primer Apellido</label>
                                            </div>
                                            <div class="col-sm-8">

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-check"></i>
                                                    </span>

                                                    <input type="text" name="ape1" id="ape1" class="form-control" placeholder="Primer Apellido" readonly="readonly" />
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="ape2">Segundo Apellido</label>
                                            </div>
                                            <div class="col-sm-8">

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-check"></i>
                                                    </span>

                                                    <input type="text" name="ape2" id="ape2" class="form-control" placeholder="Segundo Apellido" readonly="readonly" />
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="email">Correo Electronico</label>
                                            </div>
                                            <div class="col-sm-8">

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-check"></i>
                                                    </span>

                                                    <input type="text" name="email" id="email" class="form-control" placeholder="Correo Electronico" />
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="telefono">Telefono/Celular</label>
                                            </div>
                                            <div class="col-sm-8">

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-check"></i>
                                                    </span>

                                                    <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono/Celular" />
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="curso">Curso</label>
                                            </div>
                                            <div class="col-sm-8">

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-check"></i>
                                                    </span>

                                                    <?php
                                                        echo combo_curso();
                                                    ?>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="nivel">Nivel de Permiso</label>
                                            </div>
                                            <div class="col-sm-8">

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-check"></i>
                                                    </span>

                                                    <select name='nivel' id="nivel" class="form-control">
                                                        <option value="">-- Seleccione --</option>
                                                        <option value="1">ALUMNO</option>
                                                        <option value="2">INSTRUCTOR</option>
                                                        <option value="100">ADMINISTRADOR</option>
                                                       
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="pass">Password</label>
                                            </div>
                                            <div class="col-sm-8">

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-check"></i>
                                                    </span>

                                                    <input type="text" name="pass" id="pass" class="form-control search-query" placeholder="Password" readonly="readonly" />
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-purple btn-sm" onclick="xajax_generar();">
                                                            <span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
                                                            Generar
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </fieldset>

                                    <div class="form-actions center">
                                        <a href="../cp_menu/frm_menu.php"><input type="button" class="btn btn-sm" value="Cancelar" /></a>
                                            
                                            
                                       
                                        <button type="reset" class="btn btn-sm btn-yellow">
                                            Limpiar
                                            
                                        </button>
                                        <button type="button" class="btn btn-sm btn-success" onclick="xajax_crear(xajax.getFormValues('form'));">
                                            Aceptar
                                           
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-3"></div>

                
            </div>
            

            

            <!-- ==================================================================================== -->
            <!-- ========================== TERMINA AREA DE TRABAJO ================================= -->
            <!-- ==================================================================================== -->

            <!-- ========================== INICIA FOOTER =========================================== -->

            <?php
                include_once('../cp_menu/frm_menu_footer.php');
            ?>

            <!-- ========================== TEMINA FOOTER ======================================= -->

        </div><!-- /.main-container -->

        <!-- ==================================================================================== -->
        <!-- ========================== INICIA SCRIPTS DE FIN DE DOCUMENTO======================= -->
        <!-- ==================================================================================== -->

        <?php
            include_once('../cp_menu/frm_menu_script_bot.php');
        ?>  

        <!-- ==================================================================================== -->
        <!-- ========================== TERMINA SCRIPTS DE FIN DE DOCUMENTO====================== -->
        <!-- ==================================================================================== -->

    </body>
</html>