<?php
	date_default_timezone_set('America/Guatemala');
	require_once('cls_conex.php');
	
	class cls_usuario extends cls_conex{ 

//=========================================================================================================
//====================================EMPIEZA AREA DE TRABAJO==============================================
//=========================================================================================================
	
		
		function get_grado($gra_codigo){
			$sql =" SELECT * FROM grados WHERE gra_codigo = $gra_codigo;";
			// echo $sql;
			$result= $this->exec_query($sql);
			return $result;
		}
		function get_arma($arm_codigo){
			$sql =" SELECT * FROM armas WHERE arm_codigo = $arm_codigo;";
			// echo $sql;
			$result= $this->exec_query($sql);
			return $result;
		}

		function get_curso($cur_codigo){
			$sql =" SELECT * FROM cursos WHERE cur_codigo = $cur_codigo;";
			// echo $sql;
			$result= $this->exec_query($sql);
			return $result;
		}

		function get_usuario($per_catalogo){
			$sql =" SELECT * FROM usuario,grados,armas WHERE usu_arma = arm_codigo AND usu_grado = gra_codigo AND usu_catalogo = $per_catalogo;";
			// echo $sql;
			$result= $this->exec_query($sql);
			return $result;
		}

		function get_usuarios(){
			$sql =" SELECT * FROM usuario,grados,armas WHERE usu_arma = arm_codigo AND usu_grado = gra_codigo;";
			// echo $sql;
			$result= $this->exec_query($sql);
			return $result;
		}
	
		function get_mper($per_catalogo){
			$sql =" SELECT * FROM mper,grados,armas WHERE per_arma = arm_codigo AND per_grado = gra_codigo AND per_catalogo = $per_catalogo;";
			// echo $sql;
			$result= $this->exec_query($sql);
			return $result;
		}

		function insert_usuario(
			$catalogo,$grado,$arma,   
			$nom1,$ape1,$ape2,    
			$email,$telefono,$curso,
			$nivel,$pass
		){
			$sql =" INSERT INTO `usuario`(
						`usu_catalogo`, `usu_grado`, `usu_arma`, 
						`usu_nom1`, `usu_nom2`, `usu_ape1`, 
						`usu_ape2`, `usu_curso`, `usu_mail`, 
						`usu_telefono`, `usu_nivel`, `usu_pass`, 
						`usu_pregunta`, `usu_respuesta`, `usu_fecha_inicio`, 
						`usu_fecha_pass`, `usu_dias_pass`, `usu_situacion`, `usu_avilita`
					) VALUES (
						'$catalogo','$grado','$arma',
						'$nom1','','$ape1',
						'$ape2','$curso','$email',
						'$telefono','$nivel','$pass',
						'','','',
						'','1000000','1','0');
					";
			// echo $sql;
			return $sql;
		}

		function update_usuario(
			$catalogo,   
			$email,$telefono
		){
			
			$sql =" UPDATE `usuario` 
					SET `usu_mail`= '$email',`usu_telefono`= '$telefono' WHERE usu_catalogo = $catalogo;";

			// echo $sql;
			return $sql;
		}

		function update_password(
			$catalogo,   
			$usu_pass
		){
			
			$sql =" UPDATE `usuario` 
					SET `usu_pass`= '$usu_pass' WHERE usu_catalogo = $catalogo;";

			// echo $sql;
			return $sql;
		}

		function update_usuario_situacion(
			$usu_catalogo,$valor
		){
			
			$sql =" UPDATE `usuario` 
					SET `usu_situacion`= '$valor' WHERE usu_catalogo = $usu_catalogo;";

			// echo $sql;
			return $sql;
		}

		function update_usuario_avilita(
			$usu_catalogo,$valor
		){
			
			$sql =" UPDATE `usuario` 
					SET `usu_avilita`= '$valor' WHERE usu_catalogo = $usu_catalogo;";

			// echo $sql;
			return $sql;
		}
		
		
		////TTE FRANCIA 
		function traeme_usuario($per_catalogo){
			$sql =" SELECT * FROM usuario,grados,armas,cursos 
					WHERE usu_arma = arm_codigo 
					AND usu_grado = gra_codigo 
					AND usu_curso = cur_codigo
					AND usu_catalogo = $per_catalogo;";
			$result= $this->exec_query($sql);
			return $result;
		}

//=========================================================================================================
//=================================TERMINA AREA DE TRABAJO=================================================
//=========================================================================================================
		
	}
?>