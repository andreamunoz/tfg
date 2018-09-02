<?php 
	session_start();

	$user = $_REQUEST["user"];

	include_once "../../inc/user.php";
	
	$usu = new User();
	$resul = $usu->setAvisosLeidos($user);
	// var_dump($resul);
	if($resul === true){
		$_SESSION['message'] = "Los mensajes se han marcado como leídos";
	}else{
		$_SESSION['message'] = "Error al marcar como leídos los mensajes";
	}
	
	exit();
 ?>