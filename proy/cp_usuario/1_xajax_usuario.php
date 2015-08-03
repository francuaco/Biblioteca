<?php
date_default_timezone_set('America/Guatemala');
include_once('1_html_usuario.php');
require ('../xajax/xajax_core/xajax.inc.php');

//instanciamos el objeto de la clase xajax
$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');
$xajax->configure('decodeUTF8Input',true); 

//=========================================================================================
//================================START WORK AREA==========================================
//=========================================================================================


	//=============================VERIFICAR SI EL USUARIO EXISTE=========================
	
	function verificar($form){
		$respuesta = new xajaxResponse();

		$cls_login = new cls_login();

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

	//=============================VERIFICAR SI EL USUARIO EXISTE=========================

	function generar(){
		$respuesta = new xajaxResponse();

		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$pass = "";

			for($i = 0; $i < 12; $i++) {
		
				$pass.= substr($str,rand(0,62),1);

			}

		$respuesta->assign("pass","value",$pass);

		return $respuesta;
	}


	//=============================BUSCAR EN MPER=========================

	function buscar($per_catalogo){
		$respuesta = new xajaxResponse();

		$cls_usuario = new cls_usuario();


		// $respuesta->assign("catalogo","value",$per_catalogo);
		$respuesta->assign("grado","value",'');
		$respuesta->assign("arma","value",'');
		$respuesta->assign("nom1","value",'');
		$respuesta->assign("ape1","value",'');
		$respuesta->assign("ape2","value",'');
		$respuesta->assign("email","value",'');
		$respuesta->assign("telefono","value",'');
		$respuesta->assign("curso","value",'');
		$respuesta->assign("nivel","value",'');
		$respuesta->assign("pass","value",'');



		$sql = $cls_usuario->get_usuario($per_catalogo);

		if(is_array($sql)){
			$respuesta->alert("El Usuario Ya Existe...");
			return $respuesta;
		}

		$sql = $cls_usuario->get_mper($per_catalogo);
		
		if(is_array($sql)){


			foreach($sql as $row){

				$per_catalogo 	= $row['per_catalogo'];
				$per_grado 		= $row['per_grado'];
				$per_arma 		= $row['per_arma'];
				$per_nom1 		= $row['per_nom1'];
				$per_ape1 		= $row['per_ape1'];
				$per_ape2 		= $row['per_ape2'];

				
			
			}

			$per_grado		= get_grado($per_grado);
			$per_arma		= get_arma($per_arma);
			// $usu_curso		= get_curso($usu_curso);

			$respuesta->assign("catalogo","value",$per_catalogo);
			$respuesta->assign("grado","value",$per_grado);
			$respuesta->assign("arma","value",$per_arma);
			$respuesta->assign("nom1","value",$per_nom1);
			$respuesta->assign("ape1","value",$per_ape1);
			$respuesta->assign("ape2","value",$per_ape2);


		}else{

			$respuesta->alert("El Usuario a Crear no existe...");
		
		}


		return $respuesta;
	}


	//=============================CREAR USUARIO========================

	function crear($form){
		$respuesta = new xajaxResponse();


		$catalogo = $form['catalogo'];
		$grado    = $form['grado'];
		$arma     = $form['arma'];
		$nom1     = $form['nom1'];
		$ape1     = $form['ape1'];
		$ape2     = $form['ape2'];
		$email    = $form['email'];
		$telefono = $form['telefono'];
		$curso    = $form['curso'];
		$nivel    = $form['nivel'];
		$pass     = $form['pass'];

		if(empty($catalogo)){$respuesta->alert('Catalogo no puede ir vacio');return $respuesta;}
		if(empty($grado)){$respuesta->alert('Grado no puede ir vacio');return $respuesta;}
		if(empty($arma)){$respuesta->alert('Arma no puede ir vacio');return $respuesta;}
		if(empty($nom1)){$respuesta->alert('Primer Nombre no puede ir vacio');return $respuesta;}
		if(empty($ape1)){$respuesta->alert('Primer Apellido no puede ir vacio');return $respuesta;}
		if(empty($email)){$respuesta->alert('Correo Electronico no puede ir vacio');return $respuesta;}
		if(empty($telefono)){$respuesta->alert('Telefono/Celular no puede ir vacio');return $respuesta;}
		if(empty($curso)){$respuesta->alert('Curso no puede ir vacio');return $respuesta;}
		if(empty($nivel)){$respuesta->alert('Nivel de Permiso no puede ir vacio');return $respuesta;}
		if(empty($pass)){$respuesta->alert('Password no puede ir vacio');return $respuesta;}


		$cls_usuario = new cls_usuario();
		$cls_util = new cls_util();


		$pass = $cls_util->encrypt($pass, $catalogo);

		$sql = $cls_usuario->insert_usuario(
			$catalogo,$grado,$arma,   
			$nom1,$ape1,$ape2,$email,$telefono,
			$curso,$nivel,$pass   
		);

		$rs = $cls_usuario->exec_sql($sql);
	
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
	
	$xajax->register(XAJAX_FUNCTION, "verificar");
	$xajax->register(XAJAX_FUNCTION, "generar");
	$xajax->register(XAJAX_FUNCTION, "buscar");
	$xajax->register(XAJAX_FUNCTION, "crear");

	//============================PROCESAR PETICIONES==========================================
	$xajax->processRequest();
	
	//=========================================================================================
	//================================END WORK AREA============================================
	//=========================================================================================
?>