<?php
date_default_timezone_set('America/Guatemala');
include_once("../html_fns.php");

//========================================================================================
//=================================START WORK AREA========================================
//========================================================================================

//================================TABLA DE USUARIOS============================================

function tabla_usuarios(){



	$cls_usuario = new cls_usuario();
	$cls_util = new cls_util();

	
	
    


	$salida = "";
	$salida.= "";
	$salida.= "	<div class='row'>";
	$salida.= "		<div class='col-xs-12'>";
	$salida.= "			<div class='clearfix'>";
	$salida.= "				<div class='pull-right tableTools-container'></div>";
	$salida.= "			</div>";
	$salida.= "			<div class='table-header'>";
	$salida.= "				Tabla de Resultados";
	$salida.= "			</div>";
	$salida.= "			<div>";
	$salida.= "				<table id='dynamic-table' class='table table-striped table-bordered table-hover'>";
	$salida.= "					<thead>";
	$salida.= "						<tr>";
	$salida.= "							<th class='center'>No.</th>";
	$salida.= "							<th class='hidden-480'>Catalogo</th>";
	$salida.= "							<th>Grado</th>";
	$salida.= "							<th class='hidden-480'>Arma</th>";
	$salida.= "							<th>Nombre</th>";
	$salida.= "							<th class='hidden-480'>Curso</th>";
	$salida.= "							<th class='hidden-480'>Permiso</th>";
	$salida.= "							<th class='hidden-480'>Situacion</th>";
	$salida.= "							<th>Accion</th>";
	$salida.= "						</tr>";
	$salida.= "					</thead>";
	$salida.= "					<tbody>";

	$resultado = $cls_usuario->get_usuarios();

	if(is_array($resultado)){

		$num = 1;
		foreach($resultado as $row){

			$usu_catalogo 	= utf8_encode($row['usu_catalogo']);
			$usu_grado 		= utf8_encode($row['usu_grado']);
			$usu_arma 		= utf8_encode($row['usu_arma']);
			$usu_nom1 		= utf8_encode($row['usu_nom1']);
			$usu_ape1 		= utf8_encode($row['usu_ape1']);
			$usu_ape2 		= utf8_encode($row['usu_ape2']);
			$usu_curso 		= utf8_encode($row['usu_curso']);
			$usu_nivel 		= utf8_encode($row['usu_nivel']);
			$usu_situacion 	= utf8_encode($row['usu_situacion']);

			$usu_grado		= get_grado($usu_grado);
			$usu_arma		= get_arma($usu_arma);
			$usu_curso		= get_curso($usu_curso);
			
			if($usu_nivel == 1){
				$usu_nivel = 'ALUMNO';
			}elseif ($usu_nivel == 2) {
				$usu_nivel = 'INSTRUCTOR';
			}elseif ($usu_nivel == 100) {
				$usu_nivel = 'ADMINISTRADOR';
			}

			if($usu_situacion == 1){
				$usu_situacion = 'ACTIVO';
				$salida.= "			<tr class='success'>";
			}elseif ($usu_situacion == 2) {
				$usu_situacion = 'SUSPENDIDO';
				$salida.= "			<tr class='danger'>";
			}
			$catalogo = $cls_util->encrypt($usu_catalogo, 'A');
				
	            $salida.= "    			<td class='center'>".$num++."</td>";
	            $salida.= "    			<td class='hidden-480'>".$usu_catalogo."</td>";
	            $salida.= "    			<td>".$usu_grado."</td>";
	            $salida.= "   			<td class='hidden-480'>".$usu_arma."</td>";
	            $salida.= "   			<td>".$usu_nom1." ".$usu_ape1." ".$usu_ape2."</td>";
	            $salida.= "    			<td class='hidden-480'>".$usu_curso."</td>";
	            $salida.= "    			<td class='hidden-480'>".$usu_nivel."</td>";
	            $salida.= "    			<td class='hidden-480'>".$usu_situacion."</td>";
	            $salida.= '				<td>
											<div class="hidden-sm hidden-xs btn-group">
												<button class="btn btn-xs btn-success" onclick="xajax_update_situacion('.$usu_catalogo.', 1);">
													<i class="ace-icon fa fa-check bigger-120"></i>
												</button>

												<a  class="btn btn-xs btn-info" href="3_frm_usuario.php?catalogo='.$catalogo.'&valor=1">
													<i class="ace-icon fa fa-pencil bigger-120"></i>
												</a>

												<button class="btn btn-xs btn-danger" onclick="xajax_update_situacion('.$usu_catalogo.', 2);">
													<i class="ace-icon fa fa-ban bigger-120"></i>
												</button>

												
											</div>

											<div class="hidden-md hidden-lg">
												<div class="inline pos-rel">
													<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
														<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
													</button>

													<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
														<li>
															<a href="#" class="tooltip-info" data-rel="tooltip" title="Activar" onclick="xajax_update_situacion('.$usu_catalogo.', 1);">
																<span class="green">
																	<i class="ace-icon fa fa-check bigger-120"></i>
																</span>
															</a>
														</li>

														<li>
															<a href="3_frm_usuario.php?catalogo='.$catalogo.'&valor=1" class="tooltip-success" data-rel="tooltip" title="Editar">
																<span class="blue">
																	<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																</span>
															</a>
														</li>

														<li>
															<a  href="#" class="tooltip-error" data-rel="tooltip" title="Suspender" onclick="xajax_update_situacion('.$usu_catalogo.', 2);">
																<span class="red">
																	<i class="ace-icon fa fa-ban bigger-120"></i>
																</span>
															</a>
														</li>
													</ul>
												</div>
											</div>
										</td>';
       			$salida.= "			</tr>";
	
		
		}


	}

	$salida.= "					</tbody>";
	$salida.= "				</table>";
	$salida.= "			</div>";
	$salida.= "		</div>";
	$salida.= "	</div>";






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