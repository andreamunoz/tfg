<?php 
	
	include_once '../inc/ejercicio.php';
	session_start();
	$tablas= $_POST['tablas'];
	$descripcion = $_POST['descripcion'];
	$tipo = $_POST['categoria'];
	switch ($tipo) {
		case 'c1':
			$categoria = "1.Select-Basico";
			break;
		case 'c2':
			$categoria = "2.Select-Join";
			break;
		case 'c3':
			$categoria = "3.Select-Group-Basico";
			break;
		case 'c4':
			$categoria = "4.Select-Group-Having";
			break;
		case 'c5':
			$categoria = "5.Subqueries-Valor";
			break;
		case 'c6':
			$categoria = "6.Subqueries-Conjuntos";
			break;
		case 'c7':
			$categoria = "7.Operaciones Manipulacion de Datos";
			break;
		
	}
	$nivel = $_POST['nivel'];
	$enunciado = $_POST['enunciado'];
	$solucion = $_POST['solucion'];
	$deshabilitar = $_POST['deshabilitar'];
	$user = $_SESSION['user'];

	$ejer = new Ejercicio();
	$resultadoCrear = "";
	$resultadoSolucion = $ejer->executeSolucion($solucion);
	if($resultadoSolucion){
		
		$resultadoCrear = $ejer->createEjercicio($nivel,$enunciado,$descripcion,$deshabilitar,$categoria,$user,$solucion, $tablas);
		if($resultadoCrear){
			$_SESSION['message'] = "El ejercicio se ha creado correctamente.";
		}else{
			$_SESSION['message'] = "Error al crear el ejercicio.";
		}
	}else{
		$_SESSION['message'] = "Error. La consulta no es correcta";
	}
	
	header("Location: ../templates/index_profesor.php");
	exit();
?>