<?php 
	session_start();

	$seleccionado = $_REQUEST["seleccionado"];
	$id_hoja = $_REQUEST["id_hoja"];

	$resultado = array();

	include_once "../../inc/hoja_ejercicio.php";

	$he = new HojaEjercicio();
	foreach ($seleccionado as $key => $value) {
		var_dump($value);
		$resul = $he->deleteEjercicioDeHoja($id_hoja, $value);
	
		if(!$resul){
			$resultado[$key] = $value;
		}
	}
	if(count($resultado) === 0){
		$_SESSION['message'] = "Ejercicios borrados de la hoja";
	}else{
		$_SESSION['message'] = "Ha habido un error al borrar los ejercicios, vuelva a intentarlo de nuevo.";
	}
	
	$resultadoConsulta = $he->getHojasYEjerciciosById($id_hoja);
	
	$datos = array();
	$i=0;
	$fila = array();
	foreach ($resultadoConsulta as $key => $value) {
	

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

	echo json_encode($datos);
	exit();
 ?>