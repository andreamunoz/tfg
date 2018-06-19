<?php 
	include_once '../inc/hoja_ejercicio.php';
	session_start();
	$id_hoja = $_SESSION['editar_hoja'];
	var_dump($id_hoja);
	$seleccionados = $_POST['seleccionados'];
	var_dump($seleccionados);
	$hoja_ejer = new HojaEjercicio();
	$resultado = $hoja_ejer->setNuevosEjerciciosAHoja($id_hoja, $seleccionados);
	if($resultado){
		$_SESSION['message'] = "Los ejercicios se han agregado correctamente.";
	}else{
		$_SESSION['message'] = "Error al agregar los ejercicios, intentelo de nuevo.";
	}

	
	header("Location: ../templates/index_profesor.php");
	exit();
?>