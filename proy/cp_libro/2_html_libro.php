<?php
	date_default_timezone_set('America/Guatemala');
	include_once("../html_fns.php");

//========================================================================================
//=================================START WORK AREA========================================
//========================================================================================


	function combo_cursos($i='') {
		$cls_libro = new cls_libro();
		$result = $cls_libro->get_cursos('');
		if(is_array($result)){
			return combos_html($result,"lib_cursos$i","cur_codigo","cur_desc_md");
		}
	}	
	
	//================================TABLA DE USUARIOS============================================

function tabla_libros($valor){



	$cls_libro = new cls_libro();
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
	$salida.= "				<table id='tabla_libros' class='table table-striped table-bordered table-hover'>";
	$salida.= "					<thead>";
	$salida.= "						<tr>";
	$salida.= "							<th class='center'>No.</th>";
	$salida.= "							<th>Libro</th>";
	$salida.= "							<th class='hidden-480'>Autor</th>";
	$salida.= "							<th class='hidden-480'>Categoria</th>";
	$salida.= "							<th>Accion</th>";
	$salida.= "						</tr>";
	$salida.= "					</thead>";
	$salida.= "					<tbody>";

// return $salida;


	$resultado = $cls_libro->get_libros($valor);

	if(is_array($resultado)){

		$num = 1;
		foreach($resultado as $row){

			$lib_codigo 		= utf8_encode($row['lib_codigo']);
			$lib_descripcion1 	= utf8_encode($row['lib_descripcion1']);
			$lib_descripcion2 	= utf8_encode($row['lib_descripcion2']);
			$lib_autor 			= utf8_encode($row['lib_autor']);
			$lib_categoria 		= utf8_encode($row['lib_categoria']);
			$lib_cursos 		= utf8_encode($row['lib_cursos']);
			

			// $usu_grado		= get_grado($usu_grado);
			// $usu_arma		= get_arma($usu_arma);
			// $usu_curso		= get_curso($usu_curso);
			
			if($lib_categoria == 1){
				$lib_categoria = 'PAGO';
			}elseif ($lib_categoria == 2) {
				$lib_categoria = 'PUBLICO';
			}

			// if($usu_situacion == 1){
			// 	$usu_situacion = 'ACTIVO';
			// 	$salida.= "			<tr class='success'>";
			// }elseif ($usu_situacion == 2) {
			// 	$usu_situacion = 'SUSPENDIDO';
			// 	$salida.= "			<tr class='danger'>";
			// }
			// $catalogo = $cls_util->encrypt($usu_catalogo, 'A');
				$salida.= "			<tr>";
	            $salida.= "    			<td class='center'>".$num++."</td>";
	            $salida.= "    			<td>".$lib_descripcion1."</td>";
	            $salida.= "    			<td class='hidden-480'>".$lib_autor."</td>";
	            $salida.= "   			<td class='hidden-480'>".$lib_categoria."</td>";
	            $salida.= '				<td>
											<div class="hidden-sm hidden-xs btn-group">
												<a class="btn btn-xs btn-success" href="../cp_libro/libros/'.$lib_codigo.'.pdf" target = "_blank">
													<i class="fa fa-eye bigger-120" title="Visualizar"></i>
												</a>

												<a  class="btn btn-xs btn-info" href="../cp_libro/libros/'.$lib_codigo.'.pdf" download="'.$lib_descripcion2.'">
													<i class="fa fa-download bigger-120" title="Descargar"></i>
												</a>

												 

												
											</div>

											<div class="hidden-md hidden-lg">
												<div class="inline pos-rel">
													<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
														<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
													</button>

													<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
														<li>
															<a href="../cp_libro/libros/'.$lib_codigo.'.pdf" target = "_blank" class="tooltip-info" data-rel="tooltip" title="Visualizar">
																<span class="green">
																	<i class="fa fa-eye bigger-120"></i>
																</span>
															</a>
														</li>

														<li>
															<a href="../cp_libro/libros/'.$lib_codigo.'.pdf" download="'.$lib_descripcion2.'" class="tooltip-info" data-rel="tooltip" title="Descargar" >
																<span class="blue">
																	<i class="fa fa-download bigger-120"></i>
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


//========================================================================================
//=================================END WORK AREA==========================================
//========================================================================================

?>