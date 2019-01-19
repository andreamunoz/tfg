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
    if(substr($solucion_profesor, -1) !== ";"){
        $solucion_profesor = $solucion_profesor.";";
    }
    if(substr($solucion_alumno, -1) !== ";"){
        $solucion_alumno = $solucion_alumno.";";
    }

    function pasarAMinusculas($solucion){

        $nueva_solucion = "";
        $miniaux = "";
        $inicio = 0;
        $fin = strlen($solucion);
        $literal = false;

        if(strpos($solucion, '"', $inicio)){

            $posicionComillas = strpos($solucion, '"', $inicio);
            while ( $posicionComillas !== false){
                $miniaux = substr($solucion,$inicio, $posicionComillas-$inicio);
                if($literal){
                    $nueva_solucion = $nueva_solucion . $miniaux . '"';
                }else{
                    $nueva_solucion = $nueva_solucion . strtolower($miniaux) . '"';
                }
                $literal = !$literal;
                $inicio = $posicionComillas+1;
                $posicionComillas = strpos($solucion, '"',$inicio);
            }
            if ($posicionComillas !== $fin){
                $nueva_solucion = $nueva_solucion.substr($solucion,$inicio, $fin);     
            }
        }else{
            $nueva_solucion = strtolower($solucion);            
        }

        return $nueva_solucion;
    }

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
        $aux = pasarAMinusculas($solucion);
        $cambios = array('!='=>'#', ','=>'#', '('=>'#', ')'=>'#', '='=>'#', '>'=>'#', '<'=>'#', '>='=>'##', '<='=>'##', '<>'=>'##', '&&'=>'##', '||'=>'##','+'=>'#','*'=>'#','-'=>'#', '%'=>'#');

        $aux = strtr($solucion,$cambios);

        $coincidencias = substr_count($aux, "from");

        $avance = 0;
        for($i=0; $i<$coincidencias; $i++){
            //buscar select y from
            $posInicioParteUno = strpos($aux, "select", $avance);
            $posFinParteUno = strpos($aux, "from", $avance);
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
            $palabras = array(" where "," group "," having "," order "," limit ", ";");
            $posPalabraFinParteDosArray = array();
            foreach($palabras as $key => $value){
                $posAux = strpos($aux,$value,$avance);
                if($posAux != false){
                    $posPalabraFinParteDosArray[$key] = $posAux;
                }
            }
            if(count($posPalabraFinParteDosArray) > 0){
                arsort($posPalabraFinParteDosArray);
            }else{
                array_push($posPalabraFinParteDosArray, strlen($aux));
            }
            $posFinParteDos = array_pop($posPalabraFinParteDosArray);
            $longParteDos = $posFinParteDos - $posFinParteUno +1;
            $parteDos = substr($aux, $posFinParteUno, $longParteDos);

            foreach($tablasSolucionSinDueno as $key => $value){

                $posNombreParteDos = stripos($parteDos, " ".$value." ");
                if($posNombreParteDos == false) { //si justo despues de la tabla hay ;
                    $posNombreParteDos = stripos($parteDos, " ".$value.";");
                }
                if($posNombreParteDos == false) { //si justo despues de la tabla hay #
                    $posNombreParteDos = stripos($parteDos, " ".$value."#");
                }
                if($posNombreParteDos == false) { //si justo antes y despues de la tabla hay #
                    $posNombreParteDos = stripos($parteDos, "#".$value."#");
                }
                if($posNombreParteDos == false) { //si justo antes de la tabla hay #
                    $posNombreParteDos = stripos($parteDos, "#".$value." ");
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

            $longParteTres = $posFinParteTres - $posFinParteDos;
            $parteTres = substr($aux,$posFinParteDos, $longParteTres);

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
                $tablas[$i - 1] = quitarPalabrasIntermadias($tablas[$i - 1]);
                $tablas[$i - 1] = quitarAlias($tablas[$i - 1]);
                $i++;
        }
        $total = array();
        $count = 0;

        juntarArrayRecursivo($total, $tablas, $count);

        $tablasSolucionSinDueno = eliminarRepetidos($total);
        $tablasSolucion = anadirDueno($tablasSolucionSinDueno, $dueno);
        $ejer = new Ejercicio();
        $tablasDisponibles = $ejer->getTodasTablas();
        
        $ok = validarTablas($tablasSolucion, $tablasDisponibles);

        $resultado = array();
        if($ok){
                
            $solucion = sustituirNuevoNombreTabla($tablasSolucionSinDueno, $solucion, $dueno);

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
            $resultado[4] = "Las tablas de la solución no pertenecen al creador de tablas seleccionado o no existen.";
        }

        return $resultado;
    }

    function distinguirSentencia($solucionPropuesta, $user_tablas){
        $solucionPropuesta = mb_eregi_replace("[\n|\r|\n\r|\t]"," ",$solucionPropuesta);
        $solucionPropuesta = utf8_decode($solucionPropuesta);
        $solucionPropuesta = str_replace('?', '', $solucionPropuesta);
        $solucionPropuesta = utf8_encode($solucionPropuesta);
        $solucionPropuesta = preg_replace('/\s+/', ' ', $solucionPropuesta);
        $sentencia = explode(" ", $solucionPropuesta, 2);

        $resultado = array();
        if ($sentencia[0] === "select"){
            $resultado = validarSelect($solucionPropuesta, $user_tablas);
        }else{
            $resultado[0] = FALSE;
            $resultado[4] = "No hay datos disponibles.";
        }

        return $resultado;
    }


    $arrayComillas = array("`", "'");

    if ($sujeto === "Profesor"){
        $solucion_profesor = str_replace($arrayComillas, '"', $solucion_profesor);
        $solucion_profesor = pasarAMinusculas($solucion_profesor);
        
        $resultado = distinguirSentencia($solucion_profesor, $dueno_tabla);
    }else{
        $solucion_alumno = str_replace($arrayComillas, '"', $solucion_alumno);
        $solucion_alumno = pasarAMinusculas($solucion_alumno);
        
        $resultado = distinguirSentencia($solucion_alumno, $dueno_tabla);
    }

    if(!$resultado[0]){

        // if(isset($resultado[4])){
            // $mostrar = $resultado[4];
        // }else{
            $mostrar = "";
        // }
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
   
    echo $mostrar;
?>