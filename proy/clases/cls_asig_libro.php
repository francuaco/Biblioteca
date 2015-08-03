<?php
date_default_timezone_set('America/Guatemala');
require_once('cls_conex.php');
	
class cls_asig_libro extends cls_conex{ 
	
//===============================================================================================================
//=============================START WORK AREA===================================================================
//===============================================================================================================

	//==============================TRAE LIBROS ASIGNADOS============================
	function trae_libros_asignados($usu_curso,$per_catalogo){
		$sql = " SELECT * FROM libros,asigna_libro";
		$sql.= " WHERE lib_codigo = asig_libro";
		$sql.= " AND lib_cursos = $usu_curso";
		$sql.= " AND asig_catalogo = $per_catalogo ";
		$sql.= " ORDER BY lib_descripcion1 DESC ";
		$result = $this->exec_query($sql);
		return $result;
    }

	function trae_libros_catedratico($usu_curso){
		$sql = "SELECT * FROM libros";
		$result = $this->exec_query($sql);
		return $result;
	}
    //===========================INSERT EN TABLA DE LIBROS======================================

    function trae_libros_disponibles($usu_curso,$per_catalogo){
		$sql = " 	SELECT * FROM libros
					LEFT JOIN asigna_libro
					ON lib_codigo <> asig_libro
					AND asig_catalogo = $per_catalogo
					AND lib_cursos = $usu_curso
					ORDER BY lib_descripcion1 ASC ";
		$result = $this->exec_query($sql);
		return $result;
    }
	
	
	function inserta_asignacion($libro,$catalogo,$hoy,$vence){
		$sql = "INSERT INTO asigna_libro VALUES ($libro,$catalogo,'$hoy','$vence')";
		$result = $this->exec_sql($sql);
		return $result;
	}
		
//===============================================================================================================
//=============================END WORK AREA=====================================================================
//===============================================================================================================
}
?>