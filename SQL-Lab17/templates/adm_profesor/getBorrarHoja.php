<?php 
	session_start();

	$id_hoja = $_REQUEST["id"];
	$error = false;
	include_once "../../inc/hoja_ejercicio.php";


	$he = new HojaEjercicio();
	$todosIds = $he->getTodosIdEjerDeHoja($id_hoja);
	foreach ($todosIds as $key => $value) {
		$resultado = $he->deleteEjercicioDeHoja($id_hoja, $value);
		if(!$resultado){
			$error = true;
		}
	}
	$resul = $he->deleteHoja($id_hoja);
	if($resul && !$error){
		$_SESSION['message'] = "Borrado";
	}else{
		$_SESSION['message'] = "Error al borrar el ejercicio.";
	}

	echo $resul;
	exit();
 ?>