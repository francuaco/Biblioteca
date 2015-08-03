<?php
	date_default_timezone_set('America/Guatemala');
	include_once("../html_fns.php");

	//========================================================================================
	//=================================START WORK AREA========================================
	//========================================================================================

	//=============================COMBO NIVEL=========================
	//=============================COMBO CURSO=========================
	function combo_curso($curso){
		$cls_curso = new cls_curso();
		$resultado = $cls_curso->get_cursos();
		$salida = "";
		$salida.= "<span>";
		$salida.= "<select name='curso' id='curso' class='form-control'>";
		$salida.= "<option value=''>-- Seleccione --</option>";
		foreach ($resultado as $row) {
			$codigo      = $row['cur_codigo'];
			$descripcion = utf8_encode($row['cur_desc_lg']);
			if ($codigo == $curso){
				$salida.= "<option value='$codigo' selected>".$descripcion."</option>";
			}else{
				$salida.= "<option value='$codigo'>".$descripcion."</option>";
			}
		}
		$salida.="</select></span>";
		return $salida;
	}	
	
	function combo_nivel($nivel){
		$salida = "";
		$salida.= "<span>";
		$salida.= "<select name='nivel' id='nivel' class='form-control'>";
		$salida.= "<option value=''>-- Seleccione --</option>";
		if ($nivel == 100){
			$salida.= "<option value='100' selected>ADMINISTRADOR</option>";
		}else{
			$salida.= "<option value='100' >ADMINISTRADOR</option>";
		}
		if ($nivel == 2){
			$salida.= "<option value='2' selected>INSTRUCTOR</option>";
		}else{
			$salida.= "<option value='2' >INSTRUCTOR</option>";
		}
		if ($nivel == 1){
			$salida.= "<option value='1' selected>ALUMNO</option>";
		}else{
			$salida.= "<option value='1' >ALUMNO</option>";
		}		
		$salida.="</select></span>";
		return $salida;
	}
	
	function combo_pago($usu_nivel,$usu_curso,$usu_pago){
		$salida = "";
		$salida.= "<span>";
		$salida.= "<select name='pago' id='pago' class='form-control'>";
		$salida.= "<option value=''>-- Seleccione --</option>";
		if ($usu_curso <> 100 and $usu_nivel == 1){
			if ($usu_pago == 1){
				$salida.= "<option value='1' selected> ** PREMIUM ** </option>";
				$salida.= "<option value='0'> BASICO  </option>";
			}else{
				$salida.= "<option value='1'> ** PREMIUM ** </option>";
				$salida.= "<option value='0' selected> BASICO  </option>";
			}
		}else{
			if ($usu_curso == 100 or $usu_nivel == 100){
				$salida.= "<option value='0' selected> ** ADMINISTRADOR ** </option>";
			}else{
				$salida.= "<option value='0' selected> ** CATEDRATICO ** </option>";
			}
		}
		$salida.= "</select></span>";
		return $salida;
	}
	
	

	function llena_asignados($usu_nivel,$usu_curso,$per_catalogo){
		$cls_asig_libro = new cls_asig_libro();
		$salida = '<div class="col-xs-6" align = "center">';	
		$salida.= '<table id="simple-table" class="table table-striped table-bordered table-hover">';																		
		$salida.= '<tbody>';
		if ($usu_nivel == 100){
			$salida.= '<tr><td class="center"> :::EL USUARIO TIENE ACCESO A TODOS LOS LIBROS:::</td></tr>';
		}else if ($usu_nivel == 2){
			$salida.= '<tr><td class="center"> :::EL INSTRUCTOR TIENE ACCESO A TODOS LOS LIBROS:::</td></tr>';
		}else{
			$resultado = $cls_asig_libro->trae_libros_asignados($usu_curso,$per_catalogo);
			if(is_array($resultado)){
				foreach($resultado as $row){
					$lib_codigo = $row['lib_codigo'];
					$lib_categoria = $row['lib_categoria'];
					$lib_descripcion1 = utf8_encode($row['lib_descripcion1']);
					$salida.= '<tr><td class="center">'.$lib_descripcion1.'</td><td><button class="btn btn-xs btn-danger" onclick = "xajax_quitar_libro('.$lib_codigo.')" ><i class="ace-icon fa fa-trash bigger-120"></i></button></td></tr>';
				}
			}else{
				$salida.= '<tr><td class="center"> :::EL USUARIO NO TIENE LIBROS DE PAGA ASIGNADOS:::</td></tr>';
			}
		}
		$salida.= '</tbody></table></div>';
		return $salida;
	}	
	
	function llena_disponibles($usu_nivel,$usu_curso,$per_catalogo){
		$cls_asig_libro = new cls_asig_libro();
		$salida = '<div class="col-xs-6" align = "center">';	
		$salida.= '<table id="simple-table" class="table table-striped table-bordered table-hover">';																		
		$salida.= '<tbody>';
		if ($usu_nivel == 100){
			$salida.= '<tr><td class="center"> :::EL USUARIO TIENE ACCESO A TODOS LOS LIBROS:::</td></tr>';
		}else if ($usu_nivel == 2){
			$salida.= '<tr><td class="center"> :::EL INSTRUCTOR TIENE ACCESO A TODOS LOS LIBROS:::</td></tr>';
		}else{
			$resultado = $cls_asig_libro->trae_libros_disponibles($usu_curso,$per_catalogo);
			if(is_array($resultado)){
				foreach($resultado as $row){
					$lib_codigo = $row['lib_codigo'];
					$lib_categoria = $row['lib_categoria'];
					$lib_descripcion1 = utf8_encode($row['lib_descripcion1']);
					$salida.= '<tr><td class="center">'.$lib_descripcion1.'</td><td>';
					if ($lib_categoria == 1){
						$salida.= '<button class="btn btn-xs btn-success" onclick = "xajax_asignar_libro('.$lib_codigo.','.$per_catalogo.')" ><i class="ace-icon fa fa-check bigger-120"></i></button></td></tr>';
					}
				}
			}else{
				$salida.= '<tr><td class="center"> :::NO EXISTEN LIBROS EN ESTE CURSO:::</td></tr>';
			}
		}
		$salida.= '</tbody></table></div>';
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

//=================================TRAE CURSO =================================================

function get_curso($cur_codigo){


	$cls_usuario = new cls_usuario();

	
	$resultado = $cls_usuario->get_curso($cur_codigo);


	$salida = '';
	$salida.= '';

	foreach($resultado as $row){

		$salida.= utf8_encode($row['cur_desc_lg']);

	}

	return $salida;

}


//=====================================ALERTAS=================================================

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
//========================================================================================
//=================================END WORK AREA==========================================
//========================================================================================

?>