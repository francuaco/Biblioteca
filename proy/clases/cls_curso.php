<?php
	date_default_timezone_set('America/Guatemala');
	require_once('cls_conex.php');
	
	class cls_curso extends cls_conex{ 


	//================================================================================
	//=============================AREA DE TRABAJO====================================
	//================================================================================

		//=========================TRAE CURSOS========================================
	
		function get_cursos(){
			$sql =" SELECT * FROM cursos WHERE 1 = 1 ORDER BY cur_desc_lg ASC";
			$result= $this->exec_query($sql);
			return $result;
		}
	
	//================================================================================
	//============================TERMINA AREA DE TRABAJO=============================
	//================================================================================	
	}
?>