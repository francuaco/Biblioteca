<?php
date_default_timezone_set('America/Guatemala');
include_once("../html_fns.php");

//========================================================================================
//=================================START WORK AREA========================================
//========================================================================================

//================================COMBO CURSOS============================================

function combo_curso(){



	$cls_curso = new cls_curso();

	$resultado = $cls_curso->get_cursos();
	
    
	$salida = "";
	$salida.= "";

    if($resultado) {
    	$salida .= "<select name='curso' id='curso' class='form-control'>";
		$salida .= "<option value=''>-- Seleccione --</option>";

		foreach ($resultado as $row) {
			$codigo 		= $row['cur_codigo'];
			$descripcion 	= utf8_encode($row['cur_desc_lg']);

			// if($codigo != 100){

				$salida.= "<option value='$codigo'>$descripcion</option>";
			//}
			
			
		
		}

		$salida .="</select>";
    }else{
		$salida .= "<select name='curso' id='curso' class='form-control'>";
		$salida .= "<option value=''>-- Seleccione --</option>";
		$salida .= "</select>";
	}
	return $salida;

}

function html_alert($valor){
	
    
	$salida = "";
	$salida.= "";

	if($valor == 1){

		$salida.= '<div class="alert alert-block alert-success">
		                <p>
		                    <strong>
		                        <i class="ace-icon fa fa-check"></i>
		                        Bien Hecho!
		                    </strong>
		                </p>
		                <p>
		               		El registro ha sido Ingresado Correctamente...
		                </p>
		                <p>
		                    <input type="button" class="btn btn-block btn-success"  value="Enterado!!!" onclick="reload();">
		                </p>
		            </div>';

	}elseif ($valor == 2) {
			$salida.= '<div class="alert alert-block alert-danger">
		                <p>
		                    <strong>
		                        <i class="ace-icon fa fa-check"></i>
		                        Error!
		                    </strong>
		                </p>
		                <p>
		               		El registro no se Ingresado Correctamente...
		                </p>
		                <p>
		                    <input type="button" class="btn btn-block btn-danger"  value="Enterado!!!" onclick="reload();">
		                </p>
		            </div>';
	}

return $salida;

}

//=================================TRAE GRADO =================================================

function get_grado($gra_codigo){


	$cls_usuario = new cls_usuario();

	
	$resultado = $cls_usuario->get_grado($gra_codigo);


	$salida = '';
	$salida.= '';

	foreach($resultado as $row){

		$salida.= utf8_encode($row['gra_desc_lg']);

	}

	return $salida;

}

//=================================TRAE ARMA =================================================

function get_arma($arm_codigo){


	$cls_usuario = new cls_usuario();

	
	$resultado = $cls_usuario->get_arma($arm_codigo);


	$salida = '';
	$salida.= '';

	foreach($resultado as $row){

		$salida.= utf8_encode($row['arm_desc_lg']);

	}

	return $salida;

}
//========================================================================================
//=================================END WORK AREA==========================================
//========================================================================================

?>