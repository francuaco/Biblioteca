<?php
date_default_timezone_set('America/Guatemala');
include_once("../html_fns.php");

//========================================================================================
//=================================START WORK AREA========================================
//========================================================================================

	function classe($cont){
		switch ($cont){
			case  1:  $clase = "btn btn-yellow ";break;
			case  2:  $clase = 'btn btn-warning';break;
			case  3:  $clase = 'btn btn-info';break;
			case  4:  $clase = 'btn btn-primary';break;
			case  5:  $clase = 'btn btn-success';break;
			case  6:  $clase = 'btn';break;
			case  7:  $clase = 'btn btn-inverse';break;
			case  8:  $clase = 'btn btn-danger';break;
			// case  9:  $clase = 'btn-primary';break;
			// case  10: $clase = 'btn-success';break;
			// case  11: $clase = ' ';break;
			// case  12: $clase = 'btn-inverse';break;		
		}
		return $clase;
	}

//========================================================================================
//=================================END WORK AREA==========================================
//========================================================================================

?>