<?php 
	session_start();

	$id = $_REQUEST["id"];

	include_once "../../inc/ejercicio.php";
	

	
	$ejer = new Ejercicio();
	$resul = $ejer->deleteEjercicio($id);
	if($resul){
		$_SESSION['message'] = "Borrado";
	}else{
		$_SESSION['message'] = "Error al borrar el ejercicio.";
	}
	
	echo $resul;
	exit();
 ?>