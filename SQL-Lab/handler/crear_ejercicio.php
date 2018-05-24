<?php 
	
	include_once '../inc/ejercicio.php';
	session_start();
	$user_tablas= $_POST['user_tablas'];
	$tablas = $_POST['tablas'];
	$descripcion = $_POST['descripcion'];
	$tipo = $_POST['categoria'];
	switch ($tipo) {
		case 'c1':
			$categoria = "Select-Basico";
			break;
		case 'c2':
			$categoria = "Select-Join";
			break;
		case 'c3':
			$categoria = "Select-Group-Basico";
			break;
		case 'c4':
			$categoria = "Select-Group-Having";
			break;
		case 'c5':
			$categoria = "Subqueries-Valor";
			break;
		case 'c6':
			$categoria = "Subqueries-Conjuntos";
			break;
		case 'c7':
			$categoria = "Operaciones Manipulacion de Datos";
			break;
		
	}
	$nivel = $_POST['nivel'];
	$enunciado = $_POST['enunciado'];
	$solucion = $_POST['solucion'];
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
			$solucion[$i] = $dueno."_".$tablas[$i]; 
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
		$resultado[1] = $tablasSolucion;
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
				
				$resultadoCrear = $ejer->createEjercicio($nivel,$enunciado,$descripcion,$deshabilitar,$categoria,$user,$solucion, $resultado[1]);
				if($resultadoCrear){
					$_SESSION['message'] = "El ejercicio se ha creado correctamente.";
				}else{
					$_SESSION['message'] = "Error al crear el ejercicio.";
				}
			}else{
				$_SESSION['message'] = "Error. La consulta no es correcta. Intentelo de nuevo.";
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