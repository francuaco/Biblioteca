<?php
	require_once("clases/cls_login.php");
	require_once("clases/cls_curso.php");
	require_once("clases/cls_usuario.php");
	require_once("clases/cls_util.php");
	require_once("clases/cls_libro.php");
	



	function combos_html($result_id,$name,$c1,$c2) {
		if (!$result_id) {
			return ;
		}
		$salida = '<select name="'.$name.'" id="'.$name.'" class = "form-control">';
		$salida.= '<option value = "">-- Seleccione --</option>';
		foreach ($result_id as $row) {
			if($row[$c1] != 100){
				$salida.= '<option value ='.$row[$c1].'>'.utf8_encode($row[$c2]).'</option>';
			}
	   		
		}
		$salida.='</select>';
		return $salida;
	}
	
?>