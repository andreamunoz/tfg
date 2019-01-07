<?php 
	include_once '../inc/ejercicio.php';
	session_start();
	$user = $_SESSION['user'];
	$descripcion= $_POST['descripcion'];
    $ejer = new Ejercicio();
    $exist = $ejer->getExistEjercicio($descripcion);
    $user_tablas = $_POST['user_tablas'];
    $enunciado = $_POST['enunciado'];
    $solucion = trim($_POST['solucion']);
    $nivel = $_POST['nivel'];
    $deshabilitar = $_POST['deshabilitar'];
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

    $guardarDatos = array($user_tablas, $_POST['categoria'], $nivel, $deshabilitar, $descripcion, $enunciado, $solucion);
    $_SESSION['guardarDatos']= $guardarDatos;

    $arrayComillas = array("`", "'");
    $solucion = str_replace($arrayComillas, '"', $solucion);

    $solucion = strtolower($solucion);


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

    function sustituirNuevoNombreTablaUpdate($todas_tablas, $solucion, $dueno){
        $cambios = array('!='=>'#', ','=>'#', '('=>'#', ')'=>'#', '='=>'#', '>'=>'#', '<'=>'#', '>='=>'##', '<='=>'##', '<>'=>'##', '&&'=>'##', '||'=>'##', '+'=>'#','*'=>'#','-'=>'#', '%'=>'#');
        $cambios2 = $arrayName = array(')' => "", '('=>"" );
        $aux = strtr($solucion,$cambios);

        // var_dump($solucion);

        $posInicioParteUno = 0;
        // var_dump("posInicioParteUno:".$posInicioParteUno);
        $posFinParteUno = strpos($aux, "set");
        // var_dump("posFinParteUno:".$posFinParteUno);
        if(count($todas_tablas)===1){
            $parteUno = substr($aux, $posInicioParteUno, $posFinParteUno);
        }else{
            $parteUno = trim(substr($aux, $posInicioParteUno, $posFinParteUno));   
        }

        // var_dump($todas_tablas);
        // var_dump("ParteUno:".$parteUno);
        foreach($todas_tablas as $key => $value){
                // var_dump($value);
                $posNombreParteUno = strpos($parteUno, " ".$value." ");
                if(!$posNombreParteUno){
                    $posNombreParteUno = strpos($parteUno, " ".$value."#");
                }
                if (!$posNombreParteUno) {
                    $posNombreParteUno = strpos($parteUno, "#".$value." ");
                }
                if (!$posNombreParteUno) {
                    $posNombreParteUno = strpos($parteUno, "#".$value."#");
                }
                $posNombre = $posNombreParteUno + 1;
                if($posNombreParteUno != false){
                    $aux = substr($aux, 0, $posNombre). $dueno."_". substr($aux, $posNombre);
                    $solucion = substr($solucion, 0, $posNombre). $dueno."_". substr($solucion, $posNombre);
                    $posFinParteUno = $posFinParteUno + strlen($dueno) + 1;
                    $longParteUno = $posFinParteUno;
                    $parteUno = substr($aux, $posInicioParteUno, $longParteUno);
                }
        }

        if (strpos($solucion, " where ")){
            $posFinParteDos = strpos($solucion, "where");
            $hayParte3 = true;
        }else{
            $hayParte3 = false;
            $posFinParteDos = strlen($solucion);
        }
        // var_dump($posFinParteDos);
        $parteDos = substr($aux, $posFinParteUno,$posFinParteDos);
        // var_dump($parteDos);
        $posInicioParteDos = $posFinParteUno;
        // var_dump("InicioParteDos:".$posInicioParteDos);
        foreach($todas_tablas as $key => $value){

            for($j=0; $j<10; $j++){// var_dump($value);
                $posNombreParteDos = stripos($parteDos, " ".$value.".");
                // var_dump($posNombreParteDos);
                $posNombre = $posNombreParteDos +$posInicioParteDos+ 1;

                if($posNombreParteDos != false){
                    $aux = substr($aux, 0, $posNombre). $dueno."_". substr($aux, $posNombre);
                    $solucion = substr($solucion, 0, $posNombre). $dueno."_". substr($solucion, $posNombre);
                    $posFinParteDos = $posFinParteDos + strlen($dueno) + 1;
                    $longParteDos = $posFinParteDos;
                    $parteDos = substr($aux, $posInicioParteDos, $longParteDos);
                }
                // var_dump($parteDos);
            }
        }

        if($hayParte3){
            if (strpos($solucion, "select ")){
                $posFinParteTres = strpos($solucion,"select");
                $haySelect = true;
            }else{
                $haySelect = false;
                $posFinParteTres = strlen($solucion);
            }

            $parteTres = substr($aux, $posFinParteDos, $posFinParteDos);

            $posInicioParteTres = $posFinParteDos;
            foreach($todas_tablas as $key => $value){
                for($j=0; $j<10; $j++){
                    $posNombreParteTres = stripos($parteTres, " ".$value.".");
                    $posNombre = $posNombreParteTres +$posInicioParteTres+ 1;

                    if($posNombreParteTres != false){
                        $aux = substr($aux, 0, $posNombre). $dueno."_". substr($aux, $posNombre);
                        $solucion = substr($solucion, 0, $posNombre). $dueno."_". substr($solucion, $posNombre);
                        $posFinParteTres = $posFinParteTres + strlen($dueno) + 1;
                        $longParteTres = $posFinParteTres;
                        $parteTres = substr($aux, $posInicioParteTres, $longParteTres);
                    }
                }
            }



            if ($haySelect){
                $posInicioSelect = strpos($solucion, "select ");
                $posFinSelect = strlen($solucion);
                $parteSelect = substr($solucion, $posInicioSelect, $posFinSelect);
                $aux2 = strtr($parteSelect, $cambios2);

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
                $ejer = new Ejercicio();
                $tablasDisponibles = $ejer->getTodasTablas();
        
                $ok = validarTablas($tablasSolucion, $tablasDisponibles);
                $resultado = array();
                if($ok){

                    $todas_tablas_juntas_sin_dueno = array_merge($tablasSolucionSinDueno, $todas_tablas);
                    $solucion = sustituirNuevoNombreTabla($tablasSolucionSinDueno, $solucion, $dueno);

                }
            }
        }

        return $solucion;
    }

    function sustituirNuevoNombreTablaDelete($todas_tablas, $solucion, $dueno){
        $cambios = array('!='=>'#', ','=>'#', '('=>'#', ')'=>'#', '='=>'#', '>'=>'#', '<'=>'#', '>='=>'##', '<='=>'##', '<>'=>'##', '&&'=>'##', '||'=>'##', '+'=>'#','*'=>'#','-'=>'#', '%'=>'#');
        $cambios2 = $arrayName = array(')' => "", '('=>"" );
        $aux = strtr($solucion,$cambios);

        $palabras = array(" where "," order "," limit ", ";");
        $posPalabraFinParteUnoArray = array();
        foreach($palabras as $key => $value){
            $posAux = strpos($aux,$value);
            if($posAux != false){
                $posPalabraFinParteUnoArray[$key] = $posAux;
            }
        }
        if(count($posPalabraFinParteUnoArray) > 0){
                arsort($posPalabraFinParteUnoArray);
        }else{
                array_push($posPalabraFinParteUnoArray, strlen($aux));
        }
        $posFinParteUno = array_pop($posPalabraFinParteUnoArray);
        // var_dump("#############".$posFinParteUno);
        $longParteUno = $posFinParteUno +1;
        //var_dump($longParteDos);
        if(strlen($solucion) === $posFinParteUno){
            $parteUno = substr($aux, 0, $posFinParteUno);
        }else{
            $parteUno = substr($aux, 0, $posFinParteUno+1);
        }
        // var_dump("ParteUno:".$parteUno);
        // var_dump($solucion);
        foreach($todas_tablas as $key => $value){

            $posNombreParteUno = strpos($parteUno, " ".$value." ");
            if(!$posNombreParteUno){
                $posNombreParteUno = strpos($parteUno, " ".$value."#");
            }
            if (!$posNombreParteUno) {
                $posNombreParteUno = strpos($parteUno, "#".$value." ");
            }
            if (!$posNombreParteUno) {
                $posNombreParteUno = strpos($parteUno, "#".$value."#");
            }
            if (!$posNombreParteUno) {
                $posNombreParteUno = strpos($parteUno, " ".$value.";");
            }
            if (!$posNombreParteUno) {
                $posNombreParteUno = strpos($parteUno, "#".$value.";");
            }
            $posNombre = $posNombreParteUno + 1;
            // var_dump($posNombreParteDos." ".$posFinParteUno);
            if($posNombreParteUno != false){
                $aux = substr($aux, 0, $posNombre). $dueno."_". substr($aux, $posNombre);
                // var_dump($aux);
                $solucion = substr($solucion, 0, $posNombre). $dueno."_". substr($solucion, $posNombre);
                // var_dump($solucion);
                $posFinParteUno = $posFinParteUno + strlen($dueno) + 1;
                $longParteUno = $posFinParteUno;
                $parteUno = substr($aux, 0, $longParteUno+1);
            } 
        }
        if(strpos($solucion, " where ")){
            if (strpos($solucion, "select ")){
                $posFinParteDos = strpos($solucion,"select");
                $haySelect = true;
            }else{
                $haySelect = false;
                $posFinParteDos = strlen($solucion);
            }

            $parteDos = substr($aux, $posFinParteUno, $posFinParteDos);

            $posInicioParteDos = $posFinParteUno;
            foreach($todas_tablas as $key => $value){
                for($j=0; $j<10; $j++){
                    $posNombreParteDos = stripos($parteDos, " ".$value.".");
                    $posNombre = $posNombreParteDos +$posInicioParteDos+ 1;

                    if($posNombreParteDos != false){
                        $aux = substr($aux, 0, $posNombre). $dueno."_". substr($aux, $posNombre);
                        $solucion = substr($solucion, 0, $posNombre). $dueno."_". substr($solucion, $posNombre);
                        $posFinParteDos = $posFinParteDos + strlen($dueno) + 1;
                        $longParteDos = $posFinParteDos;
                        $parteDos = substr($aux, $posInicioParteDos, $longParteDos);
                    }
                }
            }



            if ($haySelect){
                $posInicioSelect = strpos($solucion, "select ");
                $posFinSelect = strlen($solucion);
                $parteSelect = substr($solucion, $posInicioSelect, $posFinSelect);
                $aux2 = strtr($parteSelect, $cambios2);

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
                $ejer = new Ejercicio();
                $tablasDisponibles = $ejer->getTodasTablas();
        
                $ok = validarTablas($tablasSolucion, $tablasDisponibles);
                $resultado = array();
                if($ok){

                    $todas_tablas_juntas_sin_dueno = array_merge($tablasSolucionSinDueno, $todas_tablas);
                    $solucion = sustituirNuevoNombreTabla($tablasSolucionSinDueno, $solucion, $dueno);

                }
            }
        }

        // var_dump($solucion);

        return $solucion;

    }

    function sustituirNuevoNombreTabla($tablasSolucionSinDueno, $solucion, $dueno){
        //var_dump($tablasSolucionSinDueno);
        // var_dump($solucion);
        //var_dump($dueno);
        $cambios = array('!='=>'#', ','=>'#', '('=>'#', ')'=>'#', '='=>'#', '>'=>'#', '<'=>'#', '>='=>'##', '<='=>'##', '<>'=>'##', '&&'=>'##', '||'=>'##', '+'=>'#','*'=>'#','-'=>'#', '%'=>'#');

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
            // var_dump("Fin parte Uno: ".$posFinParteUno."; Fin parte dos: ".$posFinParteDos);
            // var_dump("Parte dos: ".$parteDos);
            // var_dump($solucion);
            foreach($tablasSolucionSinDueno as $key => $value){

                    $posNombreParteDos = stripos($parteDos, " ".$value." ");
                    if($posNombreParteDos == false) { //si justo despues de la tabla hay ;
                            $posNombreParteDos = stripos($parteDos, " ".$value.";");
                    }
                    $posNombre = $posNombreParteDos + $posFinParteUno + 1;
                    // var_dump($posNombreParteDos." ".$posFinParteUno);
                    if($posNombreParteDos != false){
                        $aux = substr($aux, 0, $posNombre). $dueno."_". substr($aux, $posNombre);
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
        // var_dump($solucion);
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
                //var_dump($tablasSolucion);
                //var_dump($tablasDisponibles);

        $resultado = array();
        if($ok){
            
            $solucion = sustituirNuevoNombreTabla($tablasSolucionSinDueno, $solucion, $dueno);
            // var_dump($solucion);
            $resultadoSolucion = $ejer->executeSolucion($solucion, $tablasSolucion[0]);

            if($resultadoSolucion[0] === false){
                $resultado[0] = false;
                $resultado[4] = $resultadoSolucion[1];
            }else{
                $resultado[0] = true;
                $resultado[1] = $tablasSolucion;
                $resultado[2] = $resultadoSolucion;
                $resultado[3] = $solucion;
            }

        }else{
            $resultado[0] = false;
        }

        return $resultado;
    }

    function validarInsert($solucion, $dueno){
        $sentencia = explode(" ", $solucion);
        if(in_array(" select ",$sentencia)){
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

                $inicio = strpos($solucion, "select");
                $solo_select = substr($solucion, $inicio);

                $resultado_select = validarSelect($solo_select, $dueno);

                if(!$resultado_select[0]){
                    $resultado[0] = false;
                    $resultado[4] = "El Select no devuelve datos válidos: ".$resultado_select[4];
                }else{

                    $nueva_solucion = substr($solucion,0,$inicio).$resultado_select[3];
                    // var_dump($nueva_solucion);

                    $resultadoSolucion = $ejer->executeSolucionNoSelect($nueva_solucion, $tablasSolucion[0]);

                    if($resultadoSolucion[0] === false){
                        $resultado[0] = false;
                        $resultado[1] = $resultadoSolucion[1];
                    }else{
                        $resultado[0] = true;
                        $resultado[1] = $tablasSolucion;
                        $resultado[2] = $resultadoSolucion;
                    }
                }

            }else{
                $resultado[0] = false;
                $resultado[4] = "Las tablas de la solución no pertenecen al creador de tablas seleccionado o no existen.";
            }    
        }else{
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
                $resultadoSolucion = $ejer->executeSolucionNoSelect($solucion, $tablasSolucion[0]);

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
        }
        return $resultado;
    }

    function validarUpdate($solucion, $dueno){
        
        $sentencia = explode(" ", $solucion);

        if(in_array("set", $sentencia)){
            $cambios = array('('=>' ', ')'=>' ');
            $aux = strtr($solucion, $cambios);
            $quitarSet = preg_split("/ set /i", $aux);
            $tablas = str_replace("update ","",$quitarSet[0]);

                // var_dump($tablas);
            $todas_tablas_sin_dueno = quitarPalabrasIntermadias($tablas);
                // var_dump($tablas);

            $todas_tablas_sin_dueno = quitarAlias($todas_tablas_sin_dueno);

            for ($i=0; $i < count($todas_tablas_sin_dueno); $i++) { 
                $todas_tablas_sin_dueno[$i] = trim($todas_tablas_sin_dueno[$i]);
            }


            if(is_array($todas_tablas_sin_dueno)){
                $todas_tablas = anadirDueno($todas_tablas_sin_dueno, $dueno);
            }else{
                $aux = $todas_tablas_sin_dueno;
                $todas_tablas[0] = $dueno."_".$todas_tablas_sin_dueno;
                $todas_tablas_sin_dueno = array();
                $todas_tablas_sin_dueno[0] = $aux;

            }

            $ejer = new Ejercicio();
            $tablasDisponibles = $ejer->getTodasTablas();
        
            $ok = validarTablas($todas_tablas, $tablasDisponibles);
            // var_dump($ok);
            $resultado = array();
            if($ok){

                $solucionConDueno = sustituirNuevoNombreTablaUpdate($todas_tablas_sin_dueno, $solucion, $dueno);
                // var_dump($solucionConDueno);
                // var_dump("***********************************************");
                $resultadoSolucion = $ejer->executeSolucionNoSelect($solucionConDueno, $todas_tablas[0]);
                // var_dump($resultadoSolucion);
                if($resultadoSolucion[0] === false){
                        $resultado[0] = false;
                        $resultado[1] = $resultadoSolucion[1];
                }else{
                        $resultado[0] = true;
                        $resultado[1] = $todas_tablas;
                        $resultado[2] = $resultadoSolucion;
                }


            }else{
                $resultado[0] = false;
                $resultado[4] = "Las tablas de la solución no pertenecen al creador de tablas seleccionado o no existen.";
            }
            
        }else{
                $resultado[0] = false;
                $resultado[4] = "La solución no tiene una sintaxis correcta.";
        }
        return $resultado;
    }

    function validarDelete($solucion, $dueno){

        $sentencia = explode(" ", $solucion);

        if(in_array("from", $sentencia)){
                
            $cambios = array('('=>' ', ')'=>' ');
            $aux = strtr($solucion, $cambios);
            // var_dump($aux);


            $quitarFrom = preg_split("/ from /i", $aux);
            // var_dump($quitarFrom);
            $tablas_sin_dueno = quitarPalabrasFinales($quitarFrom[1]);
            // var_dump($tablas_sin_dueno);
            $tablas_sin_dueno = quitarPalabrasIntermadias($tablas_sin_dueno);
            $tablas_sin_dueno = quitarAlias($tablas_sin_dueno);

            if(!is_array($tablas_sin_dueno)){
                $aux = $tablas_sin_dueno;
                $tablas_sin_dueno = array();
                $tablas_sin_dueno[0] = $aux;
            }

             // var_dump($tablas_sin_dueno);
            juntarArrayRecursivo($total, $tablas_sin_dueno, $count);

            $tablasSolucionSinDueno = eliminarRepetidos($total);
            //var_dump($tablasSolucionSinDueno);
            $tablasSolucion = anadirDueno($tablasSolucionSinDueno, $dueno);
            // var_dump($tablasSolucion);
            $ejer = new Ejercicio();
            $tablasDisponibles = $ejer->getTodasTablas();
            $ok = validarTablas($tablasSolucion, $tablasDisponibles);
            //var_dump($tablasSolucion);

            $resultado = array();
            if($ok){
                
                $solucion = sustituirNuevoNombreTablaDelete($tablasSolucionSinDueno, $solucion, $dueno);
                // var_dump($solucion);
                $resultadoSolucion = $ejer->executeSolucionNoSelect($solucion,$tablasSolucion[0]);

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
        } else{
            $resultado[0] = false;
            $resultado[4] = "La solución no tiene una sintaxis correcta.";

        }
        // var_dump($resultado);
        return $resultado;
    }

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

        // var_dump($solucionPropuesta);
        $solucionPropuesta = preg_replace('/\s+/', ' ', $solucionPropuesta);
        // var_dump($solucionPropuesta);
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
                $resultado[4] = "La solución no tiene una sintaxis correcta.";
        }

        return $resultado;
    }

    $resultado = distinguirSentencia($solucion, $user_tablas);
    // var_dump($resultado);
    if($resultado[0]){

        $ejer = new Ejercicio();
        $resultadoCrear = "";

        $resultadoCrear = $ejer->createEjercicio($nivel,$enunciado,$descripcion,$deshabilitar,$categoria,$user,$solucion, $resultado[1]);

        if($resultadoCrear){
                unset($_SESSION['guardarDatos']);
                header("Location: ../templates/configuration_exercises.php");
        }else{
                $_SESSION['message_sheets'] = "<div class='modal fade show' id='modal-close' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                        <div class='modal-dialog modal-dialog-centered' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                  <div class='close' id='close-modal'>
                                    <i class='fas fa-times' data-dismiss='modal'></i>
                                  </div>
                                </div>
                                <div class='modal-body'>
                                    <h2><strong>¡Error!</strong></h2>
                                    <p>Error al crear el ejercicio.</p>
                                </div>
                            </div>
                        </div>   
                    </div>";
                header("Location: ../templates/configuration_new_exercises.php");
        }

    }else{

        if (isset($resultado[4])){
            $_SESSION['message_sheets'] = "<div class='modal fade show' id='modal-close' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                <div class='modal-dialog modal-dialog-centered' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                          <div class='close' id='close-modal'>
                            <i class='fas fa-times' data-dismiss='modal'></i>
                          </div>
                        </div>
                        <div class='modal-body'>
                            <h2><strong>¡Error!</strong></h2>
                            <p>". $resultado[4] ."</p>
                        </div>
                    </div>
                </div>   
            </div>";
        }else{
            $_SESSION['message_sheets'] = "<div class='modal fade show' id='modal-close' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                <div class='modal-dialog modal-dialog-centered' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                          <div class='close' id='close-modal'>
                            <i class='fas fa-times' data-dismiss='modal'></i>
                          </div>
                        </div>
                        <div class='modal-body'>
                            <h2><strong>¡Error!</strong></h2>
                            <p>Por favor repase las tablas de la solución y asegurese de que sean válidas.</p>
                        </div>
                    </div>
                </div>   
            </div>";            
        }
        
        header("Location: ../templates/configuration_new_exercises.php");
    }
    exit();
      
?>