<?php
include_once 'functions.php';

class HojaEjercicio{

  
    function createHoja($user){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "insert into sqlab_hoja_ejercicios (user) 
        values ('".$user."');";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
   
    function deleteHoja($id){

        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "DELETE FROM sqlab_hoja_ejercicios WHERE id_hoja=$id";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getAllHojas(){
    	
        $connect = new Tools();
        $conexion = $connect->connectDB();

    	$sql = "SELECT * FROM sqlab_hoja_ejercicios;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    
    function getAllHojasCreadorASC(){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM sqlab_hoja_ejercicios ORDER BY creador_hoja ASC;";

        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    function getAllHojasCreadorDESC(){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM sqlab_hoja_ejercicios ORDER BY creador_hoja DESC;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getHojaById($id){

        $connect = new Tools();
        $conexion = $connect->connectDB();
    	$sql = "SELECT nombre_hoja FROM sqlab_hoja_ejercicios WHERE id_hoja=$id;";
        $consulta = mysqli_query($conexion,$sql);
        $res = mysqli_fetch_assoc($consulta);
        $connect->disconnectDB($conexion);
        return $res['nombre_hoja'];
    }

	function getHojasByUser($user){

    	$sql = "SELECT * FROM sqlab_hoja_ejercicios WHERE user=$user;";
        $tool = new Tools();
        $array = $tool->getArraySQL($sql);
        return $array;
    }

    function getIdByName($nombre){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT id_hoja FROM sqlab_hoja_ejercicios WHERE id_hoja=$id;";
        $consulta = mysqli_query($conexion,$sql);
        $res = mysqli_fetch_assoc($consulta);
        $connect->disconnectDB($conexion);
        return $res;
    }
    function createHojaAnadirEjercicios($user, $nombre, $ejercicios){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "insert into sqlab_hoja_ejercicios (nombre_hoja, creador_hoja) 
        values ('".$nombre."', '".$user."');";
        $consulta = mysqli_query($conexion,$sql);
        $rs = mysqli_query($conexion,"SELECT MAX(id_hoja) AS id FROM sqlab_hoja_ejercicios");
            if( $row = mysqli_fetch_row($rs)){
                $id = trim($row[0]);
                foreach ($ejercicios as $key => $value) {
                    $sql2 = "insert into sqlab_esta_contenido (id_ejercicio, id_hoja, orden) values ('".$value."','".$id."','".($key + 1)."');";
                    $consulta2 = mysqli_query($conexion,$sql2);
                    if(!($consulta2)){ 
                        echo $conexion->error;
                    }
                }
            }
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    
    function getExistHoja($nombre){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "select count(nombre_hoja) as num from sqlab_hoja_ejercicios where nombre_hoja='.$nombre.'";
        $consulta = mysqli_query($conexion,$sql);       
        $count = mysqli_fetch_array($consulta);
        $connect->disconnectDB($conexion);
        return $count;
    }

    function getHojasYEjerciciosById($id){

        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM sqlab_hoja_ejercicios he, sqlab_esta_contenido ec, sqlab_ejercicio e WHERE e.id_ejercicio = ec.id_ejercicio AND he.id_hoja = ec.id_hoja AND he.id_hoja=$id ORDER BY ec.orden;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function deleteEjercicioDeHoja($id_hoja, $id_ejercicio){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "DELETE FROM sqlab_esta_contenido WHERE id_ejercicio = $id_ejercicio AND id_hoja = $id_hoja;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getTodosIdEjerDeHoja($id_hoja){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT id_ejercicio FROM sqlab_esta_contenido WHERE id_hoja = $id_hoja;";
        $consulta = mysqli_query($conexion,$sql);
        $seleccionados = array();
        while($row = mysqli_fetch_row($consulta) ){
            array_push($seleccionados, intval($row[0]));
        }
        $connect->disconnectDB($conexion);
        return $seleccionados;
    }
    function setNuevosEjerciciosAHoja($id_hoja, $seleccionados){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $ok = true;;
        $rs = mysqli_query($conexion,"SELECT MAX(orden) AS id FROM sqlab_esta_contenido WHERE id_hoja = $id_hoja");
       
        if( $row = mysqli_fetch_row($rs)){
            $orden = intval($row[0]);
            foreach ($seleccionados as $key => $value) {
                
                $sql2 = "insert into sqlab_esta_contenido (id_ejercicio, id_hoja, orden) values ('".$value."','".$id_hoja."','".$orden."');";
                $consulta2 = mysqli_query($conexion,$sql2);
                if(!($consulta2)){ 
                    $ok = false;
                }
                $orden++;
            }
        }
        $connect->disconnectDB($conexion);
        return $ok;
    }
}