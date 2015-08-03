<?php
date_default_timezone_set('America/Guatemala');
include_once('html_login.php');
require ('../xajax/xajax_core/xajax.inc.php');

//instanciamos el objeto de la clase xajax
$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');
$xajax->configure('decodeUTF8Input',true);

//=========================================================================================
//================================START WORK AREA==========================================
//=========================================================================================

	function login($form){
		$respuesta = new xajaxResponse();
		$cls_login = new cls_login();
		$usuario 		= $form['usuario'];
		$pass 			= $form['pass'];
		$usu = strlen($usuario);
		$pas = strlen($pass);
		if ($usu > 0 && $pas > 0) {
			$sql = $cls_login->verifica($usuario, $pass);
			if(is_array($sql)){
				foreach($sql as $row){
					$sit = $row['usu_situacion'];
				}
				if($sit == 0){
					session_start();
					$_SESSION['cat'] = $usuario;
					$respuesta->redirect("../cp_user/frm_cambiapass.php", 0);
				}else{
					session_start();
					$_SESSION['cat'] = $usuario;
					$respuesta->redirect("../cp_menu/frm_menu.php", 0);
				}
			}else{
				$mensaje = 'USUARIO O CONTRASEÑA INCORRECTA';
				$mensaje = utf8_decode($mensaje);
				$respuesta->alert($mensaje);
				return $respuesta;
			}
		}else{
			$mensaje = 'UNO O VARIOS CAMPOS SE ENCUENTRAN VACIOS, PORFAVOR INGRESE LOS DATOS REQUERIDOS';
			$mensaje = utf8_decode($mensaje);
			$respuesta->alert($mensaje);
			return $respuesta;
		}
		return $respuesta;
	}

	//============================SE DECLARAN FUNCIONES========================================
	
	$xajax->register(XAJAX_FUNCTION, "login");

	//============================PROCESAR PETICIONES==========================================
	$xajax->processRequest();
	
	//=========================================================================================
	//================================END WORK AREA============================================
	//=========================================================================================
?>