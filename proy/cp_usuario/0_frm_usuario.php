<?php
	date_default_timezone_set('America/Guatemala');
	include_once("0_xajax_usuario.php");
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
    		$_SESSION['nivel'] = $row['usu_nivel'];
    		$_SESSION['fec_u'] = $row['usu_fecha_pass'];
    		$_SESSION['dias'] = $row['usu_dias_pass'];
    		$avilita = $row['usu_avilita'];
    	}


    	if ($gracod > 40 && $gracod < 90){
    		$bandera = 1;
    	}

    	if($armcod != 6 && $bandera == 1){
    		$_SESSION['arma'] = 'DE '.$arma;
    	}else{
    		$_SESSION['arma'] = " ";
    	}

	
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Cosede</title>

        <meta name="description" content="User login page" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- ====================================================================================================== -->
        <!-- =======================================INCLUDE XAJAX================================================== -->
        <!-- ====================================================================================================== -->
        <?php
            $xajax->printJavascript("../xajax/");
        ?>
        <!-- ====================================================================================================== -->
        <!-- ====================================================================================================== -->
        <!-- ====================================================================================================== -->

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="../assets/css/bootstrap.css" />
        <link rel="stylesheet" href="../assets/css/font-awesome.css" />

        <!-- text fonts -->
        <link rel="stylesheet" href="../assets/css/ace-fonts.css" />

        <!-- ace styles -->
        <link rel="stylesheet" href="../assets/css/ace.css" />

        <!--[if lte IE 9]>
            <link rel="stylesheet" href="../assets/css/ace-part2.css" />
        <![endif]-->
        <link rel="stylesheet" href="../assets/css/ace-rtl.css" />

        <!--[if lte IE 9]>
          <link rel="stylesheet" href="../assets/css/ace-ie.css" />
        <![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="../assets/js/html5shiv.js"></script>
        <script src="../assets/js/respond.js"></script>
        <![endif]-->

        <!-- ==============JS MIO=============================== -->

         <script src="js/0_js.js"></script>
        <!-- =================================================== -->
    </head>

    <body class="login-layout light-login">
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="login-container">
                            <!-- <div class="center">
                                <h1>
                                    <i class="ace-icon fa fa-leaf green"></i>
                                    <span class="red">Ace</span>
                                    <span class="white" id="id-text2">Application</span>
                                </h1>
                                <h4 class="blue" id="id-company-text">&copy; Company Name</h4>
                            </div> -->

                            <div class="space-6"></div>

                            <div class="position-relative">
                                                              

                                <div id="signup-box" class="signup-box visible widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header green lighter bigger">
                                                <i class="ace-icon fa fa-users blue"></i>
                                                Cambio de Password Unico
                                            </h4>

                                            <div class="space-6"></div>
                                            <p> Ingrese los Siguientes Datos: </p>

                                            <?php
                                                $id = $_GET["id"];
                                                $cls_util = new cls_util();
                                                $usuario = $cls_util->decrypt($id, 'A');
                                                // echo trim($usuario);

                                            ?>

                                            <form id='form' name='form' action='#' autocomplete="off">
                                            
                                                <input type="hidden" name="usu_catalogo" id="usu_catalogo" class="form-control" value="<?php echo $usuario; ?>" />

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" name="usu_pass1" id="usu_pass1" class="form-control" placeholder="Password Actual" value='' autocomplete="off" />
                                                            <i class="ace-icon fa fa-lock"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" name="usu_pass2" id="usu_pass2" class="form-control" placeholder="Password Nuevo" value='' autocomplete="off" />
                                                            <i class="ace-icon fa fa-lock"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" name="usu_pass3" id="usu_pass3" class="form-control" placeholder="Repetir Password Nuevo" value='' autocomplete="off"  />
                                                            <i class="ace-icon fa fa-retweet"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block">
                                                        <input type="checkbox" class='ace' onclick="verificar();" />

                                                        <span class="lbl">
                                                            Acepto el 
                                                            <a href="#">Reglamento de Usuario</a>
                                                        </span>
                                                    </label>
                                                    <input type='hidden' name='contrato' id='contrato' value='0'>


                                                    <div class="clearfix">
                                                        <button type="reset" class="width-30 pull-left btn btn-sm">
                                                            <i class="ace-icon fa fa-refresh"></i>
                                                            <span class="bigger-110">Reset</span>
                                                        </button>

                                                        <button type="button" class="width-65 pull-right btn btn-sm btn-success" onclick="xajax_update_password_login(xajax.getFormValues(form));">
                                                            <span class="bigger-110">Actualizar</span>

                                                            <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                                        </button>
                                                    </div>
                                            </form>
                                        </div>

                                        <div class="toolbar center">
                                            <a href="../cp_login/frm_login.php" class="back-to-login-link">
                                                <i class="ace-icon fa fa-arrow-left"></i>
                                                Regresar al Login
                                            </a>
                                        </div>
                                    </div> <!-- /.widget-body -->
                                 </div><!-- /.signup-box -->
                            </div><!-- /.position-relative -->
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.main-content -->
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script type="text/javascript">
            window.jQuery || document.write("<script src='../assets/js/jquery.js'>"+"<"+"/script>");


        </script>

        <!-- <![endif]-->

        <!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='../assets/js/jquery1x.js'>"+"<"+"/script>");
</script>
<![endif]-->
        <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
        </script>

        <!-- inline scripts related to this page -->
        <script type="text/javascript">
            jQuery(function($) {
             $(document).on('click', '.toolbar a[data-target]', function(e) {
                e.preventDefault();
                var target = $(this).data('target');
                $('.widget-box.visible').removeClass('visible');//hide others
                $(target).addClass('visible');//show target
             });
            });
            
            
            
            //you don't need this, just used for changing background
            jQuery(function($) {
             $('#btn-login-dark').on('click', function(e) {
                $('body').attr('class', 'login-layout');
                $('#id-text2').attr('class', 'white');
                $('#id-company-text').attr('class', 'blue');
                
                e.preventDefault();
             });
             $('#btn-login-light').on('click', function(e) {
                $('body').attr('class', 'login-layout light-login');
                $('#id-text2').attr('class', 'grey');
                $('#id-company-text').attr('class', 'blue');
                
                e.preventDefault();
             });
             $('#btn-login-blur').on('click', function(e) {
                $('body').attr('class', 'login-layout blur-login');
                $('#id-text2').attr('class', 'white');
                $('#id-company-text').attr('class', 'light-blue');
                
                e.preventDefault();
             });
             
            });
        </script>
    </body>