<?php
date_default_timezone_set('America/Guatemala');
include_once('0_html_usuario.php');
require ('../xajax/xajax_core/xajax.inc.php');

//instanciamos el objeto de la clase xajax
$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');
$xajax->configure('decodeUTF8Input',true); 

//=========================================================================================
//================================START WORK AREA==========================================
//=========================================================================================


	//=============================ACTUALIZAR USUARIO========================

	function update_password_login($form){
		$respuesta = new xajaxResponse();


		$catalogo 			= $form['usu_catalogo'];
		$usu_password1  	= $form['usu_pass1'];
		$usu_password2 		= $form['usu_pass2'];
		$usu_password3 		= $form['usu_pass3'];
		$contrato 			= $form['contrato'];
		
		// $respuesta->alert($contrato);
		// return $respuesta;


		if(empty($catalogo)){$respuesta->alert('Catalogo no puede ir vacio');return $respuesta;}
		if(empty($usu_password1)){$respuesta->alert('El Password Actual no puede ir Vacio');return $respuesta;}
		if(empty($usu_password2)){$respuesta->alert('El nuevo Password no puede ir Vacio');return $respuesta;}
		if(empty($usu_password3)){$respuesta->alert('El campo de confirmacion de Password no puede ir Vacio');return $respuesta;}
		if($contrato==0){$respuesta->alert('Debe Aceptar las Normas que se encuentran en el Reglamento del Usuario');return $respuesta;}
		
		if($usu_password2 != $usu_password3){
			$respuesta->alert('El nuevo password y la confirmacion de password no son iguales');
			return $respuesta;
		}

		$cls_usuario = new cls_usuario();

		$sql1 = $cls_usuario->get_usuario($catalogo);

			foreach($sql1 as $row){
				$pass_old_bd	= $row['usu_pass'];
			}

		$cls_util = new cls_util();

		$pass_old_form = $cls_util->encrypt($usu_password1, $catalogo);

		if($pass_old_bd != $pass_old_form){

			$respuesta->alert('El Password Actual no es Igual al de Base de Datos');
			return $respuesta;

		}

		$usu_password2 = $cls_util->encrypt($usu_password2, $catalogo);

		$sql2 = $cls_usuario->update_password(
			$catalogo,$usu_password2   
		);

		$sql2.= $cls_usuario->update_usuario_avilita(
			$catalogo,0   
		);

		$rs = $cls_usuario->exec_sql($sql2);
	
		if($rs == 1){
			$respuesta->redirect('../cp_menu/frm_menu.php');
			return $respuesta;
		}else{
			$respuesta->alert('Error en Base de Datos, Contacte a su Administrador');
			return $respuesta;
		}

		return $respuesta;
	}

	//============================SE DECLARAN FUNCIONES========================================
	
	$xajax->register(XAJAX_FUNCTION, "update_password_login");

	//============================PROCESAR PETICIONES==========================================
	$xajax->processRequest();
	
	//=========================================================================================
	//================================END WORK AREA============================================
	//=========================================================================================
?>