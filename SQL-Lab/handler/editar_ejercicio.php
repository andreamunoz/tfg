<?php 
	
	include_once '../inc/ejercicio.php';
	session_start();
	$id = $_SESSION['editar'];
	$ejer = new Ejercicio();
	$resul = $ejer->getEjercicioById($id);
	$tablasUsa = $ejer->getTablasUsa($id);

	$user_tablas= $resul[0][7];
	$tablas = array();
	foreach ($tablasUsa as $key => $value) {
		$tablas[$key] = $value['nombre'];
	} 

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
	$solucion = trim($_POST['solucion']);
	$deshabilitar = $_POST['deshabilitar'];
	$user = $_SESSION['user'];

	function quitarPalabrasFinales($frase){
		$palabras = array("WHERE","ORDER","HAVING","GROUP","LIMIT","ON", ";");
		$quitarFinal[0] = $frase;
		$nuevafrase = $frase;
		for($i=0; $i<count($palabras); $i++){

			if(strpos($nuevafrase, $palabras[$i])!== false){
				
				$quitarFinal = explode($palabras[$i], $quitarFinal[0],2);
				$nuevafrase = $quitarFinal[0];
				$quitarFinal = trim($quitarFinal[0]);
				
			}
		}

		return $quitarFinal;
	}

	function quitarPalabrasIntermadias($frase){
		$palabras = array(',','NATURAL RIGHT OUTER JOIN','NATURAL LEFT OUTER JOIN','NATURAL LEFT JOIN','NATURAL RIGHT JOIN','LEFT OUTER JOIN','RIGHT OUTER JOIN','INNER JOIN','CROSS JOIN','LEFT JOIN','RIGHT JOIN','NATURAL JOIN','JOIN');
		// var_dump($frase);
		$quitarMedio = $frase;
		for($i=0; $i<count($palabras); $i++){
			if(strpos($frase, $palabras[$i])!== false){
				$quitarMedio = explode($palabras[$i], $quitarMedio);
				$i = count($palabras)+1;
			}
		}
				
		return $quitarMedio;
	}

	function juntarArrayRecursivo(&$total, $array1, &$count){
		
		if(is_array($array1)){
			foreach ($array1 as $key => $value) {
				if(is_array($array1[$key])){
					juntarArrayRecursivo($total, $array1[$key], $count);
				}else{
					$total[$count] = trim($value);
					$count++;
				}
			}
		}
	}

	function anadirDueno($tablas, $dueno){
		$solucion = array();
		for($i = 0; $i < count($tablas); $i++){
			$solucion[$i] = strtoupper($dueno)."_".$tablas[$i]; 
		}
		return $solucion;
	}

	function validarTablas($tSolucion, $tDisponibles){
		$ok = true;
		for($i = 0; $i < count($tSolucion); $i++){
			if(!(in_array($tSolucion[$i], $tDisponibles))){
				$ok = false;
			}
		}
		return $ok;
	}

	function validarSolucion($solucion, $dueno){
		$quitarFrom = explode(" FROM ", strtoupper($solucion));
		$i=1;
		$tablas= array();
		while ($i < count($quitarFrom)){
			$tablas[$i - 1] = quitarPalabrasFinales($quitarFrom[$i]);
			var_dump($tablas[$i - 1]);
			$tablas[$i - 1] = quitarPalabrasIntermadias($tablas[$i - 1]);
			var_dump($tablas[$i - 1]);
			$i++;
		}
		$total = array();
		$count = 0; 
		
		juntarArrayRecursivo($total, $tablas, $count);
		
		$tablasSolucion = array_unique($total);
	
		$tablasSolucion = anadirDueno($tablasSolucion, $dueno);

		$ejer = new Ejercicio();
		$tablasDisponibles = $ejer->getTodasTablas();
		$ok = validarTablas($tablasSolucion, $tablasDisponibles);

		$resultado = array();
		$resultado[0] = $ok;
		$resultado[1] = $tablasSolución;
		return $resultado;
	}

	$resultado = validarSolucion($solucion, $user_tablas); 
	if($resultado[0]){
		$sentencia = explode(" ", $solucion, 2);

		if (strtoupper($sentencia[0]) === "SELECT"){
			$ejer = new Ejercicio();
			$resultadoCrear = "";
			$resultadoSolucion = $ejer->executeSolucion($solucion);
			if($resultadoSolucion){
				
				$resultadoCrear = $ejer->update($id,$nivel,$enunciado,$descripcion,$deshabilitar,$categoria,$solucion,$user);
				if($resultadoCrear){
					$_SESSION['message'] = "El ejercicio se ha modificado correctamente.";
				}else{
					$_SESSION['message'] = "Error al modificar el ejercicio.";
				}
			}else{
				$_SESSION['message'] = "Error al ejecutar la solucion. La consulta no es válida. Intentelo de nuevo.";
			}
		}else{
			$_SESSION['message'] = "Error. La consulta no es correcta. Intentelo de nuevo.";
		}
	}else{
		$_SESSION['message'] = "Error. Por favor repase las tablas de la solución y asegurese de que sean válidas.";
	}
	header("Location: ../templates/index_profesor.php");
	exit();
?>