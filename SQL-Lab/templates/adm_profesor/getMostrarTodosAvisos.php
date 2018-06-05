<?php 
	session_start();

	$user = $_REQUEST["user"];

	include_once "../../inc/usuario.php";
	
	$usu = new Usuario();
	$resul = $usu->getAvisos($user);
	
	echo json_encode($resul);
	exit();
 ?>