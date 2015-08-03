<?php
date_default_timezone_set('America/Guatemala');
include_once('2_html_libro.php');
require ('../xajax/xajax_core/xajax.inc.php');

//instanciamos el objeto de la clase xajax
$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');
$xajax->configure('decodeUTF8Input',true);

//=========================================================================================
//================================START WORK AREA==========================================
//=========================================================================================


	
// function grabar($form){
// 	$respuesta = new xajaxResponse();

	
	
// 	return $respuesta;
// }

//============================SE DECLARAN FUNCIONES========================================

$xajax->register(XAJAX_FUNCTION, "grabar");

//============================PROCESAR PETICIONES==========================================
// $xajax->processRequest();

//=========================================================================================
//================================END WORK AREA============================================
//=========================================================================================
?>