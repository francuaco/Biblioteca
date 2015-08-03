<?php
	session_start();
	unset($_SESSION['cat']);
	unset($_SESSION['nom']);
	unset($_SESSION['ape']);
	unset($_SESSION['gra']);
	unset($_SESSION['nivel']);
	unset($_SESSION['fec_u']);
	unset($_SESSION['dias']);
	session_destroy();
	// echo "<script>alert('CERRANDO SESION');</script>";
    header('Location: frm_login.php');
?>
