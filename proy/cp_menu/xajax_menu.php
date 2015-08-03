<?php
date_default_timezone_set('America/Guatemala');
include_once('html_menu.php');
require ('../xajax/xajax_core/xajax.inc.php');

//instanciamos el objeto de la clase xajax
$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');
$xajax->configure('decodeUTF8Input',true);

//=========================================================================================
//================================START WORK AREA==========================================
//=========================================================================================


	
	function verificar($form){
		$respuesta = new xajaxResponse();

		//====CLASES============================//
		$cls_login = new cls_login();
		//======================================//

		$usuario 		= $form['usuario'];
		$pass 			= $form['pass'];


		$sql = $cls_login->verifica($usuario, $pass);
		
		if(is_array($sql)){

			foreach($sql as $row){
				$cantidad 		= $row['cantidad'];
			}

			if($cantidad == 1){
				$respuesta->redirect("../cp_menu/frm_menu.php", 0);
			}else{
				$respuesta->alert("NO EXISTE");
				// $respuesta->script("location.reload();");
			}

		}else{
			$respuesta->alert("ERROR DE BASE DE DATOS, CONTACTE A SU ADMINISTRADOR");
		}
		
		return $respuesta;
	}

	//============================SE DECLARAN FUNCIONES========================================
	
	$xajax->register(XAJAX_FUNCTION, "verificar");

	//============================PROCESAR PETICIONES==========================================
	$xajax->processRequest();
	
	//=========================================================================================
	//================================END WORK AREA============================================
	//=========================================================================================
?>