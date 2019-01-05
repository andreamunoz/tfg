<?php 
	include_once '../inc/ejercicio.php';
	session_start();
	$user = $_SESSION['user'];
    $id = $_GET['exercise'];
	$descripcion = $_POST['descripcion'];
    $ejer = new Ejercicio();
    $exist = $ejer->getExistEjercicio($descripcion);
    $user_tablas = $_SESSION['user_tablas'];
    $enunciado = $_POST['enunciado'];
    $solucion = trim($_POST['solucion']);
    $nivel = $_POST['nivel'];
    $deshabilitar = $_POST['habdes'];
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

    if(substr($solucion, -1) !== ";"){
        $solucion = $solucion.";";
    }
    

    $guardarDatosEditar = array($user_tablas, $_POST['categoria'], $nivel, $deshabilitar, $descripcion, $enunciado, $solucion, $id);
    $_SESSION['guardarDatosEditar']= $guardarDatosEditar;
    // var_dump( $_SESSION['guardarDatosEditar']);

    $arrayComillas = array("`", "'");
    $solucion = str_replace($arrayComillas, '"', $solucion);

    $solucion = strtolower($solucion);

    function quitarPalabrasFinales($frase){
        $palabrasBuscar = array(" where "," order "," having "," group "," limit "," on ", ";");
        $palabras = array("where","order","having","grpup","limit","on", ";");
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
        $palabras = array(',','natural right outer join','natural left outer join','natural left join','natural right join','left outer join','right outer join','inner join','cross join','left join','right join','natural join','join');
        $frasebuena = "";
        if(is_array($frase)){
            $quitarMedio = $frase[0];
            $frasebuena = $frase[0];
        }else{
            $quitarMedio = $frase;
            $frasebuena = $frase;
        }
        for($i=0; $i<count($palabras); $i++){
            if(stripos($frasebuena, $palabras[$i])!== false){
                $quitarMedio = preg_split("/".$palabras[$i]."/i", $quitarMedio);
                $i = count($palabras)+1;
            }
        }
        
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

            if(!(in_array($tSolucion[$i], $tDisponibles))){
                $ok = false;
            }
        }
        return $ok;
    }
    function sustituirNuevoNombreTabla($tablasSolucionSinDueno, $solucion, $dueno){
            //var_dump($tablasSolucionSinDueno);
            //var_dump($solucion);
            //var_dump($dueno);
            $cambios = array('!='=>' ', ','=>' ', '('=>' ', ')'=>' ', '='=>' ', '>'=>' ', '<'=>' ', '>='=>' ', '<='=>' ', '<>'=>' ', '&&'=>' ', '||'=>' ');

            $aux = strtr($solucion,$cambios);
            // $cuantosFrom = substr_count($aux,"from");

            $copiaAux = strtolower($aux);
            $coincidencias = substr_count($copiaAux, "from");

            $avance = 0;
            for($i=0; $i<$coincidencias; $i++){
                    //var_dump("Avance:".$avance);
                    //buscar select y from
                    $posInicioParteUno = strpos($aux, "select", $avance);
                    //var_dump("posInicioParteUno:".$posInicioParteUno);
                    $posFinParteUno = strpos($aux, "from", $avance);
                    //var_dump("posFrom".$posFrom);
                    $longParteUno = $posFinParteUno - $posInicioParteUno;
                    $parteUno = substr($aux, $posInicioParteUno, $longParteUno);
                    
                    foreach($tablasSolucionSinDueno as $key => $value){
                            for($j=0; $j<10; $j++){
                                    $compara = " ".$value.".";
                                    $posNombreSiExiste = strpos($parteUno, $compara);
                                    $posNombre = $posNombreSiExiste + $avance +1;
                                    if($posNombreSiExiste != false){
                                            $aux = substr($aux, 0,$posNombre). $dueno."_".substr($aux, $posNombre);
                                            $solucion = substr($solucion, 0, $posNombre). $dueno."_".substr($solucion, $posNombre);
                                            $posFinParteUno = strpos($aux, "from", $avance);
                                            $parteUno = substr($aux, $posInicioParteUno, $posFinParteUno);

                                    }
                            }
                    }
                    //var_dump($aux);
                    $palabras = array(" where "," group "," having "," order "," limit ", ";");
                    $posPalabraFinParteDosArray = array();
                    foreach($palabras as $key => $value){
                            $posAux = strpos($aux,$value,$avance);
                            if($posAux != false){
                                    $posPalabraFinParteDosArray[$key] = $posAux;
                                    //var_dump($posAux);
                            }
                    }
                    if(count($posPalabraFinParteDosArray) > 0){
                            arsort($posPalabraFinParteDosArray);
                    }else{
                            array_push($posPalabraFinParteDosArray, strlen($aux));
                    }
                    $posFinParteDos = array_pop($posPalabraFinParteDosArray);
            //var_dump($posFinParteDos);
                    $longParteDos = $posFinParteDos - $posFinParteUno +1;
            //var_dump($longParteDos);
                    $parteDos = substr($aux, $posFinParteUno, $longParteDos);
            //var_dump($parteDos);
                    //var_dump("Fin parte Uno: ".$posFinParteUno."; Fin parte dos: ".$posFinParteDos);
                    //var_dump("Parte dos: ".$parteDos);
                    foreach($tablasSolucionSinDueno as $key => $value){

                            $posNombreParteDos = stripos($parteDos, " ".$value." ");
                            if($posNombreParteDos == false) { //si justo despues de la tabla hay ;
                                    $posNombreParteDos = stripos($parteDos, " ".$value.";");
                            }
                            $posNombre = $posNombreParteDos + $posFinParteUno + 1;

                            if($posNombreParteDos != false){
                                    $aux = substr($aux, 0,$posNombre). $dueno."_". substr($aux, $posNombre);
                                    $solucion = substr($solucion, 0, $posNombre). $dueno."_". substr($solucion, $posNombre);
                                    $posFinParteDos = $posFinParteDos + strlen($dueno) + 1;
                                    $longParteDos = $posFinParteDos - $posFinParteUno +1;
                                    $parteDos = substr($aux, $posFinParteUno, $longParteDos);
                            }

                    }

                    if($i+1 == $coincidencias){

                            $posFinParteTres = strlen($aux);

                    }else{
                            $posFinParteTres = strpos($aux, "select", $posFinParteDos);
                    }
                    //var_dump($posFinParteTres);
                    $longParteTres = $posFinParteTres - $posFinParteDos;
                    $parteTres = substr($aux,$posFinParteDos, $longParteTres);
                    //var_dump($parteTres);
                    foreach($tablasSolucionSinDueno as $key => $value){

                            for($j=0; $j<10; $j++){
                                    $posNombreParteTres = strpos($parteTres, " ".$value.".");
                                    $posNombre = $posNombreParteTres + $posFinParteDos +1;

                                    if($posNombreParteTres != false){
                                            $aux = substr($aux, 0,$posNombre). $dueno."_".substr($aux, $posNombre);
                                            $solucion = substr($solucion, 0, $posNombre). $dueno."_".substr($solucion, $posNombre);
                                            $posFinParteTres = $posFinParteTres + strlen($dueno)+1;
                                            $longParteTres = $posFinParteTres - $posFinParteDos;
                                            $parteTres = substr($aux, $posFinParteDos, $longParteTres);
                                    }
                            }
                    }
                    $avance = $posFinParteTres;

            }
            //var_dump("fuera del for: ->");
            //var_dump($aux);
            //var_dump($solucion);
            return $solucion;
    }
    function validarSelect($solucion, $dueno){
        
        $quitarFrom = preg_split("/ from /i", $solucion);

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
            // for ($i =0; $i<count($tablasSolucion); $i++) {
            //     $nombreAntiguo = " ".$tablasSolucionSinDueno[$i];
            //     $solucion = str_replace($nombreAntiguo, " ".$tablasSolucion[$i], $solucion );
            // }

            $solucion = sustituirNuevoNombreTabla($tablasSolucionSinDueno, $solucion, $dueno);
            
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
        $palabras = array("low_priority","delayed","high_priority","ignore","into",";");
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

        $sentencia = explode(" ", $solucion);

        if(in_array("set", $sentencia)){
            
            $pos = array_search("set", $sentencia);
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

        $sentencia = explode(" ", $solucion);
        // var_dump($sentenciaCopia);
        if(in_array("from", $sentencia)){
            
            $pos = array_search("from", $sentencia);
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
        $solucionPropuesta = mb_eregi_replace("[\n|\r|\n\r|\t]", " ",$solucionPropuesta);
        $solucionPropuesta = utf8_decode($solucionPropuesta);
        $solucionPropuesta = str_replace('?', '', $solucionPropuesta);
        $solucionPropuesta = utf8_encode($solucionPropuesta);
        $solucionPropuesta = preg_replace('/\s+/', ' ', $solucionPropuesta);
        $sentencia = explode(" ", $solucionPropuesta, 2);
        
        $resultado = array();
        if ($sentencia[0] === "select"){
            $resultado = validarSelect($solucionPropuesta, $user_tablas);
        }elseif ($sentencia[0] === "insert"){
            $resultado = validarInsert($solucionPropuesta, $user_tablas);
        }elseif ($sentencia[0] === "update") {
            $resultado = validarUpdate($solucionPropuesta, $user_tablas);
        }elseif ($sentencia[0] === "delete"){
            $resultado = validarDelete($solucionPropuesta, $user_tablas);

        }else{
            $resultado[0] = FALSE;
        }

        return $resultado;
    }

    $resultado = distinguirSentencia($solucion, $user_tablas); 
     // var_dump($resultado);
    if($resultado[0]){
        
            $ejer = new Ejercicio();
            $resultadoEditar = "";

            $resultadoEditar = $ejer->update($id,$nivel,$enunciado,$descripcion,$deshabilitar,$categoria,$solucion,$user,$resultado[1]);
             var_dump($resultadoEditar);
            if($resultadoEditar){
                $ejer->enviarAviso($id);
                unset($_SESSION['guardarDatosEditar']);
                header("Location: ../templates/configuration_exercises.php");
            }else{
                $_SESSION['message_edit_sheets'] = "<div class='modal fade show' id='modal-close' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <div class='close' id='close-modal'>
                                    <i class='fas fa-times' data-dismiss='modal'></i>
                                </div>
                            </div>
                            <div class='modal-body'>
                                <h2><strong>¡Error!</strong></h2>
                                <p>Error al modificar el ejercicio</p>
                            </div>
                        </div>
                    </div>   
                </div>";
                header("Location: ../templates/configuration_edit_exercises.php?exercise=$id");
            }
        
    }else{
        $_SESSION['message_edit_sheets'] = "<div class='modal fade show' id='modal-close' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <div class='close' id='close-modal'>
                                    <i class='fas fa-times' data-dismiss='modal'></i>
                                </div>
                            </div>
                            <div class='modal-body'>
                                <h2><strong>¡Error!</strong></h2>
                                <p>Por favor repase la solución y asegurese de que sea válida.</p>
                            </div>
                        </div>
                    </div>   
                </div>";
        header("Location: ../templates/configuration_edit_exercises.php?exercise=$id");

    }
    exit();     
    
?>