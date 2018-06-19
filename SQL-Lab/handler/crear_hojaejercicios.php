<?php 
	include_once '../inc/hoja_ejercicio.php';
	session_start();
	$user = $_SESSION['user'];
	$nombre_hoja= $_POST['nombre'];
	$seleccionados = $_POST['seleccionados'];
	print_r($seleccionados);


	$hoja_ejer = new HojaEjercicio();
	$resultado = $hoja_ejer->createHojaAnadirEjercicios($user, $nombre_hoja, $seleccionados);
	if($resultado){
		$_SESSION['message'] = "La hoja se ha creado correctamente y se han agregado los ejercicios.";
	}else{
		$_SESSION['message'] = "Error al crear la hoja de ejercicios.";
	}

	
	header("Location: ../templates/index_profesor.php");
	exit();
?>