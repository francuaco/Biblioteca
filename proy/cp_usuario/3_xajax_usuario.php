<?php
date_default_timezone_set('America/Guatemala');
include_once('3_html_usuario.php');
require ('../xajax/xajax_core/xajax.inc.php');

//instanciamos el objeto de la clase xajax
$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');
$xajax->configure('decodeUTF8Input',true); 

//=========================================================================================
//================================START WORK AREA==========================================
//=========================================================================================

	//=============================ACTUALIZAR USUARIO========================

	function update_password($form){
		$respuesta = new xajaxResponse();


		$catalogo 			= $form['usu_catalogo'];
		$usu_password1  	= $form['usu_pass1'];
		$usu_password2 		= $form['usu_pass2'];
		$usu_password3 		= $form['usu_pass3'];
		

		if(empty($catalogo)){$respuesta->alert('Catalogo no puede ir vacio');return $respuesta;}
		if(empty($usu_password1)){$respuesta->alert('El Password Actual no puede ir Vacio');return $respuesta;}
		if(empty($usu_password2)){$respuesta->alert('El nuevo Password no puede ir Vacio');return $respuesta;}
		if(empty($usu_password3)){$respuesta->alert('El campo de confirmacion de Password no puede ir Vacio');return $respuesta;}
		
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

		$rs = $cls_usuario->exec_sql($sql2);
	
		if($rs == 1){
			$valor 	= 1;
			$alert 	= 	html_alert($valor);
			$alert 	= 	utf8_decode($alert);
			$respuesta->assign("div_all", "innerHTML", "$alert");
			return $respuesta;
		}else{
			$valor 	= 2;
			$alert 	= 	html_alert($valor);
			$alert 	= 	utf8_decode($alert);
			$respuesta->assign("div_all", "innerHTML", "$alert");
			return $respuesta;
		}

		return $respuesta;
	}

	//===============================ACTUALIZAR================================================

	function update_datos_personales($form){
		$respuesta = new xajaxResponse();


		$catalogo 			= $form['usu_catalogo'];
		$usu_mail  			= $form['usu_mail'];
		$usu_telefono 		= $form['usu_telefono'];
		

		if(empty($catalogo)){$respuesta->alert('Catalogo no puede ir vacio');return $respuesta;}
		if(empty($usu_mail)){$respuesta->alert('El Correo Electronico no Puede ir Vacio');return $respuesta;}
		if(empty($usu_telefono)){$respuesta->alert('El Numero de Telefono no Puede ir Vacio');return $respuesta;}

		if(filter_var($usu_mail, FILTER_VALIDATE_EMAIL)){
		   //=====DIRECCIN DE CORREO VALIDA
		}else{
			//====DIRECCION DE CORREO NO VALIDA
		    $respuesta->alert('Ingrese una Direccion de Correo Electronico Valida');
		    return $respuesta;
		} 

		
		$cls_usuario = new cls_usuario();

		$sql2 = $cls_usuario->update_usuario(
			$catalogo,$usu_mail, $usu_telefono
		);

		$rs = $cls_usuario->exec_sql($sql2);
	
		if($rs == 1){
			$valor 	= 1;
			$alert 	= 	html_alert($valor);
			$alert 	= 	utf8_decode($alert);
			$respuesta->assign("div_all", "innerHTML", "$alert");
			return $respuesta;
		}else{
			$valor 	= 2;
			$alert 	= 	html_alert($valor);
			$alert 	= 	utf8_decode($alert);
			$respuesta->assign("div_all", "innerHTML", "$alert");
			return $respuesta;
		}

		return $respuesta;
	}

	//============================SE DECLARAN FUNCIONES========================================
	function buscar_cat($per_catalogo){
		$respuesta = new xajaxResponse();
		$cls_usuario = new cls_usuario();
		$sql = $cls_usuario->traeme_usuario($per_catalogo);
		if(is_array($sql)){
			foreach($sql as $row){
				$usu_nivel = $row['usu_nivel'];
				$usu_curso = $row['usu_curso'];
				$usu_pago = $row['usu_pago'];
			}
			$nivel = combo_nivel($usu_nivel);
			$respuesta->assign("combo_nivel", "innerHTML", "$nivel");
			$curso = combo_curso($usu_curso);
			$respuesta->assign("combo_curso", "innerHTML", "$curso");
			$pago = combo_pago($usu_nivel,$usu_curso,$usu_pago);
			$respuesta->assign("combo_pago", "innerHTML", "$pago");
			$respuesta->Script("document.getElementById('botones').style.display='';");
			// $disponibles = llena_disponibles($usu_nivel,$usu_curso,$per_catalogo);
			// $asignados   = llena_asignados  ($usu_nivel,$usu_curso,$per_catalogo);
			// $respuesta->assign("disponibles", "innerHTML", "$disponibles");
			// $respuesta->assign("asignados", "innerHTML", "$asignados");
		}else{
			$respuesta->alert("El Catalogo ingresado no existe...");

		}
		return $respuesta;
	}	
	function asignar_libro ($libro,$catalogo){
		$respuesta = new xajaxResponse();
		$cls_asig_libro = new cls_asig_libro();
		$hoy = date("Y-m-d");
		$m = date("m");
		if ($m <= 9){
			$dd = date("d");
			$mm = ($m + 3);
			$yy = date("Y");
		}else{
			$dd = date("d");
			$mm = (($m + 3)-12);
			$yy = (date("Y") + 1);
		}
		$vence = $yy."-".$mm."-".$dd;
		$sql = $cls_asig_libro->inserta_asignacion($libro,$catalogo,$hoy,$vence);
		$disponibles = llena_disponibles($usu_nivel,$usu_curso,$per_catalogo);
		$asignados   = llena_asignados  ($usu_nivel,$usu_curso,$per_catalogo);
		$respuesta->assign("disponibles", "innerHTML", "$disponibles");
		$respuesta->assign("asignados", "innerHTML", "$asignados");
		return $respuesta;
	}
	
	
	function guardar_cambios_user($form){
		$respuesta = new xajaxResponse();
		$cls_usuario = new cls_usuario();
		$catalogo 	= $form['catalogo'];
		$nivel  	= $form['nivel'];
		$curso 		= $form['curso'];
		$pago 		= $form['pago'];
		$sql = " UPDATE usuario SET usu_nivel = $nivel,usu_curso = $curso,usu_pago = $pago WHERE usu_catalogo = $catalogo";
		$result = $cls_usuario->exec_sql($sql);
		if ($result == 1){
			$respuesta->alert("MODIFICADOS EXITOSAMENTE!...");
			$respuesta->Script("window.location = '3_frm_usuario.php'");
			;
		}else {
			$respuesta->alert("ERRO DE CONEXION, INTENTE MAS TARDE!..");
			$respuesta->Script("window.location = '3_frm_usuario.php'");
		}
		return $respuesta;
	}
	$xajax->register(XAJAX_FUNCTION, "update_password");
	$xajax->register(XAJAX_FUNCTION, "update_datos_personales");
	$xajax->register(XAJAX_FUNCTION, "buscar_cat");
	$xajax->register(XAJAX_FUNCTION, "asignar_libro");
	$xajax->register(XAJAX_FUNCTION, "guardar_cambios_user");

	//============================PROCESAR PETICIONES==========================================
	$xajax->processRequest();
	
	//=========================================================================================
	//================================END WORK AREA============================================
	//=========================================================================================
?>