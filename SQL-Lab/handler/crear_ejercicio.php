<?php 
	
	include_once '../inc/ejercicio.php';
	session_start();
	$nombre_ejercicio = $_POST['name_ejercicio'];
	$descrip = $_POST['descripcion'];
	/*comprobar vacios y el tipo tendriamos que hacer una consulta getCategoria()*/
	$tipo = $_POST['categoria'];
	if($tipo == "c1")
		$categoria = "1.Select-Basico";
	else
		$categoria = "2.Select-Join";
	$nivel = $_POST['nivel'];
	$enunciado = $_POST['enunciado'];
	$solucion = $_POST['solucion'];
	$deshabilitar = $_POST['deshabilitar'];
	$user = $_SESSION['email'];
	$ejer = new Ejercicio();

	
	if( $ejer->getEjercicio($nombre_ejercicio) == null ){
		
		/*$ejer->createEjercicio($nombre_ejercicio,$nivel,$enunciado,$descrip,$deshabilitar,$categoria,$user,$solucion);*/
		$ejer->createEjercicio($nombre_ejercicio,$nivel,$enunciado,$descrip,$deshabilitar,$categoria,$user,$solucion);
		/*if($ejercicio != null) crear un modal de Se ha insertado el ejercicio correctamente */
	}
	/*else{
		Modal El ejercicio ya existe
	}*/
	exit();
?>