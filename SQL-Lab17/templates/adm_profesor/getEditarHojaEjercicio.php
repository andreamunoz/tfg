<?php 
	session_start();
	unset($_SESSION['editar_hoja']);

	$id = $_GET["id"];
	$_SESSION['editar_hoja'] = intval($id);

	
	include_once '../../inc/hoja_ejercicio.php';
	$he = new HojaEjercicio();

	$resultadoHoja = $he->getHojasById($id);
	$datos = array();
	$datos["nombre_hoja"] = $resultadoHoja[0]["nombre_hoja"];
	$datos["id_hoja"] = $resultadoHoja[0]["id_hoja"];

	$resultado = $he->getHojasYEjerciciosById($id);
	if( mysqli_num_rows($resultado)!==0){
		

		$i=0;
		$fila = array();
		$datos["hayEjercicios"]=1;
		$datos["numEjercicios"]=mysqli_num_rows($resultado);
		foreach ($resultado as $key => $value) {
		
			$fila["nombre_hoja"] = $value["nombre_hoja"];
			$fila["descripcion"] = $value["descripcion"];
			$fila["nivel"] = $value["nivel"];
			$fila["tipo"] = $value["tipo"];
			$fila["creador_ejercicio"] = $value["creador_ejercicio"];
			$fila["id_ejercicio"] = $value["id_ejercicio"];
			$fila["id_hoja"] = $value["id_hoja"];
			$datos[$i] = $fila;
			$i++;
		}
	}else{
		$datos["hayEjercicios"] = 0;
		$datos["numEjercicios"] = 0;
	}
	echo json_encode($datos);
 ?>