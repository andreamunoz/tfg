<?php     
    session_start();                                        
    include_once '../../inc/functions.php';
    $connect = new Tools();
    include_once '../../inc/solucion.php';
    $sol = new Solucion(); 
    include_once '../../inc/ejercicio.php';
    include_once '../../inc/usa.php';
    $usa = new Usa();
    $conexion = $connect->connectDB();
    $sujeto = $_REQUEST["sujeto"];
    $solucion_profesor = $_SESSION["solProf"];

    if(isset($_SESSION["solAlum"])){
        $solucion_alumno = $_SESSION["solAlum"];
    }else{
        $solucion_alumno = "";
    }
    $dueno_tabla = $_SESSION["duenoTablas"];
    $id_ejer = $_SESSION["idEjer"];

    $tablas_usadas = $usa->getTablasUsadas($id_ejer);
    //var_dump($tablas_usadas);

    function quitarPalabrasFinales($frase){

            $palabrasBuscar = array(" where "," group "," having "," order "," limit ", ";", "select");
            $palabras = array("where","group","having","order","limit", ";","select");
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

                                    if($value !== ""){

                                            $total[$count] = trim($value);
                                            $count++;
                                    }
                            }
                    }
            }
    }

    function eliminarRepetidos($array){
            foreach($array as $key => $value){
                    $auxValue = str_replace(")","",$value);
                    $auxValue = str_replace(",","",$auxValue);
                    $array[$key] = $auxValue;
            }
            $aux = array_unique($array);
            $total = array();
            $contadorReal = 0;
            foreach ($aux as $key => $value) {
                    $total[$contadorReal] = $value;
                    $contadorReal++;
            }
            return $total;
    }

    function anadirDueno($tablas, $dueno){
            $solucion = array();
            for($i = 0; $i < count($tablas); $i++){
                    $solucion[$i] = $dueno."_".$tablas[$i];
            }
            return $solucion;
    }

    function validarTablas(&$tSolucion, $tDisponibles){
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
            $cambios = array('('=>' ', ')'=>' ');
            $aux = strtr($solucion, $cambios);
            $quitarFrom = preg_split("/ from /i", $aux);

            $i=1;
            $tablas= array();
            while ($i < count($quitarFrom)){
                    $tablas[$i - 1] = quitarPalabrasFinales($quitarFrom[$i]);
                    //var_dump($tablas);
                    $tablas[$i - 1] = quitarPalabrasIntermadias($tablas[$i - 1]);
                    // var_dump($tablas[$i - 1]);
                    $tablas[$i - 1] = quitarAlias($tablas[$i - 1]);
                    // var_dump($tablas[$i - 1]);
                    $i++;
            }

            $total = array();
            $count = 0;

            juntarArrayRecursivo($total, $tablas, $count);

            $tablasSolucionSinDueno = eliminarRepetidos($total);
            //var_dump($tablasSolucionSinDueno);
            $tablasSolucion = anadirDueno($tablasSolucionSinDueno, $dueno);
            //var_dump($tablasSolucion);
            $ejer = new Ejercicio();
            $tablasDisponibles = $ejer->getTodasTablas();
            
            $ok = validarTablas($tablasSolucion, $tablasDisponibles);

            $resultado = array();
            if($ok){
                    $ejer = new Ejercicio();
                    // for ($i =0; $i<count($tablasSolucion); $i++) {
                    //      $nombreAntiguo = " ".$tablasSolucionSinDueno[$i];
                    //      // var_dump($nombreAntiguo." -> ".$tablasSolucion[$i]);
                    //      $solucion = str_replace($nombreAntiguo, " ".strtolower($tablasSolucion[$i]), $solucion );
                    //      //var_dump($solucion);
                    // }
                    $solucion = sustituirNuevoNombreTabla($tablasSolucionSinDueno, $solucion, $dueno);
                    //var_dump($solucion);
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
                $resultado[4] = "Las tablas de la solución no pertenecen al creador de tablas seleccionado o no existen.";
            }

            return $resultado;
    }

    // function validarInsert($solucion, $dueno){
    //         $sentencia = explode(" ", $solucion);

    //         $i=0;
    //         $palabras = array("low_priority","delayed","high_priority","ignore","into",";");
    //         while ($i < count($palabras)){
    //                 if(in_array($palabras[$i], $sentencia)){
    //                         $pos = array_search($palabras[$i], $sentencia);
    //                         unset($sentencia[$pos]);
    //                 }
    //                 $i++;
    //         }
    //         $contador = 0;
    //         foreach ($sentencia as $key => $value) {
    //                 if($contador > 1){
    //                         unset($sentencia[$key]);
    //                 }
    //                 $contador++;
    //         }
    //         $tabla = array();
    //         $tabla[0] = array_pop($sentencia);

    //         $tablasSolucion = anadirDueno($tabla, $dueno);

    //         $ejer = new Ejercicio();
    //         $tablasDisponibles = $ejer->getTodasTablas();

    //         $ok = validarTablas($tablasSolucion, $tablasDisponibles);

    //         if($ok){
    //             $nombreAntiguo = " ".$tabla[0];
    //             $solucion = str_replace($nombreAntiguo, " ".$tablasSolucion[0], $solucion);
    //             $resultadoSolucion = $ejer->executeSolucionNoSelect($solucion);

    //             if($resultadoSolucion[0] === false){
    //                     $resultado[0] = false;
    //                     $resultado[1] = $resultadoSolucion[1];
    //             }else{
    //                     $resultado[0] = true;
    //                     $resultado[1] = $tablasSolucion;
    //                     $resultado[2] = $resultadoSolucion;
    //             }

    //         }else{
    //                 $resultado[0] = false;
    //                 $resultado[4] = "Las tablas de la solución no pertenecen al creador de tablas seleccionado o no existen.";
    //         }
    //         return $resultado;
    // }

    // function validarUpdate($solucion, $dueno){
    //         //$solucionCopia = strtoupper($solucion);
    //         $sentencia = explode(" ", $solucion);
    //         // $sentenciaCopia = explode(" ", $solucionCopia);

    //         if(in_array("set", $sentencia)){

    //                 $pos = array_search("set", $sentencia);
    //                 $tabla[0] = $sentencia[$pos - 1];
    //                 $tablasSolucion = anadirDueno($tabla, $dueno);

    //                 $ejer = new Ejercicio();
    //                 $tablasDisponibles = $ejer->getTodasTablas();

    //                 $ok = validarTablas($tablasSolucion, $tablasDisponibles);

    //                 if($ok){
    //                         $nombreAntiguo = " ".$tabla[0];
    //                         $solucion = str_replace($nombreAntiguo, " ".$tablasSolucion[0], $solucion);
    //                         $resultadoSolucion = $ejer->executeSolucionNoSelect($solucion);

    //                         if($resultadoSolucion[0] === false){
    //                                 $resultado[0] = false;
    //                                 $resultado[1] = $resultadoSolucion[1];
    //                         }else{
    //                                 $resultado[0] = true;
    //                                 $resultado[1] = $tablasSolucion;
    //                                 $resultado[2] = $resultadoSolucion;
    //                         }

    //                 }else{
    //                     $resultado[0] = false;
    //                     $resultado[4] = "Las tablas de la solución no pertenecen al creador de tablas seleccionado o no existen.";

    //                 }
    //         }else{
    //                 $resultado[0] = false;
    //                 $resultado[4] = "La solución no tiene una sintaxis correcta.";
    //         }
    //         return $resultado;
    // }

    // function validarDelete($solucion, $dueno){

    //         $sentencia = explode(" ", $solucion);

    //         if(in_array("from", $sentencia)){

    //                 $pos = array_search("from", $sentencia);
    //                 $tabla[0] = $sentencia[$pos + 1];
    //                 $tablasSolucion = anadirDueno($tabla, $dueno);

    //                 $ejer = new Ejercicio();
    //                 $tablasDisponibles = $ejer->getTodasTablas();

    //                 $ok = validarTablas($tablasSolucion, $tablasDisponibles);

    //                 if($ok){
    //                         $nombreAntiguo = " ".$tabla[0];
    //                         $solucion = str_replace($nombreAntiguo, " ".$tablasSolucion[0], $solucion);
    //                         $resultadoSolucion = $ejer->executeSolucionNoSelect($solucion);

    //                         if($resultadoSolucion[0] === false){
    //                                 $resultado[0] = false;
    //                                 $resultado[1] = $resultadoSolucion[1];
    //                         }else{
    //                                 $resultado[0] = true;
    //                                 $resultado[1] = $tablasSolucion;
    //                                 $resultado[2] = $resultadoSolucion;
    //                         }

    //                 }else{
    //                         $resultado[0] = false;
    //                         $resultado[4] = "Las tablas de la solución no pertenecen al creador de tablas seleccionado o no existen.";

    //                 }
    //         }else{
    //                 $resultado[0] = false;
    //                 $resultado[4] = "La solución no tiene una sintaxis correcta.";

    //         }
    //         return $resultado;
    // }

    function distinguirSentencia($solucionPropuesta, $user_tablas){
        // var_dump("AL ENTRAR".$solucionPropuesta);
        //$solucionPropuesta = preg_replace("[\n|\r|\n\r|\t]", " ",$solucionPropuesta);
        $solucionPropuesta = mb_eregi_replace("[\n|\r|\n\r|\t]"," ",$solucionPropuesta);
        //var_dump("despues replace1".$solucionPropuesta);
        $solucionPropuesta = utf8_decode($solucionPropuesta);
        // var_dump("decode".$solucionPropuesta);
        $solucionPropuesta = str_replace('?', '', $solucionPropuesta);
        // var_dump("despues replace1".$solucionPropuesta);
        $solucionPropuesta = utf8_encode($solucionPropuesta);
        //var_dump("encode".$solucionPropuesta);

        $solucionPropuesta = preg_replace('/\s+/', ' ', $solucionPropuesta);
        $sentencia = explode(" ", $solucionPropuesta, 2);

        $resultado = array();
        if ($sentencia[0] === "select"){
                $resultado = validarSelect($solucionPropuesta, $user_tablas);
        // }elseif ($sentencia[0] === "insert"){
        //         $resultado = validarInsert($solucionPropuesta, $user_tablas);
        // }elseif ($sentencia[0] === "update") {
        //         $resultado = validarUpdate($solucionPropuesta, $user_tablas);
        // }elseif ($sentencia[0] === "delete"){
        //         $resultado = validarDelete($solucionPropuesta, $user_tablas);

        }else{
                $resultado[0] = FALSE;
                $resultado[4] = "No hay datos disponibles.";
        }

        return $resultado;
    }


    $arrayComillas = array("`", "'");

    if ($sujeto === "Profesor"){
        $solucion_profesor = str_replace($arrayComillas, '"', $solucion_profesor);
        $solucion_profesor = strtolower($solucion_profesor);
        
        $resultado = distinguirSentencia($solucion_profesor, $dueno_tabla);
    }else{
        $solucion_alumno = str_replace($arrayComillas, '"', $solucion_alumno);
        $solucion_alumno = strtolower($solucion_alumno);
        
        $resultado = distinguirSentencia($solucion_alumno, $dueno_tabla);
    }
    if(!$resultado[0]){

        if(isset($resultado[4])){
            $mostrar = $resultado[4];
        }else{
            $mostrar = "";
        }
    }else{
        $datos = $resultado[2][0];
        $mostrar = '<thead><tr>';
        $contador = 0;
        foreach ($datos as $key => $value) {
            if($contador == 0){
                foreach ($value as $key => $value2) {
                    $mostrar = $mostrar . '<th style="text-align: center; width: 150px">' . $key . '</th>';
                    $contador = 1;
                }
            }
        }
        $mostrar = $mostrar . '</tr></thead><tbody>';
        foreach ($datos as $key => $value) {
            $mostrar = $mostrar . '<tr>';
            foreach ($value as $key => $value2) {
                $mostrar = $mostrar . '<td style="text-align: center; width: 150px">' . $value2 . '</td>';
            }
            $mostrar = $mostrar .'</tr>';
        }
        $mostrar = $mostrar .'</tbody>';
    }
   



    //var_dump($solucion_profesor);
    //$resultadoSolucionProfesor = $ejer->executeSolucion($solucion_profesor);
    //var_dump($resultadoSolucionProfesor);


    
//    $consulta = mysqli_query($conexion, $sql);
//    $_SESSION["columnas"] = "";
    // $_SESSION["num_col"] = 0;
    // $resultado = "";
    // while (($fila = $consulta->fetch_array(MYSQLI_ASSOC))) {
        // $resultado = $resultado . '<tr>
                // <td style="text-align: center">' . $fila["COLUMN_NAME"] . '</td>
            // </tr>';
    // }
    // $connect->disconnectDB($conexion);
    echo $mostrar;
?>