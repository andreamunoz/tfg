<?php
session_start();
include_once 'functions.php';

class Administrar_schema{



    function pasarAMinusculas($solucion){

        $arrayComillas = array("`", "'");
        $solucion = str_replace($arrayComillas, '"', $solucion);

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
            if ($posicionComillas !== $fin ){
                $nueva_solucion = $nueva_solucion.substr($solucion,$inicio, $fin);     
            }

        }else{
            $nueva_solucion = strtolower($solucion);            
        }        

        return $nueva_solucion;
    }

    function transformarAMinusculas($solucion){
        $admin = new Administrar_schema();
        $subsentencia = explode(" ", $solucion, 4);
        if("create" === strtolower($subsentencia[0]) or "drop" === strtolower($subsentencia[0]) or "alter" === strtolower($subsentencia[0])){
            $solucion = strtolower($solucion);
        }else if("insert" === strtolower($subsentencia[0])){
            $solucion = $admin->pasarAMinusculas($solucion);
        }
        return $solucion;
    }
    


    //Ejecutar codigo
    function executeCode($code){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
            
        if (!($resultado = mysqli_query($conexion, "CALL sp_ejecutar_script('".$code."');"))) {
            $resultado = $conexion->error;
        }else{
            $resultado = true;
        }
        
        $connect->disconnectDB($conexion);
        return $resultado;
    }

    function updateTablasDisponibles($profe){
        $respuesta = "";
        $nombre_todas_tablas_profe = array();
        $nombre_tablas_antiguas = array();
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.tables WHERE TABLE_SCHEMA='tfg17sql' AND TABLE_NAME LIKE '".$profe."_%';";

        $array = $connect->getArraySQL($sql);
        for($i = 0; $i<count($array); $i++) {
            $nombre_todas_tablas_profe[$i] = $array[$i][0];
        }
        $sql2 = "SELECT nombre FROM sqlab_tablas_disponibles WHERE schema_prof = '".$profe."';";
        $array2 = $connect->getArraySQL($sql2);
        if(!empty($array2) ){
            for($i = 0; $i<count($array2); $i++) {
                $nombre_tablas_antiguas[$i] = $array2[$i][0];
            }
        }

        $viejos_nombres = array_diff( $nombre_tablas_antiguas, $nombre_todas_tablas_profe);
        foreach ($viejos_nombres as $key=>$value) {
            if($value !==""){
                $sql = "DELETE FROM sqlab_tablas_disponibles WHERE nombre='$value';";
                 if(!($consulta = mysqli_query($conexion,$sql))){
                    echo "Falló la llamada para borrar tablas_disponibles: ".$conexion->error;
                }
            }
        }

        $nuevos_nombres = array_diff($nombre_todas_tablas_profe, $nombre_tablas_antiguas);

        foreach ($nuevos_nombres as $key=>$value) {
            if($value !==""){
                $sql = "INSERT INTO sqlab_tablas_disponibles(nombre, schema_prof) VALUES ('".$value."','".$profe."');";
                 if(!($consulta = mysqli_query($conexion,$sql))){
                    echo "Falló la llamada para insertar en tablas_disponibles: ".$conexion->error;
                }
            }
        }

        $connect->disconnectDB($conexion);
    }

    function comprobarSintaxis($sentencia){
        $sentencia = preg_replace('/\s+/', ' ', $sentencia);
        $miarray = explode(" ", $sentencia);
        // var_dump($miarray);
        $tabla = false;

        if(in_array("create",$miarray) && in_array("table",$miarray) ){
            $agujas = array("temporary ", "if ", "not ", "exists ");
            foreach ($agujas as $value) {
                $sentencia = str_replace($value, "", $sentencia);
            }
        }else if(in_array("insert",$miarray) && in_array("into",$miarray)){
            $agujas = array("low_priority ", "delayed ", "high_priority ", "ignore ");
            foreach ($agujas as $value) {
                $sentencia = str_replace($value, "", $sentencia);
            }
        }else if(in_array("drop",$miarray) && in_array("table",$miarray)){
            $agujas = array("temporary ", "if ", "exists ");
            foreach ($agujas as $value) {
                $sentencia = str_replace($value, "", $sentencia);
            }
        }else if(in_array("alter",$miarray) && in_array("table",$miarray)){
            $agujas = array("online ", "offline ", "ignore ");
            foreach ($agujas as $value) {
                $sentencia = str_replace($value, "", $sentencia);
            }
        }else{
            return false;
        }

        $sentencia = preg_replace('/\s+/', ' ', $sentencia);
        $miarray = explode(" ", $sentencia);
        if(count($miarray) < 3){
            $tabla = false;
        }else{
            $tabla= $miarray[2];
        }
        // var_dump($tabla);
        return $tabla;
    }

    function reemplazar_primero($buscar, $remplazar, $texto){
        //var_dump("BUSCAR:".$buscar." REEMPLAZAR:".$remplazar." TEXTO:".$texto);
        $pos = strpos($texto, " ".$buscar);
        if($pos !== false){
            $texto = substr_replace($texto, $remplazar, $pos+1, strlen($buscar));
        }
        return $texto;
    }

    function reemplazar_referencias($buscar, $reemplazar, $texto){
        return $texto = str_ireplace($buscar, $reemplazar, $texto);
    }

    function obtenerSentencias($contenido, $profe){
        $admin = new Administrar_schema();
        $sentencias = explode(";", $contenido);
        // var_dump("aqui empieza");
        // var_dump($contenido);
        $contador = count($sentencias) - 1;
        $bienEjecutadas = 0;
        if($contador > 0){
            for ($j = 0; $j < $contador; $j++) {
                $sentencias[$j] = trim($sentencias[$j]);
            }        
            $i = 0;
            $arrayResultado = array($contador);
            $subsentencia = array();
            while ($i < $contador ) {

                $sentencia_con_minusculas = $admin->transformarAMinusculas($sentencias[$i]);
                $subsentencia = explode(" ", $sentencia_con_minusculas, 4);
                $nombre_tabla_con_comillas = $admin->comprobarSintaxis($sentencia_con_minusculas);
                // var_dump($sentencia_con_minusculas);

                if($nombre_tabla_con_comillas !== FALSE){

                    $miSentenciaEntera = $sentencia_con_minusculas;

                    //QUITAR COMILLAS DEL NOMBRE
                    $arrayComillas = array("`", '"', "'");
                    $nombre_tabla = str_replace($arrayComillas, "", $nombre_tabla_con_comillas);
                    
                    //CREAMOS EL NUEVO NOMBRE Y LO REEMPLAZAMOS 
                    $nuevoNombre = $profe."_".$nombre_tabla;
                    
                    $miSentenciaEntera = $admin->reemplazar_primero($nombre_tabla_con_comillas, $nuevoNombre, $miSentenciaEntera);
                    // var_dump($miSentenciaEntera);
                    //SUSTITUIMOS LAS COMILLAS POR COMILLAS DOBLES PARA QUE NO INTERFIERAN CON LAS QUE USAMOS.
                    $miSentenciaEntera = str_replace("'", '"', $miSentenciaEntera);

                    if((strtolower(stripos($sentencia_con_minusculas, "create")))!==FALSE){

                        //SI ES UN CREATE TABLE, BUSCAMOS SI TIENE REFERENCIAS PARA AÑADIR EL PREFIJO AL NOMBRE DE LA TABLA
                        $miSentenciaEntera = $admin->reemplazar_referencias("references ", "references ".$profe."_", $miSentenciaEntera);
                    //var_dump($miSentenciaEntera);

                        //EJECUTAMOS LA SENTENCIA
                        $respuesta = $admin->executeCode($miSentenciaEntera.";");
                        //var_dump($respuesta);
                    } elseif(((strtolower(stripos($sentencia_con_minusculas, "drop")))!==FALSE) || ((strtolower(stripos($sentencia_con_minusculas, "alter")))!==FALSE) ){
                        include_once 'ejercicio.php';
                        $ejer = new Ejercicio();
                        $resultado = $ejer->comprobarSiEstaUsada($nuevoNombre);
                        if ($resultado === 0) {
                            //EJECUTAMOS LA SENTENCIA
                            $respuesta = $admin->executeCode($miSentenciaEntera.";");        
                        } else{
                            $respuesta = "No se puede ejecutar porque las tablas están siendo usadas.";
                        }
                    }elseif((strtolower(stripos($sentencia_con_minusculas, "insert")))!==FALSE){
                        //EJECUTAMOS LA SENTENCIA
                        $respuesta = $admin->executeCode($miSentenciaEntera.";");
                    }   
                    if($respuesta !== true){
                        $arrayResultado[$i] = "La sentencia número ".($i+1)." falló. Mensaje: ".$respuesta;
                    }else{
                        $bienEjecutadas++;
                        // $arrayResultado[$i] = $respuesta;
                    }
                    
                }else{
                    $arrayResultado[$i] = "La sentencia número ". ($i+1) ." no tiene una sintaxis correcta.";
                }
                $i = $i+1;
            }

            $admin->updateTablasDisponibles($profe);
            if($bienEjecutadas === $contador){
                $arrayResultado = "";
                unset($_SESSION['guardarDatosTablas']);
            }else{
                foreach ($arrayResultado as $key => $value) {
                    //var_dump($value);
                    $recorte = explode(";", $value); //recortamos el error que devuelve phpmyadmin
                    $arrayResultado[$key] = $recorte[0];
                    
                }
            }
        }else{
            $arrayResultado = "La sentencia debe terminar en ';'";
        }
        
        return $arrayResultado;
    }

}