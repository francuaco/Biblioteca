<?php
	date_default_timezone_set('America/Guatemala');
	require_once('cls_conex.php');
	
	class cls_login extends cls_conex{ 
	
		function verifica($usuario, $pass){
			$pass = $this->encrypt($pass, $usuario); //encrypta el pasword
			$sql =" SELECT * FROM usuario";
			$sql.=" WHERE usu_catalogo = '$usuario'";
			$sql.=" AND usu_pass = '$pass'";
			$sql.=" AND usu_situacion = 1";

			// echo $sql;
			$result= $this->exec_query($sql);
			return $result;
			// return $sql;
		}
		
		function trae_usuario($usuario){
			$sql =" SELECT * FROM usuario,grados,armas,cursos 
					WHERE usu_arma = arm_codigo 
					AND usu_grado = gra_codigo 
					AND usu_curso = cur_codigo
					AND usu_catalogo = $usuario";
			$result= $this->exec_query($sql);
			return $result;
		}
		
		function get_usuario_libro($nivel,$curso){
			$sql = "SELECT cur_codigo,cur_desc_lg FROM cursos";
			$sql.= " WHERE cur_codigo > 0";
			if ($nivel > 1){
				$sql.= " WHERE cur_codigo = $curso";
			}
			$result= $this->exec_query($sql);
			return $result;
		}

		function get_cursos($nivel,$curso){
			$sql = "SELECT * FROM cursos";
			$sql.= " WHERE cur_codigo > 0";
			if ($nivel == 100 && $curso == 100){
				
			}else{
				$sql.= " AND cur_codigo = $curso";
			}
			$sql.= " AND cur_codigo <> 7";
			$sql.= " AND cur_codigo <> 6";
			// echo $sql;
			$result= $this->exec_query($sql);
			return $result;
		}
		
		function total_libros(){
			$sql = "SELECT COUNT(*) AS total FROM LIBROS WHERE 1";
			$result= $this->exec_query($sql);
			foreach($result as $row){
				$total = $row['total'];
			}
			return $total;
		}
	}
?>