
<?php 
	session_start();

	$id = $_REQUEST["id"];

	include_once "../../inc/ejercicio.php";
	
	$ejer = new Ejercicio();
	$resul = $ejer->setDeshabilitar($id);
	if($resul === true){
		$_SESSION['message'] = "Ejercicio Deshabilitado";
	}else{
		$_SESSION['message'] = "Error al dehabilitar el ejercicio.";
	}
	
	echo $resul;
	exit();
 ?>