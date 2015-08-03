<?php
	date_default_timezone_set('America/Guatemala');
	include_once("3_xajax_usuario.php");
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
        <script src="js/2_js.js"></script>
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
                            Perfil
                    </small>
                </h1>
            </div>


            

            <div class="row" id="div_all">     
            <?php 

                echo html_perfil_frm5($usuario);
                       
            ?>
                       
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
            // include_once('../cp_menu/frm_menu_tablas.php');
        ?>  

        <!-- ==================================================================================== -->
        <!-- ========================== TERMINA SCRIPTS DE FIN DE DOCUMENTO====================== -->
        <!-- ==================================================================================== -->

    </body>
</html>