<?php
date_default_timezone_set('America/Guatemala');
include_once("1_xajax_libro.php");

$lib_descripcion1 	= $_REQUEST['lib_descripcion'];
$lib_autor 			= $_REQUEST['lib_autor'];
$lib_categoria 		= $_REQUEST['lib_categoria'];
$lib_cursos 		= $_REQUEST['lib_cursos'];

$file_size 			= $_FILES["id-input-file-3"]['size'];
$file_type 			= $_FILES["id-input-file-3"]['type'];
$file_name 			= $_FILES["id-input-file-3"]['name'];
$lib_descripcion2 	= $_FILES["id-input-file-3"]['name'];

	$cls_libro = new cls_libro();
	$lib_codigo = $cls_libro->sql_max_lib_codigo();
	// Sube archivo
	if ($file_name != "") {
		if (strpos($file_name, ".pdf")) { 
			if ($file_size < 6000000) {
				// guardamos el archivo a la carpeta files
				$destino =  "libros/".$lib_codigo.".pdf";
				if (move_uploaded_file($_FILES['id-input-file-3']['tmp_name'],$destino)) {
					// $msj = "Archivo <b>$file_name</b> subido como Orden Numero $lib_codigo<br> Carga Exitosa...!" ; 
					$status = 1;
				} else {
					// $msj = "Error al subir el archivo"; 
					$status = 2;
				}
			}else {
				// $msj = "Se permiten archivos de 1 Mb máximo. $file_size"; 
				$status = 3;
			}
		}else {
			// $msj = "El Tipo de Archivo es incorrecto, solo se aceptan Archivos formato PDF";  
			$status = 4;
		}
	} else {
		// $msj = "Archivo vacio."; 
		$status = 5;
	}
	
	
	if ($status == 1) {	

		

		//inserta en la tabla libros
		$sql = $cls_libro->sql_insert_libros($lib_codigo, $lib_descripcion1, $lib_descripcion2, $lib_autor, $lib_categoria, $lib_cursos);
		$rs = $cls_libro->exec_sql($sql);

		if($rs == 1){
			header("Location: 1_frm_libro.php?valor=1");
			return;
		}else{
			// echo $sql;
			header("Location: 1_frm_libro.php?valor=2");
			return;
		}
		
	}elseif($status == 2){
		header("Location: 1_frm_libro.php?valor=2");
		return;
	}elseif($status == 3){
		header("Location: 1_frm_libro.php?valor=3");
		return;
	}elseif($status == 4){
		header("Location: 1_frm_libro.php?valor=4");
		return;
	}elseif($status == 5){
		header("Location: 1_frm_libro.php?valor=5");
		return;
	}


?>