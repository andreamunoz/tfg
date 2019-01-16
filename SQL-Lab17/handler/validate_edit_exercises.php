<?php 
	include_once '../inc/ejercicio.php';
	session_start();
	$user = $_SESSION['user'];
    $id = $_GET['exercise'];
	$descripcion = $_POST['descripcion'];
    $old_descripcion = $_SESSION['old_descripcion'];
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

    if ($exist != 0 and $descripcion != $_SESSION['old_descripcion']){
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
                                    <p>Esa descripción ya ha sido utilizada en otro ejercicio.</p>
                                </div>
                            </div>
                        </div>   
                    </div>";
        header("Location: ../templates/configuration_edit_exercises.php?exercise=$id");
    } else {


        $arrayComillas = array("`", "'");
        $solucion = str_replace($arrayComillas, '"', $solucion);


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

        function sustituirNuevoNombreTablaUpdate($todas_tablas, $solucion, $dueno){
            $cambios = array('!='=>'#', ','=>'#', '('=>'#', ')'=>'#', '='=>'#', '>'=>'#', '<'=>'#', '>='=>'##', '<='=>'##', '<>'=>'##', '&&'=>'##', '||'=>'##', '+'=>'#','*'=>'#','-'=>'#', '%'=>'#');
            $cambios2 = $arrayName = array(')' => "", '('=>"" );
            $aux = strtr($solucion,$cambios);

            $posInicioParteUno = 0;
            $posFinParteUno = strpos($aux, "set");
            if(count($todas_tablas)===1){
                $parteUno = substr($aux, $posInicioParteUno, $posFinParteUno);
            }else{
                $parteUno = trim(substr($aux, $posInicioParteUno, $posFinParteUno));   
            }

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
            $parteDos = substr($aux, $posFinParteUno,$posFinParteDos);
            $posInicioParteDos = $posFinParteUno;
            foreach($todas_tablas as $key => $value){

                for($j=0; $j<10; $j++){
                    $posNombreParteDos = stripos($parteDos, " ".$value.".");
                    $posNombre = $posNombreParteDos + $posInicioParteDos + 1;

                    if($posNombreParteDos != false){
                        $aux = substr($aux, 0, $posNombre). $dueno."_". substr($aux, $posNombre);
                        $solucion = substr($solucion, 0, $posNombre). $dueno."_". substr($solucion, $posNombre);
                        $posFinParteDos = $posFinParteDos + strlen($dueno) + 1;
                        $longParteDos = $posFinParteDos;
                        $parteDos = substr($aux, $posInicioParteDos, $longParteDos);
                    }
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
                        $tablas[$i - 1] = quitarPalabrasIntermadias($tablas[$i - 1]);
                        $tablas[$i - 1] = quitarAlias($tablas[$i - 1]);
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

        function sustituirNuevoNombreTablaDeleteMultiple($tablas, $solucion,$dueno){
            $sentencia_copia_minusculas = $solucion;

            foreach ($tablas as $key => $value) {
                $avance = 0;
                $buscarFin = array();
                if (stripos($sentencia_copia_minusculas, " where ")!== false){
                    $buscarFin[0] = stripos($sentencia_copia_minusculas, " where ");
                }else{
                    $buscarFin[0] = 9999999;
                }
                if (stripos($sentencia_copia_minusculas, ";")!== false){
                    $buscarFin[1] = stripos($sentencia_copia_minusculas, ";");
                }else{
                    $buscarFin[1] = 9999999;
                }
                asort($buscarFin);
                $limite = $buscarFin[0];

                for($j=0; $j<5; $j++){
                    $posicion_tabla = strpos($sentencia_copia_minusculas, " ".$value." ");
                    if ($posicion_tabla !== false and $posicion_tabla+1 < $limite){
                        $sentencia_copia_minusculas = substr($sentencia_copia_minusculas, 0,$posicion_tabla+1).$dueno."_".substr($sentencia_copia_minusculas, $posicion_tabla+1);
                        $limite = $limite + strlen($value)+1;
                    }
                }
                for($j=0; $j<5; $j++){
                    $posicion_tabla = strpos($sentencia_copia_minusculas," ".$value.",");
                    if ($posicion_tabla !== false and $posicion_tabla+1 < $limite){
                        $sentencia_copia_minusculas = substr($sentencia_copia_minusculas, 0,$posicion_tabla+1).$dueno."_".substr($sentencia_copia_minusculas, $posicion_tabla+1);
                        $limite = $limite + strlen($value)+1;
                    }
                }
                for($j=0; $j<5; $j++){
                    $posicion_tabla = strpos($sentencia_copia_minusculas,",".$value.",");
                    if ($posicion_tabla !== false and $posicion_tabla+1 < $limite){
                        $sentencia_copia_minusculas = substr($sentencia_copia_minusculas, 0,$posicion_tabla+1).$dueno."_".substr($sentencia_copia_minusculas, $posicion_tabla+1);
                        $limite = $limite + strlen($value)+1;
                    }
                }
                for($j=0; $j<5; $j++){
                    $posicion_tabla = strpos($sentencia_copia_minusculas,",".$value." ");
                    if ($posicion_tabla !== false and $posicion_tabla+1 < $limite){
                        $sentencia_copia_minusculas = substr($sentencia_copia_minusculas, 0,$posicion_tabla+1).$dueno."_".substr($sentencia_copia_minusculas, $posicion_tabla+1);
                        $limite = $limite + strlen($value)+1;
                    }
                }

                $posicion_tabla_fin = $posicion_tabla + strlen($value)+1;
                if (stripos($sentencia_copia_minusculas, " where ")!== false and stripos($sentencia_copia_minusculas, "(select ")!== false){
                    $parteMediaFin = stripos($sentencia_copia_minusculas, "(select ");
                    $longMedia = stripos($sentencia_copia_minusculas, "(select ") - stripos($sentencia_copia_minusculas, " where ");
                    $parteMedia = substr($sentencia_copia_minusculas, stripos($sentencia_copia_minusculas, " where "), $longMedia);

                    foreach ($tablas as $key => $value) {
                        for($j=0; $j<10; $j++){
                            $posicion_tabla = strpos($sentencia_copia_minusculas, " ".$value.".");
                            if ($posicion_tabla !== false and $posicion_tabla+1 < $parteMediaFin){
                                $sentencia_copia_minusculas = substr($sentencia_copia_minusculas, 0,$posicion_tabla+1).$dueno."_".substr($sentencia_copia_minusculas, $posicion_tabla+1);
                                $parteMediaFin = $parteMediaFin + strlen($value)+1;
                            }
                        }
                    }
                }
                //parte dos despues de la tabla
                $posSelect = strpos($sentencia_copia_minusculas, "(select ");
                if(!$posSelect){
                    $posFinParteTres = strlen($sentencia_copia_minusculas);
                }else{
                    $posFinParteTres = $posSelect;
                }
                $posFinParteDos = $posicion_tabla_fin;
                $longParteTres = $posFinParteTres - $posFinParteDos;
                $parteTres = substr($sentencia_copia_minusculas,$posFinParteDos, $longParteTres);

                for($j=0; $j<10; $j++){
                    $posNombreParteTres = strpos($parteTres, " ".$value.".");
                    $posNombre = $posNombreParteTres + $posFinParteDos +1;

                    if($posNombreParteTres != false){
                        // $aux = substr($aux, 0,$posNombre). $dueno."_".substr($aux, $posNombre);
                        $sentencia_copia_minusculas = substr($sentencia_copia_minusculas, 0, $posNombre). $dueno."_".substr($sentencia_copia_minusculas, $posNombre);
                        $posFinParteTres = $posFinParteTres + strlen($dueno)+1;
                        $longParteTres = $posFinParteTres - $posFinParteDos;
                        $parteTres = substr($sentencia_copia_minusculas, $posFinParteDos, $longParteTres);
                    }
                }
                $posSelect = strpos($sentencia_copia_minusculas, "(select");
                if($posSelect !== false){
                    $posFinSelect = strrpos($sentencia_copia_minusculas, ")");
                    $posFinSelect++;
                    $posFinSentencia = strlen($sentencia_copia_minusculas);
                    if($posFinSelect < $posFinSentencia ){
                        $longParteCuatro = $posFinSentencia - $posFinSelect;
                        $parteCuatro = substr($sentencia_copia_minusculas, $posFinSelect, $longParteCuatro);

                        for($j=0; $j<10; $j++){
                            $posNombreParteCuatro = strpos($parteCuatro, " ".$value.".");
                            $posNombre = $posNombreParteCuatro + $posFinSelect +1;
                            if($posNombreParteCuatro != false){
                                $sentencia_copia_minusculas = substr($sentencia_copia_minusculas, 0, $posNombre). $dueno."_".substr($sentencia_copia_minusculas, $posNombre);
                                $posFinSentencia = $posFinSentencia + strlen($dueno)+1;
                                $longParteCuatro = $posFinSentencia - $posFinSelect;
                                $parteCuatro = substr($sentencia_copia_minusculas, $posFinSelect, $longParteCuatro);
                            }
                        }
                    }
                }
            }
            return $sentencia_copia_minusculas;
        }

        function sustituirNuevoNombreTablaDeleteSimple($tablas, $solucion,$dueno){
            $sentencia_copia_minusculas = $solucion;

            foreach ($tablas as $key => $value) {
                
                $posicion_tabla = strpos($sentencia_copia_minusculas,$value);
                if ($posicion_tabla !== false){
                    $sentencia_copia_minusculas = substr($sentencia_copia_minusculas, 0,$posicion_tabla).$dueno."_".substr($sentencia_copia_minusculas, $posicion_tabla);
                }

                $posicion_tabla_fin = $posicion_tabla + strlen($value)+1;

                //parte dos despues de la tabla
                $posSelect = strpos($sentencia_copia_minusculas, "(select ");
                if(!$posSelect){
                    $posFinParteTres = strlen($sentencia_copia_minusculas);
                }else{
                    $posFinParteTres = $posSelect;
                }
                $posFinParteDos = $posicion_tabla_fin;
                $longParteTres = $posFinParteTres - $posFinParteDos;
                $parteTres = substr($sentencia_copia_minusculas,$posFinParteDos, $longParteTres);

                for($j=0; $j<10; $j++){
                    $posNombreParteTres = strpos($parteTres, " ".$value.".");
                    $posNombre = $posNombreParteTres + $posFinParteDos +1;

                    if($posNombreParteTres != false){
                        $sentencia_copia_minusculas = substr($sentencia_copia_minusculas, 0, $posNombre). $dueno."_".substr($sentencia_copia_minusculas, $posNombre);
                        $posFinParteTres = $posFinParteTres + strlen($dueno)+1;
                        $longParteTres = $posFinParteTres - $posFinParteDos;
                        $parteTres = substr($sentencia_copia_minusculas, $posFinParteDos, $longParteTres);
                    }
                }
                $posSelect = strpos($sentencia_copia_minusculas, "(select");
                if($posSelect !== false){
                    $posFinSelect = strrpos($sentencia_copia_minusculas, ")");
                    $posFinSelect++;
                    $posFinSentencia = strlen($sentencia_copia_minusculas);
                    if($posFinSelect < $posFinSentencia ){
                        $longParteCuatro = $posFinSentencia - $posFinSelect;
                        $parteCuatro = substr($sentencia_copia_minusculas, $posFinSelect, $longParteCuatro);

                        for($j=0; $j<10; $j++){
                            $posNombreParteCuatro = strpos($parteCuatro, " ".$value.".");
                            $posNombre = $posNombreParteCuatro + $posFinSelect +1;
                            if($posNombreParteCuatro != false){
                                $sentencia_copia_minusculas = substr($sentencia_copia_minusculas, 0, $posNombre). $dueno."_".substr($sentencia_copia_minusculas, $posNombre);
                                $posFinSentencia = $posFinSentencia + strlen($dueno)+1;
                                $longParteCuatro = $posFinSentencia - $posFinSelect;
                                $parteCuatro = substr($sentencia_copia_minusculas, $posFinSelect, $longParteCuatro);
                            }
                        }
                    }
                }
            }
            return $sentencia_copia_minusculas;
        }

        function sustituirNuevoNombreTabla($tablasSolucionSinDueno, $solucion, $dueno){
            $aux = pasarAMinusculas($solucion);
            $cambios = array('!='=>'#', ','=>'#', '('=>'#', ')'=>'#', '='=>'#', '>'=>'#', '<'=>'#', '>='=>'##', '<='=>'##', '<>'=>'##', '&&'=>'##', '||'=>'##','+'=>'#','*'=>'#','-'=>'#', '%'=>'#');

            $aux = strtr($aux,$cambios);

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

        function validarInsert($solucion, $dueno){
            $sentencia = explode(" ", $solucion);
            if(in_array("select",$sentencia)){
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

                        $resultadoSolucion = $ejer->executeSolucionNoSelect($nueva_solucion, $tablasSolucion[0],"insert");

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
                    $resultadoSolucion = $ejer->executeSolucionNoSelect($solucion,$tablasSolucion[0],"insert");

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

                $todas_tablas_sin_dueno = quitarPalabrasIntermadias($tablas);

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
                $resultado = array();
                if($ok){

                    $solucionConDueno = sustituirNuevoNombreTablaUpdate($todas_tablas_sin_dueno, $solucion, $dueno);
                    $resultadoSolucion = $ejer->executeSolucionNoSelect($solucionConDueno, $todas_tablas[0], "update");
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
            $resultado = array();
            $ejer = new Ejercicio();
            $sentencia_copia_minusculas = pasarAMinusculas($solucion);

            $sentencia = $sentencia_copia_minusculas;
            if (stripos($sentencia, " low_priority ")!== false){
                $encontrado = stripos($sentencia, "low_priority");
                $tamano = 13;
                $sentencia = substr($sentencia, 0,$encontrado).substr($sentencia,$encontrado+$tamano);
            }
            if (stripos($sentencia, " quick ")!== false){
                $encontrado = stripos($sentencia, "quick");
                $tamano = 6;
                $sentencia = substr($sentencia, 0,$encontrado).substr($sentencia,$encontrado+$tamano);
            }
            if (stripos($sentencia, " ignore ")!== false){
                $encontrado = stripos($sentencia, "ignore");
                $tamano = 7;
                $sentencia = substr($sentencia, 0,$encontrado).substr($sentencia,$encontrado+$tamano);
            }

            if(strpos($sentencia, "delete from")!== false){
                if (strpos($sentencia_copia_minusculas, " using ") === false){

                    $buscarFin = array();
                    if (stripos($sentencia, " where ")!== false){
                        $buscarFin[0] = stripos($sentencia, " where ");
                    }else{
                        $buscarFin[0] = 9999999;
                    }

                    if (stripos($sentencia, " order ")!== false){    
                        $buscarFin[1] = stripos($sentencia, " order ");
                    }else{
                        $buscarFin[1] = 9999999;
                    }

                    if (stripos($sentencia, " limit ")!== false){    
                        $buscarFin[2] = stripos($sentencia, " limit ");
                    }else{
                        $buscarFin[2] = 9999999;
                    }

                    if (stripos($sentencia, ";")!== false){
                        $buscarFin[3] = stripos($sentencia, ";");
                    }else{
                        $buscarFin[3] = 9999999;
                    }
                    asort($buscarFin);
                    $subcadena_tablas = substr($sentencia,0, $buscarFin[0]);
                    $subcadena_tablas = preg_replace("/delete from /i", "", $subcadena_tablas);

                    // correcta sintaxis de la subsentencia
                    if ( strpos($sentencia_copia_minusculas, "(select ") === false and  strpos($sentencia_copia_minusculas, " select ") !== false){
                        $resultado[0] = false;
                        $resultado[4] = "La solución no tiene una sintaxis correcta. La subsentencia va entre parentesis.";
                        return $resultado;
                    }

                    //buscamos cuantas selects hay y las validamos
                    $avance = 0;
                    $coincidencias = substr_count($sentencia_copia_minusculas, "(select ");
                    if($coincidencias > 0){
                        for ($i=0; $i <$coincidencias ; $i++) { 
                            $inicio_subselect = strpos($sentencia_copia_minusculas, "(select ", $avance);
                            $fin_subselect = strrpos($sentencia_copia_minusculas, ")");
                            $avance = $inicio_subselect +1;

                            $subselect = substr($sentencia_copia_minusculas, $inicio_subselect, $fin_subselect-$inicio_subselect+1);
                            $resultado_subselect = validarSelect($subselect, $dueno);
                            if($resultado_subselect[0] === true){
                                $sentencia_copia_minusculas = substr($sentencia_copia_minusculas, 0, $inicio_subselect).$resultado_subselect[3].substr($sentencia_copia_minusculas,$fin_subselect + 1);
                            }else{
                                $resultado[0] = false;
                                $resultado[4] = "La subsentencia no es correcta.";
                                return $resultado;
                            }

                        }
                        if (is_string($subcadena_tablas)){
                            $tablas[0] = $subcadena_tablas;
                        } 
                        $sentencia_delete_simple = sustituirNuevoNombreTablaDeleteSimple($tablas, $sentencia_copia_minusculas, $dueno);
                    }else{
                        if (is_string($subcadena_tablas)){
                            $tablas[0] = $subcadena_tablas;
                        } 
                        $sentencia_delete_simple = sustituirNuevoNombreTablaDeleteSimple($tablas, $sentencia_copia_minusculas, $dueno);
                    }

                    $resultadoSolucion = $ejer->executeSolucionNoSelect($sentencia_delete_simple, $tablas, "delete");

                    if($resultadoSolucion[0] === false){
                        $resultado[0] = false;
                        $resultado[4] = $resultadoSolucion[1];
                    }else{
                        foreach ($tablas as $key => $value) {
                            $tablasConDueno[$key] = $dueno."_".$value;
                        }
                        $resultado[0] = true;
                        $resultado[1] = $tablasConDueno;
                        $resultado[2] = $resultadoSolucion;
                        $resultado[3] = $sentencia_delete_simple;
                    }

                } else {

                    $buscarFin = array();
                    if (stripos($sentencia, " where ")!== false){
                        $buscarFin[0] = stripos($sentencia, " where ");
                    }else{
                        $buscarFin[0] = 9999999;
                    }
                    if (stripos($sentencia, ";")!== false){
                        $buscarFin[1] = stripos($sentencia, ";");
                    }else{
                        $buscarFin[1] = 9999999;
                    }
                    asort($buscarFin);
                    $subcadena_tablas = substr($sentencia,0, $buscarFin[0]);
                    $subcadena_tablas = preg_replace("/delete from /i", "", $subcadena_tablas);

                    $posUsing = stripos($subcadena_tablas, " using ") + 7;
                    $obtener_tablas = substr($subcadena_tablas, $posUsing);

                    $tablas = quitarPalabrasIntermadias($obtener_tablas);
                    $tablas = quitarAlias($tablas);

                    //tenemos las tablas-> comprobar si hay subselect y sustituir el nombre.
                    // correcta sintaxis de la subsentencia
                    if ( strpos($sentencia_copia_minusculas, "(select ") === false and  strpos($sentencia_copia_minusculas, " select ") !== false){
                        $resultado[0] = false;
                        $resultado[4] = "La solución no tiene una sintaxis correcta. La subsentencia va entre parentesis.";
                        return $resultado;
                    }

                    //buscamos cuantas selects hay y las validamos
                    $avance = 0;
                    $coincidencias = substr_count($sentencia_copia_minusculas, "(select ");
                    if($coincidencias > 0){
                        for ($i=0; $i <$coincidencias ; $i++) { 
                            $inicio_subselect = strpos($sentencia_copia_minusculas, "(select ", $avance);
                            $fin_subselect = strrpos($sentencia_copia_minusculas, ")");
                            $avance = $inicio_subselect +1;

                            $subselect = substr($sentencia_copia_minusculas, $inicio_subselect, $fin_subselect-$inicio_subselect+1);

                            $resultado_subselect = validarSelect($subselect, $dueno);
                            if($resultado_subselect[0] === true){
                                $sentencia_copia_minusculas = substr($sentencia_copia_minusculas, 0, $inicio_subselect).$resultado_subselect[3].substr($sentencia_copia_minusculas,$fin_subselect + 1);
                            }else{
                                $resultado[0] = false;
                                $resultado[4] = "La subsentencia no es correcta.";
                                return $resultado;
                            }
                        }
                        if (is_string($tablas)){
                            $tabla[0] = $tablas;
                        } else{
                            foreach ($tablas as $key => $value) {
                                $tabla[$key] = $value;
                            }
                        }
                        $sentencia_delete_simple = sustituirNuevoNombreTablaDeleteMultiple($tabla, $sentencia_copia_minusculas, $dueno);

                    }else{
                        if (is_string($tablas)){
                            $tabla[0] = $tablas;
                        }else{
                            foreach ($tablas as $key => $value) {
                                $tabla[$key] = $value;
                            }
                        }
                        $sentencia_delete_simple = sustituirNuevoNombreTablaDeleteMultiple($tabla, $sentencia_copia_minusculas, $dueno);
                    }

                    $resultadoSolucion = $ejer->executeSolucionNoSelect($sentencia_delete_simple, $tabla, "delete");

                    if($resultadoSolucion[0] === false){
                        $resultado[0] = false;
                        $resultado[4] = $resultadoSolucion[1];
                    }else{
                        foreach ($tabla as $key => $value) {
                            $tablasConDueno[$key] = $dueno."_".$value;
                        }
                        $resultado[0] = true;
                        $resultado[1] = $tablasConDueno;
                        $resultado[2] = $resultadoSolucion;
                        $resultado[3] = $sentencia_delete_simple;
                    }
                }
            
            } elseif(stripos($sentencia, " from ")){

                $buscarFin = array();
                if (stripos($sentencia_copia_minusculas, " where ")!== false){
                    $buscarFin[0] = stripos($sentencia_copia_minusculas, " where ");
                }else{
                    $buscarFin[0] = 9999999;
                }
                if (stripos($sentencia_copia_minusculas, ";")!== false){
                    $buscarFin[1] = stripos($sentencia_copia_minusculas, ";");
                }else{
                    $buscarFin[1] = 9999999;
                }
                asort($buscarFin);
                // var_dump($buscarFin);
                $posFrom = stripos($sentencia_copia_minusculas, " from ") + 6;
                $longTablas = $buscarFin[0] - $posFrom;
                $subcadena_tablas = substr($sentencia_copia_minusculas,$posFrom, $longTablas);

                $tablas = quitarPalabrasIntermadias($subcadena_tablas);
                $tablas = quitarAlias($tablas);
                //tenemos las tablas-> comprobar si hay subselect y sustituir el nombre.
                // correcta sintaxis de la subsentencia
                if ( strpos($sentencia_copia_minusculas, "(select ") === false and  strpos($sentencia_copia_minusculas, " select ") !== false){
                    $resultado[0] = false;
                    $resultado[4] = "La solución no tiene una sintaxis correcta. La subsentencia va entre parentesis.";
                    return $resultado;
                }
                //buscamos cuantas selects hay y las validamos
                $avance = 0;
                $coincidencias = substr_count($sentencia_copia_minusculas, "(select ");
                if($coincidencias > 0){
                    for ($i=0; $i <$coincidencias ; $i++) { 
                        $inicio_subselect = strpos($sentencia_copia_minusculas, "(select ", $avance);
                        $fin_subselect = strrpos($sentencia_copia_minusculas, ")");
                        $avance = $inicio_subselect +1;

                        $subselect = substr($sentencia_copia_minusculas, $inicio_subselect, $fin_subselect-$inicio_subselect+1);
                        $resultado_subselect = validarSelect($subselect, $dueno);

                        if($resultado_subselect[0] === true){
                            $sentencia_copia_minusculas = substr($sentencia_copia_minusculas, 0, $inicio_subselect).$resultado_subselect[3].substr($sentencia_copia_minusculas,$fin_subselect + 1);
                        }else{
                            $resultado[0] = false;
                            $resultado[4] = "La subsentencia no es correcta.";
                            return $resultado;
                        }

                    }
                    if (is_string($tablas)){
                        $tabla[0] = $tablas;
                    } else{
                        foreach ($tablas as $key => $value) {
                            $tabla[$key] = $value;
                        }
                    }
                    $sentencia_delete_simple = sustituirNuevoNombreTablaDeleteMultiple($tabla, $sentencia_copia_minusculas, $dueno);
                }else{
                    if (is_string($tablas)){
                        $tabla[0] = $tablas;
                    }else{
                        foreach ($tablas as $key => $value) {
                            $tabla[$key] = $value;
                        }
                    }

                    $sentencia_delete_simple = sustituirNuevoNombreTablaDeleteMultiple($tabla, $sentencia_copia_minusculas, $dueno);
                }

                $resultadoSolucion = $ejer->executeSolucionNoSelect($sentencia_delete_simple, $tabla, "delete");

                if($resultadoSolucion[0] === false){
                    $resultado[0] = false;
                    $resultado[4] = $resultadoSolucion[1];
                }else{
                    foreach ($tabla as $key => $value) {
                        $tablasConDueno[$key] = $dueno."_".$value;
                    }
                    $resultado[0] = true;
                    $resultado[1] = $tablasConDueno;
                    $resultado[2] = $resultadoSolucion;
                    $resultado[3] = $sentencia_delete_simple;
                }

            }else{
                $resultado[0] = false;
                $resultado[4] = "La solución no tiene una sintaxis correcta.";

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
                $resultado[4] = "La solución no tiene una sintaxis correcta.";
            }

            return $resultado;
        }

        $solucion = pasarAMinusculas($solucion);
        $resultado = distinguirSentencia($solucion, $user_tablas); 
        var_dump($resultado);
        if($resultado[0]){
            
            $ejer = new Ejercicio();
            $resultadoEditar = "";

            $resultadoEditar = $ejer->update($id,$nivel,$enunciado,$descripcion,$deshabilitar,$categoria,$solucion,$user,$resultado[1]);
             var_dump($resultadoEditar);
            if($resultadoEditar){
                $ejer->enviarAviso($id);
                unset($_SESSION['guardarDatosEditar']);
                // header("Location: ../templates/configuration_exercises.php");
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
                // header("Location: ../templates/configuration_edit_exercises.php?exercise=$id");
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
            }
            // header("Location: ../templates/configuration_edit_exercises.php?exercise=$id");
        }
    }
    exit();     
    
?>