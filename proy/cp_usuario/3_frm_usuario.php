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
        <script src="js/3_js.js"></script>
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
                            Modificar Información
                    </small>
                </h1>
            </div>
			<div class="row" id="div_all"> 
				<div class="widget-body">
					<div class="widget-main no-padding">
						<div id="user-profile-2" class="user-profile">
							<div class="tabbable">
								<ul class="nav nav-tabs padding-18">
									<li class="active">
										<a data-toggle="tab" href="#home"><i class="green ace-icon fa fa-user bigger-120"></i>  Perfil </a>
									</li>
					                <!--li>
										<a data-toggle="tab" href="#opciones"><i class="orange ace-icon fa fa-cogs bigger-120"></i> Asignacion de LIbros </a>
									</li-->
								</ul>
								<form id="form">
						            <div class="tab-content padding-24">
						                <div id="home" class="tab-pane in active">
						                    <div class="row">
						                        <div class="col-xs-12 col-sm-9">
						                            <h4 class="blue">
						                                <span class="middle">Informacion de Usuario</span>
						                            </h4>
						                            <div class="profile-user-info">
														<div class="profile-info-name"> Catálogo </div>
														<div class="profile-info-value">
															<div class="input-group">
																<span class="input-group-addon"><i class="ace-icon fa fa-check"></i></span>
																<input type="text" name="catalogo" id="catalogo" class="form-control search-query" placeholder="Catalogo" />
																<span class="input-group-btn">
																	<button type="button" class="btn btn-purple btn-sm" onclick="busqueda();">
																		<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
																		Buscar
																	</button>
																</span>
															</div>
														</div>
						                            </div>						                            
													<div class="profile-user-info">
														<div class="profile-info-name"> Rol </div>
														<div class="profile-info-value" id = "combo_nivel">
															<span><input type="text" class="col-xs-12" name="usu_nivel" id="usu_nivel" readonly="readonly" /> </span>
														</div>
						                            </div>
						                            <div class="profile-user-info">
														<div class="profile-info-name"> Curso </div>
														<div class="profile-info-value" id = "combo_curso">
															<span><input type="text" class="col-xs-12" name="usu_curso" id="usu_curso"  readonly="readonly"/> </span>
														</div>
						                            </div>						                            
													<div class="profile-user-info">
														<div class="profile-info-name"> Membresia </div>
														<div class="profile-info-value" id = "combo_pago">
															<span><input type="text" class="col-xs-12" name="usu_pago" id="usu_pago"  readonly="readonly"/> </span>
														</div>
						                            </div>
													<div class="profile-user-info">
														<div align="center" style='display:none;' id = "botones">
															<button type="button" class="btn btn-sm btn-success" onclick="xajax_guardar_cambios_user(xajax.getFormValues('form'));"> Guardar Cambios</button>
															<button   href = "3_frm_usuario.php" class="btn btn-sm btn-yellow">Limpiar</button>
														</div>
						                             </div>
						                        </div>
						                    </div>
						                </div>
						                <!--div id="opciones" class="tab-pane">	 
						                    <div class="row">
												<div class="col-sm-6">
													<div class="row">
														<div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
															<b>Libros Disponibles</b>
														</div>
													</div>
													<div id = "disponibles"></div>
												</div>
												<div class="col-sm-6">
													<div class="row">
														<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
															<b>Libros Asignados</b>
														</div>
													</div>
													<div id = "asignados"></div>
												</div>
											</div>
						                </div-->
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- ==================================================================================== -->
			<!-- ========================== TERMINA AREA DE TRABAJO ================================= -->
			<!-- ==================================================================================== -->
			<!-- ========================== INICIA FOOTER =========================================== -->
			<?php include_once('../cp_menu/frm_menu_footer.php'); ?>
			<!-- ========================== TEMINA FOOTER ======================================= -->
        </div>
        <!-- ==================================================================================== -->
        <!-- ========================== INICIA SCRIPTS DE FIN DE DOCUMENTO======================= -->
        <!-- ==================================================================================== -->
        <?php include_once('../cp_menu/frm_menu_script_bot.php'); ?>  
        <!-- ==================================================================================== -->
        <!-- ========================== TERMINA SCRIPTS DE FIN DE DOCUMENTO====================== -->
        <!-- ==================================================================================== -->
    </body>
</html>