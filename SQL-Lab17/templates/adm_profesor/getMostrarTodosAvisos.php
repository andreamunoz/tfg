<?php 
	session_start();

	$user = $_REQUEST["user"];

	include_once "../../inc/user.php";
	
	$usu = new User();
	$resul = $usu->getAvisos($user);
	
	echo json_encode($resul);
	exit();
 ?>