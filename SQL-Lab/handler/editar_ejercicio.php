<?php 
	
	include_once '../inc/ejercicio.php';
	session_start();
	$id = intval($_POST['e_id']);

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
	$solucion = trim($_POST['solucion']);
	$deshabilitar = $_POST['deshabilitar'];
	$user_tablas = $_POST['dueno'];
	$user = $_SESSION['user'];

	$arrayComillas = array("`", "'");
	$solucion = str_replace($arrayComillas, '"', $solucion);

	function quitarPalabrasFinales($frase){
		$palabrasBuscar = array(" WHERE "," ORDER "," HAVING "," GROUP "," LIMIT "," ON ", ";");
		$palabras = array("WHERE","ORDER","HAVING ","GROUP","LIMIT","ON", ";");
		$quitarFinal[0] = $frase;
		$nuevafrase = $frase;
		for($i=0; $i<count($palabras); $i++){
			if(stripos($nuevafrase, $palabrasBuscar[$i])!== false){
				$quitarFinal = preg_split("/".$palabras[$i]."/i", $quitarFinal[0],2);
				$nuevafrase = $quitarFinal[0];
				$quitarFinal = trim($quitarFinal[0]);
			}
		}

		return $quitarFinal;
	}

	function quitarPalabrasIntermadias($frase){
		$palabras = array(',','NATURAL RIGHT OUTER JOIN','NATURAL LEFT OUTER JOIN','NATURAL LEFT JOIN','NATURAL RIGHT JOIN','LEFT OUTER JOIN','RIGHT OUTER JOIN','INNER JOIN','CROSS JOIN','LEFT JOIN','RIGHT JOIN','NATURAL JOIN','JOIN');
		$frasebuena = "";
		if(is_array($frase)){
			$quitarMedio = $frase[0];
			$frasebuena = $frase[0];
		}else{
			$quitarMedio = $frase;
			$frasebuena = $frase;
		}
		//var_dump($frase);
		for($i=0; $i<count($palabras); $i++){
			if(stripos($frasebuena, $palabras[$i])!== false){
				$quitarMedio = preg_split("/".$palabras[$i]."/i", $quitarMedio);
				$i = count($palabras)+1;
			}
		}
		//var_dump($quitarMedio);		
		return $quitarMedio;
	}

	function quitarAlias($tablas){
		
		if (is_string($tablas)){
			$value = trim($tablas);
			$nombre = explode(" ", $tablas, 2);

			$tablas = $nombre[0];

		}else{

			foreach ($tablas as $key => $value) {
				$value = trim($value);
				$nombre = explode(" ", $value, 2);

				$tablas[$key] = $nombre[0];
			}
		}
		return $tablas;
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

			if(!(in_array(strtolower($tSolucion[$i]), $tDisponibles))){
				$ok = false;
			}
		}
		return $ok;
	}

	function validarSelect($solucion, $dueno){
		//$quitarFrom = explode(" FROM ", $solucion);
		$quitarFrom = preg_split("/ FROM /i", $solucion);

		$i=1;
		$tablas= array();
		while ($i < count($quitarFrom)){
			$tablas[$i - 1] = quitarPalabrasFinales($quitarFrom[$i]);
			// var_dump($tablas[$i - 1]);
			$tablas[$i - 1] = quitarPalabrasIntermadias($tablas[$i - 1]);
			// var_dump($tablas[$i - 1]);
			$tablas[$i - 1] = quitarAlias($tablas[$i - 1]);
			// var_dump($tablas[$i - 1]);
			$i++;
		}
		$total = array();
		$count = 0; 
		//var_dump($tablas);
		juntarArrayRecursivo($total, $tablas, $count);
		
		$tablasSolucionSinDueno = array_unique($total);
		$tablasSolucion = anadirDueno($tablasSolucionSinDueno, $dueno);
		//var_dump($tablasSolucion);
		$ejer = new Ejercicio();
		$tablasDisponibles = $ejer->getTodasTablas();

		$ok = validarTablas($tablasSolucion, $tablasDisponibles);

		$resultado = array();
		if($ok){
			$ejer = new Ejercicio();
			for ($i =0; $i<count($tablasSolucion); $i++) {
				$nombreAntiguo = " ".$tablasSolucionSinDueno[$i];
				$solucion = str_replace($nombreAntiguo, " ".$tablasSolucion[$i], $solucion );
			}
			$resultadoSolucion = $ejer->executeSolucion($solucion);

			if($resultadoSolucion[0] === false){
				$resultado[0] = false;
				$resultado[1] = $resultadoSolucion[1];
			}else{
				$resultado[0] = true;
				$resultado[1] = $tablasSolucion;
				$resultado[2] = $resultadoSolucion;
			}
			
		}else{
			$resultado[0] = false;
		}		

		return $resultado;
	}

	function validarInsert($solucion, $dueno){
		$sentencia = explode(" ", $solucion);

		$i=0;
		$palabras = array("LOW_PRIORITY","DELAYED","HIGH_PRIORITY","IGNORE","INTO",";");
		while ($i < count($palabras)){
			if(in_array($palabras[$i], $sentencia)){
				$pos = array_search($palabras[$i], $sentencia);
				unset($sentencia[$pos]);
			}
			$i++;
		}
		$contador = 0;
		foreach ($sentencia as $key => $value) {
			if($contador > 1){
				unset($sentencia[$key]);
			}
			$contador++;
		}
		$tabla = array();
		$tabla[0] = array_pop($sentencia);

		$tablasSolucion = anadirDueno($tabla, $dueno);
		
		$ejer = new Ejercicio();
		$tablasDisponibles = $ejer->getTodasTablas();

		$ok = validarTablas($tablasSolucion, $tablasDisponibles);
		
		if($ok){
			$nombreAntiguo = " ".$tabla[0];
			$solucion = str_replace($nombreAntiguo, " ".$tablasSolucion[0], $solucion);
			$resultadoSolucion = $ejer->executeSolucionNoSelect($solucion);

			if($resultadoSolucion[0] === false){
				$resultado[0] = false;
				$resultado[1] = $resultadoSolucion[1];
			}else{
				$resultado[0] = true;
				$resultado[1] = $tablasSolucion;
				$resultado[2] = $resultadoSolucion;
			}
			
		}else{
			$resultado[0] = false;
		}
		return $resultado;
	}

	function validarUpdate($solucion, $dueno){
		$solucionCopia = strtoupper($solucion);
		$sentencia = explode(" ", $solucion);
		$sentenciaCopia = explode(" ", $solucionCopia);

		if(in_array("SET", $sentenciaCopia)){
			
			$pos = array_search("SET", $sentenciaCopia);
			$tabla[0] = $sentencia[$pos - 1];
			$tablasSolucion = anadirDueno($tabla, $dueno);
		
			$ejer = new Ejercicio();
			$tablasDisponibles = $ejer->getTodasTablas();

			$ok = validarTablas($tablasSolucion, $tablasDisponibles);
			
			if($ok){
				$nombreAntiguo = " ".$tabla[0];
				$solucion = str_replace($nombreAntiguo, " ".$tablasSolucion[0], $solucion);
				$resultadoSolucion = $ejer->executeSolucionNoSelect($solucion);
				
				if($resultadoSolucion[0] === false){
					$resultado[0] = false;
					$resultado[1] = $resultadoSolucion[1];
				}else{
					$resultado[0] = true;
					$resultado[1] = $tablasSolucion;
					$resultado[2] = $resultadoSolucion;
				}
				
			}else{
				$resultado[0] = false;
			}
		}else{
			$resultado[0] = false;
		}
		return $resultado;	
	}

	function validarDelete($solucion, $dueno){
		$solucionCopia = strtoupper($solucion);
		$sentencia = explode(" ", $solucion);
		$sentenciaCopia = explode(" ", $solucionCopia);
		// var_dump($sentenciaCopia);
		if(in_array("FROM", $sentenciaCopia)){
			
			$pos = array_search("FROM", $sentenciaCopia);
			$tabla[0] = $sentencia[$pos + 1];
			$tablasSolucion = anadirDueno($tabla, $dueno);

			$ejer = new Ejercicio();
			$tablasDisponibles = $ejer->getTodasTablas();

			$ok = validarTablas($tablasSolucion, $tablasDisponibles);
			
			if($ok){
				$nombreAntiguo = " ".$tabla[0];
				$solucion = str_replace($nombreAntiguo, " ".$tablasSolucion[0], $solucion);
				$resultadoSolucion = $ejer->executeSolucionNoSelect($solucion);
				
				if($resultadoSolucion[0] === false){
					$resultado[0] = false;
					$resultado[1] = $resultadoSolucion[1];
				}else{
					$resultado[0] = true;
					$resultado[1] = $tablasSolucion;
					$resultado[2] = $resultadoSolucion;
				}
				
			}else{
				$resultado[0] = false;
			}
		}else{
			$resultado[0] = false;
		}
		return $resultado;
	}

	function distinguirSentencia($solucionPropuesta, $user_tablas){
		$solucionPropuesta = preg_replace("[\n|\r|\n\r|\t]", " ",$solucionPropuesta);
		$solucionPropuesta = utf8_decode($solucionPropuesta);
		$solucionPropuesta = str_replace('?', '', $solucionPropuesta);
		$solucionPropuesta = preg_replace('/\s+/', ' ', $solucionPropuesta);
		$sentencia = explode(" ", $solucionPropuesta, 2);

		$resultado = array();
		if (strtoupper($sentencia[0]) === "SELECT"){
			$resultado = validarSelect($solucionPropuesta, $user_tablas);
		}elseif (strtoupper($sentencia[0]) === "INSERT"){
			$resultado = validarInsert($solucionPropuesta, $user_tablas);
		}elseif (strtoupper($sentencia[0]) === "UPDATE") {
			$resultado = validarUpdate($solucionPropuesta, $user_tablas);
		}elseif (strtoupper($sentencia[0]) === "DELETE"){
			$resultado = validarDelete($solucionPropuesta, $user_tablas);

		}else{
			$resultado[0] = FALSE;
		}

		return $resultado;
	}

	$resultado = distinguirSentencia($solucion, $user_tablas); 
	if($resultado[0]){
		
			$ejer = new Ejercicio();
			$resultadoEditar = "";

			$resultadoEditar = $ejer->update($id,$nivel,$enunciado,$descripcion,$deshabilitar,$categoria,$solucion,$user);
			//var_dump($resultadoEditar);
			if($resultadoEditar){
				$_SESSION['message'] = "El ejercicio se ha modificado correctamente.";
			}else{
				$_SESSION['message'] = "Error al modificar el ejercicio.";
			}
			//var_dump($_SESSION['message']);
	}else{
		$_SESSION['message'] = "Error. Por favor repase la solución y asegurese de que sea válida.";
	}
	header("Location: ../templates/index_profesor.php");
	exit();

?>