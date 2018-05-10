<?php
include_once 'functions.php';

class Administrar_schema{

    //Ejecutar codigo
    function executeCode($code){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
            
        if (!($resultado = mysqli_query($conexion, "CALL sp_ejecutar_script('".$code."');"))) {
            echo "Falló la llamada para ejecutar el codigo: " . $conexion->error;
        }
        
        // echo $conexion->error;
        $connect->disconnectDB($conexion);
        return $resultado;
    }

    function updateTablasDisponibles($profe){
        $nombre_todas_tablas_profe = array();
        $nombre_tablas_antiguas = array();
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.tables WHERE TABLE_SCHEMA='tfg17sql' AND TABLE_NAME LIKE '".$profe."_%';";

        $array = $connect->getArraySQL($sql);
        for($i = 0; $i<count($array); $i++) {
            $nombre_todas_tablas_profe[$i] = $array[$i][0];
        }
        $sql2 = "SELECT nombre FROM tablas_disponibles WHERE schema_prof = '".$profe."';";
        $array2 = $connect->getArraySQL($sql2);
        if(!empty($array2) ){
            for($i = 0; $i<count($array2); $i++) {
                $nombre_tablas_antiguas[$i] = $array2[$i][0];
            }
        }

        $nuevos_nombres = array_diff($nombre_todas_tablas_profe, $nombre_tablas_antiguas);

        foreach ($nuevos_nombres as $key=>$value) {
            if($value !==""){
                $sql = "INSERT INTO tablas_disponibles(nombre, schema_prof) VALUES ('".$value."','".$profe."');";
                 if(!($consulta = mysqli_query($conexion,$sql))){
                    echo "Falló la llamada para insertar en tablas_disponibles: ".$conexion->error;
                }
            }
        }

        // echo $conexion->error;
        $connect->disconnectDB($conexion);
        // return $resultado;
    }

    function obtenerSentencias($contenido, $profe){
        $admin = new Administrar_schema();
        $sentencias = explode(";", $contenido);
        $contador = count($sentencias) - 1;
        
        for ($j = 0; $j < $contador; $j++) {
            $sentencias[$j] = trim($sentencias[$j]);
        }        
        $i = 0;
        $arrayResultado = array($contador);
        $subsentencia = array();
        while ($i < $contador ) {

            $subsentencia = explode(" ", $sentencias[$i], 4);

            $arrayComillas = array("`", '"', "'");
            $nombreTabla_sinComillas = str_replace($arrayComillas, "", $subsentencia[2]);

            if(((strcmp(strtoupper($subsentencia[0]." ".$subsentencia[1]), "CREATE TABLE"))===0) || ((strcmp(strtoupper($subsentencia[0]." ".$subsentencia[1]), "INSERT INTO"))===0)){
                 $arrayResultado[$i] = $admin->executeCode($subsentencia[0]." ".$subsentencia[1]." ".$profe."_".$nombreTabla_sinComillas." ".$subsentencia[3].";");
            }else{
                $arrayResultado[$i] = "No se ha podido ejecutar la sentencia numero: ".$i;
            }
            $i = $i+1;
        }

        $admin->updateTablasDisponibles($profe);

        return $arrayResultado;
    }

}