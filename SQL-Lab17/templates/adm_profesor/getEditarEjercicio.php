<?php 
	session_start();
	unset($_SESSION['editar']);

	$id = $_GET["id"];
	$_SESSION['editar'] = intval($id);
	
	include_once '../../inc/ejercicio.php';
    $ejer = new Ejercicio();
    $resul = $ejer->getEjercicioById($id);
    $row = mysqli_fetch_array($resul, MYSQLI_NUM);
    $tablasUsa = $ejer->getTablasUsa($id);
    $tablas = "";
    foreach ($tablasUsa as $key => $value) {
        $separado = explode("_", $value[0], 2);
    	$tablas = $tablas.$separado[1]." ";
    }
    $resultado = $ejer->getCategorias();
    $niveles = array("facil","medio","dificil");
    if($resul){
    	$datos = array();
    	 
    	$datos["nombre"] = $row[0];
    	$datos["dueno"] = $row[7];
    	$datos["tablas"] = $tablas;
    	$datos["categoria"] = $row[5];
    	$datos["nivel"] = $row[1];
    	$datos["deshabilitar"] = $row[4];
    	$datos["descripcion"] = $row[3];
    	$datos["enunciado"] = $row[2];
    	$datos["solucion"] = $row[8];
        $datos["todasCategorias"] = $resultado;
        $datos["todosNiveles"] = $niveles;
        $datos["todosDeshabilitado"] = array("Deshabilitado","Habilitado");
    }
    echo json_encode($datos);
 ?>