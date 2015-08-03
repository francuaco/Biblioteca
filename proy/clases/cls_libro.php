<?php
date_default_timezone_set('America/Guatemala');
require_once('cls_conex.php');
	
class cls_libro extends cls_conex{ 
	
//===============================================================================================================
//=============================START WORK AREA===================================================================
//===============================================================================================================

	//==============================TRAE EL MAXIMO DE LA TABLA LIBROS============================
	function sql_max_lib_codigo(){
		$sql = "SELECT MAX(lib_codigo) as maximo";
		$sql.= " FROM libros";

		// echo $sql;
		$result = $this->exec_query($sql);
		// $max = 0;
		foreach($result as $row){
			$max = $row['maximo'];
		}

		$max = $max + 1;
		return $max;
    }


    //===========================INSERT EN TABLA DE LIBROS======================================

    function sql_insert_libros($lib_codigo, $lib_descripcion1, $lib_descripcion2, $lib_autor, $lib_categoria, $lib_cursos){

    	$sql = "INSERT INTO `libros`(
    		`lib_codigo`, `lib_descripcion1`, `lib_descripcion2`, `lib_autor`, `lib_categoria`, `lib_cursos`
    		) VALUES (
    		'$lib_codigo', '$lib_descripcion1', '$lib_descripcion2', '$lib_autor', '$lib_categoria', '$lib_cursos');";


		return $sql;

    }
	
	function get_categorias (){
		$sql = "SELECT * FROM categorias WHERE 1 = 1";
		$result = $this->exec_query($sql);
		return $result;
	}	
	
	function get_cursos (){
		$sql = "SELECT * FROM cursos WHERE cur_codigo > 0";
		$result = $this->exec_query($sql);
		return $result;
	}		
	
	function get_libros($valor){

		//=========ADMINISTRADOR===============
		if($valor == 100){
			$sql = "SELECT * FROM libros, cursos
				WHERE lib_cursos = cur_codigo
				ORDER BY lib_categoria ASC";
				$result = $this->exec_query($sql);
				return $result;	
		//===========EL RESTO DEL MUNDO================
		}else{

			$sql = "SELECT * FROM libros, cursos
				WHERE lib_cursos = cur_codigo
				AND lib_cursos = $valor
				ORDER BY lib_categoria ASC";
				$result = $this->exec_query($sql);
				return $result;	

		}
			
		
	}
		
//===============================================================================================================
//=============================END WORK AREA=====================================================================
//===============================================================================================================
}
?>