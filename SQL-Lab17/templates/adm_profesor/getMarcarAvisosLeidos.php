<?php 
	session_start();

	$user = $_REQUEST["user"];

	include_once "../../inc/usuario.php";
	
	$usu = new Usuario();
	$resul = $usu->setAvisosLeidos($user);
	var_dump($resul);
	if($resul === true){
		$_SESSION['message'] = "Los mensajes se han marcado como leídos";
	}else{
		$_SESSION['message'] = "Error al marcar como leídos los mensajes";
	}
	
	exit();
 ?>