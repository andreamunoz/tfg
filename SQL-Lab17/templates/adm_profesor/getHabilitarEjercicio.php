<?php 
	session_start();

	$id = $_REQUEST["id"];

	include_once "../../inc/ejercicio.php";
	
	$ejer = new Ejercicio();
	$resul = $ejer->setHabilitar($id);
	if($resul){
		$_SESSION['message'] = "Ejercicio Habilitado";
	}else{
		$_SESSION['message'] = "Error al habilitar el ejercicio.";
	}
	
	echo $resul;
	exit();
 ?>